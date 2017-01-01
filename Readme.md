Herrnhuter Losung
=================

Aktuelle Version: 1.7.3 (vom 01.01.2017)

*Donate link*: http://www.lutherkirchgemeinde-radebeul.de/<br>
*Tags*: deutsch, german, bible, Bibel, daily, täglich<br>
*Requires at least*: 2.8<br>
*Tested up to*: 4.7<br>
*License*: GPLv2 or later<br>
*License URI*: http://www.gnu.org/licenses/gpl-2.0.html<br>

Das Plugin zeigt die tägliche Losung der Herrnhuter Brüdergemeine in Deutsch als Widget an der Sidebar an.

Description
-----------

Das Plugin zeigt die tägliche Losung der Herrnhuter Brüdergemeine in Deutsch als Widget an der Sidebar an, mit je einen Vers aus dem alten und dem neuen Testament. Aus lizenzrechtlichen Gründen fehlt der Liedvers bzw. das Gebet.

*Die Losungen gibt es seit 1728. Für jeden Tag zieht die Herrnhuter Brüdergemeine einen Vers aus dem alten Testament der Bibel, dazu wird eine Vers aus dem neuen Testament und ein sowie ein Liedvers oder ein Gebet auswählt. Die Losungen verbinden Menschen aus verschiedenen Konfessionen und mit unterschiedlicher Frömmigkeit.*

