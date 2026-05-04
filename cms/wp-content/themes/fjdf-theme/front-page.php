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
	$hero_headline   = fjdf_field( 'fjdf_hero_headline', 6, __( 'Lass die Träume der Kinder in Peru wahr werden', 'fjdf' ) );
	$hero_subtext    = fjdf_field( 'fjdf_hero_subtext', 6 );
	$hero_cta_label  = fjdf_field( 'fjdf_hero_cta_label', 6, __( 'Jetzt spenden', 'fjdf' ) );
	$hero_cta_url    = fjdf_field( 'fjdf_hero_cta_url', 6 );
	$hero_scroll     = fjdf_field( 'fjdf_hero_scroll_label', 6, __( 'Scrollen', 'fjdf' ) );
	?>
	<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'fjdf' ); ?>">
		<?php if ( ! empty( $hero_image['id'] ) ) : ?>
			<div class="hero__bg" aria-hidden="true">
				<?php echo wp_get_attachment_image( $hero_image['id'], 'fjdf-hero', false, [
					'class'   => 'hero__bg-img',
					'loading' => 'eager',
					'fetchpriority' => 'high',
					'alt'     => '',
				] ); ?>
			</div>
		<?php endif; ?>

		<div class="hero__overlay" aria-hidden="true"></div>

		<div class="container hero__content">
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
				</div>
				<div class="swiper-pagination js-stats-pagination"></div>
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
	<?php
	$test_label    = fjdf_field( 'fjdf_testimonial_label',    6, 'ZEUGNIS' );
	$test_headline = fjdf_field( 'fjdf_testimonial_headline', 6, __( 'Erfahren Sie mehr über die Erlebnisse unserer Begünstigten', 'fjdf' ) );
	$testimonials  = fjdf_field( 'fjdf_testimonials',         6, [] );
	$video_id      = get_post_meta( 6, 'fjdf_testimonial_video_id', true ) ?: '30lFwLSgJHo';
	$video_thumb   = get_field( 'fjdf_testimonial_video_thumb', 6 );
	$first         = ! empty( $testimonials ) ? $testimonials[0] : null;
	?>
	<section class="testimonials-new section bg-white">
		<div class="container testimonials-new__inner">

			<?php if ( $test_label ) : ?>
				<p class="testimonials-new__label category-label u-text-center"><?php echo esc_html( $test_label ); ?></p>
			<?php endif; ?>

			<?php if ( $test_headline ) : ?>
				<h2 class="testimonials-new__headline"><?php echo esc_html( $test_headline ); ?></h2>
			<?php endif; ?>

			<?php if ( $first && ! empty( $first['quote'] ) ) : ?>
				<blockquote class="testimonials-new__quote">
					<p><?php echo esc_html( $first['quote'] ); ?></p>
					<footer>
						<cite class="testimonials-new__cite">
							— <?php echo esc_html( $first['name'] ); ?><?php if ( ! empty( $first['origin'] ) ) : ?>, <?php echo esc_html( $first['origin'] ); ?><?php endif; ?>
						</cite>
					</footer>
				</blockquote>
			<?php endif; ?>

		</div>

		<?php if ( $video_id ) : ?>
			<div class="testimonials-new__video-wrap">
				<button class="testimonials-new__video-thumb"
				        data-modal-trigger="video-modal-testimonial"
				        aria-label="<?php esc_attr_e( 'Video abspielen', 'fjdf' ); ?>">
					<img class="testimonials-new__video-img"
					     src="<?php echo ! empty( $video_thumb['url'] ) ? esc_url( $video_thumb['url'] ) : 'https://img.youtube.com/vi/' . esc_attr( $video_id ) . '/maxresdefault.jpg'; ?>"
					     alt="<?php echo ! empty( $video_thumb['alt'] ) ? esc_attr( $video_thumb['alt'] ) : esc_attr__( 'Video Vorschaubild', 'fjdf' ); ?>"
					     loading="lazy">
					<div class="testimonials-new__play" aria-hidden="true">
						<svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
							<circle cx="30" cy="30" r="30" fill="rgba(245,162,0,0.9)"/>
							<polygon points="24,18 24,42 44,30" fill="white"/>
						</svg>
					</div>
				</button>
			</div>

			<!-- Video Modal -->
			<div class="modal modal--lg" id="video-modal-testimonial" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Video', 'fjdf' ); ?>" aria-hidden="true">
				<div class="modal__overlay" data-modal-close></div>
				<div class="modal__dialog modal__dialog--video">
					<button class="modal__close" data-modal-close aria-label="<?php esc_attr_e( 'Schließen', 'fjdf' ); ?>">&times;</button>
					<div class="modal__video-wrap">
						<iframe width="100%" height="100%"
						        src=""
						        data-src="https://www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autoplay=1&rel=0&modestbranding=1"
						        title="<?php esc_attr_e( 'Zeugnis Video', 'fjdf' ); ?>"
						        frameborder="0"
						        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						        allowfullscreen></iframe>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</section>


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
	<?php
	$cta_head    = fjdf_field( 'fjdf_cta_headline', 6, __( 'Spenden und mitmachen', 'fjdf' ) );
	$cta_text    = fjdf_field( 'fjdf_cta_text', 6 );
	$cta_btn_l   = fjdf_field( 'fjdf_cta_button_label', 6, __( 'Jetzt spenden', 'fjdf' ) );
	$cta_btn_u   = fjdf_field( 'fjdf_cta_button_url', 6 );
	$cta_note    = fjdf_field( 'fjdf_cta_note', 6 );
	$cta_image   = fjdf_field( 'fjdf_cta_image', 6 );
	?>
	<section class="donation-cta section">
		<div class="container donation-cta__inner">
			<div class="donation-cta__content">
				<h2 class="donation-cta__headline"><?php echo esc_html( $cta_head ); ?></h2>
				<?php if ( $cta_text ) : ?>
					<p class="donation-cta__text"><?php echo esc_html( $cta_text ); ?></p>
				<?php endif; ?>
				<?php if ( $cta_btn_u ) : ?>
					<a href="<?php echo esc_url( $cta_btn_u ); ?>" class="btn btn--primary btn--heart donation-cta__btn">
						<?php echo esc_html( $cta_btn_l ); ?>
					</a>
				<?php endif; ?>
				<?php if ( $cta_note ) : ?>
					<div class="donation-cta__note">
						<?php echo wp_kses_post( $cta_note ); ?>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $cta_image['id'] ) ) : ?>
				<div class="donation-cta__image" aria-hidden="true">
					<?php
					$cta_img_url = ! empty( $cta_image['url'] ) ? $cta_image['url'] : wp_get_attachment_url( $cta_image['id'] );
					$cta_img_alt = ! empty( $cta_image['alt'] ) ? esc_attr( $cta_image['alt'] ) : '';
					?>
					<img src="<?php echo esc_url( $cta_img_url ); ?>" class="donation-cta__img" alt="<?php echo $cta_img_alt; ?>" loading="lazy">
				</div>
			<?php endif; ?>
		</div>
	</section>

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
