=== Herrnhuter Losung ===
Contributors: hesstobi
Donate link: http://www.lutherkirchgemeinde-radebeul.de/
Tags: deutsch, german, bible, Bibel, daily, täglich 
Requires at least: 2.8
Tested up to: 3.05
Stable tag: 1.4

Das Plugin zeigt die tägliche Losung der Herrnhuter Brüdergemeinde in Deutsch als Widget an der Sidebar an.

== Description ==

Das Plugin zeigt die tägliche Losung der Herrnhuter Brüdergemeinde in Deutsch als Widget an der Sidebar an, mit je einen Vers aus dem alten und dem neuen Testament. Aus lizenzrechtlichen Gründen fehlt der Liedvers bzw. das Gebet.

*Die Losungen gibt es seit 1728. Für jeden Tag zieht die Herrnhuter Brüdergemeinde einen Vers aus dem alten Testament der Bibel, dazu wird eine Vers aus dem neuen Testament und ein sowie ein Liedvers oder ein Gebet auswählt. Die Losungen verbinden Menschen aus verschiedenen Konfessionen und mit unterschiedlicher Frömmigkeit.*

*Weiter Informationen gibt es unter.  [losungen.de](http://www.losungen.de/ "Offizelle Webseiter der Herrnhuter Losungen")*

Das Design des Widgets kann über CSS gesteuert werden. Dafür sind für den Losungstext, den Lehrtext, die Versangaben und das Copyright CSS Klassen definiert. Für eine genau Dokumentation der CSS Klassen siehe *Installation*.

Den Titel des Widgets, die Verlinkung zu [bibleserver.com](http://www.bibleserver.com/ "Bibel Server") und die Sichtbarkeit des Copyrights kann in den Einstellungen des Widgets verändert werden.



### Voraussetungen

* Wordpress > 2.8
* PHP > 5.0

== Installation ==

1. Lade die Zip-Datei in dein Pluginsverzeichnis `/wp-content/plugins/` und entpacke es
1. Aktiviere das Plugin im 'Plugins' Menü in WordPress
1. Füge das Widget im etsprechenden Menü zu deiner Seitenleiste hinzu

Zur Anpassung des Designs können folgende CSS Klassen verwendet werden:

* Losungstext: *losung-losungstext*
* Lehrtext: *losung-lehrtext*
* Einleitende Worte: *losung-losungseinleitung*  (z.B. Jesus Christus Spricht)
* Versangaben: *losung-versangabe*
* Copyright: *losung-copy*


	
	

Als Beispiel könnt ihr folgendes in eurer CSS Stylesheet schreiben:

	#sidebar .losung-losungstext {font-weight: bold;}
	#sidebar .losung-lehrtext {font-weight: bold;}
	#sidebar .losung-losungseinleitung {font-style:italic; font-weight: normal;}
	#sidebar .losung-copy {font-size: 0.7em; text-align: right;}
	
Damit wird der Losungstext und der Lehrtext fett gedruckt und das Copyright ist etwas kleiner und steht rechtsbündig.


== Frequently Asked Questions ==

= Ich bekomme folgende Fehlermeldung: Fatal error: Call to undefined function: simplexml_load_file() =

Das Widget benötigt PHP5 das es die Funktionen der php-Klasse simplexml verwendet. Für php4 gibt es leider keinen so einfachen xml-Parser

== Screenshots ==

1. Das Widgets in Aktion
2. Die Einstellungen des Widgets

== Changelog ==

= 1.41 =
* kleine Verbesserungen am Quellcode, vielen Dank Benjamin!
* Die Losungen für 2012

= 1.4 =
* Problem mit xml-file load auf einigen Servern behoben. Vielen Danke Benjamin für den Hinweis
* Die Einleitenden Worte der Losung (wie z.B. Jesus spircht:) werden nun ohne die '/' angezeigt und können über die css-Klasse losung-losungseinleitung formatiert werden

= 1.3 =
* Anpassung für das Wordpress Plugin Directory

= 1.2 =
* Losungen für 2011 hinzugefügt
* Losungstext, Lehrtext, Versangaben und Copyright sind nun einzeln über CSS anschprechbar

= 1.11 =
* Losungen für 2010 hinzugefügt

== Upgrade Notice ==

= 1.3 =
Diese Version ist die erste die durch das Wordpress Plugin Directory gehostet wird

= 1.2 =
Diese Version ergäntzt die Losungen für 2011 und es sind nun erweiterte Anpassungen über CSS möglich.

= 1.11 =
Diese Version ergäntzt die Losungen für 2010.

