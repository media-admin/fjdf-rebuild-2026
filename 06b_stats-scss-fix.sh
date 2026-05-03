#!/bin/bash
# FJDF: Stats-Slider JS + SCSS fixen
THEME="cms/wp-content/themes/fjdf-theme"

echo "=== 1. stats-slider.js: Selektor auf .js-stats-slider ==="
cat > "$THEME/assets/src/js/components/stats-slider.js" << 'EOF'
/**
 * FJDF — Stats Slider
 * Swiper: 1 Slide mobile, 3 Desktop, gold Pagination Dots
 */
import Swiper from 'swiper';
import { Pagination, A11y } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

export default class StatsSlider {
        constructor() {
                const el = document.querySelector('.js-stats-slider');
                if (!el) return;
                new Swiper(el, {
                        modules: [Pagination, A11y],
                        slidesPerView: 1,
                        spaceBetween: 32,
                        loop: false,
                        pagination: {
                                el: el.querySelector('.swiper-pagination'),
                                clickable: true,
                        },
                        a11y: { enabled: true },
                        breakpoints: {
                                768: { slidesPerView: 3, spaceBetween: 48 },
                        },
                });
        }
}
EOF
echo "✓ stats-slider.js aktualisiert"

echo ""
echo "=== 2. SCSS: stats-slider komplett neu ==="
SCSS="$THEME/assets/src/scss/pages/_home.scss"

# Alten stats-slider Block entfernen (ab Zeile 491)
# Einfacher: am Ende der Datei ersetzen
python3 - << 'PYEOF'
import re
path = "cms/wp-content/themes/fjdf-theme/assets/src/scss/pages/_home.scss"
with open(path, 'r') as f:
    content = f.read()

# Stats-Slider Block entfernen (alles ab "// Stats als Swiper-Slider")
content = re.sub(r'\n// Stats als Swiper-Slider.*', '', content, flags=re.DOTALL)

# Neuen Block anhängen
new_block = """
// Stats Slider (Swiper)
.stats-slider {
        background: var(--color-white);
        padding-block: var(--space-10);

        .swiper-pagination {
                bottom: 0;
        }
        .swiper-pagination-bullet {
                width: 10px;
                height: 10px;
                background: var(--color-gold);
                opacity: 0.35;
                &-active { opacity: 1; }
        }
        .swiper-wrapper {
                align-items: center;
                padding-bottom: var(--space-8);
        }
}
.stats-slider__item {
        display: flex;
        align-items: center;
        gap: var(--space-5);
}
.stats-slider__icon {
        flex-shrink: 0;
        img {
                width: 64px;
                height: 64px;
                object-fit: contain;
        }
}
.stats-slider__number {
        display: block;
        font-family: var(--font-serif);
        font-size: clamp(2.25rem, 3vw, 3rem);
        font-weight: 400;
        color: var(--color-dark);
        line-height: 1;
        margin-bottom: var(--space-2);
}
.stats-slider__label {
        font-size: var(--text-body-sm);
        color: var(--color-text-secondary);
        line-height: var(--leading-snug);
}
"""

with open(path, 'w') as f:
    f.write(content + new_block)

print("✓ _home.scss: stats-slider SCSS aktualisiert")
PYEOF

echo ""
echo "=== Fertig — jetzt: npm run build ==="
