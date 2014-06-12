<?php if (!empty($error)) : ?>
<p class="error">
	<?php echo $error; ?>
</p>
<?php endif; ?>
<?php if (!empty($message)) : ?>
<p class="updated">
	<?php echo $message; ?>
</p>
<?php endif; ?>
<?php if ($updateAvailable) :?>
<p class="notice">
	<?php foreach ($updateAvailable as $date) : ?>
	Die Losungen für <?php echo $date['year']; ?> können jetzt installiert werden:
	<input type="hidden" name="action" value="updatelosungen" /><input type="hidden" name="year" value="<?php echo $date['year']; ?>" /><input type="submit" class="button button-secondary right" value="Installieren" />
	<?php endforeach; ?>
</p>
<?php endif; ?>