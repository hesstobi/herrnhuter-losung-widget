<?php 
$defaults = array(
	'css' => 'losung',
	'showlink' => true
);
$options = $options + $defaults;
?>
<p class="losung-text <?php echo $options['css'] ?>"><?php echo $text; ?></p>
<p class="losung-versangabe">
<?php if ($options['showlink']) : ?>
	<a href="http://www.bibleserver.com/go.php?lang=de&amp;bible=LUT&amp;ref=<?php echo urlencode($vers) ?>" target="_blank" title="Auf bibleserver.com nachschlagen"><?php echo esc_html($vers); ?></a>
<?php else : ?>
	<?php echo esc_html($vers); ?>
<?php endif; ?>
</p>
