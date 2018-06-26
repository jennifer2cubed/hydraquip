<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	get_header( 'shop' );

	$l = et_page_config();

	$full_width = etheme_get_option('shop_full_width');

	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	do_action( 'woocommerce_before_main_content' );
	
?>

<?php $cat_desc = etheme_get_option('product_banner_position') ? etheme_get_option('product_banner_position') : ''; ?>
<div class="<?php echo (!$full_width) ? 'container' : 'shop-full-width'; ?>">
	<div class="page-content sidebar-position-<?php echo esc_attr( $l['sidebar'] ); ?> <?php if (etheme_get_option('grid_sidebar') != 'without'): ?> sidebar-mobile-<?php esc_attr_e( $l['shop-sidebar-mobile'] ); ?> <?php endif; ?>">
		<div class="row row-eq-height">

			<div class="content main-products-loop <?php esc_attr_e( $l['content-class'] ); ?>">
                <div <?php echo ($full_width) ? 'class="container"' : ''; ?>>
					<?php if ( $cat_desc == 'top' || $cat_desc == '' ): ?>
						<?php etheme_category_header();?>
					<?php endif; ?>
					<?php
						/**
						 * Hook: woocommerce_archive_description.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
					?>
                </div>

				<div class="shop-filters-area">
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('shop-widgets-area')): ?>
					<?php endif; ?>
				</div>


				<?php if ( have_posts() ) : ?>

					<?php if (woocommerce_products_will_display()): ?>
	                    <div class="filter-wrap">
	                    	<div class="filter-content">
		                    	<?php
		                    		/**
		                    		 * woocommerce_before_shop_loop hook
		                    		 *
		                    		 * @hooked woocommerce_result_count - 20
		                    		 * @hooked woocommerce_catalog_ordering - 30
		                             * @hooked et_grid_list_switcher - 35
		                    		 */
		                    		do_action( 'woocommerce_before_shop_loop' );
		                    	?>
	                    	</div>
	                    </div>
					<?php endif ?>

					<?php

					woocommerce_product_loop_start();
					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();
							
							$currency = get_woocommerce_currency_symbol();
							$price = floatval(get_post_meta( get_the_ID(), '_regular_price', true));
							$price = number_format((float)$price, 2, '.', '');
							
							$product_id = get_the_ID();
							//$sku = get_sku($product_id);
							
							$terms_post = get_the_terms( $post->cat_ID , 'product_cat' );
								foreach ($terms_post as $term_cat) { 
									$term_cat_id = $term_cat->term_id; 
									$term_cat_id;
								}
							
							$cat = get_the_category_by_ID($term_cat_id);
							
							?>
							<div class="col-md-4">
								<div class="archive_wrapper">
									<div class="archive_category">
											<?php echo $cat; ?>
									</div>
									<div class="archive_title">
										<a href="<?php echo get_permalink(); ?>">
											<?php echo get_the_title(); ?>
										</a>
									</div>
									<div class="archive_img">
										<a href="<?php echo get_permalink(); ?>">
											<img src="<?php echo get_the_post_thumbnail_url(); ?>">
										</a>
									</div>
									<div class="archive_rating">
										<?php echo woocommerce_template_loop_rating(); ?>
									</div>
									<div class="archive_short_desc">
										<?php echo get_the_excerpt(); ?>
									</div>
									<div class="archive_sku">
										<?php //echo $sku; ?>
									</div>
									<div class="row">
										<div class="col-md-8">
											<div class="archive_price">
												<?php echo $currency; echo $price; ?>
											</div>
											<div class="archive_inc_vat">
												<?php price_excluding_vat(); ?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="archive_add_to_cart">
												<a href="/?add-to-cart=<?php echo $product_id; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>
									<div class="row compare_wish">
										<div class="col-md-6">
											<div class="btn_wrapper">
												<a href="/?action=yith-woocompare-add-product&id=<?php echo $product_id; ?>"><i class="fa fa-refresh" aria-hidden="true"></i> Add to Compare</a>
											</div>
										</div>
										<div class="col-md-6">
											<div class="btn_wrapper">
												<a href="/?add-to-wishlist=<?php echo $product_id; ?>"><i class="fa fa-heart-o" aria-hidden="true"></i> Add to Wishlist</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							/**
							 * Hook: woocommerce_shop_loop.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );*/
						}
					}

					woocommerce_product_loop_end();

					?>

					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php else: ?>

					<?php
						/**
						 * Hook: woocommerce_no_products_found.
						 *
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
					 ?>

				<?php endif; ?>

			<?php
				/**
				 * woocommerce_after_main_content hook
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );
			?>
			<?php if ( $cat_desc == 'bottom' ) {
					etheme_category_header();
				}; ?>
			</div>

			<?php if ( etheme_get_option('shop_sidebar_responsive_display') && etheme_get_option('grid_sidebar') != 'without' && wc_get_loop_prop( 'columns', wc_get_default_products_per_row() ) < 6) : ?>
			<button type="button" class="btn filled medium" id="show-shop-sidebar"><?php esc_html_e('Filters', 'woopress'); ?> </button> <div class="hidden-shop-sidebar already-hidden"> <?php endif; ?>
			<?php do_action( 'woocommerce_sidebar' ); ?>
				<?php if ( etheme_get_option('shop_sidebar_responsive_display') && etheme_get_option('grid_sidebar') != 'without' && wc_get_loop_prop( 'columns', wc_get_default_products_per_row() ) < 6) echo '</div>'; ?>

		</div>

	</div>
</div>




<?php get_footer( 'shop' ); ?>
