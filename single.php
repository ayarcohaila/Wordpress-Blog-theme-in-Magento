<?php
	$theme_settings = korra_theme_settings();
	get_header();

	if (have_posts()): while (have_posts()) : the_post();

	if( $theme_settings['post_infobar'] ){
		get_template_part('infobar');
	}

	$format = get_post_format();
	$post_classes = '';
	$post_classes .= ' article-single article-single--post';
?>

<div class="main-content">


<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?> role="main" data-title="<?php echo esc_attr( get_the_title() ); ?>">

	<div class="post__content">

		<h1 class="post__title post__title__mobile"><?php echo esc_html( get_the_title() ); ?></h1>

		<?php
			$meta_class = '';
			if( get_post_meta( get_the_ID(), 'post_meta_sticky', true ) == '0' ){
				$meta_class = 'korra-sideblock--non-sticky';
			}
		?>

		<div class="korra-sideblock korra-sideblock--meta <?php echo $meta_class; ?>">

			<?php
			if( $theme_settings['post_share'] ){
				get_template_part('share_block');
			}

			get_template_part('post_meta');
			?>
		</div>

		<h2 class="h1 post__title post__title__not_mobile"><?php echo esc_html( get_the_title() ); ?></h2>

		<div class="editor-content">

			<?php
			// If Gallery or video is shown as cover, exclude it from content
			switch( get_post_meta( get_the_ID(), 'cover_media', true ) ){
				case 'gallery':
					$output_content = korra_match_gallery( get_the_content(), true );
					echo apply_filters( 'the_content', $output_content );
					break;
				case 'video':
					$output_content = korra_match_first_embed( get_the_content(), true );
					echo apply_filters( 'the_content', $output_content );
					break;
				default:
					the_content();
			}
			?>

		</div>


		<?php if( $theme_settings['post_author'] ): ?>
			<div class="post__author clearfix cl">
				<?php get_template_part('author_block'); ?>
			</div>
		<?php endif; ?>

	</div>

	<?php korra_link_split_pages(); ?>

	<div class="korra-separator"><div class="korra-x left"></div></div>

</article>

<?php if( $theme_settings['post_related'] ): ?>
	<div class="post__related">
		<?php get_template_part('related_posts') ?>
	</div>
<?php endif; ?>



<?php if(
get_post_meta( get_the_ID(), 'comments_use', true ) != '0' // comments are not disabled on post MUST
&& ( comments_open() || get_comments_number() > 0 ) // comments are open or count > 0 MUST
&& !post_password_required()
){
	echo '<div class="post__comments korra-fullwidth grey-mode">';
	echo '<div class="post__comments__inwrap js-masonry-comments">';
	comments_template();
	echo '</div>';
	echo '</div>';
}?>





<?php endwhile; endif;

get_footer();
