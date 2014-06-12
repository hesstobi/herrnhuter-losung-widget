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
require_once(ABSPATH . '/wp-admin/includes/file.php');

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

		$newFilename = $this->alternate_dir . "/losungen" . (int) $date['year'] . ".xml";

		return $newFilename;
	}

	protected function _getDownloadUrl($date)
	{
		if (WP_DEBUG)
			$url = 'http://localhost/local/Losung_%s_XML.zip';
		else
			$url = apply_filters('herrnhuterlosung_download_url', self::DOWNLOAD_URL);
		return sprintf($url, (int) $date['year']);	
	}
	
	public function updater_gui()
	{
		if (@$_POST['action'] == 'updatelosungen')
		{
			$year = (int) $_POST['year'];
		
			$ret = $this->doUpdate(array('year' => $year));
			if ($ret === true) {
				$message = 'Die Losungen für ' . $year . ' wurden erfolgreich installiert.';
			} elseif (is_wp_error($ret)) {
				$error = '<b>Fehler:</b> ' . $ret->get_error_message();
			}
		} 
		
		$updateAvailable = $this->checkIfUpdatesAreAvailable();
		
		include(dirname(__FILE__) . '/../views/updater.php');
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
		global $wp_filesystem;

		$download_url = $this->_getDownloadUrl($date);    
		$this->_setup_WP_Filesystem($download_url);
		
		// 1) Downlaod File
        $tmpFile = download_url($download_url);
        if (is_wp_error($tmpFile))
         	return $tmpFile;       
        
        // 2) Unzip to tempDir
        $tempDir = $this->alternate_dir . '/update-losungen-' . time() . '/';
        if (!is_dir($tempDir))
        	$wp_filesystem->mkdir($tempDir);
        
        $ret = unzip_file($tmpFile, $tempDir);
        if (is_wp_error($ret))
        	return $ret;
        	
        // Search any XML File!
        $losungenFile = '';
        foreach (list_files($tempDir) as $file)
        {
        	if (substr($file, -4) == '.xml') {
        		$losungenFile = $file;
        		break;
        	}
        }
        
        if (!$losungenFile)
        	return new WP_Error(17000, 'No XML-File in Zip found! (' . $download_url . ')');
        
        $wp_filesystem->move($losungenFile, $this->xmlFileName('', $date), true);
        
        // Clean up
        $wp_filesystem->delete($tmpFile);
        $wp_filesystem->delete($tempDir, true); // TODO Recursive Delete!
        
        return file_exists($this->xmlFileName('', $date));
	}
	
	public function checkIfUpdateAvailable($date)
	{
		$url = $this->_getDownloadUrl($date);
		$ret = wp_remote_head($url);
		if (is_wp_error($ret)) {
			if (WP_DEBUG)
				echo "<div class='error'>Fehler: $url: " . $ret->get_error_message() . '<br /></div>';
			return false;
		}
			
		return ($ret['response']['code'] == 200);
	}

	protected function _setup_WP_Filesystem($download_url) {
		global $wp_filesystem;
		
		if ( false === ( $credentials = request_filesystem_credentials( $download_url, '', false, $this->alternate_dir ) ) ) {
			return;
		}
	
		if ( ! WP_Filesystem( $credentials, $this->alternate_dir ) ) {
			// Failed to connect, Error and request again
			request_filesystem_credentials( $download_url, '', true, $this->alternate_dir );
			return;
		}
	
		if ( $wp_filesystem->errors->get_error_code() ) {
			foreach ( $wp_filesystem->errors->get_error_messages() as $message )
				show_message($message);
			return;
		}
	}
	
	/**
	 * Überprüfe, ob aktuelle und nächstjährige Losungen vorhanden sind.
	 * Falls nicht, überprüfe ob sie heruntergeladen werden können.
	 */
	function checkIfUpdatesAreAvailable() {
	    $now = getdate();
	    $nextYear = getdate(strtotime('next year'));

	    $updateAvailable = array();
	    foreach (array($now, $nextYear) as $date)
	    {
	    	if ($this->checkIfUpdateIsAvailable($date))
	    		$updateAvailable[] = $date;
	    }
	    
	    return $updateAvailable;
	}
	
	private function checkIfUpdateIsAvailable($date)
	{
	    $losungen = new HerrnhuterLosungenPlugin_Xml();
	    if (!$losungen->checkIfLosungenAvailable($date))
	    {
			if ($this->checkIfUpdateAvailable($date))
				return true;
	    }
	    return false;
	}
	
	
	
}