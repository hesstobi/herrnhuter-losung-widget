<?php
/**
License:
==============================================================================
Copyright 2009 Tobias Heß  (email : me@tobiashess.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

The Losungen of the Herrnhuter Brüdergemeine are copyrighted. Owner of
copyright is the Evangelische Brüder-Unität – Herrnhuter Brüdergemeine.
The biblical texts from the Lutheran Bible, revised texts in 1984, revised
edition with a new spelling, subject to the copyright of the German Bible
Society, Stuttgart.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Requirements:
==============================================================================
This plugin requires WordPress >= 2.8 and tested with PHP Interpreter >= 5.2.10
*/

//@include_once(dirname(__FILE__) . '/xml_automatic_updater.php');

class HerrnhuterLosungenPlugin_Xml
{
	public function __construct()
	{
		if (!function_exists('simplexml_load_file'))
		{
			throw new Exception("<p>Die Bibliothek f&uuml;r die Herrnhuter Losungen ben&ouml;tigt PHP 5 (Das Modul simplexml fehlt).</p>");
		}
	}
	
	protected function _getLosungenFilename($date)
	{
		$filename = dirname(__FILE__) ."/../losungen" . $date['year'] . ".xml";
		$filename = apply_filters('herrnhuterlosung_filename_xml', $filename, $date);
		
		return $filename;
	}
	
	public function checkIfLosungenAvailable($date)
	{
		return file_exists($this->_getLosungenFilename($date));
	}
	
	protected function loadXmlNode($date)
	{
		$filename = $this->_getLosungenFilename($date);
		if (!file_exists($filename))
		{
			if (WP_DEBUG)
				echo 'File not found: ' . $filename;
			throw new Exception("<p>Die Losungensdatei von diesem Jahr konnte nicht gefunden werden. Weitere Infos in der ReadMe.md des Plugins.</p>");
		}
		
		$xml = simplexml_load_file($filename);

		$Losung = $xml->Losungen[ $date['yday'] ];

		if (is_null($Losung))
		{
			throw new Exception("<p>Komischer Fehler: Konnte keine Losungsverse für diesen Tag finden.</p>");
		}
		
		return $Losung;
	}
	
	/**
	 * Lade den heutigen Vers
	 * 
	 * @param int $date UNIX Timestamp oder null (now)
	 * @return array(array_assoc)
	 */
	public function getVerse($date = null)
	{
		if (is_null($date))
			$date = getdate();
		else if (is_numeric($date))
			$date = getdate($date);
		
		$xml = $this->loadXmlNode($date);
		
		$vers = array(
			'losungstext' =>
				array(
					'vers' => (string) $xml->Losungsvers,
					'text' => (string) $xml->Losungstext,
				),
			'lehrtext' =>
				array(
					'vers' => (string) $xml->Lehrtextvers,
					'text' => (string) $xml->Lehrtext,
				),
		);
		
		return apply_filters('herrnuterlosung_vers', $vers, $date);
	}
	
	public function convertTextToHtml($text)
	{
		$text = preg_replace('#/(.*?:)/#', '<span class="losung-losungseinleitung">$1</span>', $text, 1);
		$text = preg_replace('/#(.*?)#/', '<em>$1</em>', $text);
		
		return $text;
	}
}

