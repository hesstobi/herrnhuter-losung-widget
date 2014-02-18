<?php
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
