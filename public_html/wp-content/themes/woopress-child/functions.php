<?php add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'bootstrap', 'parent-style' ) );
}

add_shortcode('footer','footer');
function footer() {
	ob_start();
	?>
		<div class="row he_footer">
			<div class="col-md-4">
				<img src="/wp-content/uploads/2018/05/logo_v1.png"><br>
				<div class="he_footer_contact">
					<div class="row">
						<div class="col-md-3">
							<img src="/wp-content/uploads/2018/05/hydraquip-headphone-mic-v01.png">
						</div>
						<div class="col-md-9">
							<span class="he_footer_call">Got questions? Call us Mon-Fri 9am-6pm
							<span>+353 45438415</span>
							</span>
						</div>
					</div>
					<div class="he_footer_social">
						<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="he_footer_title">Contact info</div>
					Hydraquip Ltd.,<br>
					Unit W5A,<br>
					Toughers Business Park,<br>
					Ladytown, Naas,<br>
					Co. Kildare,<br>
					Republic of Ireland<br>
			</div>
			<div class="col-md-2">
				<div class="he_footer_title">Find it Fast</div>
				<?php wp_nav_menu( array( 
										'menu'				=> 'find-it-fast',
										'theme_location' 	=> '__no_such_location',
										'fallback_cb'		=> false
										) ); ?>
			</div>
			<div class="col-md-2">
				<div class="he_footer_title">Company</div>
				<?php wp_nav_menu( array( 
										'menu'				=> 'company',
										'theme_location' 	=> '__no_such_location',
										'fallback_cb'		=> false
										) ); ?>
			</div>
			<div class="col-md-2">
				<div class="he_footer_title">Customer Care</div>
				<?php wp_nav_menu( array( 
										'menu'				=> 'customer-care',
										'theme_location' 	=> '__no_such_location',
										'fallback_cb'		=> false
										) ); ?>
			</div>
		</div>
	<?php
	return ob_get_clean();
};

add_shortcode('copyright','copyright');
function copyright() {
	ob_start();
	?>
		<div class="row he_copyright">
			<div class="col-md-6">
				&copy; <strong>Hydraquip Ltd</strong> - All rights Reserved - Web Design by <a href="https://2cubed.ie">2Cubed</a>
			</div>
			<div class="col-md-6">
				<img src="/wp-content/uploads/2018/05/cards.png" style="float:right">
			</div>
		</div>
	<?php
	return ob_get_clean();
};

//Partner logos loop
add_shortcode('partner_logo','partner_logo');
function partner_logo() {
	ob_start();
	
	echo do_shortcode('[vc_row][vc_column][vc_gallery images="148,147,151,152,149,150" img_size="full" el_class="about_slider"][/vc_column][/vc_row]');
	
	return ob_get_clean();
}

//Display products (3 columns)
add_shortcode('products_short_display','products_short_display');
function products_short_display() {
	ob_start();
	
	echo do_shortcode('[vc_row][vc_column width="1/3"][vc_raw_html]JTNDaDUlM0VGZWF0dXJlZCUyMFByb2R1Y3RzJTNDJTJGaDUlM0UlM0NiciUzRSUwQSUzQ3NwYW4lMjBjbGFzcyUzRCUyMmJsdWVfYm90X2xpbmUlMjIlM0UlM0MlMkZzcGFuJTNFJTNDc3BhbiUyMGNsYXNzJTNEJTIyZ3JheV9ib3RfbGluZSUyMiUzRSUzQyUyRnNwYW4lM0U=[/vc_raw_html][vc_column_text][/vc_column_text][/vc_column][vc_column width="1/3"][vc_raw_html]JTNDaDUlM0VPbnNhbGUlMjBQcm9kdWN0cyUzQyUyRmg1JTNFJTNDYnIlM0UlMEElM0NzcGFuJTIwY2xhc3MlM0QlMjJibHVlX2JvdF9saW5lJTIyJTNFJTNDJTJGc3BhbiUzRSUzQ3NwYW4lMjBjbGFzcyUzRCUyMmdyYXlfYm90X2xpbmUlMjIlM0UlM0MlMkZzcGFuJTNF[/vc_raw_html][vc_column_text][/vc_column_text][/vc_column][vc_column width="1/3"][vc_raw_html]JTNDaDUlM0VUb3AlMjBSYXRlZCUyMFByb2R1Y3RzJTNDJTJGaDUlM0UlM0NiciUzRSUwQSUzQ3NwYW4lMjBjbGFzcyUzRCUyMmJsdWVfYm90X2xpbmUlMjIlM0UlM0MlMkZzcGFuJTNFJTNDc3BhbiUyMGNsYXNzJTNEJTIyZ3JheV9ib3RfbGluZSUyMiUzRSUzQyUyRnNwYW4lM0U=[/vc_raw_html][vc_column_text][/vc_column_text][/vc_column][/vc_row]');
	
	return ob_get_clean();
}

