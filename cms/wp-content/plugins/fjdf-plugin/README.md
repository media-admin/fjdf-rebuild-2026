# Friends of Juan Diego Flórez Plugin (former Media Lab Project Starter)

Project-specific CPTs, taxonomies, and ACF fields for client websites.

## What's Included

- **Custom Post Types**: Team, Project, Job, Service, Testimonial, FAQ, Hero Slides, Carousel, Maps
- **Taxonomies**: Project Categories, Service Categories, Job Categories, Job Types, Job Locations, etc.
- **ACF Field Groups**: 11 field groups (65 fields total) stored as JSON

## Usage

### For Each New Client Project:

1. Duplicate this plugin folder
2. Rename to `client-name-project` (e.g., `acme-corp-project`)
3. Update plugin header in main PHP file
4. Activate for client site
5. Customize CPTs/ACF as needed

## Customization

Add/remove CPTs in `inc/custom-post-types.php`
Add/remove taxonomies in `inc/taxonomies.php`
ACF fields auto-load from `acf-json/`

## Dependencies

Requires: Media Lab Agency Core plugin

## Changelog

### 2026-09-03 — Spendenquittung als PDF-Anhang & mehrsprachiger GiveWP-Redirect

**PDF-Spendenquittung (E-Mail-Anhang)**
- Neue Datei: `inc/pdf-receipt-attachment.php`
- Generiert bei jeder abgeschlossenen Spende automatisch eine PDF-Quittung
  (dompdf, via Composer lokal im Plugin installiert) und hängt sie an die
  GiveWP-Spendenquittungs-Mail an, statt auf den GiveWP-eigenen
  "Beleg im Browser anzeigen"-Link (Donor Dashboard) zu verweisen — das
  Dashboard bleibt für Spender:innen weiterhin gesperrt
- Enthält: Spendername, Firma (`_give_donation_company`, falls angegeben),
  Spendenform, Häufigkeit (aktuell fix "Einmalig"/"One-time"/"Único" —
  Recurring Donations ist noch nicht aktiv), Datum, Betrag, Zahlungsart,
  Zahlungs-ID
- Mehrsprachig (DE/EN/ES): Beschriftungen richten sich nach der Sprache des
  verwendeten Spendenformulars (`pll_get_post_language()`), inkl.
  `switch_to_locale()` für Datum & GiveWP-eigene Gateway-Labels
- Logo wird als Base64-Data-URI eingebettet, nicht als Dateipfad — eine
  ImageMagick-Sicherheitsrichtlinie auf dem Server (`IsCoderAuthorized`)
  blockiert sonst den dateibasierten Bildzugriff durch dompdf
- PDF-Erzeugung ist mit `try/catch` abgesichert: schlägt sie fehl, geht die
  Spendenquittungs-Mail trotzdem ohne Anhang raus — die Spende selbst darf
  dadurch nie fehlschlagen

**Mehrsprachiger GiveWP-Redirect**
- Neue Datei: `inc/givewp-polylang-redirect.php`
- GiveWP kennt nur eine einzige, global konfigurierte Erfolgsseite
  (Einstellungen → Allgemein → Erfolgsseite) und ignoriert dabei
  Polylang-Übersetzungen
- Hook auf `give_get_success_page_uri` (Priorität 20, nach GiveWPs eigenem
  `TemporarilyReplaceLegacySuccessPageUri`) ermittelt die Sprache anhand des
  verwendeten Spendenformulars (nicht `pll_current_language()`, das im
  AJAX-Kontext der Zahlungsabwicklung unzuverlässig die Standardsprache
  liefert) und leitet auf die passende Sprachversion der Danke-Seite weiter
- Zusätzlich in GiveWP je Sprachformular unter Spenden Bestätigung →
  "Umleitung aktivieren" aktiviert; GiveWP-eigene "Donation Confirmation"-
  Blöcke wurden aus allen drei Danke-Seiten (DE/EN/ES) entfernt

**Fix: "Zurück zur Startseite"-Link im Thank-You-Template**
- `fjdf-theme/page-thank-you.php` nutzte reines Gettext
  (`esc_html_e( '...', 'fjdf' )`) ohne existierende `.mo`-Datei, wodurch der
  Link auf EN/ES fälschlich Deutsch blieb
- Der String war über `pll_register_string( 'thankyou_back', ... )` in
  `polylang-setup.php` bereits korrekt registriert — Template ruft ihn jetzt
  über den bestehenden `fjdf_str()`-Helper ab

**Bekannte offene Punkte**
- Häufigkeit in der PDF ist hartkodiert "Einmalig" — muss erweitert werden,
  sobald Recurring Donations aktiviert wird
- EN/ES-Übersetzungstexte in der PDF sind eigene Formulierungen, sollten von
  Muttersprachler:innen gegengelesen werden

### 2026-09-03 — FluentCRM: Free statt Pro

- Umstieg von FluentCRM Pro auf FluentCRM Free beschlossen, da keine der
  Pro-exklusiven Funktionen genutzt wurde (Sequences: 0, Automation Funnels: 0,
  Recurring Campaigns: 0 zum Zeitpunkt des Wechsels)
- Vorgehen: Lizenz zuerst unter FluentCRM Pro → Settings → License deaktiviert,
  danach Plugin deaktiviert & gelöscht
- Kontakte, Listen, Tags, Templates und Custom Fields bleiben unverändert, da
  sie in den Core-FluentCRM-Tabellen liegen (`fjdf_fc_*`)

**Mehrsprachige E-Mail-Footer**
- FluentCRM's "Email Footer Settings" (Settings → Email Settings) sind global
  und unterstützen nur eine Sprache — kein natives Multi-Language-Feature
- Lösung: Pro nicht-deutschem Template (Template EN, Template ES) den Schalter
  "Disable Default Email Footer" in den Template-Einstellungen aktiviert
- Stattdessen manueller, übersetzter Footer-Block direkt im jeweiligen Template
  ergänzt (Text + `{{crm.business_name}}`, `{{crm.business_address}}`,
  `##crm.unsubscribe_url##`, `##crm.manage_subscription_url##`)
- Template DE nutzt weiterhin den globalen Footer (bereits auf Deutsch konfiguriert)

**Runde Bilder im Newsletter (Block-Editor + Versand)**
- Neue Datei: `inc/fluentcrm-email-styles.php`
- Hooks: `fluent_crm/email_header` (Versand) und `fluent_crm/block_editor_head`
  (Live-Vorschau im Editor)
- CSS-Klasse `.fjdf-circle-img` (220×220px, `border-radius:50%`, `object-fit:cover`)
  wird im Bild-Block über "Erweitert → Zusätzliche CSS-Klasse(n)" gesetzt
- Bekannte Einschränkung: klassisches Outlook Desktop ignoriert `border-radius`
  bei `<img>` — betrifft alle HTML-E-Mails generell, keine Lösung dagegen nötig

## Version

1.0.0
