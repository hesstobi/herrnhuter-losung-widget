<?php
/**
 * This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * @author Benjamin Pick
 *
 */


class HerrnhuterLosungenPlugin_Xml_Automatic_Update
{
	const DOWNLOAD_URL = 'http://www.brueder-unitaet.de/download/Losung_%s_XML.zip';
	
	protected $alternate_dir;
	
	public function __construct()
	{
		// Look for the Losungen xml in the /uploads-Folder as well
		add_filter('herrnhuterlosung_filename_xml', array($this, 'xmlFileName'), 10, 2);

        $upload_dir = wp_upload_dir();
        $this->alternate_dir = $upload_dir['basedir'];
	}
	
	public function xmlFileName($oldFilename, $date)
	{
		if (file_exists($oldFilename))
			return $oldFilename;

        $newFilename = $this->alternate_dir . "/Losungen Free " . (int) $date['year'] . ".xml";
      
        return $newFilename;
	}
	
	protected function _getDownloadUrl($date)
	{
		$url = apply_filters('herrnhuterlosung_download_url', self::DOWNLOAD_URL);
		return sprintf($url, (int) $date['year']);	
	}
	
	/**
	 * Wann soll das ausgeführt werden?
	 * * Am 28. Dezember des Vorjahres (via cron -> Failures should be reported via email)
	 * * Direkt nach Installation des Plugins (activate?)
	 * * Manuell im Backend (Knopf im Widget? Optionen?)
	 * 
	 * @param int $year
	 */
	public function doUpdate($date)
	{
		$download_url = $this->_getDownloadUrl($date);
		
        $tmpFile = download_url($download_url);
        if (is_wp_error($tmpFile))
         	return $tmpFile;
        
        $ret = unzip_file($tmpFile, $this->alternate_dir);
        if (is_wp_error($ret))
        	return $ret;
        	
        // TODO rename file from temporary directory 
        // DAS xml-File, egal wie es heißt, soll losungen$year.xml werden
        
        @unlink($tmpFile);
        
        return true;
	}
	
	public function checkIfUpdateAvailable($date)
	{
		$url = $this->_getDownloadUrl($date);
		$ret = wp_remote_head($url);
		if (is_wp_error($ret))
			throw $ret;
			
		return ($ret['response']['code'] == 200);
	}

}