*Weiter Informationen gibt es unter: [losungen.de](http://www.losungen.de/ "Offizelle Webseiter der Herrnhuter Losungen")*

### Auszug der Lizenzbedingungen:	
"Auf Internet-Seiten, die auch kommerziellen Zwecken dienen, sowie in Software, die entgeltlich
angeboten wird, dürfen die Losungen nicht verwendet werden. Gleiches gilt für Internetseiten und
Softwareprogramme deren Inhalt geeignet ist, das Ansehen der Evangelischen Kirche und der
Evangelischen Brüder-Unität - Herrnhuter Brüdergemeine herabzusetzen. Anwendungen außerhalb dieser Nutzungsbedingungen bedürfen einer gesonderten Vereinbarung mit der Evangelischen Brüder-Unität – Herrnhuter Brüdergemeine."

(Diese Bedingungen gelten für die beigelegte XML-Datei, die die Losungen enthält. Das Wordpress-Plugin ist unabhängig davon unter "GPLv2 or later" lizenziert.)

### Technische Details

Das Design des Widgets kann über CSS gesteuert werden. Dafür sind für den Losungstext, den Lehrtext, die Versangaben und das Copyright CSS Klassen definiert. Für eine genau Dokumentation der CSS Klassen siehe *Installation*.

Den Titel des Widgets, die Verlinkung zu [bibleserver.com](http://www.bibleserver.com/ "Bibel Server") und die Sichtbarkeit des Copyrights kann in den Einstellungen des Widgets verändert werden.



### Voraussetzungen

* Wordpress > 2.8
* PHP > 5.0

Installation
------------

Leider wurde dieses Plugin aus dem Plugin-Directory genommen, weil die Bibel-Verse nicht GPL-kompatibel sind. Darum muss es manuell installiert werden:

1. Lade die aktuelle ZIP-Datei rechts herunter.
2. Unter Plugins > Installieren > Hochladen die Datei hochladen.
3. Aktiviere das Plugin
4. Füge das Widget im entsprechenden Menü zu deiner Seitenleiste hinzu

Zur Anpassung des Designs können folgende CSS Klassen verwendet werden:

* Losungstext: *losung-losungstext* und *losung-text*
* Lehrtext: *losung-lehrtext* und *losung-text*
* Einleitende Worte: *losung-losungseinleitung*  (z.B. Jesus Christus spricht)
* Versangaben: *losung-versangabe*
* Copyright: *losung-copy*

Als Beispiel könnt ihr folgendes in eurer CSS Stylesheet schreiben:

	#sidebar .losung-text {margin-bottom:0; font-weight: bold;}
	#sidebar .losung-losungseinleitung {font-style:italic; font-weight: normal;}
	#sidebar .losung-copy {font-size: 0.7em; text-align: right;}
	
Damit wird der Losungstext und der Lehrtext fett gedruckt und das Copyright ist etwas kleiner und steht rechtsbündig.


Update des Plugins
------

### Manuell

1. Unter Installierte Plugins, deaktivere und lösche das bisher installierte Plugin.
2. Dann installiere es nach obiger Anleitung

### Über FTP

1. Lade die aktuelle ZIP-Datei rechts herunter.
2. Ersetze die bestehende Plugin-Dateien auf dem FTP-Server mit dem Inhalt der ZIP-Datei.

### Über Wordpress-Aktualisierungen

*(Diese Funktion ist derzeit deaktiviert.)*

1. Installiere das Update.
2. Ggf. musst du das Plugin erneut aktivieren und überprüfen, ob das Widget noch existiert.

Update der Losungen
------
Das Plugin an sich stellt nur die technische Hülle für die Einbindung der Losungen in eine Webseite bereit. Die Losungen selber werden dabei aus einer XML-Datei gelesen. Diese enthält immer die Losungen für ein komplettes Jahr. Herunterladen kann man diese immer hier: http://www.losungen.de/download/ (als Format "XML" auswählen).

Die XML-Datei muss folgendem Namensschema genügen: "losungen" + [jahr] + ".xml" (Bsp.: "losungen2016.xml").

Diese Datei einfach in den Hauptordner des Plugins legen.

Frequently Asked Questions
--------------------------

### Ich bekomme folgende Fehlermeldung: Fatal error: Call to undefined function: simplexml_load_file()

Das Widget benötigt PHP5 das es die Funktionen der php-Klasse simplexml verwendet. Für php4 gibt es leider keinen so einfachen xml-Parser.

### Wo kann ich Verbesserungen am Code einreichen?

Immer gerne! Am besten hier als Pull Request.

Geplante Verbesserungen (irgendwann):
* Lade die losungen.xml direkt von losungen.de herunter, falls die aktuelle XML-Datei nicht gefunden werden kann. Auf diese Weise müsste ich nicht mehr jährlich ein Update herausbringen.

Screenshots
-----------

1. Das Widgets in Aktion<br />
![Das Widgets in Aktion](screenshot-1.png)

2. Die Einstellungen des Widgets<br />
![Die Einstellungen des Widgets](screenshot-2.png)

3. Update der Losungs-Datei zum Jahres-Ende<br />
![Update der Losungs-Datei zum Jahres-Ende](screenshot-3.png)

Changelog
---------

### 1.7.3
* Losungen für 2017 hinzugefügt

### 1.7.2
* Losungen für 2016 hinzugefügt
* Informationen ergänzt bezgl. Losungs-Updates (Dateinamen-Konvention, etc.).

### 1.7.1
* Die manuell heruntergeladene Datei funktioniert jetzt auch.
* Losungen für 2015 hinzugefügt

### 1.7
* Die Losungs-Dateien können nun manuell im Backend unter Widgets aktualisiert werden.

### 1.6.3
* FIX: Die Losungen von 2014 werden jetzt wieder gefunden.

### 1.6.2
* Automatisches Update erstmal wieder deaktiviert (hat das Backend langsamer gemacht)

### 1.6.1

* Fix Fatal Error bei Plugin-Aktivierung.

### 1.6

* Automatisches Update ist jetzt auch über Github möglich. Ggf. muss das Plugin anschließend neu aktiviert werden.

### 1.5
* Refactor und nach Github umziehen

### 1.45
* Losungen für 2014

### 1.44
* Losungen für 2013
* Zeige ein Warnung, falls XML-Datei nicht existiert oder nicht den gesuchten Inhalt hat.

### 1.43
* Update Screenshots
* Neue CSS-Klasse losung-text für beide Bibelverse

### 1.42
* XHTML Compatibility
* Fix: Hervorhebungen im Losungstext mit # # werden jetzt kursiv angezeigt

### 1.41
* kleine Verbesserungen am Quellcode, vielen Dank Benjamin!
* Die Losungen für 2012

### 1.4
* Problem mit xml-file load auf einigen Servern behoben. Vielen Danke Benjamin für den Hinweis
* Die Einleitenden Worte der Losung (wie z.B. Jesus spricht:) werden nun ohne die '/' angezeigt und können über die css-Klasse losung-losungseinleitung formatiert werden

### 1.3
* Anpassung für das Wordpress Plugin Directory

### 1.2
* Losungen für 2011 hinzugefügt
* Losungstext, Lehrtext, Versangaben und Copyright sind nun einzeln über CSS ansprechbar

### 1.11
* Losungen für 2010 hinzugefügt

