# Changelog

Alle wesentlichen Änderungen am Media Lab Starter Kit werden hier dokumentiert.
Format basiert auf [Keep a Changelog](https://keepachangelog.com/de/1.0.0/).

---

## [1.18.0] - 2026-03-26

### custom-theme 1.14.0

#### Added
- **Footer Legal Navigation** – neue Menu-Location `footer-legal` registriert
  - Ausgabe via `wp_nav_menu()` in `footer.php` (Tiefe 1, keine Submenüs)
  - Geeignet für Impressum, Datenschutz, AGB, Cookie-Richtlinie
  - Zuweisung im WP-Admin unter Design → Menüs
- **Footer Legal Styling** – `_footer.scss`
  - `.footer-legal` – dezente horizontale Link-Leiste mit Trennpunkten (`·`)
  - `.footer-legal a` – `font-size-xs`, `color-text-muted`, Hover: `color-primary`
  - `.site-footer__bottom` – Flex-Layout: Copyright links, Legal-Links rechts
  - Responsive: unterhalb 768px gestapelt, linksbündig
- **Credit-Line** – dezenter Agentur-Hinweis ganz unten im Footer
  - Text: „Konzept und Programmierung: Media Lab Tritremmel GmbH"
  - Link auf `https://www.media-lab.at` (öffnet in neuem Tab)
  - Styling: `opacity: 0.6` im Ruhezustand, `opacity: 1` bei Hover
  - Trennlinie (`border-top`) zwischen Legal-Bereich und Credit-Line

---

## [1.17.0] - 2026-03-10

### custom-theme 1.13.0

#### Added
- **WCAG 2.1 AA Audit** – 11 Fixes implementiert
  - Skip-Link für Tastaturnavigation
  - Keyboard-Pause für animierte Elemente
  - Primärfarbe `#ff0000` → `#d40000` (WCAG Kontrastanforderung)
  - Focus-Styles für alle interaktiven Elemente
  - `aria-hidden` auf dekorativen Elementen
  - Alt-Text-Fallback für Bilder ohne Alt-Attribut
  - Heading-Level-Hierarchie korrigiert
  - Touch-Targets auf min. 44×44px vergrößert
  - `prefers-reduced-motion` Media Query eingebaut
  - Kontrast-Fixes für Text auf farbigen Hintergründen
  - Semantische Struktur (`main`, `nav`, `footer` Landmarks)

---

## [1.16.0] - 2026-02-20

### custom-theme 1.12.0 / media-lab-agency-core 1.6.0

#### Added
- **8 Custom Gutenberg Blocks** abgeschlossen (Kategorie „Design")
  - Hero, Testimonial, Team-Mitglied, Logo-Leiste, Logo-Slider (ACF-Blöcke)
  - CTA-Banner, Accordion/FAQ, Icon+Text (Native Blöcke)
- **ACF-Felder** via PHP registriert (`inc/acf-blocks.php`)

---

## [1.15.0] - 2026-02-10

### media-lab-agency-core 1.5.0

#### Added
- ACF Field Groups programmatisch via PHP registriert (Version Control-fähig)
- `inc/acf-blocks.php` als zentrale Registrierungsdatei

---

## [1.14.0] - 2026-01-28

#### Changed
- **Vite Multi-Config Build** – zwei separate Config-Dateien
  - `vite.config.js` → Theme-Assets (SCSS, JS)
  - `vite.config.blocks.js` → Gutenberg-Block-Assets
- **Stale Hot-File Fix** – `npm run dev:stop &&` vor Build-Scripts
- `cssCodeSplit: false` – CSS direkt via `filemtime()` eingebunden

---

## [1.13.0] - 2026-01-15

### custom-theme 1.10.0

#### Added
- **4-Ebenen Navigation** – Desktop (Flyout) + Mobile (Accordion)
- **Footer Navigation** – `footer` Menu-Location, Flyout nach oben (Desktop)
- Viewport-Kollisionserkennung: `.opens-left` bei Überlauf

---

## [1.12.0] - 2025-12-10

### media-lab-seo 1.3.0

#### Added
- SEO-Toolkit: Meta-Tags, Open Graph, Sitemap-Integration
- Schema.org Structured Data

---

## [1.11.0] - 2025-11-20

#### Added
- Dark Mode (CSS Custom Properties, `data-theme`-Attribut)
- Maintenance Mode mit ACF-Konfiguration, 503-Header, Admin-Bypass

---

## [1.10.0] - 2025-11-05

#### Added
- 404-Seite mit Suchformular und Quick-Links aus Hauptmenü
- Security: Open Redirect Fix, SQL-Wildcard, DB-Flooding Prevention

---

## [1.9.0] - 2025-10-15

#### Added
- Performance: Code-Splitting, Lazy Loading, Responsive Images
- WP-Cleanup: Entfernung nicht benötigter Core-Skripte

---

## [1.8.0] - 2025-10-01

#### Added
- Security: Rate-Limiting, SMTP Credentials via wp-config, HTTP-Header

---

## [1.7.0] - 2025-09-15

#### Added
- Fullwidth-Helper: Klassen + Mixins (`.fullwidth`, `.fullwidth--bg`, `.fullwidth--media`)
- Design Tokens vollständig als CSS Custom Properties

---

## [1.6.0] - 2025-09-01

#### Added
- Sass-Migration: 7-1-Architektur, Abstracts, Mixins, Breakpoints

---

## [1.0.0] - 2025-08-01

#### Added
- Initiales Starter Kit Setup
- `media-lab-agency-core` Plugin-Grundstruktur
- `custom-theme` Theme-Grundstruktur
- Vite Build-System (Single Config)
