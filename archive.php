<?php
	get_header();
?>

<div class="main-content sub_categories">

	<div class="sidebar">
	<?php get_sidebar(); ?>
	</div>

<?php
get_template_part('loop');

get_footer();
