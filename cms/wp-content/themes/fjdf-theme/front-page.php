<?php
/**
 * FJDF — front-page.php
 * Homepage Template
 *
 * Sektionen:
 *  1. Hero
 *  2. Stats-Leiste
 *  3. Nosotros-Teaser
 *  4. Qué Hacemos-Teaser
 *  5. Impact Stats
 *  6. Testimonials
 *  7. Con tu donación (Beiträge)
 *  8. Donation CTA
 *  9. Partner Logos
 * 10. News Preview
 * 11. Newsletter
 *
 * @package fjdf
 */

get_header();
?>

<main id="main" class="site-main home-page">

	<?php /* ================================================================
	   1. HERO
	   ================================================================ */ ?>
	<?php
	$hero_image      = fjdf_field( 'fjdf_hero_image', 6 );
	$hero_person_image = fjdf_field( 'fjdf_hero_person_image', 6 );
	$hero_headline   = fjdf_field( 'fjdf_hero_headline', 6, __( 'Lass die Träume der Kinder in Peru wahr werden', 'fjdf' ) );
	$hero_subtext    = fjdf_field( 'fjdf_hero_subtext', 6 );
	$hero_cta_label  = fjdf_field( 'fjdf_hero_cta_label', 6, __( 'Jetzt spenden', 'fjdf' ) );
	$hero_cta_url    = fjdf_field( 'fjdf_hero_cta_url', 6 );
	$hero_scroll     = fjdf_field( 'fjdf_hero_scroll_label', 6, __( 'Scrollen', 'fjdf' ) );
	?>
	<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'fjdf' ); ?>">
		<?php if ( ! empty( $hero_image['id'] ) ) : ?>
			<div class="hero__bg" aria-hidden="true">
				<?php
				$_url    = $hero_image["url"] ?? "";
				$_srcset = wp_get_attachment_image_srcset( $hero_image["id"], "fjdf-hero" );
				$_sizes  = wp_get_attachment_image_sizes( $hero_image["id"], "fjdf-hero" );
				?>
				<img src="<?php echo esc_url( $_url ); ?>"
					class="hero__bg-img"
					alt=""
					loading="eager"
					fetchpriority="high"
					<?php if ( $_srcset ) echo 'srcset="' . esc_attr( $_srcset ) . '"'?>
					<?php if ( $_sizes ) echo ' sizes="' . esc_attr( $_sizes ) . '"'?>>
			</div>
		<?php endif; ?>

		<div class="hero__overlay" aria-hidden="true"></div>

		<div class="container hero__content<?php echo ! empty( $hero_person_image['id'] ) ? ' hero__content--split' : ''; ?>">
			<?php if ( ! empty( $hero_person_image['id'] ) ) : ?>
				<div class="hero__person" aria-hidden="true">
					<?php echo wp_get_attachment_image( $hero_person_image['id'], 'large', false, [ 'class' => 'hero__person-img', 'loading' => 'eager', 'alt' => '' ] ); ?>
				</div>
			<?php endif; ?>
			<div class="hero__text">
				<h1 class="hero__headline"><?php echo wp_kses_post( $hero_headline ); ?></h1>

				<?php if ( $hero_subtext ) : ?>
					<p class="hero__subtext"><?php echo esc_html( $hero_subtext ); ?></p>
				<?php endif; ?>

				<?php if ( $hero_cta_url ) : ?>
					<a href="<?php echo esc_url( $hero_cta_url ); ?>" class="btn btn--primary hero__cta">
						<?php echo esc_html( $hero_cta_label ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $hero_scroll ) : ?>
					<a href="#about" class="hero__scroll" aria-hidden="true">
						<span><?php echo esc_html( $hero_scroll ); ?></span>
						<span class="hero__scroll-arrow">↓</span>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php /* ================================================================
	   2. STATS-LEISTE
	   ================================================================ */ ?>
	<?php $stats_bar = fjdf_field( 'fjdf_stats_bar', 6 ); ?>
	<?php /* ================================================================
	   3. NOSOTROS-TEASER
	   ================================================================ */ ?>
	<?php
	$about_label   = fjdf_field( 'fjdf_about_label', 6, 'ÜBER UNS' );
	$about_head    = fjdf_field( 'fjdf_about_headline', 6, __( 'Partner für Wandel durch Musik', 'fjdf' ) );
	$about_text    = fjdf_field( 'fjdf_about_text', 6 );
	$about_cta_l   = fjdf_field( 'fjdf_about_cta_label', 6, __( 'Mehr erfahren', 'fjdf' ) );
	$about_cta_u   = fjdf_field( 'fjdf_about_cta_url', 6 );
	$about_image   = fjdf_field( 'fjdf_about_image', 6 );
	?>
	<section class="about-teaser section" id="about">
		<div class="container about-teaser__inner">
			<div class="about-teaser__content">
				<p class="about-teaser__label category-label"><?php echo esc_html( $about_label ); ?></p>
				<h2 class="about-teaser__headline"><?php echo esc_html( $about_head ); ?></h2>
				<?php if ( $about_text ) : ?>
					<p class="about-teaser__text"><?php echo esc_html( $about_text ); ?></p>
				<?php endif; ?>
				<?php if ( $about_cta_u ) : ?>
					<a href="<?php echo esc_url( $about_cta_u ); ?>" class="btn btn--primary">
						<?php echo esc_html( $about_cta_l ); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $about_image['id'] ) ) : ?>
				<div class="about-teaser__image">
					<?php echo fjdf_image( $about_image, 'fjdf-portrait', 'about-teaser__img' ); ?>
				</div>
			<?php endif; ?>
		</div>
        <?php if ( ! empty( $stats_bar ) ) : ?>
		<section class="stats-slider" aria-label="<?php esc_attr_e( 'Kennzahlen', 'fjdf' ); ?>">
			<div class="container">
				<div class="swiper js-stats-slider">
					<div class="swiper-wrapper">
						<?php foreach ( $stats_bar as $stat ) : ?>
							<div class="swiper-slide">
								<div class="stats-slider__item">
									<?php if ( ! empty( $stat['icon']['id'] ) ) : ?>
										<div class="stats-slider__icon" aria-hidden="true">
											<?php echo wp_get_attachment_image( $stat['icon']['id'], 'medium', false, [ 'alt' => '' ] ); ?>
										</div>
									<?php endif; ?>
									<div class="stats-slider__text">
										<strong class="stats-slider__number"><?php echo esc_html( $stat['number'] ); ?></strong>
										<span class="stats-slider__label"><?php echo esc_html( $stat['label'] ); ?></span>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<!-- Pagination INNERHALB des swiper-Elements: -->
					<div class="swiper-pagination js-stats-pagination"></div>
				</div>
			</div>
		</section>
		<?php endif; ?>

	</section>

	<?php /* ================================================================
	   4. QUÉ HACEMOS-TEASER
	   ================================================================ */ ?>
	<?php
	$what_label  = fjdf_field( 'fjdf_what_label', 6, 'WAS WIR TUN' );
	$what_head   = fjdf_field( 'fjdf_what_headline', 6, __( 'Wir verändern Leben durch Musik', 'fjdf' ) );
	$what_text   = fjdf_field( 'fjdf_what_text', 6 );
	$what_cta_l  = fjdf_field( 'fjdf_what_cta_label', 6, __( 'Unser Einfluss', 'fjdf' ) );
	$what_cta_u  = fjdf_field( 'fjdf_what_cta_url', 6 );
	$what_image  = fjdf_field( 'fjdf_what_image', 6 );
	?>
	<section class="what-teaser section bg-cream-dark">
		<div class="container what-teaser__inner">
			<?php if ( ! empty( $what_image['id'] ) ) : ?>
				<div class="what-teaser__image">
					<?php
					$what_img_url = ! empty( $what_image['url'] ) ? $what_image['url'] : wp_get_attachment_url( $what_image['id'] );
					$what_img_alt = ! empty( $what_image['alt'] ) ? esc_attr( $what_image['alt'] ) : '';
					?>
					<img src="<?php echo esc_url( $what_img_url ); ?>" class="what-teaser__img" alt="<?php echo $what_img_alt; ?>" loading="lazy">
				</div>
			<?php endif; ?>

			<div class="what-teaser__content">
				<p class="what-teaser__label category-label"><?php echo esc_html( $what_label ); ?></p>
				<h2 class="what-teaser__headline"><?php echo esc_html( $what_head ); ?></h2>
				<?php if ( $what_text ) : ?>
					<p class="what-teaser__text"><?php echo esc_html( $what_text ); ?></p>
				<?php endif; ?>
				<?php if ( $what_cta_u ) : ?>
					<a href="<?php echo esc_url( $what_cta_u ); ?>" class="btn btn--primary">
						<?php echo esc_html( $what_cta_l ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php /* ================================================================
	   5. IMPACT STATS — 3 Tabs with separate stats + portrait
	   ================================================================ */ ?>
	<?php
	$impact_label   = fjdf_field( 'fjdf_impact_label', 6, __( 'SOZIALER EINFLUSS', 'fjdf' ) );
	$impact_head    = fjdf_field( 'fjdf_impact_headline', 6, __( 'Wirkungsindikatoren und erzielte Ergebnisse', 'fjdf' ) );
	$impact_sub     = fjdf_field( 'fjdf_impact_subtext', 6 );
	$impact_portrait = fjdf_field( 'fjdf_impact_portrait', 6 );
	$tab1_label     = fjdf_field( 'fjdf_impact_tab1_label', 6, __( 'Persönlich', 'fjdf' ) );
	$tab2_label     = fjdf_field( 'fjdf_impact_tab2_label', 6, __( 'Bildung', 'fjdf' ) );
	$tab3_label     = fjdf_field( 'fjdf_impact_tab3_label', 6, __( 'Familie', 'fjdf' ) );
	$stats_ind      = fjdf_field( 'fjdf_impact_stats_individual', 6, [] );
	$stats_edu      = fjdf_field( 'fjdf_impact_stats_educational', 6, [] );
	$stats_fam      = fjdf_field( 'fjdf_impact_stats_family', 6, [] );

	// Fallback: if no per-tab stats exist yet, use the old generic field
	$stats_fallback = fjdf_field( 'fjdf_impact_stats', 6, [] );
	if ( empty( $stats_ind ) ) $stats_ind = $stats_fallback;
	if ( empty( $stats_edu ) ) $stats_edu = $stats_fallback;
	if ( empty( $stats_fam ) ) $stats_fam = $stats_fallback;

	$all_tabs = [
		[ 'label' => $tab1_label, 'stats' => $stats_ind ],
		[ 'label' => $tab2_label, 'stats' => $stats_edu ],
		[ 'label' => $tab3_label, 'stats' => $stats_fam ],
	];
	?>

	<?php if ( ! empty( $stats_ind ) || ! empty( $stats_fallback ) ) : ?>
		<section class="impact-section section" id="impacto">
			<div class="container">

				<?php if ( $impact_label ) : ?>
					<p class="impact-section__label category-label u-text-center"><?php echo esc_html( $impact_label ); ?></p>
				<?php endif; ?>

				<?php if ( $impact_head ) : ?>
					<h2 class="impact-section__headline"><?php echo esc_html( $impact_head ); ?></h2>
				<?php endif; ?>

				<?php if ( $impact_sub ) : ?>
					<p class="impact-section__subtext"><?php echo esc_html( $impact_sub ); ?></p>
				<?php endif; ?>

				<!-- Tab Buttons -->
				<div class="impact-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Impact-Kategorien', 'fjdf' ); ?>">
					<?php foreach ( $all_tabs as $i => $tab ) : ?>
						<button class="impact-tabs__btn <?php echo $i === 0 ? 'is-active' : ''; ?>"
								role="tab"
								id="impact-tab-<?php echo esc_attr( $i ); ?>"
								aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
								aria-controls="impact-panel-<?php echo esc_attr( $i ); ?>">
							<?php echo esc_html( $tab['label'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>

				<!-- Tab Panels: Portrait + Stats side by side -->
				<?php foreach ( $all_tabs as $i => $tab ) : ?>
					<div class="impact-tabpanel impact-split <?php echo $i === 0 ? 'is-active' : ''; ?>"
						 role="tabpanel"
						 id="impact-panel-<?php echo esc_attr( $i ); ?>"
						 aria-labelledby="impact-tab-<?php echo esc_attr( $i ); ?>"
						 <?php echo $i !== 0 ? 'hidden' : ''; ?>>

						<?php if ( ! empty( $impact_portrait['id'] ) ) : ?>
							<div class="impact-split__image">
								<?php echo wp_get_attachment_image( $impact_portrait['id'], 'fjdf-portrait', false, [
									'class'   => 'impact-split__img',
									'loading' => 'lazy',
									'alt'     => '',
								] ); ?>
							</div>
						<?php endif; ?>

						<div class="impact-split__stats impact-stats__grid">
							<?php foreach ( $tab['stats'] as $stat ) : ?>
								<div class="impact-stat">
									<strong class="impact-stat__value"><?php echo esc_html( $stat['value'] ); ?></strong>
									<p class="impact-stat__text"><?php echo esc_html( $stat['text'] ); ?></p>
								</div>
							<?php endforeach; ?>
						</div>

					</div>
				<?php endforeach; ?>

			</div>
		</section>
	<?php endif; ?>

<?php /* ================================================================
	   6. TESTIMONIALS
	   ================================================================ */ ?>
	<?php fjdf_video_testimonial( 6 ); ?>


        <?php /* ================================================================
        <?php /* ================================================================
           7b. CONTRIBUTION ITEMS (Flip Cards)
           ================================================================ */ ?>
        <?php
        $contrib_label = get_field( 'fjdf_what_contrib_label', 8 );
        $contrib_head  = get_field( 'fjdf_what_contrib_headline', 8 );
        $contrib_items = get_field( 'fjdf_what_contrib_items', 8 );
        $back_texts    = get_option( 'fjdf_contrib_back_texts', [] );
        ?>
        <?php if ( ! empty( $contrib_items ) ) : ?>
                <section class="contrib-section section">
                        <div class="container">
                                <?php if ( $contrib_label ) : ?>
                                        <p class="contrib-section__label category-label u-text-center"><?php echo esc_html( $contrib_label ); ?></p>
                                <?php endif; ?>
                                <?php if ( $contrib_head ) : ?>
                                        <h2 class="contrib-section__headline"><?php echo esc_html( $contrib_head ); ?></h2>
                                <?php endif; ?>
                                <div class="contrib-section__grid">
                                        <?php foreach ( $contrib_items as $i => $item ) :
                                                $back_text = $back_texts[ $i ] ?? '';
                                        ?>
                                                <div class="contrib-card">
                                                        <div class="contrib-card__inner">
                                                                <div class="contrib-card__front">
                                                                        <?php if ( ! empty( $item['image']['id'] ) ) : ?>
                                                                                <div class="contrib-card__image">
                                                                                        <?php echo wp_get_attachment_image( $item['image']['id'], 'large', false, [ 'loading' => 'lazy', 'alt' => '' ] ); ?>
                                                                                </div>
                                                                        <?php endif; ?>
                                                                        <p class="contrib-card__text"><?php echo esc_html( $item['text'] ); ?></p>
                                                                </div>
                                                                <?php if ( $back_text ) : ?>
                                                                        <div class="contrib-card__back">
                                                                                <p class="contrib-card__back-text"><?php echo esc_html( $back_text ); ?></p>
                                                                        </div>
                                                                <?php endif; ?>
                                                        </div>
                                                </div>
                                        <?php endforeach; ?>
                                </div>
                        </div>
                </section>
        <?php endif; ?>

        <?php /* ================================================================
           7. DONATION CTA BLOCK
	   ================================================================ */ ?>
	<?php fjdf_donation_cta(); ?>

	<?php /* ================================================================
	   8. PARTNER LOGOS
	   ================================================================ */ ?>
	<?php fjdf_partner_logos( 'partners section--sm' ); ?>

	<?php /* ================================================================
	   9. NEWS PREVIEW
	   ================================================================ */ ?>
	<?php
	$news_query = fjdf_get_news( 3 );
	if ( $news_query->have_posts() ) :
	?>
		<section class="news-preview section" aria-label="<?php esc_attr_e( 'Neuigkeiten & Aktuelles', 'fjdf' ); ?>">
			<div class="container">
				<div class="news-preview__header">
					<h2 class="news-preview__headline"><?php esc_html_e( 'Neuigkeiten & Aktuelles', 'fjdf' ); ?></h2>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>" class="news-preview__all btn btn--outline">
						<?php esc_html_e( 'Alle Neuigkeiten', 'fjdf' ); ?>
					</a>
				</div>

				<div class="news-preview__grid">
					<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
						<?php fjdf_news_card( get_the_ID() ); ?>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php /* ================================================================
	  10. NEWSLETTER
	   ================================================================ */ ?>
	<?php fjdf_newsletter_section(); ?>

</main>

<?php get_footer(); ?>
