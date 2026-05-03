#!/bin/bash
# =============================================================================
# FJDF — WP-CLI Migration Script
# Run AFTER deploying refactored theme/plugin files.
#
# USAGE: bash wp-cli-migration.sh
# Run from WordPress root (where wp-config.php lives).
# =============================================================================

set -e

echo "=== FJDF Migration: Starting ==="
echo ""

# 1. Rename WordPress page slugs (Spanish → German)
echo "--- Step 1: Rename page slugs ---"
wp post list --post_type=page --name=nosotros --fields=ID --format=csv | tail -n +2 | while read ID; do
  wp post update $ID --post_name=ueber-uns --post_title="Über uns"
  echo "  ✓ Renamed 'nosotros' → 'ueber-uns' (ID $ID)"
done

wp post list --post_type=page --name=que-hacemos --fields=ID --format=csv | tail -n +2 | while read ID; do
  wp post update $ID --post_name=was-wir-tun --post_title="Was wir tun"
  echo "  ✓ Renamed 'que-hacemos' → 'was-wir-tun' (ID $ID)"
done

wp post list --post_type=page --name=dona --fields=ID --format=csv | tail -n +2 | while read ID; do
  wp post update $ID --post_name=spenden --post_title="Spenden"
  echo "  ✓ Renamed 'dona' → 'spenden' (ID $ID)"
done

wp post list --post_type=page --name=gracias --fields=ID --format=csv | tail -n +2 | while read ID; do
  wp post update $ID --post_name=danke --post_title="Danke für Ihre Spende"
  echo "  ✓ Renamed 'gracias' → 'danke' (ID $ID)"
done

wp post list --post_type=page --name=noticias --fields=ID --format=csv | tail -n +2 | while read ID; do
  wp post update $ID --post_name=aktuelles --post_title="Aktuelles"
  echo "  ✓ Renamed 'noticias' → 'aktuelles' (ID $ID)"
done

# 2. Update page template assignments
echo ""
echo "--- Step 2: Update page templates ---"
# Find page using old template 'page-nosotros.php' and assign new one
for ID in $(wp post list --post_type=page --fields=ID,post_name --format=csv | grep "ueber-uns\|nosotros" | cut -d, -f1); do
  wp post meta update $ID _wp_page_template page-about.php
  echo "  ✓ Template → page-about.php (ID $ID)"
done

for ID in $(wp post list --post_type=page --fields=ID,post_name --format=csv | grep "was-wir-tun\|que-hacemos" | cut -d, -f1); do
  wp post meta update $ID _wp_page_template page-what-we-do.php
  echo "  ✓ Template → page-what-we-do.php (ID $ID)"
done

for ID in $(wp post list --post_type=page --fields=ID,post_name --format=csv | grep "spenden\|^dona$" | cut -d, -f1); do
  wp post meta update $ID _wp_page_template page-donate.php
  echo "  ✓ Template → page-donate.php (ID $ID)"
done

for ID in $(wp post list --post_type=page --fields=ID,post_name --format=csv | grep "danke\|gracias" | cut -d, -f1); do
  wp post meta update $ID _wp_page_template page-thank-you.php
  echo "  ✓ Template → page-thank-you.php (ID $ID)"
done

# 3. Rename ACF meta keys (old dona_ fields → donate_)
echo ""
echo "--- Step 3: Migrate ACF field keys (dona → donate) ---"
wp search-replace 'fjdf_dona_' 'fjdf_donate_' wp_postmeta --include-columns=meta_key --dry-run
echo "  ↑ DRY RUN — remove --dry-run to apply"

# 4. Rename ACF meta keys (nosotros_ → about_)
echo ""
echo "--- Step 4: Migrate ACF field keys (nosotros → about) ---"
wp search-replace 'fjdf_nos_' 'fjdf_about_' wp_postmeta --include-columns=meta_key --dry-run
echo "  ↑ DRY RUN — remove --dry-run to apply"

# 5. Rename ACF meta keys (que_ → what_)
echo ""
echo "--- Step 5: Migrate ACF field keys (que → what) ---"
wp search-replace 'fjdf_que_' 'fjdf_what_' wp_postmeta --include-columns=meta_key --dry-run
echo "  ↑ DRY RUN — remove --dry-run to apply"

# 6. Flush rewrite rules
echo ""
echo "--- Step 6: Flush rewrite rules ---"
wp rewrite flush --hard
echo "  ✓ Rewrite rules flushed"

echo ""
echo "=== Migration complete ==="
echo ""
echo "NEXT STEPS:"
echo "  1. Remove --dry-run from steps 3–5 above and re-run to apply DB changes"
echo "  2. Check wp-admin → Settings → Reading: homepage/posts page assignments"
echo "  3. Rebuild menus: wp-admin → Appearance → Menus"
echo "  4. In Polylang: set DE as default language, add EN and ES"
echo "  5. Set /aktuelles/ as posts archive slug in Polylang settings"
