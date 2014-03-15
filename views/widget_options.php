<?php if ($message) : ?>
<p class="notice">
	<?php echo $message; ?>
</p>
<?php endif; ?>
<?php if ($updateAvailable) :?>
<p class="notice">
	<?php foreach ($updateAvailable as $date) : ?>
	Die Losungen für <?php echo $date['year']; ?> können jetzt installiert werden:
	<form action="#" method="post"><input type="hidden" name="action" value="updatelosungen" /><input type="hidden" name="year" value="<?php echo $date['year']; ?>" /><input type="submit" class="button button-secondary right" value="Installieren" />
	<?php endforeach; ?>
</p>
<?php endif; ?>
<p>
	<label for="<?php echo $this->get_field_id('title') ?>">Titel:</label>
   	<input style="width: 100%;" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
</p>
	
<p>
	<input class="checkbox" type="checkbox" <?php if ($instance['showlink']) echo 'checked="checked" '; ?> id="<?php echo $this->get_field_id( 'showlink' ) ?>" name="<?php echo $this->get_field_name( 'showlink' ) ?> " />
	<label for="<?php echo $this->get_field_id( 'showlink' ) ?>">Zeige Link zu Bibleserver.com</label>
</p>
