<?php
/*
Plugin Name: Herrnhuter Losung
Plugin URI: http://www.tobiashess.de/herrnhuter-losungen-widget/
Description: Dieses Plugin erstellt ein Sidebar-Widget, was die heutige Losung der Herrnhuter Brüdergemeine auf der Sidebar ausgibt.
Author: Tobias Heß, Benjamin Pick
Version: 1.45
Author URI: http://www.tobiashess.de
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
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

class Losung_Widget extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname' => 'widget_losung',
			'description' => 'Die heutige Losung der Herrnhuter Brüdergemeine'
		);
		parent::__construct('losung', 'Herrnhuter Losung', $widget_ops);
	}

	function widget($args, $instance) {
		if (!function_exists('simplexml_load_file'))
		{
			echo "<p>Das Losung-Widget ben&ouml;tigt PHP 5 (simplexml fehlt).</p>";
			return;
		}
	
		$title = apply_filters('widget_title', $instance['title'] );
		
		$showcopy = isset( $instance['showcopy'] ) ? $instance['showcopy'] : false;
		$showlink = isset( $instance['showlink'] ) ? $instance['showlink'] : false;
		
		echo $args['before_widget'];
		
		#Titel ausgeben
		if ( $title )
			echo $args['before_title'] . $title . $args['after_title'];
		
		$this->showLosungen(getdate(), $showlink, $showcopy);

		echo $args['after_widget'];
	}
	
	function showLosungen($datum, $showlink, $showcopy)
	{
		#Losung einlesen
		$filename = dirname(__FILE__) ."/losungen" . $datum['year'] . ".xml";
		if (!file_exists($filename))
		{
			echo "<p>Die Losungen von diesem Jahr sind noch nicht da. Ein Update k&ouml;nnte helfen.</p>";
			return;
		}
		
		$xml = simplexml_load_file($filename);
		$Losung = $xml->Losungen[ $datum['yday'] ];
		if (is_null($Losung))
		{
			echo "<p>Komischer Fehler: Konnte keine Losungsverse für diesen Tag finden.</p>";
			return;
		}

		#Losung ausgeben:
		$options = array('showlink' => $showlink);
		$options['css'] = 'losung-losungstext';
		$this->showBibleVers($Losung->Losungstext, $Losung->Losungsvers, $options);
	
		#Lehrtext ausgeben:
		$options['css'] = 'losung-lehrtext';
		$this->showBibleVers($Losung->Lehrtext, $Losung->Lehrtextvers, $options);
		
		#Copyright ausgeben
		if ($showcopy)
			echo '<p class="losung-copy"><a href="http://www.ebu.de" target="_blank" title="Evangelische Br&uuml;der-Unit&auml;t">&copy; Evangelische Br&uuml;der-Unit&auml;t – Herrnhuter Br&uuml;dergemeine</a> <br> <a href="http://www.losungen.de" target="_blank" title="www.losungen.de">Weitere Informationen finden Sie hier</a></p>';
	}
	
	function showBibleVers($text, $vers, $options = array())
	{
		$defaults = array(
			'css' => 'losung',
			'showlink' => true
		);
		$options = $options + $defaults;
	
		echo '<p class="losung-text ' . $options['css'] . '">' . $this->applyFormat($text) . "</p>";
		
		echo '<p class="losung-versangabe">';
		
		if ($options['showlink'])
			echo '<a href="http://www.bibleserver.com/go.php?lang=de&amp;bible=LUT&amp;ref=' . urlencode($vers) . '" target="_blank" title="Auf bibleserver.com nachschlagen">' . $vers . "</a>";
		else
			echo $vers;
		
		echo "</p>";
	}
	
	function applyFormat($text)
	{
		$text = preg_replace('#/(.*?:)/#', '<span class="losung-losungseinleitung">$1</span>', $text, 1);
		$text = preg_replace('/#(.*?)#/', '<em>$1</em>', $text);
		
		return $text;
	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['showcopy'] = $new_instance['showcopy'];
		$instance['showlink'] = $new_instance['showlink'];
		
		return $instance;
	}
 
	function form($instance) {
		$default = array('title' => 'Die Losung von Heute', 'showcopy' => true, 'showlink' => true );
	    $instance = wp_parse_args( (array) $instance, $default);
	
		echo '<p>';
	    echo  '<label for="' . $this->get_field_id('title') . '">';
	    echo  'Titel:</label>';
	    echo  '<input style="width: 100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $instance['title'] . '" />';
	    echo  '</p>';
		
		echo '<p>';
		echo '<input class="checkbox" type="checkbox" ';
		if ($instance['showlink'])
			echo 'checked="checked" ';
		echo 'id="' . $this->get_field_id( 'showlink' ) . '" name="' .  $this->get_field_name( 'showlink' ) . '" />';
		echo '<label for="' . $this->get_field_id( 'showlink' ) . '"> Zeige Link zu Bibleserver.com</label>';
		echo '</p>';
		
		echo '<p>';
		echo '<input class="checkbox" type="checkbox" ';
		if ($instance['showcopy'])
			echo 'checked="checked" ';
		echo 'id="' . $this->get_field_id( 'showcopy' ) . '" name="' .  $this->get_field_name( 'showcopy' ) . '" />';
		echo '<label for="' . $this->get_field_id( 'showcopy' ) . '"> Zeige Copyright</label>';
		echo '</p>';
	}
}

function LosungInit() {
  register_widget('Losung_Widget');
}
add_action('widgets_init', 'LosungInit');


?>