//Date last modified
add_shortcode('last_edited','last_edited');
function last_edited() {
	ob_start();
	
	?>
	<p><center>This Agreement was last modified on <?php the_modified_date('j F, Y'); ?></center></p>
	<?php
	
	return ob_get_clean();
}

//Add Confirm password field
function woocommerce_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'woocommerce_registration_errors_validation', 10, 3);
function woocommerce_register_form_password_repeat() {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Confirm password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
}
add_action( 'woocommerce_register_form', 'woocommerce_register_form_password_repeat' );


add_shortcode('delivery_costs','delivery_costs');
function delivery_costs() {
	ob_start();
	?>
	<script>
	jQuery(document).ready(function($){
		
		var default_country = $('.outtaHere').val();
		$('.'+default_country).fadeIn(500, function(){});
		$('.outtaHere').change(function(){
			var selected = $(this).val();
			
			$('.countrylist > div').hide();
			$('.'+selected).fadeIn(500, function(){}); 
			//$('.optionvalue').html(selected.html());
		});
	});
	</script>
	<div class="delivery_wrapper">
		<div class="delivery_country">
			<div class="delivery_select">Shipping costs for:</div>
			<select class=" outtaHere">
				<option class="selected" value="shipping_ireland">Ireland</option>
				<option value="shipping_uk">United Kingdom</option>
				<option value="shipping_europe">European Union</option>
				<option value="shipping_rest">Rest of world</option>
			</select>
			<div class="delivery_select_info">Want to see the delivery options for other countries? Please select a different country</div>
		</div>
		<div class="scroll-content">
			<div class="countrylist">
				
				<div class="shipping_ireland">
					<div class="row delivery_heading">
						<div class="col-md-10">
							Delivery Method fo Ireland
						</div>
						<div class="col-md-2">
							Cost
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Free Delivery</strong><br>
							4-6 working days after dispatch<br>
							Free Delivery available on orders over €50.00
						</div>
						<div class="col-md-2">
							<strong>€0.00</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Standard Delivery</strong><br>
							3-4 working days after dispatch<br>
							Upgrade for faster delivery
						</div>
						<div class="col-md-2">
							<strong>€3.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Express Tracked</strong><br>
							Product will be shipped with next day delivery if in stock with 1-3<br>
							working days after dispatch fast, tracked, with peace of mind.
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Next Day Delivery</strong><br>
							1 working day after dispatch with Premium<br>
							Dispatch and delivery
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
				</div>
				<div class="shipping_uk">
					<div class="row delivery_heading">
						<div class="col-md-10">
							Delivery Method fo United Kingdom
						</div>
						<div class="col-md-2">
							Cost
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Free Delivery</strong><br>
							4-6 working days after dispatch<br>
							Free Delivery available on orders over €50.00
						</div>
						<div class="col-md-2">
							<strong>€0.00</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Standard Delivery</strong><br>
							3-4 working days after dispatch<br>
							Upgrade for faster delivery
						</div>
						<div class="col-md-2">
							<strong>€3.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Express Tracked</strong><br>
							Product will be shipped with next day delivery if in stock with 1-3<br>
							working days after dispatch fast, tracked, with peace of mind.
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Next Day Delivery</strong><br>
							1 working day after dispatch with Premium<br>
							Dispatch and delivery
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
				</div>
				<div class="shipping_europe">
					<div class="row delivery_heading">
						<div class="col-md-10">
							Delivery Method fo European Union
						</div>
						<div class="col-md-2">
							Cost
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Free Delivery</strong><br>
							4-6 working days after dispatch<br>
							Free Delivery available on orders over €50.00
						</div>
						<div class="col-md-2">
							<strong>€0.00</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Standard Delivery</strong><br>
							3-4 working days after dispatch<br>
							Upgrade for faster delivery
						</div>
						<div class="col-md-2">
							<strong>€3.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Express Tracked</strong><br>
							Product will be shipped with next day delivery if in stock with 1-3<br>
							working days after dispatch fast, tracked, with peace of mind.
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Next Day Delivery</strong><br>
							1 working day after dispatch with Premium<br>
							Dispatch and delivery
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
				</div>
				<div class="shipping_rest">
					<div class="row delivery_heading">
						<div class="col-md-10">
							Delivery Method fo Rest of the World
						</div>
						<div class="col-md-2">
							Cost
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Free Delivery</strong><br>
							4-6 working days after dispatch<br>
							Free Delivery available on orders over €50.00
						</div>
						<div class="col-md-2">
							<strong>€0.00</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Standard Delivery</strong><br>
							3-4 working days after dispatch<br>
							Upgrade for faster delivery
						</div>
						<div class="col-md-2">
							<strong>€3.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Express Tracked</strong><br>
							Product will be shipped with next day delivery if in stock with 1-3<br>
							working days after dispatch fast, tracked, with peace of mind.
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
					<div class="row delivery_costs row-eq-height">
						<div class="col-md-10">
							<strong>Next Day Delivery</strong><br>
							1 working day after dispatch with Premium<br>
							Dispatch and delivery
						</div>
						<div class="col-md-2">
							<strong>€4.95</strong>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="desrarea optionvalue"></div>
	
	</div>
	
	<?php
	return ob_get_clean();
}

