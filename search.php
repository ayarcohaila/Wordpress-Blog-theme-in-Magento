<?php
	$theme_settings = korra_theme_settings();
	get_header();

?>

<div class="main-content sub_categories">
	<div class="sidebar">
	<?php get_sidebar(); ?>
	</div>

<?php

get_template_part('loop');

if( !have_posts() ): ?>
	<div class="article-single article-single--page article--widget-area article-single--search-no-results">

		<div class="post__content">
			<?php
				if( is_active_sidebar('search-results') ){
						dynamic_sidebar('search-results');
				}else{
					echo '<div class="align-center">';
					echo '<p class="highlighted-p">' . esc_html__( 'Unfortunately, no results have been found.', 'whyte' ) . '</p>';
					echo '</div>';
				}
			?>
		</div>

	</div>

<?php endif;

get_footer();
