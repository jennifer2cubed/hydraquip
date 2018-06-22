<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php global $etheme_responsive, $woocommerce; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

    <meta name="viewport" content="<?php if($etheme_responsive): ?>width=device-width, initial-scale=1, maximum-scale=2.0<?php else: ?>width=1200<?php endif; ?>"/>
   	<meta http-equiv="X-UA-Compatible" content="IE=edge" >

	<link rel="shortcut icon" href="<?php echo et_get_favicon(); ?>" />
	<title><?php wp_title( '|', true, 'right' );?></title>
		<?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'et_after_body' ); ?>

<div class="he_top_bar_full">
	<div class="he_top_bar">
		<div class="he_top_bar_left">
			<span><i class="fa fa-phone" aria-hidden="true"></i> +353 45 438415</span>
			<span><i class="fa fa-envelope-o" aria-hidden="true"></i> sales@hydraquip.ie</span>
		</div>
		<div class="he_top_bar_right">
			<span><a href="/store-locator/"><i class="fa fa-map-marker" aria-hidden="true"></i> Store Locator</a></span>
			<span></span>
			<span>
			<?php 
				if(!is_user_logged_in()) {
					?>
					<span><a href="/my-account/"><i class="fa fa-user-o" aria-hidden="true"></i> Register</a></span>
					<span> or </span>
					<span><a href="/my-account/">Sign in</a></span>
					<?php
				} else {
					?>
					<span><a href="/my-account/"><i class="fa fa-user-o" aria-hidden="true"></i> My Account</a></span>
					<?php
				}
				
			?>
			</span>
		</div>
	</div>
</div>

<div id="st-container" class="st-container">
	<nav class="st-menu mobile-menu-block">
		<div class="nav-wrapper">
			<div class="st-menu-content">
				<div class="mobile-nav">
					<div class="close-mobile-nav close-block mobile-nav-heading"><i class="fa fa-bars"></i> <?php esc_html_e('Navigation', 'woopress'); ?></div>

					<?php et_get_mobile_menu();	?>

					<?php  if (etheme_get_option('top_links')): ?>
						<div class="mobile-nav-heading"><i class="fa fa-user"></i><?php esc_html_e('Account', 'woopress'); ?></div>
						<?php etheme_top_links(array('popups' => false)); ?>
					<?php endif;  ?>

					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('mobile-sidebar')): ?>

					<?php endif; ?>
				</div>
			</div>
		</div>

	</nav>

	<div class="st-pusher" style="background-color:#fff;">
	<div class="st-content">
	<div class="st-content-inner">
	<div class="page-wrapper fixNav-enabled">

		<?php

			$ht = ''; $ht = apply_filters('custom_header_filter',$ht);
			$hstrucutre = etheme_get_header_structure($ht);
			if ( etheme_get_option('custom_header') ) $hstrucutre = 'custom';
			if ( etheme_get_custom_field( 'current_header_type', et_get_page_id() ) ) $hstrucutre = etheme_get_header_structure( etheme_get_custom_field( 'current_header_type', et_get_page_id() ) );
			if ( etheme_get_custom_field('current_custom_header', et_get_page_id() ) ) $hstrucutre = 'custom';

		?>

		<?php if (etheme_get_option('fixed_nav_sw') == 'on'): ?>

			<div class="fixed-header-area fixed-header-type-<?php echo esc_attr($ht); ?> color-<?php echo etheme_get_option('fixed_header_colors'); ?>">
				<div class="fixed-header">
					<div class="container">

						<div id="st-trigger-effects" class="column">
							<button data-effect="mobile-menu-block" class="menu-icon"></button>
						</div>

						<div class="header-logo">
							<?php etheme_logo(true); ?>
						</div>

						<div class="collapse navbar-collapse">

							<?php
								et_get_main_menu();
								et_get_main_menu('main-menu-right');
							?>

						</div><!-- /.navbar-collapse -->

						<div class="navbar-header navbar-right">
							<div class="navbar-right">
					            <?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget_sw') == 'on'): ?>
				                    <?php echo do_shortcode( '[et_top_cart]' ); ?>
					            <?php endif ;?>

								<?php if(etheme_get_option('search_form_sw') == 'on'): ?>
									<?php etheme_search_form(); ?>
								<?php endif; ?>

							</div>
						</div>

					</div>
				</div>
			</div>
		<?php endif ?>

		<?php get_template_part('headers/header-structure', $hstrucutre); ?>
