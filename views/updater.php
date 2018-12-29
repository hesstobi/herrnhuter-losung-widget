<?php if (!empty($error)) : ?>
<div class="error">
	<b>Herrnhuter Losungen:</b><br />
	<?php echo $error; ?>
</div>
<?php endif; ?>
<?php if (!empty($message)) : ?>
<div class="updated">
	<b>Herrnhuter Losungen:</b><br />
	<?php echo $message; ?>
</div>
<?php endif; ?>
<?php if ($updateAvailable) : ?>
<div class="updated">
	<b>Herrnhuter Losungen:</b>	<br />
	<?php foreach ($updateAvailable as $date) : ?>
	Die Losungen für <?php echo $date['year']; ?> können installiert werden:
	<br /> <br />
	<form action="" method="post">
	<input type="hidden" name="action" value="updatelosungen" />
	<input type="hidden" name="year" value="<?php echo $date['year']; ?>" />
	<input type="submit" class="button button-primary" value="Installieren" />
	</form>
	<br /> <br />
	<?php endforeach; ?>
</div>
<?php endif; ?>
