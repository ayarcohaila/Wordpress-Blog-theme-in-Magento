<?php
	$theme_settings = korra_theme_settings();
	get_header();

	if (have_posts()): while (have_posts()) : the_post();

	$use_comments = false;
	if(
		get_post_meta( get_the_ID(), 'comments_use', true ) != '0' // comments are not disabled on post MUST
		&& ( comments_open() || get_comments_number() > 0 ) // comments are open or count > 0 MUST
		&& !post_password_required()
	){
		$use_comments = true;
	}

	$page_blog_use = get_post_meta( get_the_ID(), 'blog_use', true );

	$post_classes = '';
	$post_classes .= ' article-single article-single--page';

	if( !$use_comments && $page_blog_use ){
		$post_classes .= ' article-single--post-blog-last';
	}
?>



<div class="main-content">

	<div class="sidebar">
	<?php get_sidebar(); ?>
	</div>

	<div class="content-area">
		<!-- article -->
		<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>

			<div class="post__content"><?php
				if(
					get_post_meta( get_the_ID(), 'show_main_page_title', true ) !== '0' &&
					get_post_meta( get_the_ID(), 'show_main_page_title', true ) !== 'false' &&
					get_post_meta( get_the_ID(), 'rich_cover', true ) !== '1'
				){
					echo '<h1 class="post__title">';
					the_title();
					echo '</h1>';
				}
				if( get_the_content() ){
					echo '<div class="editor-content">';
						// If Gallery shown as cover, exclude it from content
						if( get_post_meta( get_the_ID(), 'cover_media', true ) == 'gallery' ){
							$output_content = korra_match_gallery( get_the_content(), true );
							echo apply_filters( 'the_content', $output_content );
						}else{
							the_content();
						}
					echo '</div>';
				}
			?></div>

			<?php korra_link_split_pages(); ?>

			<?php
			if( get_post_meta( get_the_ID(), 'blog_use', true ) ){
				get_template_part('page_blog');
			}
			?>

			<?php if( $use_comments ){
				echo '<div class="korra-fullwidth">';
				echo '<div class="grey-mode">';
				echo '<div class="post__comments js-masonry-comments">';
				comments_template();
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}?>

		</div>
	</div>
</div>




<?php endwhile; endif;

get_footer();
