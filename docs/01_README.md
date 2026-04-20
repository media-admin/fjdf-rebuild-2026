# Media Lab Starter Kit

**Professional WordPress Agency Framework** – Modulares Plugin-System für skalierbare Kundenprojekte.

[![Version](https://img.shields.io/badge/version-1.18.0-blue.svg)](../../CHANGELOG.md)
[![PHP](https://img.shields.io/badge/PHP-8.0+-purple.svg)](https://php.net)
[![WordPress](https://img.shields.io/badge/WordPress-6.0+-blue.svg)](https://wordpress.org)
[![License](https://img.shields.io/badge/license-proprietary-red.svg)](#lizenz)

---

## Übersicht

Vollständiges WordPress-Starter-Kit mit modularer Plugin-Architektur für Agentur-Workflows.
Entwickelt für Wartbarkeit, Sicherheit und schnelles Client-Deployment.

### Architektur-Prinzip

```
media-lab-agency-core   →  Wiederverwendbares Framework (nie modifizieren)
media-lab-seo           →  SEO-Toolkit (pro Projekt aktivieren + konfigurieren)
custom-theme            →  Präsentationsebene (pro Projekt anpassen)
```

---

## Komponenten & Versionen

| Komponente             | Version  | Beschreibung                          |
|------------------------|----------|---------------------------------------|
| `media-lab-agency-core`| `1.6.0`  | Framework-Plugin (nicht modifizieren) |
| `media-lab-seo`        | `1.3.0`  | SEO-Toolkit                           |
| `custom-theme`         | `1.14.0` | Theme & Gutenberg-Blocks              |

---

## Custom Gutenberg Blocks (8)

Alle Blöcke sind unter der Kategorie **„Design"** im Editor verfügbar.

| Block           | Typ         | Beschreibung                        |
|-----------------|-------------|-------------------------------------|
| Hero            | ACF         | Fullscreen-Hero mit CTA             |
| Testimonial     | ACF         | Kundenstimmen mit Slider            |
| Team-Mitglied   | ACF         | Teamkarten mit Social Links         |
| Logo-Leiste     | ACF         | Statische Logo-Reihe                |
| Logo-Slider     | ACF         | Animierter Logo-Karussell           |
| CTA-Banner      | Native      | Handlungsaufforderung               |
| Accordion / FAQ | Native      | Barrierefreies Akkordeon            |
| Icon + Text     | Native      | Icon mit Textbereich                |

---

## Footer-Menüs

Das Theme registriert drei Menü-Locations:

| Location       | Beschreibung                                          |
|----------------|-------------------------------------------------------|
| `primary`      | Hauptnavigation (4 Ebenen, Desktop + Mobile)          |
| `footer`       | Footer Navigation (oberer Footer-Bereich)             |
| `footer-legal` | Footer Legal (Impressum, Datenschutz, AGB, etc.)      |

**Footer Legal** wird unterhalb des Copyright-Hinweises als dezente, horizontale
Link-Leiste ausgegeben. Ganz unten erscheint die Credit-Line mit Verweis auf
[media-lab.at](https://www.media-lab.at).

---

## Projektstruktur

```
media-lab-starter-kit/
├── cms/
│   └── wp-content/
│       ├── plugins/
│       │   ├── media-lab-agency-core/     # Framework v1.6.0
│       │   └── media-lab-seo/             # SEO-Toolkit v1.3.0
│       └── themes/
│           └── custom-theme/              # Theme v1.14.0
│               ├── assets/src/scss/       # SCSS + Design-Tokens
│               ├── assets/src/js/         # JS-Komponenten
│               ├── assets/dist/           # Build-Output (nicht committen)
│               ├── inc/                   # PHP-Helpers (ACF, Enqueue, etc.)
│               └── template-parts/        # Wiederverwendbare Template-Teile
├── docs/                                  # Dokumentation
├── scripts/                               # vite-dev.mjs, Deploy-Scripts
├── vite.config.js                         # Theme-Build
├── vite.config.blocks.js                  # Block-Build
├── package.json
└── CHANGELOG.md
```

---

## Build-System

```bash
# Entwicklung starten
npm run dev

# Produktions-Build
npm run build

# Dev-Server stoppen
npm run dev:stop
```

Zwei separate Vite-Configs werden via `npm run build` nacheinander ausgeführt:
- `vite.config.js` → Theme-Assets (SCSS, JS)
- `vite.config.blocks.js` → Gutenberg-Block-Assets

---

## Dokumentation

| Dokument                     | Inhalt                              |
|------------------------------|-------------------------------------|
| [02_INSTALLATION.md]         | Vollständige Installationsanleitung |
| [03_PLUGINS.md]              | Plugin-Referenz                     |
| [06_DEVELOPMENT.md]          | Entwicklungs-Guide                  |
| [07_TROUBLESHOOTING.md]      | Fehlerbehebung                      |
| [09_ACF-FIELDS.md]           | ACF-Felder Referenz                 |
| [CHANGELOG.md](../../CHANGELOG.md) | Vollständige Versionshistorie  |

---

## Versionshistorie (Auszug)

| Version  | Schwerpunkt                                                  |
|----------|--------------------------------------------------------------|
| v1.18.0  | Footer Legal Navigation + Credit-Line                        |
| v1.17.0  | WCAG 2.1 AA Audit – 11 Fixes (Kontrast, Fokus, Motion, ...) |
| v1.16.0  | 8 Custom Gutenberg Blocks abgeschlossen                      |
| v1.15.0  | ACF-Felder via PHP registriert (inc/acf-blocks.php)          |
| v1.14.0  | Vite Multi-Config Build (theme + blocks)                     |

Vollständiger Changelog: [CHANGELOG.md](../../CHANGELOG.md)

---

## Lizenz

Proprietär – Media Lab Tritremmel GmbH
Kontakt: [markus.tritremmel@media-lab.at](mailto:markus.tritremmel@media-lab.at)
Website: [www.media-lab.at](https://www.media-lab.at)
