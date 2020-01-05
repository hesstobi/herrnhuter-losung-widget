<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="updated inline">
    <?php

    foreach ($installed as $data) {
        echo "Losungen " ;
        echo $data['date']['year'] . ": " ;
        echo $data['installed'] ? 'Installiert' : 'Nicht installiert';
        echo '<br />' ;
    }
    ?>
</div>

<p>
	<label for="<?php echo $this->get_field_id('title') ?>">Titel:</label>
   	<input style="width: 100%;" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
</p>
	
<p>
	<input class="checkbox" type="checkbox" <?php if ($instance['showlink']) echo 'checked="checked" '; ?> id="<?php echo $this->get_field_id( 'showlink' ) ?>" name="<?php echo $this->get_field_name( 'showlink' ) ?> " />
	<label for="<?php echo $this->get_field_id( 'showlink' ) ?>">Zeige Link zu Bibleserver.com</label>
</p>
