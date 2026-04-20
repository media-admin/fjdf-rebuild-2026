# 14. Bookings Plugin

**Plugin:** `media-lab-bookings`
**Version:** 1.5.2
**Abhängigkeiten:** ACF Pro, jQuery (WordPress Core)

---

## Übersicht

Das Bookings Plugin ermöglicht standortbasierte Terminbuchungen direkt auf der Website. Buchungen werden in der WordPress-Datenbank gespeichert, per E-Mail bestätigt und sind über einen iCal-Feed in gängigen Kalender-Apps abonnierbar. Der Mailversand nutzt die SMTP-Konfiguration aus `media-lab-agency-core`.

### Features

| Feature | Beschreibung |
|---|---|
| Standortverwaltung | Beliebig viele Filialen/Standorte als CPT |
| Öffnungszeiten | Pro Wochentag konfigurierbar (on/off + von/bis) |
| Zeitslots | Slot-Dauer in Minuten, letzter Slot X Min. vor Schließung |
| Kapazitätslimit | Max. Buchungen pro Zeitslot konfigurierbar |
| Tageslimit | Max. Buchungen pro Tag (0 = unbegrenzt) |
| Buchungs-CPT | Backend-Übersicht mit Statusverwaltung + Filter |
| Manuelle Buchung | Direkte Erfassung im Backend (Bookings → Neue Buchung) |
| Kalenderansicht | Monatsansicht mit Buchungen pro Tag, Detail-Popup |
| Dashboard-Widget | Nächste X Termine auf WP-Startseite |
| iCal-Anhang | .ics-Datei in Bestätigungs-, Status- und Erinnerungsmails |
| iCal-Feed | Abonnierbare URL für Google Calendar, Apple Calendar, Outlook |
| Status-Mails | Kunden-E-Mail bei Statuswechsel (Bestätigt / Storniert) |
| Erinnerungsmail | WP-Cron X Stunden vor dem Termin |
| Stornierungslink | Token-basierter Link in jeder Mail |
| CSV-Export | Buchungen als CSV-Datei aus dem Backend |
| E-Mail Kunden | Standortspezifisches HTML-Template mit Platzhaltern |
| E-Mail Filiale | Automatische Kopie an Filial-E-Mail-Adresse |
| SMTP | Nutzt `wp_mail()` → Core Plugin SMTP-Konfiguration |
| Shortcode | `[mlb_booking_form]` mit optionalem Standort-Preset |
| Datepicker | Flatpickr (DE) – geschlossene Wochentage automatisch deaktiviert |
| DSGVO | Pflicht-Checkbox, client- und serverseitig validiert |
| ACF-Labels | Alle Feldbeschriftungen pro Standort im Backend konfigurierbar |
| Template-Override | Theme kann `media-lab-bookings/booking-form.php` überschreiben |
| PHP-Filter/Actions | Hooks für projektspezifische Anpassungen |

---

## Pluginstruktur

```
media-lab-bookings/
├── media-lab-bookings.php      Hauptdatei, Plugin-Header, Includes
├── inc/
│   ├── cpt.php                 CPTs mlb_location + mlb_booking, Custom Statuses
│   ├── acf-fields.php          ACF-Feldgruppen (programmatisch registriert)
│   ├── slots.php               Slot-Generierung, Kapazitäts- und Tageslimitprüfung
│   ├── ajax.php                AJAX-Handler (Standortdaten, Slots, Submit)
│   ├── ical.php                iCal-Generator (.ics), Download-Endpunkt
│   ├── feed.php                iCal-Feed (abonnierbare URL für Kalender-Apps)
│   ├── mail.php                E-Mail-Versand, Platzhalter, HTML-Wrapper
│   ├── notifications.php       Status-Mails, Erinnerungs-Cron, Stornierungstoken
│   ├── export.php              CSV-Export
│   ├── calendar.php            Backend-Kalenderansicht (Monatsansicht)
│   ├── dashboard-widget.php    WP-Dashboard-Widget (nächste Termine)
│   ├── shortcode.php           [mlb_booking_form] + Asset-Enqueue
│   └── admin.php               Menü, Dashboard, Buchungs-Tabelle, Filter
├── templates/
│   └── booking-form.php        Formular-HTML-Template
└── assets/
    ├── js/
    │   ├── booking-form.js     Frontend-JS (Flatpickr, AJAX, Submit)
    │   └── calendar.js         Kalender-JS (Popup per AJAX)
    └── css/
        ├── booking-form.css    Formular-Styles mit CSS Custom Properties
        └── calendar.css        Kalender-Styles
```