//Blog sidebar
function blog_sidebar() {
	register_sidebar( array(
		'name'          => 'Blog Sidebar',
		'id'            => 'blog_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'blog_sidebar' );

//blogs / news
add_shortcode('news_page', 'news_page');
function news_page() {

  $page  = new WP_Query( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page'=>-1, 'order'=>'DESC', 'orderby'=>'ID') );
  $author = get_the_author();
  
  $return = "";
  if ( $page->have_posts() ) {
    while ( $page->have_posts() ) {
      $page->the_post();
	  
	  $post_categories = wp_get_post_categories( get_the_ID());
		$cats = '';
		$count = count($post_categories);
		$i = 1;
		
		foreach($post_categories as $c){
			$cat = get_category( $c );
			if($i < $count) {
				$cats .= $cat->name.', ';
			} else {
				$cats .= $cat->name.'';
			}
			$i++;
		}
		
      $return .= "
					<div class='row cc_news_'>
					
						<div class='col-md-12'>
							".get_the_post_thumbnail()."
						</div>
						<div class='col-md-12'>
							<div class='cc_news_box'>
								<div class='cc_news_title'>
									<span class='he_news_title'>".get_the_title()."</span><br>									
									
									<span class='cc_news_categories'>".$cats." | </span>
									<span class='cc_news_month'>".get_the_date('d F Y')." | </span>
									<span class='cc_news_author'>Posted by ".$author."</span>
									
									
								</div>
								<p class='cc_news_ex'>".$string = rtrim(implode(' ', array_slice(explode(' ', get_the_excerpt()), 0, 70)), ',.-!? +-–=_')."</p>
								<span>
									<a href='".get_post_permalink()."' class='cc_news_readmore'>Read More</a>
									<span class='cc_news_comments'>
										<i class='fa fa-comment-o' aria-hidden='true'></i>
											<strong>".get_comments_number_text( '0', '1', '%' )."</strong>
									</span>
								</span>
							</div>
						</div>
					</div>
	";
    }
  }
  wp_reset_postdata();
  return $return;
}

// List of categories - news page
add_shortcode('list_of_categories', 'list_of_categories');
function list_of_categories(){
	
	ob_start();
	
	$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
	) );
	 
	foreach( $categories as $category ) {
		$category_link = sprintf( 
			'<a href="%1$s" alt="%2$s">%3$s</a>',
			esc_url( get_category_link( $category->term_id ) ),
			esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
			esc_html( $category->name )
		);
		 
		echo '<p class="cc_list_of_categories"><i class="fa fa-chevron-right" aria-hidden="true"></i> ' . sprintf( esc_html__( ' %s', 'textdomain' ), $category_link ) . '</p> ';
	}
	
	return ob_get_clean();
	
}

//recent posts
add_shortcode('news_recent_posts', 'news_recent_posts');
function news_recent_posts() {

  $page  = new WP_Query( array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page'=>5, 'order'=>'DESC', 'orderby'=>'ID') );
  
  $return = "";
  if ( $page->have_posts() ) {
    while ( $page->have_posts() ) {
      $page->the_post();
		
      $return .= "
					<div class='row cc_recent_news'>
						<div class='col-md-4'>
							".get_the_post_thumbnail()."
						</div>
						<div class='col-md-8'>
							<div class='cc_recent_news_box'>
								<div class='cc_recent_news_title'>
									".get_the_title()."
								</div>
								<a href='".get_post_permalink()."'>".get_the_date('F d, Y')."</a>
							</div>
						</div>
					</div>
	";
    }
  }
  wp_reset_postdata();
  return $return;
}

// Get free shipping is you spend XX more
add_action( 'woocommerce_before_cart', 'bbloomer_free_shipping_cart_notice_zones' );
function bbloomer_free_shipping_cart_notice_zones() {
 
global $woocommerce;
 
		// Get Free Shipping Methods for Rest of the World Zone & populate array $min_amounts
		 
		$default_zone = new WC_Shipping_Zone(0);
		$default_methods = $default_zone->get_shipping_methods();
		 
		foreach( $default_methods as $key => $value ) {
			if ( $value->id === "free_shipping" ) {
			  if ( $value->min_amount > 0 ) $min_amounts[] = $value->min_amount;
			}
		}
 
		// Get Free Shipping Methods for all other ZONES & populate array $min_amounts
 
		$delivery_zones = WC_Shipping_Zones::get_zones();
 
		foreach ( $delivery_zones as $key => $delivery_zone ) {
		  foreach ( $delivery_zone['shipping_methods'] as $key => $value ) {
			if ( $value->id === "free_shipping" ) {
			if ( $value->min_amount > 0 ) $min_amounts[] = $value->min_amount;
			}
		  }
		}
		 
		// Find lowest min_amount
		 
		if ( is_array($min_amounts) ) {
		 
		$min_amount = min($min_amounts);
		 
		// Get Cart Subtotal inc. Tax excl. Shipping
		 
		$current = WC()->cart->subtotal;
		 
		// If Subtotal < Min Amount Echo Notice
		// and add "Continue Shopping" button
 
		if ( $current < $min_amount ) {
				$added_text = esc_html__('Spend another ', 'woocommerce' ) . wc_price( $min_amount - $current ) . esc_html__(' to avail of free delivery', 'woocommerce' );
				$return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
				$notice = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continue Shopping', 'woocommerce' ), $added_text );
			wc_print_notice( $notice, 'notice' );
		}
	}
}

// Custom hooks for single product page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

//add_action( 'tc_product_add_to_cart_column', 'woocommerce_stock_html', 5 );
add_action( 'tc_product_add_to_cart_column', 'woocommerce_template_single_price', 10 );
add_action( 'tc_product_add_to_cart_column', 'price_excluding_vat', 20 );
add_action( 'tc_product_add_to_cart_column', 'woocommerce_template_single_add_to_cart', 30 );

add_action( 'woocommerce_single_product_summary', 'product_supplier_fnc', 6 );
add_action( 'woocommerce_single_product_summary', 'product_social_share', 11 );

function price_excluding_vat() {
	global $product;
	$currency = get_woocommerce_currency_symbol();
	$price = get_post_meta( get_the_ID(), '_regular_price', true);
	$exc_price = $product->get_price_excluding_tax();
	$inc_price = $product->get_price_including_tax();
	
	echo '<div class="price_exc_vat">exc VAT ('.$currency.''.$inc_price.' inc VAT)</div>'; 
}

function product_supplier_fnc() {
	global $product;
	$supp_logo = get_field('supplier');
	//var_dump(get_the_post_thumbnail_url($supp_logo));
	
	echo '<div class="supplier_logo"><img src="'.get_the_post_thumbnail_url($supp_logo).'"></div>';
}

function product_social_share() {
	global $product;
	$product_share = get_permalink();
	
	echo '	<div class="product_social_share"><a href="https://www.facebook.com/sharer/sharer.php?u='.$product_share.'"><img src="/wp-content/uploads/2018/06/fb.png"></a> 
			<a href="https://twitter.com/home?status='.$product_share.'"><img src="/wp-content/uploads/2018/06/twit.png"></a>
			<a href="https://pinterest.com/pin/create/button/?url=&media=&description='.$product_share.'"><img src="/wp-content/uploads/2018/06/pinit.png"></a>
			</div><br>';
}

//Variable product 
function wc_varb_price_range( $wcv_price, $product ) {
 
    $prefix = sprintf('%s ', __('<span class="price_from">From:</span><br>', 'wcvp_range'));
 
    $wcv_reg_min_price = $product->get_variation_regular_price( 'min', true );
    $wcv_min_sale_price    = $product->get_variation_sale_price( 'min', true );
    $wcv_max_price = $product->get_variation_price( 'max', true );
    $wcv_min_price = $product->get_variation_price( 'min', true );
 
    $wcv_price = ( $wcv_min_sale_price == $wcv_reg_min_price ) ?
        wc_price( $wcv_reg_min_price ) :
        '<del>' . wc_price( $wcv_reg_min_price ) . '</del>' . '<ins>' . wc_price( $wcv_min_sale_price ) . '</ins>';
 //return $wcv_min_price;
    return ( $wcv_min_price == $wcv_max_price ) ?
        $wcv_price :
        sprintf('%s%s', $prefix, $wcv_price);
}
 
add_filter( 'woocommerce_variable_sale_price_html', 'wc_varb_price_range', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_varb_price_range', 10, 2 );


// Product Suppliers
function product_suppliers() {

	$labels = array(
		'name'                  => _x( 'Product Suppliers', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Product Supplier', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Product Suppliers', 'text_domain' ),
		'name_admin_bar'        => __( 'Product Suppliers', 'text_domain' ),
		'archives'              => __( 'Supplier Archives', 'text_domain' ),
		'attributes'            => __( 'Supplier Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Supplier:', 'text_domain' ),
		'all_items'             => __( 'All Suppliers', 'text_domain' ),
		'add_new_item'          => __( 'Add New Supplier', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Supplier', 'text_domain' ),
		'edit_item'             => __( 'Edit Supplier', 'text_domain' ),
		'update_item'           => __( 'Update Supplier', 'text_domain' ),
		'view_item'             => __( 'View Supplier', 'text_domain' ),
		'view_items'            => __( 'View Suppliers', 'text_domain' ),
		'search_items'          => __( 'Search Supplier', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Supplier Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set Supplier image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove Supplier image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as Supplier image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Supplier', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Suppliers list', 'text_domain' ),
		'items_list_navigation' => __( 'Suppliers list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Suppliers list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Product Supplier', 'text_domain' ),
		'description'           => __( 'Supplier Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-products',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'product_suppliers', $args );

}
add_action( 'init', 'product_suppliers', 0 );


add_action('woocommerce_single_product_summary', 'add_contact_form', 20);
function add_contact_form() {
    global $product;
    if(!$product->is_in_stock( )) {
       echo do_shortcode('[name_of_shortcode]');
    }
}


//PDF Categories
add_shortcode('pdf_catalogue', 'pdf_catalogue');
function pdf_catalogue() {

  $page  = new WP_Query( 
			array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'posts_per_page'=>-1,
				'order'=>'DESC',
				'orderby'=>'date'
				)
			);
  
  $return = "";
  if ( $page->have_posts() ) {
    while ( $page->have_posts() ) {
      $page->the_post();
	  $file = get_field('pdf_catalogue');
		
      $return .= 
			($file ? '
				<div class="pdf_drawing_wrapper">
					Open this drawing in new window: <a href="'.$file['url'].'" target="_blank">'.$file['filename'].'</a>
				</div>
				<embed src="'.$file['url'].'" class="pdf_embed" type="application/pdf">
			' : 'Sorry there is no PDF catalogue available for this product');
    }
  }
  wp_reset_postdata();
  return $return;
}

//CAD Drawings
add_shortcode('cad_drawing', 'cad_drawing');
function cad_drawing() {

  $page  = new WP_Query( 
			array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'posts_per_page'=> -1,
				'order'=>'DESC',
				'orderby'=>'date'
				)
			);
  
  $return = "";
  if ( $page->have_posts() ) {
    while ( $page->have_posts() ) {
		$page->the_post();
		$file = get_field('cad_drawing');
		
		$return .= 
			($file ? '
				<div class="cad_drawing_wrapper">
					Open this drawing in new window: <a href="'.$file['url'].'" target="_blank">'.$file['filename'].'</a>
				</div>
				<embed src="'.$file['url'].'" class="cad_embed" type="application/pdf">
			' : 'Sorry there is no CAD Drawing available for this product');
		}
  }
  wp_reset_postdata();
  return $return;
}

//Removing Woocommerce Auto Login
function ws_new_user_approve_autologout(){
       if ( is_user_logged_in() ) {
                $current_user = wp_get_current_user();
                $user_id = $current_user->ID;

                if ( get_user_meta($user_id, 'pw_user_status', true )  === 'approved' ){ $approved = true; }
		else{ $approved = false; }


		if ( $approved ){ 
			return $redirect_url;
		}
                else{ //when user not approved yet, log them out
			wp_logout();
                        return add_query_arg( 'approved', 'false', get_permalink( get_option('woocommerce_myaccount_page_id') ) );
                }
        }
}
add_action('woocommerce_registration_redirect', 'ws_new_user_approve_autologout', 2);

function ws_new_user_approve_registration_message(){
        $not_approved_message = '<p class="registration">Send in your registration application today!<br /> NOTE: Your account will be held for moderation and you will be unable to login until it is approved.</p>';

        if( isset($_REQUEST['approved']) ){
                $approved = $_REQUEST['approved'];
                if ($approved == 'false')  echo '<p class="registration successful">Registration successful! You will be notified upon approval of your account.</p>';
                else echo $not_approved_message;
        }
        else echo $not_approved_message;
}
add_action('woocommerce_before_customer_login_form', 'ws_new_user_approve_registration_message', 2);

//Email Notifications
//Content parsing borrowed from: woocommerce/classes/class-wc-email.php
function ws_new_user_approve_send_approved_email($user_id){

	global $woocommerce;
	//Instantiate mailer
	$mailer = $woocommerce->mailer();

        if (!$user_id) return;

        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
        $user_pass  = "As specified during registration";

        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        $subject  = apply_filters( 'woocommerce_email_subject_customer_new_account', sprintf( __( 'Your account on %s has been approved!', 'woocommerce'), $blogname ), $user );
        $email_heading  = "User $user_login has been approved";

        // Buffer
        ob_start();

        // Get mail template
        woocommerce_get_template('emails/customer-account-approved.php', array(
                'user_login'    => $user_login,
                'user_pass'             => $user_pass,
                'blogname'              => $blogname,
                'email_heading' => $email_heading
       ));

        // Get contents
        $message = ob_get_clean();

        // Send the mail
        woocommerce_mail( $user_email, $subject, $message, $headers = "Content-Type: text/htmlrn", $attachments = "" );
}
add_action('new_user_approve_approve_user', 'ws_new_user_approve_send_approved_email', 10, 1);

function ws_new_user_approve_send_denied_email($user_id){
        return;
}
add_action('new_user_approve_deny_user', 'ws_new_user_approve_send_denied_email', 10, 1); 


//Rename Additional Information tab renamed to Technical Information tab
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {

	$tabs['additional_information']['title'] = __( 'Technical Information' );	// Rename the additional information tab

	return $tabs;

}

add_filter( 'woocommerce_breadcrumb_defaults', 'category_breadcrumbs' );
function category_breadcrumbs() {
	 return array(
            'delimiter'   => ' > ',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( '', 'breadcrumb', 'woocommerce' ),
        );
}

add_action('woocommerce_product_meta_start','woocommerce_breadcrumb' );
























