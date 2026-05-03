#!/usr/bin/env python3
fp = "cms/wp-content/themes/fjdf-theme/assets/src/scss/pages/_home.scss"
with open(fp, 'r') as f:
    lines = f.readlines()

# Zeilen 86-109 (0-indexed 85-108) komplett ersetzen
new = """.about-teaser__inner {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: var(--space-12);
        align-items: stretch;
        @include respond-below('lg') { grid-template-columns: 1fr; gap: var(--space-8); }
}
.what-teaser__inner {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: var(--space-12);
        align-items: stretch;
        @include respond-below('lg') { grid-template-columns: 1fr; gap: var(--space-8); }
}
.about-teaser__headline,
.what-teaser__headline {
        @include heading-serif(var(--text-h2), 500);
        @include gold-underline;
        margin-bottom: var(--space-5);
}
.about-teaser__text,
.what-teaser__text { color: var(--color-text-secondary); margin-bottom: var(--space-6); }
.about-teaser__image {
        border-radius: var(--radius-xl);
        overflow: hidden;
        order: -1;
}
.what-teaser__image {
        border-radius: var(--radius-xl);
        overflow: hidden;
        @include respond-below('lg') { order: -1; max-height: 400px; }
}
.about-teaser__img,
.what-teaser__img { @include img-cover; }
"""

lines[85:109] = [new]

with open(fp, 'w') as f:
    f.writelines(lines)

# Nun den Rest per String-Replace
with open(fp, 'r') as f:
    content = f.read()

# Testimonial headline: zentriert
if "testimonials-new__headline {\n        text-align: center;" not in content:
    content = content.replace(
        ".testimonials-new__headline {",
        ".testimonials-new__headline {\n        text-align: center;"
    )

# Donation CTA: kein padding
if "padding-block: 0 !important" not in content:
    content = content.replace(
        ".donation-cta {\n        background: var(--color-cream);\n}",
        ".donation-cta {\n        background: var(--color-cream);\n        padding-block: 0 !important;\n}"
    )

# Contrib gap breiter auf Desktop
content = content.replace(
    "@include respond-to('md') { grid-template-columns: repeat(3, 1fr); }",
    "@include respond-to('md') { grid-template-columns: repeat(3, 1fr); gap: var(--space-16); }"
)

# Contrib Vorderseite: Larken
if ".contrib-card__front { font-family: var(--font-serif); }" not in content:
    content = content.replace(
        ".contrib-card__front {",
        ".contrib-card__front {\n        font-family: var(--font-serif);"
    )

with open(fp, 'w') as f:
    f.write(content)

print("Fertig")
