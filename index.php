<?php
	$theme_settings = korra_theme_settings();
	get_header();
?>

	<div class="main-content">
		<div class="sidebar">
		<?php get_sidebar(); ?>
		</div>
<?php

	get_template_part('loop');

	get_footer();
