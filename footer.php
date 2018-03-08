<?php

$theme_settings = korra_theme_settings();
$footer_class = 'padding-wrapper';

if( !empty( $theme_settings['bg_footer'] ) ){
	if( $theme_settings['bg_footer_dark'] ){
		$footer_class .= ' dark-mode';
	}
}else{
	$footer_class .= ' no-background';
}
?>

</div> <!-- /.main-content -->



<?php
	if( is_active_sidebar('widget-area-after-content') ){
		echo '<div class="widget-area--content widget-area--after-content">';
		echo '<div class="padding-wrapper">';
			dynamic_sidebar('widget-area-after-content');
			echo '</div>';
		echo '</div>';
	}
?>


<?php

if( is_active_sidebar('footer-area-instagram') ){
	echo '<div class="footer-instagram padding-wrapper">';
		dynamic_sidebar('footer-area-instagram');
	echo '</div>';
}

if( $theme_settings['logo_footer'] || $theme_settings['copyright'] ){
	echo '<div class="footer__floor">';
		// Footer Logo
		if( $theme_settings['logo_footer'] ){
			echo '<a class="footer__logo" href="' . esc_url( home_url('/') ) . '">';
			echo '<img src="' . esc_url( $theme_settings['logo_footer'] ) . '" alt="'.get_bloginfo('name').'"/>';
			echo '</a>';
		}
		// Copyright
		if( $theme_settings['copyright'] ){
			echo '<div class="copyright label--italic">';
			echo wpautop( do_shortcode( esc_html( $theme_settings['copyright'] ) ) );
			echo '</div>';
		}
	echo '</div>';
}

?>


<div class="footer <?php echo esc_attr($footer_class); ?>">
<div class="footer__inwrap">

	<?php

	if( is_active_sidebar('footer-area-top') ){
		echo '<div class="footer__top">';
		dynamic_sidebar('footer-area-top');
		echo '</div>';
	}

	// Widgets
	if( is_active_sidebar('footer-area-1') || is_active_sidebar('footer-area-2') ){
		echo '<div class="footer__widgets">';
			if( is_active_sidebar('footer-area-1') ){
				echo '<div class="footer__widgets__1">';
				dynamic_sidebar('footer-area-1');
				echo '</div>';
			}
			if( is_active_sidebar('footer-area-2') ){
				echo '<div class="footer__widgets__2">';
				dynamic_sidebar('footer-area-2');
				echo '</div>';
			}
		echo '</div>';
	}

	if( is_active_sidebar('footer-area-bottom') ){
		echo '<div class="footer__bottom">';
			dynamic_sidebar('footer-area-bottom');
		echo '</div>';
	}
?>

</div>
</div>

</div> <!-- /# content wrapper inside -->
</div> <!-- /# content wrapper -->



<?php wp_footer(); ?>

</body>
</html>
