#!/bin/bash
# FJDF: Layout-Fixes — Header, Hero, Stats, Category Labels
# Ausführen: bash 05_layout-fixes.sh (im Projektroot)

THEME="cms/wp-content/themes/fjdf-theme"
SCSS="$THEME/assets/src/scss"
JS="$THEME/assets/src/js"

echo "=== 1. Category Labels: orange Tag → gold Text (kein Hintergrund) ==="
sed -i '' \
  's/--tag-bg:.*$/--tag-bg:                 transparent;/' \
  "$SCSS/abstracts/_tokens.scss"
sed -i '' \
  's/--tag-color:.*$/--tag-color:              var(--color-gold);/' \
  "$SCSS/abstracts/_tokens.scss"
# Padding + Border entfernen für sauberes Label
sed -i '' \
  's/--tag-padding:.*$/--tag-padding:            0;/' \
  "$SCSS/abstracts/_tokens.scss"
echo "✓ Tokens angepasst"

echo ""
echo "=== 2. Stats-Zahlen: orange → dunkel ==="
sed -i '' \
  's/--stats-number-color:.*$/--stats-number-color:     var(--color-dark);/' \
  "$SCSS/abstracts/_tokens.scss"
echo "✓ Stats-Farbe angepasst"

echo ""
echo "=== 3. _home.scss: Hero-Underline + Scroll-Button ==="
# Goldene Linie unter Hero-Headline hinzufügen
sed -i '' \
  's/\.hero__headline {/\.hero__headline {\n        @include gold-underline-center;\n        color: #ffffff;/' \
  "$SCSS/pages/_home.scss"

# gold-underline-center muss für weißen Hintergrund auf dark gelten
# Scroll-Button als klickbaren Link stylen
cat >> "$SCSS/pages/_home.scss" << 'SCSS_EOF'

// Scroll-Button
.hero__scroll {
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
        color: rgba(255,255,255,0.7);
        font-size: var(--text-body-sm);
        text-decoration: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        transition: color var(--transition-base), gap var(--transition-base);
        &:hover {
                color: rgba(255,255,255,1);
                gap: var(--space-3);
        }
}
.hero__scroll-arrow {
        animation: bounce 2s ease-in-out infinite;
        font-style: normal;
}
SCSS_EOF
echo "✓ Hero-SCSS ergänzt"

echo ""
echo "=== 4. Stats Bar: Swiper-Slider ==="
cat >> "$SCSS/pages/_home.scss" << 'SCSS_EOF'

// Stats als Swiper-Slider (wie US-Vorlage)
.stats-slider {
        background: var(--color-cream);
        padding-block: var(--space-10);

        .swiper { padding-bottom: var(--space-8); }

        .swiper-slide {
                display: flex;
                align-items: center;
                justify-content: center;
        }

        .swiper-pagination-bullet {
                background: var(--color-gold);
                opacity: 0.35;
                &-active { opacity: 1; }
        }
}
.stats-slider__item {
        display: flex;
        align-items: center;
        gap: var(--space-5);
        justify-content: center;
        text-align: left;
}
.stats-slider__icon img {
        width: 56px;
        height: 56px;
        object-fit: contain;
}
.stats-slider__number {
        display: block;
        font-family: var(--font-serif);
        font-size: clamp(2.5rem, 4vw, 4rem);
        font-weight: 600;
        color: var(--color-dark);
        line-height: 1;
}
.stats-slider__label {
        font-size: var(--text-body-sm);
        color: var(--color-text-secondary);
        line-height: var(--leading-snug);
        margin-top: var(--space-1);
}
SCSS_EOF
echo "✓ Stats-Slider SCSS ergänzt"

echo ""
echo "=== 5. Header CTA: Herz als gold Kreis ==="
cat >> "$SCSS/layout/_navbar.scss" << 'SCSS_EOF'

// CTA mit gold Herz-Kreis (wie US-Vorlage)
.btn--heart-circle {
        display: inline-flex;
        align-items: center;
        gap: 0;
        padding-right: 0;
        overflow: hidden;

        .btn__heart {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: var(--btn-height-sm);
                height: var(--btn-height-sm);
                background: var(--color-gold);
                color: #ffffff;
                font-size: 1rem;
                line-height: 1;
                flex-shrink: 0;
                margin-left: var(--space-3);
                border-radius: 50%;
        }
}
SCSS_EOF
echo "✓ Header CTA SCSS ergänzt"

echo ""
echo "=== 6. Stats-Slider JS Component ==="
cat > "$JS/components/stats-slider.js" << 'JS_EOF'
/**
 * FJDF — Stats Slider
 * Swiper mit Pagination-Dots, 1 Slide pro View
 */
import Swiper from 'swiper';
import { Pagination, A11y } from 'swiper/modules';

export default class StatsSlider {
        constructor() {
                const el = document.querySelector('.stats-slider .swiper');
                if (!el) return;

                new Swiper(el, {
                        modules: [Pagination, A11y],
                        slidesPerView: 1,
                        spaceBetween: 0,
                        loop: false,
                        pagination: {
                                el: el.querySelector('.swiper-pagination'),
                                clickable: true,
                        },
                        a11y: { enabled: true },
                        breakpoints: {
                                768: { slidesPerView: 3 },
                        },
                });
        }
}
JS_EOF
echo "✓ stats-slider.js erstellt"

echo ""
echo "=== 7. main.js: Stats-Slider initialisieren ==="
sed -i '' \
  "s|import('./components/modal.js').then(m => new m.default());|import('./components/modal.js').then(m => new m.default());\nimport('./components/stats-slider.js').then(m => new m.default());|" \
  "$JS/main.js"
echo "✓ main.js aktualisiert"

echo ""
echo "=== 8. gallery.js DOM-Selektor aktualisieren ==="
# gallery.js sucht nach .nosotros-gallery__thumbs — anpassen auf about-gallery__thumbs
sed -i '' \
  "s|'.nosotros-gallery__thumbs'|'.about-gallery__thumbs'|g" \
  "$JS/main.js"
echo "✓ gallery.js Selektor aktualisiert"

echo ""
echo "=== SCSS + JS fertig — jetzt front-page.php + header.php patchen ==="
echo "→ Bitte 05b_patch-php.php ausführen: wp eval-file 05b_patch-php.php --path=cms"