### Klassen-Übersicht

| Klasse | Datei | Funktion |
|---|---|---|
| `MLB_CPT` | `cpt.php` | Registriert CPTs + Post Statuses |
| `MLB_Slots` | `slots.php` | Slot-Logik, Öffnungszeiten, Kapazität, Tageslimit |
| `MLB_Ajax` | `ajax.php` | 3 AJAX-Endpunkte |
| `MLB_ICal` | `ical.php` | .ics-Generator, Datei-Anhang, Download-URL |
| `MLB_Feed` | `feed.php` | Abonnierbarer iCal-Feed |
| `MLB_Mail` | `mail.php` | Kunden- + Admin-Mail |
| `MLB_Notifications` | `notifications.php` | Status-Mails, Cron, Stornierungstoken |
| `MLB_Export` | `export.php` | CSV-Export |
| `MLB_Calendar` | `calendar.php` | Backend-Kalenderansicht |
| `MLB_Dashboard_Widget` | `dashboard-widget.php` | WP-Dashboard-Widget |
| `MLB_Shortcode` | `shortcode.php` | Shortcode-Registrierung + Assets |
| `MLB_Admin` | `admin.php` | Backend-UI |

---

## Installation

1. ZIP in WordPress hochladen: **Plugins → Installieren → Plugin hochladen**
2. Plugin aktivieren
3. SMTP unter **Agency Core → E-Mail / SMTP** konfigurieren
4. **Einstellungen → Permalinks → Speichern** (für iCal-Feed-Rewrite-Rule)
5. Ersten Standort anlegen: **Bookings → Standorte → Hinzufügen**

**Voraussetzungen:** ACF Pro aktiv, `media-lab-agency-core` aktiv (SMTP), WordPress 6.0+, PHP 7.4+

---

## Menü-Struktur

```
Bookings
├── Übersicht       Dashboard mit Statistiken, Feed-URLs, Schnellzugriff
├── Buchungen       Liste aller mlb_booking Einträge
├── Neue Buchung    Manuelle Buchungserfassung im Backend
├── Standorte       Liste aller mlb_location Einträge
├── Neuer Standort  Neuen Standort anlegen
└── Kalender        Monatsansicht mit Buchungen pro Tag
```

---

## Custom Post Types

### `mlb_location` – Standorte
- Sichtbarkeit: `public => false`, `show_in_menu => false` (manuell über admin.php)
- Unterstützt: `title` (= Standortname)

### `mlb_booking` – Buchungen
- Sichtbarkeit: `public => false`, `show_in_menu => false`
- Standard-Status bei neuem Eintrag: `mlb-pending`

### Custom Post Statuses

| Status-Key | Label | Bedeutung |
|---|---|---|
| `mlb-pending` | Ausstehend | Neu eingegangen, noch nicht bearbeitet |
| `mlb-confirmed` | Bestätigt | Buchung bestätigt → Bestätigungsmail wird gesendet |
| `mlb-cancelled` | Storniert | Storniert → Stornierungsmail wird gesendet |

---

## ACF-Felder

### Feldgruppe: Standort-Einstellungen (`group_mlb_location`)

**Tab: Öffnungszeiten** – Pro Wochentag (Montag–Sonntag):

| Feldname | Typ | Beschreibung |
|---|---|---|
| `mlb_{day}_active` | true/false | Standort an diesem Tag geöffnet? |
| `mlb_{day}_open` | text | Öffnungszeit (Format `HH:MM`) |
| `mlb_{day}_close` | text | Schließzeit (Format `HH:MM`) |

