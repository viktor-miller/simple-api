# Simple-API

## Installation

### DDEV
Die Anwendung wurde unter Verwendung von DDEV entwickelt und kommt mit einer Konfigurationsdatei **/.ddev/config.yaml** zusammen.
Falls DDEV bereits installiert ist, genügt folgender Befehl um die Anwendung zu starten

```console
ddev start
```

### Manuell
Die Anwendung setzt folgendes voraus:

- PHP ^8.1
- MySQL
- Nginx/Apache Server
- Composer v2

### Abhängigkeiten laden

```console
composer install
```

### Konfigurationen vornehmen

in der Datei /.env Konfigurationen (z.B. für DB vornehmen)

### Migrationen ausführen

mit folgendem Befehl Datenbank-Schema generieren lassen.

```console
php artisan migrate
```

## Verwendung

Die Anwendung beinhaltet ein Endpunkt, der unter **/v1/postingStats** erreichbar ist.

### Parametern
Folgende Parametern werden unterstützt.

- **gender:** male,female
- **status:** active,inactive

## Ausblick

Für den produktiven Einsatz werden folgende Schritte benötigt:

- Die fehlende Implementierung ergänzen.
- Die Ressourcenlastige Prozesse wie HTTP-Anfragen an externen Server in Queue auslagern und im Hintergrund mittels CronJob ausführen lassen.
- Die DB-Afragen (deren Ergebnisse) bei großen Datenmengen cachen um den Serverlast zu reduzieren.
- Evtl. Datenmenge, die per HTTP abgefragt wird auf die nötige reduzieren.
- Den Endpunkt evtl. gegen unerlaubten Zugriffen schützen.
- API-Dokumentation erstellen.
