#!/usr/bin/env python3

# ---------------------------------------------------------------
# 1. footer.php: Social Label + Icons mit Gold-BG
# ---------------------------------------------------------------
fp = "cms/wp-content/themes/fjdf-theme/footer.php"
with open(fp, 'r') as f:
    content = f.read()

# Social Label hinzufügen + Icons in Gold-Buttons
old_social_wrap = """                        <!-- Social + Email -->
                        <div class="site-footer__social-wrap">
                                <ul class="site-footer__social-list" role="list">"""

new_social_wrap = """                        <!-- Social + Email -->
                        <div class="site-footer__social-wrap">
                                <p class="site-footer__social-label"><?php esc_html_e( 'Lerne Sinfonía por el Perú kennen', 'fjdf' ); ?></p>
                                <ul class="site-footer__social-list" role="list">"""

content = content.replace(old_social_wrap, new_social_wrap)

# Collab Label auf übersetzbar setzen
content = content.replace(
    "fjdf_option( 'fjdf_footer_collab_label', __( 'Colaboración con:', 'fjdf' ) )",
    "fjdf_option( 'fjdf_footer_collab_label', __( 'Zusammenarbeit mit:', 'fjdf' ) )"
)

with open(fp, 'w') as f:
    f.write(content)
print("✓ footer.php angepasst")

# ---------------------------------------------------------------
# 2. SCSS: Logo zentriert, schwarzer BG, Social Icons gold
# ---------------------------------------------------------------
fp2 = "cms/wp-content/themes/fjdf-theme/assets/src/scss/layout/_footer.scss"
with open(fp2, 'r') as f:
    content = f.read()

# Schwarzer Hintergrund
content = content.replace(
    "--footer-bg:",
    "--footer-bg-old:"
)

# Footer BG auf schwarz
if "--footer-bg" in content:
    content = content.replace(
        ".site-footer {",
        ".site-footer {\n        --footer-bg: #000000;"
    ) if "--footer-bg: #000000" not in content else content

# Top-Inner: Logo + Nav zentriert
content = content.replace(
    ".site-footer__top-inner {\n        display: flex;\n        flex-direction: column;\n        align-items: center;\n        gap: var(--space-6);\n        text-align: center;\n}",
    ".site-footer__top-inner {\n        display: flex;\n        flex-direction: column;\n        align-items: center;\n        gap: var(--space-8);\n        text-align: center;\n}"
)

with open(fp2, 'w') as f:
    f.write(content)

# Neue Styles anhängen
new_styles = """
// Footer Social Icons (gold background)
.site-footer__social-label {
        font-size: var(--text-body-sm);
        color: var(--color-text-gold);
        margin-bottom: var(--space-3);
}
.site-footer__social-list {
        display: flex;
        gap: var(--space-3);
        list-style: none;
        padding: 0;
        margin: 0;
}
.site-footer__social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        background: var(--color-gold);
        color: var(--color-dark);
        transition: opacity var(--transition-base);
        &:hover { opacity: 0.8; }
        svg { width: 20px; height: 20px; }
}
// Footer Top: Logo zentriert
.site-footer__top-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: var(--space-8);
}
.site-footer__logo img {
        height: 56px;
        width: auto;
        filter: brightness(0) invert(1);
}
"""

with open(fp2, 'a') as f:
    f.write(new_styles)
print("✓ SCSS angepasst")

# ---------------------------------------------------------------
# 3. _tokens.scss: Footer BG auf schwarz
# ---------------------------------------------------------------
import glob
token_files = glob.glob("cms/wp-content/themes/fjdf-theme/assets/src/scss/**/_tokens.scss", recursive=True)
for tf in token_files:
    with open(tf, 'r') as f:
        tc = f.read()
    if '--footer-bg' in tc:
        import re
        tc = re.sub(r'--footer-bg:\s*[^;]+;', '--footer-bg: #0a0a0a;', tc)
        with open(tf, 'w') as f:
            f.write(tc)
        print(f"✓ Footer BG in {tf} auf schwarz gesetzt")