`{day}` = `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `sun`. Standard: Mo–Fr aktiv (`09:00`–`18:00`).

**Tab: Zeitslots**

| Feldname | Typ | Standard | Beschreibung |
|---|---|---|---|
| `mlb_slot_duration` | number | `60` | Slot-Dauer in Minuten |
| `mlb_last_slot_offset` | number | `60` | Letzter Slot startet X Min. vor Schließung |
| `mlb_max_capacity` | number | `1` | Max. Buchungen pro Slot |
| `mlb_max_per_day` | number | `0` | Max. Buchungen pro Tag (0 = unbegrenzt) |

**Tab: Kontakt**

| Feldname | Typ | Beschreibung |
|---|---|---|
| `mlb_location_email` | email | Filial-E-Mail (Kopie-Empfänger) |
| `mlb_location_phone` | text | Telefonnummer |
| `mlb_location_address` | textarea | Adresse |

**Tab: Bestätigungsmail** (beim ersten Formular-Submit)

| Feldname | Typ | Beschreibung |
|---|---|---|
| `mlb_confirmation_subject` | text | Betreff |
| `mlb_confirmation_template` | wysiwyg | HTML-Mailtext mit Platzhaltern |

**Tab: Mail: Bestätigt** (bei Statuswechsel auf `mlb-confirmed`)

| Feldname | Typ | Beschreibung |
|---|---|---|
| `mlb_confirmed_subject` | text | Betreff |
| `mlb_confirmed_template` | wysiwyg | HTML-Mailtext (iCal wird automatisch angehängt) |

**Tab: Mail: Storniert** (bei Statuswechsel auf `mlb-cancelled`)

| Feldname | Typ | Beschreibung |
|---|---|---|
| `mlb_cancelled_subject` | text | Betreff |
| `mlb_cancelled_template` | wysiwyg | HTML-Mailtext |

**Tab: Erinnerungsmail** (WP-Cron)

| Feldname | Typ | Standard | Beschreibung |
|---|---|---|---|
| `mlb_reminder_hours` | number | `24` | Stunden vor Termin (0 = deaktiviert) |
| `mlb_reminder_subject` | text | – | Betreff |
| `mlb_reminder_template` | wysiwyg | – | HTML-Mailtext (iCal wird angehängt) |

**Tab: Formular-Labels**

| Feldname | Placeholder | Beschreibung |
|---|---|---|
| `mlb_label_location` | Standort wählen | Label Standort-Dropdown |
| `mlb_label_date` | Datum | Label Datumsfeld |
| `mlb_label_time` | Uhrzeit | Label Zeitslot-Dropdown |
| `mlb_label_service` | Dienstleistung | Label Dienstleistungs-Dropdown |
| `mlb_label_persons` | Personenanzahl | Label Personenfeld |
| `mlb_label_name` | Vor- und Nachname | Label Namensfeld |
| `mlb_label_email` | E-Mail-Adresse | Label E-Mail-Feld |
| `mlb_label_phone` | Telefon | Label Telefonfeld |
| `mlb_label_notes` | Anmerkungen | Label Anmerkungsfeld |
| `mlb_label_submit` | Buchung anfragen | Button-Beschriftung |
| `mlb_label_privacy` | (Zustimmungstext) | DSGVO-Checkbox-Text |
| `mlb_label_privacy_note` | – | Optionaler Hinweis unter Button |

**Tab: Dienstleistungen** – Repeater `mlb_services`:

| Sub-Feld | Typ | Beschreibung |
|---|---|---|
| `service_name` | text | Bezeichnung |
| `service_duration` | number | Optionale Dauer in Minuten |

---

### Feldgruppe: Buchungsdetails (`group_mlb_booking`)

| Feldname | Typ | Beschreibung |
|---|---|---|
| `mlb_booking_status` | select | `mlb-pending` / `mlb-confirmed` / `mlb-cancelled` |
| `mlb_booking_location` | post_object | Verknüpfter Standort (ID) |
| `mlb_booking_date` | date_picker | Buchungsdatum (`Y-m-d`) |
| `mlb_booking_time` | time_picker | Uhrzeit (`H:i`) |
| `mlb_booking_service` | text | Gewählte Dienstleistung |
| `mlb_booking_persons` | number | Personenanzahl |
| `mlb_booking_name` | text | Name des Kunden |
| `mlb_booking_email` | email | E-Mail des Kunden |
| `mlb_booking_phone` | text | Telefonnummer |
| `mlb_booking_notes` | textarea | Anmerkungen |

---

## Shortcode

```
[mlb_booking_form]
[mlb_booking_form location="123"]
[mlb_booking_form location="wien-mitte" title="Jetzt buchen"]
[mlb_booking_form location="42" class="mein-custom-wrapper"]
```

| Attribut | Typ | Beschreibung |
|---|---|---|
| `location` | ID oder Slug | Standort vorauswählen; Dropdown wird ausgeblendet |
| `title` | string | Überschrift über dem Formular |
| `class` | string | Zusätzliche CSS-Klassen auf dem Wrapper |

**Auto-Preset:** Wenn nur 1 aktiver Standort vorhanden ist, wird dieser automatisch vorausgewählt und das Dropdown ausgeblendet.

---

## E-Mail-Platzhalter

Verfügbar in allen Mail-Templates (`mlb_confirmation_template`, `mlb_confirmed_template`, `mlb_cancelled_template`, `mlb_reminder_template`):

| Platzhalter | Inhalt |
|---|---|
| `{name}` | Vor- und Nachname des Kunden |
| `{email}` | E-Mail-Adresse des Kunden |
| `{phone}` | Telefonnummer |
| `{date}` | Buchungsdatum (WordPress-Datumsformat) |
| `{time}` | Uhrzeit + „Uhr" |
| `{service}` | Gewählte Dienstleistung |
| `{persons}` | Personenanzahl |
| `{notes}` | Anmerkungen |
| `{location_name}` | Name des Standorts |
| `{location_address}` | Adresse des Standorts |
| `{location_email}` | Filial-E-Mail |
| `{location_phone}` | Filial-Telefon |
| `{booking_id}` | WordPress-Post-ID der Buchung (`#42`) |
| `{cancel_url}` | Stornierungslink (einmalig, token-basiert) |

