<?php
/**
 * FJDF – PDF-Spendenquittung als E-Mail-Anhang
 *
 * Erzeugt bei jeder abgeschlossenen Spende eine PDF-Quittung und hängt sie
 * direkt an die GiveWP-Spendenquittungs-Mail an. Kein öffentlicher Endpunkt,
 * kein Donor Dashboard nötig.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class FJDF_PDF_Receipt {

	/** @var int|null Payment-ID, zwischengespeichert für den aktuellen Request */
	private static $current_payment_id = null;

	public static function init() {
		add_action( 'give_complete_donation', array( __CLASS__, 'remember_payment_id' ), 1 );
		add_filter( 'give_donation-receipt_get_email_attachments', array( __CLASS__, 'attach_pdf' ), 10, 3 );
	}

	public static function remember_payment_id( $payment_id ) {
		self::$current_payment_id = (int) $payment_id;
	}

	public static function attach_pdf( $attachments, $email_notification, $form_id ) {
		$payment_id = self::$current_payment_id;

		if ( empty( $payment_id ) ) {
			return $attachments;
		}

		try {
			$pdf_path = self::generate_pdf( $payment_id );

			if ( $pdf_path ) {
				$attachments[] = $pdf_path;
			}
		} catch ( \Throwable $e ) {
			// PDF-Erzeugung darf den Spendenvorgang niemals zum Scheitern bringen.
			error_log( sprintf(
				'FJDF PDF Receipt: PDF-Erzeugung für Payment #%d fehlgeschlagen: %s',
				$payment_id,
				$e->getMessage()
			) );
		}

		return $attachments;
	}

	private static function generate_pdf( $payment_id ) {
		if ( ! class_exists( 'Dompdf\Dompdf' ) ) {
			require_once MEDIALAB_PROJECT_PATH . 'vendor/autoload.php';
		}

		$payment = new Give_Payment( $payment_id );

		$upload_dir  = wp_upload_dir();
		$receipt_dir = trailingslashit( $upload_dir['basedir'] ) . 'fjdf-receipts';

		if ( ! file_exists( $receipt_dir ) ) {
			wp_mkdir_p( $receipt_dir );
			file_put_contents( $receipt_dir . '/.htaccess', "Deny from all\n" );
			file_put_contents( $receipt_dir . '/index.php', "<?php // Silence is golden.\n" );
		}

		$filepath = trailingslashit( $receipt_dir ) . sprintf( 'spendenquittung-%d.pdf', $payment_id );

		if ( file_exists( $filepath ) ) {
			return $filepath;
		}

		$options = new Dompdf\Options();
		$options->setChroot( ABSPATH );        // erlaubt lokale Dateizugriffe innerhalb des WP-Root
		$options->setIsRemoteEnabled( false ); // Remote-URLs bleiben bewusst gesperrt

		$dompdf = new Dompdf\Dompdf( $options );
		$dompdf->loadHtml( self::render_html( $payment ), 'UTF-8' );
		$dompdf->setPaper( 'A4', 'portrait' );
		$dompdf->render();

		file_put_contents( $filepath, $dompdf->output() );

		return $filepath;
	}

	/**
	 * Liest eine SVG-Datei ein und gibt reines <svg>-Markup zurück,
	 * damit dompdf es inline rendern kann (statt über <img src="file://...">).
	 */
	private static function get_inline_svg( $path ) {
		if ( ! file_exists( $path ) ) {
			return '';
		}

		$svg = file_get_contents( $path );
		$svg = preg_replace( '/<\?xml.*?\?>/', '', $svg );
		$svg = preg_replace( '/<!--.*?-->/s', '', $svg );

		return trim( $svg );
	}

	/**
	 * Übersetzungen für die feste Beschriftung der Quittung.
	 */
	private static function get_translations( $lang ) {
		$strings = array(
			'de' => array(
				'title'      => 'Spendenquittung',
				'intro'      => 'Vielen Dank für Ihre Großzügigkeit.',
				'donor'      => 'Spender',
				'company'    => 'Unternehmen',
				'donation'   => 'Spende',
				'frequency' => 'Häufigkeit',
				'frequency_onetime' => 'Einmalig',
				'date'       => 'Spendendatum',
				'amount'     => 'Summe',
				'method'     => 'Zahlungsart',
				'payment_id' => 'Zahlungs-ID',
			),
			'en' => array(
				'title'      => 'Donation Receipt',
				'intro'      => 'Thank you for your generosity.',
				'donor'      => 'Donor',
				'company'    => 'Company',
				'donation'   => 'Donation',
				'frequency' => 'Frequency',
				'frequency_onetime' => 'One-time',	
				'date'       => 'Donation Date',
				'amount'     => 'Amount',
				'method'     => 'Payment Method',
				'payment_id' => 'Payment ID',
			),
			'es' => array(
				'title'      => 'Recibo de donación',
				'intro'      => 'Gracias por tu generosidad.',
				'donor'      => 'Donante',
				'company'    => 'Empresa',
				'donation'   => 'Donación',
				'frequency' => 'Frecuencia',
				'frequency_onetime' => 'Único',
				'date'       => 'Fecha de donación',
				'amount'     => 'Importe',
				'method'     => 'Método de pago',
				'payment_id' => 'ID de pago',
			),
		);

		return isset( $strings[ $lang ] ) ? $strings[ $lang ] : $strings['de'];
	}

	/**
	 * Ermittelt das WP-Locale (z. B. "de_AT") anhand der Sprache
	 * des verwendeten Spendenformulars.
	 */
	private static function get_locale_for_payment( Give_Payment $payment ) {
		if ( function_exists( 'pll_get_post_language' ) && ! empty( $payment->form_id ) ) {
			$locale = pll_get_post_language( $payment->form_id, 'locale' );
			if ( $locale ) {
				return $locale;
			}
		}

		return get_locale();
	}

	private static function render_html( Give_Payment $payment ) {
		$locale = self::get_locale_for_payment( $payment );
		$lang   = substr( $locale, 0, 2 );
		$t      = self::get_translations( $lang );

		// Für Datum & Zahlungsart (z. B. Gateway-Label) kurz auf das
		// passende Locale umschalten, damit GiveWP-eigene Strings mitziehen.
		$switched = switch_to_locale( $locale );

		$donor_name = trim( $payment->first_name . ' ' . $payment->last_name );
		$company    = give_get_meta( $payment->ID, '_give_donation_company', true );
		$amount     = give_currency_filter( give_format_amount( $payment->total ) );
		$date       = date_i18n( get_option( 'date_format' ), strtotime( $payment->date ) );
		$method     = give_get_gateway_checkout_label( $payment->gateway );

		if ( $switched ) {
			restore_previous_locale();
		}

		$upload_dir = wp_upload_dir();
		$logo_path  = trailingslashit( $upload_dir['basedir'] ) . '2026/04/Logo_Friends-of-Juan-Diego-Florez-gray.png';
		$logo_src   = self::get_image_data_uri( $logo_path );

		ob_start();
		?>
		<html>
		<head>
			<style>
				body {
					font-family: "Aribau Grotesk", Arial, sans-serif;
					font-size: 12px;
					color: #1c2340;
					margin: 0;
					padding: 0;
				}
				.header {
					height: 80px;
					border-bottom: 3px solid #e05428;
					padding: 20px 0 18px;
					margin-bottom: 28px;
					overflow: hidden;
				}
				.header .logo { float: left; height: 70px; }
				.header .logo img { height: 70px; width: auto; }
				.header .org-address {
					float: right;
					text-align: right;
					font-size: 10px;
					line-height: 1.5;
				}
				h1 {
					font-family: "Larken", Georgia, serif;
					font-size: 22px;
					margin: 0 0 4px;
					clear: both;
				}
				.intro { font-size: 12px; margin-bottom: 20px; }
				table { width: 100%; border-collapse: collapse; }
				td { padding: 8px 0; border-bottom: 1px solid #e5e0d8; }
				td.label { font-weight: bold; width: 40%; color: #1c2340; }
				tr.highlight td { background-color: #f3f0ea; font-weight: bold; }
				.footer {
					margin-top: 32px;
					padding-top: 16px;
					border-top: 1px solid #e5e0d8;
					font-size: 10px;
					color: #6b6b6b;
				}
			</style>
		</head>
		<body>
			<div class="header">
				<?php if ( $logo_src ) : ?>
					<div class="logo"><img src="<?php echo esc_attr( $logo_src ); ?>" alt="Friends of Juan Diego Flórez"></div>
				<?php endif; ?>
				<div class="org-address">
					Friends of Juan Diego Flórez Association<br>
					Alberichgasse 2<br>
					1150 Vienna<br>
					Austria
				</div>
			</div>

			<h1><?php echo esc_html( $t['title'] ); ?></h1>
			<p class="intro"><?php echo esc_html( $t['intro'] ); ?></p>

			<table>
				<tr><td class="label"><?php echo esc_html( $t['donor'] ); ?></td><td><?php echo esc_html( $donor_name ); ?></td></tr>
				<?php if ( ! empty( $company ) ) : ?>
				<tr><td class="label"><?php echo esc_html( $t['company'] ); ?></td><td><?php echo esc_html( $company ); ?></td></tr>
				<?php endif; ?>
				<tr><td class="label"><?php echo esc_html( $t['donation'] ); ?></td><td><?php echo esc_html( $payment->form_title ); ?></td></tr>
				<tr><td class="label"><?php echo esc_html( $t['frequency'] ); ?></td><td><?php echo esc_html( $t['frequency_onetime'] ); ?></td></tr>
				<tr><td class="label"><?php echo esc_html( $t['date'] ); ?></td><td><?php echo esc_html( $date ); ?></td></tr>
				<tr class="highlight"><td class="label"><?php echo esc_html( $t['amount'] ); ?></td><td><?php echo esc_html( $amount ); ?></td></tr>
				<tr><td class="label"><?php echo esc_html( $t['method'] ); ?></td><td><?php echo esc_html( $method ); ?></td></tr>
				<tr><td class="label"><?php echo esc_html( $t['payment_id'] ); ?></td><td><?php echo esc_html( $payment->ID ); ?></td></tr>
			</table>

			<div class="footer">
				Friends of Juan Diego Flórez Association &middot; Alberichgasse 2 &middot; 1150 Vienna &middot; Austria
			</div>
		</body>
		</html>
		<?php
		return ob_get_clean();
	}

	/**
	 * Liest eine Bilddatei ein und gibt sie als Data-URI zurück.
	 * Vermeidet dateipfad-basierten Zugriff, den ImageMagick-Policies
	 * auf manchen Hosting-Umgebungen blockieren.
	 */
	private static function get_image_data_uri( $path ) {
		if ( ! file_exists( $path ) ) {
			return '';
		}

		$data = file_get_contents( $path );

		if ( false === $data ) {
			return '';
		}

		$mime = function_exists( 'mime_content_type' ) ? mime_content_type( $path ) : 'image/png';

		return 'data:' . $mime . ';base64,' . base64_encode( $data );
	}
	
}

FJDF_PDF_Receipt::init();