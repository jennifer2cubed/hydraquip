<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); 
$l = et_page_config();
$sidebarname = 'single';
?>
<?php
	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	//do_action('woocommerce_before_main_content');
?>
<div class="product_breadcrumbs_main">
	<div class="product_breadcrumbs">
		Home
	</div>
</div>

<div id="product-<?php the_ID(); ?>" class="container">
	<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?> sidebar-mobile-<?php esc_attr_e( $l['shop-sidebar-mobile'] ); ?>">
        
		<?php while ( have_posts() ) : the_post(); ?>
	
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
	
		<?php endwhile; // end of the loop. ?>
    
    	<?php
    		/**
    		 * woocommerce_after_main_content hook
    		 *
    		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
    		 */
    		do_action( 'woocommerce_after_main_content' );
    	?>
	</div>
</div>

<div class="product_footer_main">
	<div class="product_footer">
		<?php echo do_shortcode('[partner_logo]'); ?>
		<br>
		<?php echo do_shortcode('[products_short_display]'); ?>
	</div>
</div>
<?php get_footer( 'shop' ); ?>