---

## iCal-Feed (Kalender-Abonnement)

Nach der Aktivierung ist unter `/mlb-calendar-feed/` ein iCal-Feed verfügbar. Die Feed-URLs werden im Backend-Dashboard unter **Bookings → Übersicht** angezeigt.

### URL-Parameter

| Parameter | Beispiel | Beschreibung |
|---|---|---|
| `token` | `?token=abc123` | Sicherheits-Token (im Dashboard angezeigt) |
| `location` | `?location=42` | Nur Buchungen eines Standorts (ID oder Slug) |
| `status` | `?status=confirmed` | Nur bestätigte Buchungen |

### Kalender-Apps einrichten

**Google Calendar:** Andere Kalender → Per URL hinzufügen → Feed-URL einfügen

**Apple Calendar:** Ablage → Neues Kalenderabonnement → Feed-URL einfügen

**Outlook:** Kalender hinzufügen → Aus dem Internet → Feed-URL einfügen

**Wichtig:** Nach Aktivierung einmal unter **Einstellungen → Permalinks → Speichern** klicken, damit die Rewrite-Rule aktiv wird.

---

## Manuelle Buchungserfassung

Buchungen die persönlich oder telefonisch erfolgen können direkt im Backend erfasst werden:

1. **Bookings → Neue Buchung** (oder Button im Dashboard)
2. Alle Felder ausfüllen: Status, Standort, Datum, Uhrzeit, Kunde etc.
3. **Veröffentlichen** klicken

**Hinweis:** Bei manuell erfassten Buchungen werden keine E-Mails automatisch versendet. Status-Mails werden erst bei einer manuellen Statusänderung ausgelöst (z.B. von Ausstehend auf Bestätigt).

---

## Slot-Logik

### Generierung
`MLB_Slots::generate( $location_id, $date )` erzeugt alle Slots für einen Tag:

```
Öffnungszeit → Schließzeit − last_slot_offset
Slot-Abstände = slot_duration Minuten
Beispiel: 09:00–18:00, Dauer 60 Min., Offset 60 Min.
→ Slots: 09:00, 10:00, 11:00, 12:00, 13:00, 14:00, 15:00, 16:00, 17:00
```

### Kapazitätsprüfung
Pro Slot wird `MLB_Slots::count_bookings()` ausgeführt. Stornierte Buchungen werden nicht gezählt.

### Tageslimit
Wenn `mlb_max_per_day > 0` und `MLB_Slots::count_day_bookings()` das Limit erreicht hat, gibt `generate()` ein leeres Array zurück — alle Slots des Tages sind gesperrt.

### AJAX-Endpunkte

