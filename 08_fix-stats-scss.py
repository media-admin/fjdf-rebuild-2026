#!/usr/bin/env python3
import re

path = "cms/wp-content/themes/fjdf-theme/assets/src/scss/pages/_home.scss"
with open(path, 'r') as f:
    content = f.read()

content = re.sub(r'\n// Stats Slider.*$', '', content, flags=re.DOTALL)

new_block = """
// Stats Slider (Swiper)
.stats-slider {
        background: var(--color-white);
        padding-block: var(--space-10);

        .swiper {
                overflow: hidden;
                padding-bottom: 40px;
        }

        .swiper-pagination {
                bottom: 8px;
        }

        .swiper-pagination-bullet {
                width: 10px;
                height: 10px;
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
        padding: var(--space-4) var(--space-6);
        min-height: 100px;
}

.stats-slider__icon {
        flex-shrink: 0;
        img {
                width: 64px;
                height: 64px;
                object-fit: contain;
        }
}

.stats-slider__text { flex: 1; }

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

print("✓ fertig")
