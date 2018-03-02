<!doctype html>
<?php $theme_settings = korra_theme_settings(); ?>

<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<?php wp_head(); ?>
</head>



<body <?php body_class(); ?>>
<div class="korra-loader korra-loader--body"></div>

<?php get_template_part('notification_bar'); ?>

<nav class="korra-nav--mobile">
	<div class="nano-content">
	<div class="nano-content-inwrap">
		<a href="#" class="korra-nav--mobile-btn js-korra-nav-toggle label--small"><?php esc_html_e('Close', 'whyte'); ?></a>
		<?php
			korra_nav_menu_mobile();
			get_template_part('searchform');
		 ?>
	</div>
	</div>
</nav>

<?php
// Get header classes
$header_classes = '';
?>

<header id="header" class="header <?php echo esc_attr($header_classes); ?>">


	<div class="header__inwrap max-width-wrapper">

		<div class="header__menu">
			<div class="korra-nav--classic">
				<?php korra_nav_menu_header(); ?>
			</div>
		</div>

		<div class="header__location">

			<a href="#" class="korra-nav--mobile-btn js-korra-nav-toggle"><?php esc_html_e('Menu & Search', 'whyte'); ?><i class="has-dropdown-icon"></i></a>

			<?php if( function_exists('bcn_display') ){
				echo '<div class="breadcrumbs label--small">';
				echo '<div class="breadcrumbs_inwrap" typeof="BreadcrumbList" vocab="http://schema.org/">';
					bcn_display();
				echo '</div>';
				echo '</div>';
			}?>

			<div class="search__toggle"><i class="korra-icon-magnifier"></i></div>
			<?php get_template_part('searchform'); ?>

		</div>

	</div>

	<div class="korra-logo">
		<a href="<?php echo  esc_url( home_url('/') ) ; ?>">
			<?php if( !$theme_settings['logo'] ): ?>
				<span class="sitename h2"><?php echo bloginfo('name'); ?></span>
			<?php else: ?>
				<img src="<?php echo esc_url($theme_settings['logo']); ?> " alt="<?php echo get_bloginfo('name'); ?>" class="main"/>
			<?php endif; ?>
		</a>
	</div>

</header>



<!-- wrapper -->
<div id="content-wrapper" class="content-wrapper">
	<div id="content-wrapper-inside" class="content-wrapper__inside <?php echo korra_layout_classes(); ?>">

		<?php
			if( is_active_sidebar('widget-area-before-content') ){
				echo '<div class="padding-wrapper">';
				echo '<div class="widget-area--content widget-area--before-content">';
				dynamic_sidebar('widget-area-before-content');
				echo '</div>';
				echo '</div>';
			}

			if( is_home() ){
				if( (int)$theme_settings['featured_count'] != 0 ){
					get_template_part('loop', 'featured');
				}
			}

			if( is_page() ){
				if(
					(int)$theme_settings['featured_count'] != 0
					&& get_post_meta( get_the_ID(), 'use_featured', true ) == '1'
				){
					get_template_part('loop', 'featured');
				}
			}
		?>

		<?php get_template_part('cover'); ?>