| Action | Funktion | Parameter |
|---|---|---|
| `mlb_get_location_data` | Wochentage + Services | `location_id`, `nonce` |
| `mlb_get_slots` | Zeitslots für Datum | `location_id`, `date`, `nonce` |
| `mlb_submit_booking` | Buchung speichern + Mails | Alle Formularfelder, `nonce` |
| `mlb_download_ical` | .ics-Datei herunterladen | `booking_id`, `nonce` (GET) |
| `mlb_calendar_day` | Tages-Detail (Kalender-Popup) | `date`, `location_id`, `nonce` |
| `mlb_cancel_booking` | Buchung stornieren | `booking_id`, `token` (GET) |

---

## Benachrichtigungen & Cron

### Status-Mails (automatisch bei Statuswechsel im Backend)

| Status | Mail an Kunden | Mail an Filiale | iCal |
|---|---|---|---|
| Formular-Submit | Bestätigungsmail | Neue-Buchung-Kopie | ✅ |
| → Bestätigt | Bestätigt-Mail | Kopie | ✅ |
| → Storniert | Storniert-Mail | Kopie | ✗ |

### Stornierungslink
- Token wird bei `mlb_after_save_booking` generiert (`_mlb_cancel_token` in Post Meta)
- Link `{cancel_url}` in allen Templates verfügbar
- Einmalverwendung — Token wird nach Stornierung gelöscht
- Setzt Status auf `mlb-cancelled`, versendet Stornierungsmail, entfernt Cron-Job

### Erinnerungs-Cron
- Wird beim Statuswechsel auf `mlb-confirmed` geplant
- Zeitpunkt: Buchungsdatum/zeit minus `mlb_reminder_hours` Stunden
- Bei Stornierung wird der geplante Job automatisch entfernt (`wp_clear_scheduled_hook`)

---

## CSV-Export

**Bookings → Buchungen → „Als CSV exportieren"**

- Respektiert aktive Filter (Standort, Status)
- UTF-8 BOM für Excel-Kompatibilität
- Semikolon als Trenner
- Spalten: ID, Status, Standort, Datum, Uhrzeit, Name, E-Mail, Telefon, Dienstleistung, Personen, Anmerkungen, Eingangsdatum

---

## Kalenderansicht

**Bookings → Kalender**

- Monatsnavigation (vor/zurück + Heute)
- Filter nach Standort
- Buchungen farbkodiert: Gelb = Ausstehend, Grün = Bestätigt, Rot = Storniert
- Klick auf einen Tag öffnet Detail-Popup mit vollständiger Buchungstabelle
- Direktlink zur Buchung im Popup

---

## Dashboard-Widget

Zeigt nächste X bevorstehende Buchungen (Status: Ausstehend/Bestätigt) auf der WP-Startseite. Anzahl über Widget-Einstellungen konfigurierbar (1–20, Standard: 5).

---

## Styling

CSS Custom Properties für einfache Theme-Integration:

```css
.mlb-booking-form {
    --mlb-color-primary:    #d40000;  /* Primärfarbe */
    --mlb-color-primary-dk: #b30000;  /* Hover */
    --mlb-color-border:     #d0d5dd;  /* Input-Rahmen */
    --mlb-radius:           6px;      /* Border-Radius */
    --mlb-font:             inherit;  /* Schriftart */
}
```

---

## Projektspezifische Anpassungen (update-sicher)

### 1. CSS-Overrides im Theme
```scss
// custom-theme/assets/src/scss/_bookings.scss
.mlb-booking-form {
    --mlb-color-primary: #e8a000;
}
```

### 2. Template-Override
```
// Datei anlegen:
custom-theme/media-lab-bookings/booking-form.php
```
Das Plugin lädt automatisch diese Datei wenn vorhanden (`locate_template()`).

### 3. PHP-Filter/Actions in `functions.php`
```php
// Buchungsdaten vor dem Speichern ändern
add_filter( 'mlb_before_save_booking', function( $data ) {
    return $data;
} );

// Nach dem Speichern
add_action( 'mlb_after_save_booking', function( $booking_id, $data ) {
    // eigene Logik
}, 10, 2 );

// Bestätigungsmail-Body
add_filter( 'mlb_confirmation_body', function( $body, $booking_id, $location_id ) {
    return $body;
}, 10, 3 );

// Bestätigungsmail-Betreff
add_filter( 'mlb_confirmation_subject', function( $subject, $booking_id, $location_id ) {
    return $subject;
}, 10, 3 );
```

