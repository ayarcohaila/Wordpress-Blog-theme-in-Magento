<?php

/*------------------------------------------------------------
 * This is loop_item-masonry_image template.
 * Style: masonry_image
 * Title: Image Masonry Grid
 *------------------------------------------------------------*/

$theme_settings = korra_theme_settings();
$post_format = get_post_format();

// revert post format for unsupported formats
// helpfull for pre-korra content
if( $post_format == 'status' || $post_format == 'link' || $post_format == 'aside' ){
	$post_format = false;
}

$post_classes = '';
$post_classes .= 'korra-animate-appearance';

?>

<article <?php post_class( $post_classes ); ?>>
	<div class="post__inwrap">

		<?php if( $post_format == 'quote' ){

			$quote = korra_match_blockquote( get_the_content() );
			if( !empty( $quote ) ){
				echo '<div class="blockquote-wrapper dark-mode" style="'.korra_get_post_gradient(false, true).'">';
					echo '<a href="'.get_the_permalink().'" title="'.esc_attr( get_the_title() ).'">';
						$quote_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'korra-portrait-m' );
						echo '<div class="img" style="background-image:url('.$quote_image[0].');"></div>';
					echo '</a>';
					echo do_shortcode( $quote );
				echo '</div>';
			}else{
				// treat the post like a standard format
				$post_format = false;
			}

		}?>



		<?php if( $post_format == 'video' || $post_format == 'audio' ){

			$embed = korra_match_first_embed( get_the_content() );

			if( !empty( $embed ) ){

				$tag = substr($embed, 0, 6);
				$wrap = false;

				if( $tag == '<ifram' || $tag == '<objec' || $tag == '<embed' ){
					$wrap = true;
				}

				if( $wrap ){
					// Wrap with youtube domain to ensure responsiveness
					// If it happens that user needs to support twitter or similar
					// non-responsive embed, tweak it via custom CSS
					echo '<div class="korra-embed-container domain-youtube">';
				}

				echo do_shortcode( $embed );

				if( $wrap ){
					echo '</div>';
				}
			}else{
				// treat the post like a standard format
				$post_format = false;
			}

		}?>



		<?php if( $post_format == 'gallery' ){


			$gallery = korra_match_gallery( get_the_content() );

			if( !empty( $gallery ) ){

				preg_match('/ids=".*?"/', $gallery, $ids);

				if( !empty($ids) ){
					$gallery = '[gallery size="korra-portrait-m" korra_style="slider" korra_interval="0" link="none" '.$ids[0].']';

					echo do_shortcode( $gallery );
				}

			}else{
				// treat the post like a standard format
				$post_format = false;
			}

		}?>



		<?php if( $post_format=='image' ){
			$post_format = false;
		}?>



		<?php if( !$post_format && has_post_thumbnail() ): ?>
			<div class="post__media">
				<div class="korra-media-gradient-hover">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
						<?php the_post_thumbnail( 'korra-portrait-m' ); ?>
					</a>
					<div class="korra-media-gradient-hover__hover" style="<?php echo korra_get_post_gradient(false, true); ?>"></div>
					<div class="korra-x"></div>
				</div>
			</div>
		<?php endif; ?>



		<div class="post__text">

			<?php if( $post_format != 'quote'): ?>

				<?php echo korra_category(2); ?>

				<h4 class="post__title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
						<?php echo esc_html( get_the_title() ); ?>
					</a>
				</h4>

				<div class="post__excerpt--wrapper">
					<?php korra_wp_excerpt(); ?>
				</div>

			<?php endif; ?>

			<div class="post__meta label--small">
				<div class="meta--date"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . esc_html__(' ago', 'whyte'); ?></div>
			</div>

			<?php get_template_part('share_block'); ?>

		</div>



	</div>
</article>