---

## Troubleshooting

### Keine Zeitslots werden angezeigt
1. Öffnungszeiten im Standort prüfen — Tab „Zeitslots" → `mlb_slot_duration` ausgefüllt?
2. Tageslimit erreicht? → `mlb_max_per_day` erhöhen oder auf 0 setzen
3. Alle Slots ausgebucht → `mlb_max_capacity` erhöhen
4. Browser-Konsole auf AJAX-Fehler prüfen (`mlb_get_slots`)

### Keine E-Mails
1. SMTP testen: **Agency Core → E-Mail / SMTP → Test-Mail senden**
2. `mlb_location_email` im Standort hinterlegt?
3. `wp-content/debug.log` auf `wp_mail_failed` prüfen

### iCal-Feed gibt 404
Permalinks neu speichern: **Einstellungen → Permalinks → Speichern**

### Doppelte Menüeinträge
Prüfen ob `show_in_menu => false` in `inc/cpt.php` gesetzt ist. Bei `show_in_menu => 'mlb-bookings'` generiert WordPress automatisch Untermenüeinträge zusätzlich zu den manuell angelegten.

### Erinnerungsmail wird nicht gesendet
1. WP-Cron aktiv? → `wp cron event list | grep mlb_send_reminder`
2. Status der Buchung muss `mlb-confirmed` sein
3. Erinnerungszeitpunkt muss in der Zukunft liegen
4. `mlb_reminder_hours` > 0 im Standort gesetzt?

### Stornierungslink funktioniert nicht
Token wird bei der ersten Buchung generiert (Action `mlb_after_save_booking`). Für ältere Buchungen ohne Token funktioniert der Link nicht — nur neue Buchungen ab v1.4.0 haben einen Token.

---

## Datei-Referenz

| Datei | Klasse / Funktion | Hook |
|---|---|---|
| `cpt.php` | `MLB_CPT::register()` | `init` |
| `cpt.php` | `MLB_CPT::register_statuses()` | `init` |
| `acf-fields.php` | `mlb_register_acf_fields()` | `acf/include_fields` |
| `slots.php` | `MLB_Slots::generate()` | – (statisch) |
| `slots.php` | `MLB_Slots::count_bookings()` | – (statisch) |
| `slots.php` | `MLB_Slots::count_day_bookings()` | – (statisch) |
| `ajax.php` | `MLB_Ajax::get_location_data()` | `wp_ajax(_nopriv)_mlb_get_location_data` |
| `ajax.php` | `MLB_Ajax::get_slots()` | `wp_ajax(_nopriv)_mlb_get_slots` |
| `ajax.php` | `MLB_Ajax::submit_booking()` | `wp_ajax(_nopriv)_mlb_submit_booking` |
| `ical.php` | `MLB_ICal::generate()` | – (statisch) |
| `ical.php` | `MLB_ICal::ajax_download()` | `wp_ajax(_nopriv)_mlb_download_ical` |
| `feed.php` | `MLB_Feed::handle_feed()` | `template_redirect` |
| `mail.php` | `MLB_Mail::send_confirmation()` | – (statisch) |
| `notifications.php` | `MLB_Notifications::on_acf_save()` | `acf/save_post` |
| `notifications.php` | `MLB_Notifications::send_reminder()` | `mlb_send_reminder` (Cron) |
| `notifications.php` | `MLB_Notifications::ajax_cancel()` | `wp_ajax(_nopriv)_mlb_cancel_booking` |
| `export.php` | `MLB_Export::handle_export()` | `admin_init` |
| `calendar.php` | `MLB_Calendar::render_page()` | – (Menü-Callback) |
| `calendar.php` | `MLB_Calendar::ajax_day_detail()` | `wp_ajax_mlb_calendar_day` |
| `dashboard-widget.php` | `MLB_Dashboard_Widget::render()` | `wp_dashboard_setup` |
| `shortcode.php` | `MLB_Shortcode::render()` | `shortcode mlb_booking_form` |
| `admin.php` | `MLB_Admin::register_menu()` | `admin_menu` |
| `admin.php` | `MLB_Admin::dashboard_page()` | – (Menü-Callback) |
