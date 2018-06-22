<?php
/**
 * Plugin Name: TC WooCommerce Whole Sale customer
 * Description: An e-commerce toolkit that helps you sell anything. Beautifully.
 * Version: 1.0
 * Author: Jahan Zeb Khan
 * Text Domain: woocommerce-wholesale-customer
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define('WHC_DIR', plugin_dir_path( __FILE__ ));

include_once(WHC_DIR.'classes/class-shortcodes.php');
 
function add_roles_on_plugin_activation() {
       add_role( 'wholesale_customer', 'Wholesale customer', array( 'read' => true, 'level_0' => true ) );
}
register_activation_hook( __FILE__, 'add_roles_on_plugin_activation' );
 

 
 function add_my_stylesheet() 
{
    wp_enqueue_style( 'whc_style', plugins_url( '/assets/style.css', __FILE__ ) );
}

add_action('wp_enqueue_scripts', 'add_my_stylesheet');
 
 
 
add_action('woocommerce_register_form_start', 'add_wholesale_customer_checkbox');

function add_wholesale_customer_checkbox(){

	//echo '<input type="checkbox" value="wholesale_customer" name="wholesale_customer"> <label>I am a wholesale customer.</label>';
	
	$register_page = get_option('wholesale_registration_page');
	
	if($register_page != '0'){
		echo 'Click <a href="'.get_the_permalink($register_page).'" style="color: blue;"><b>here</b></a> to register as a Wholesale Customer.';
	}
	
}
 
 
// Assign role and status after user registers
/*add_action( 'user_register', 'myplugin_registration_save', 10, 1 );
function myplugin_registration_save( $user_id ) {

	if(isset($_POST['wholesale_customer'])){
		$wp_user_object = new WP_User($user_id);
		$wp_user_object->set_role('wholesale_customer');
		update_user_meta($user_id, 'wholesale_status','UNAPPROVED');
	}
}*/


// add status field in user profile in backend
add_action( 'edit_user_profile', 'extra_user_profile_fields' );
function extra_user_profile_fields( $user ) { 
	
	$status = get_the_author_meta( 'wholesale_status', $user->ID );
	$whc_country = get_the_author_meta( 'whc_country', $user->ID );
	$whc_vat = get_the_author_meta( 'whc_vat', $user->ID );
	$whc_discount = get_the_author_meta( 'whc_discount', $user->ID );
	$whc_vat_exempt = get_the_author_meta('whc_vat_exempt', $user->ID );
	$whc_company = get_the_author_meta( 'whc_company', $user->ID );
	$whc_tel = get_the_author_meta( 'whc_tel', $user->ID );
	$whc_address = get_the_author_meta( 'whc_address', $user->ID );
?>
    <h3><?php _e("Trade customer information", "blank"); ?></h3>

    <table class="form-table">

    <tr>
    <th><label for="status"><?php _e("Trade customer approval "); ?></label></th>
        <td>
		
			<select name="wholesale_status">
				<option value="UNAPPROVED" <?php echo ($status == 'UNAPPROVED'?'selected':'');?>>UNAPPROVED</option>
				<option  value="APPROVED"<?php echo ($status == 'APPROVED'?'selected':'');?>>APPROVED</option>
			</select>
        </td>
    </tr>
	
	<tr>
    <th><label for="whc_country"><?php _e("Trade customer country "); ?></label></th>
        <td>
		
			<select name="whc_country">
				<option value="">Select country</option>
				<option value="irl" <?php echo ($whc_country == 'irl'?'selected':'');?>>Ireland</option>
				<option  value="nirl"<?php echo ($whc_country == 'nirl'?'selected':'');?>>Northern Ireland</option>
			</select>
        </td>
    </tr>
	<tr>
    <th><label for="whc_discount"><?php _e("Trade Discount (%)"); ?></label></th>
        <td>
			<input type="text" name="whc_discount" value="<?php echo $whc_discount;?>">
        </td>
    </tr>
	<tr>
    <th><label for="whc_vat"><?php _e("Trade customer VAT"); ?></label></th>
        <td>
			<input type="text" name="whc_vat" value="<?php echo $whc_vat;?>">
        </td>
    </tr>
	
	
	    <th><label for="whc_vat_exempt"><?php _e("VAT exempt"); ?></label></th>
        <td>
		
			<select name="whc_vat_exempt">
				<option value="No" <?php echo ($whc_vat_exempt == 'No'?'selected':'');?>>No</option>
				<option  value="Yes"<?php echo ($whc_vat_exempt == 'Yes'?'selected':'');?>>Yes</option>
			</select>
        </td>
    </tr>
	<tr>
    <th><label for="whc_comapny"><?php _e("Company Name"); ?></label></th>
        <td>
			<input type="text" name="whc_comapny" value="<?php echo $whc_company;?>">
        </td>
    </tr>
	<tr>
    <th><label for="whc_tel"><?php _e("Telephone"); ?></label></th>
        <td>
			<input type="text" name="whc_tel" value="<?php echo $whc_tel;?>">
        </td>
    </tr>
	<tr>
    <th><label for="whc_address"><?php _e("Address"); ?></label></th>
        <td>
			<textarea type="text" name="whc_address" value="<?php echo $whc_address;?>"><?php echo $whc_address;?></textarea>
        </td>
    </tr>
	
    </table>
<?php 

}

// Save status field
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'wholesale_status', $_POST['wholesale_status'] );
	update_user_meta( $user_id, 'whc_country', $_POST['whc_country'] );
	update_user_meta( $user_id, 'whc_vat', $_POST['whc_vat'] );
	update_user_meta( $user_id, 'whc_discount', $_POST['whc_discount'] );
	update_user_meta( $user_id, 'whc_vat_exempt', $_POST['whc_vat_exempt'] );
	update_user_meta( $user_id, 'whc_comapny', $_POST['whc_comapny'] );
	update_user_meta( $user_id, 'whc_tel', $_POST['whc_tel'] );
	update_user_meta( $user_id, 'whc_address', $_POST['whc_address'] );
}




add_action( 'woocommerce_account_dashboard', 'add_wholesale_not_approved_message' );
function add_wholesale_not_approved_message(){
	
	$user = wp_get_current_user();
	$status = get_the_author_meta( 'wholesale_status', $user->ID );
	
	if ( in_array( 'wholesale_customer', (array) $user->roles ) && $status =='UNAPPROVED' ) {
			
		echo '<div class="not_approved">Your are not approved as a wholesale customer yet. You can avail whole sale prices after approval</div>';
	}
	
}



// discount price if approved wholesale customer
add_filter('woocommerce_product_get_price', 'wholesale_discount_price', 20, 1);
add_filter('woocommerce_product_variation_get_price','wholesale_discount_price', 5, 2);
function wholesale_discount_price($price){
	$user = wp_get_current_user();
	$status = get_the_author_meta( 'wholesale_status', $user->ID );
	//var_dump($min_or_max);
	if ( in_array( 'wholesale_customer', (array) $user->roles ) && $status =='APPROVED' ) {
			
			$discount_percent =  get_the_author_meta( 'whc_discount', $user->ID );
			/*error_log('discount_price');
			error_log($discount_percent);*/
			if($discount_percent>0){
				$discount = ($price/100)*$discount_percent;
				
				$price = $price - $discount;
			}
	}
	return $price;
}

add_filter('woocommerce_get_variation_price','wholesale_discount_price1', 5, 4);
function wholesale_discount_price1($price, $this, $min_or_max, $for_display){
	$user = wp_get_current_user();
	$status = get_the_author_meta( 'wholesale_status', $user->ID );
	/*if($min_or_max == 'min') {
		$price = floatval($price);*/
		if ( in_array( 'wholesale_customer', (array) $user->roles ) && $status =='APPROVED' ) {
				
				$discount_percent =  get_the_author_meta( 'whc_discount', $user->ID );
				/*error_log('discount_price');
				error_log($discount_percent);*/
				if($discount_percent>0){
					$discount = ($price/100)*$discount_percent;
					
					$price = $price - $discount;
				}
		}
	//}
	return $price;
}



add_filter( 'woocommerce_general_settings', 'add_wholesale_discount_setting' );
function add_wholesale_discount_setting( $settings ) {

  $updated_settings = array();

  foreach ( $settings as $section ) {

    // at the bottom of the General Options section

    if ( isset( $section['id'] ) && 'general_options' == $section['id'] &&

       isset( $section['type'] ) && 'sectionend' == $section['type'] ) {

      $updated_settings[] = array(

        'name'     => __( 'Wholesale discount', 'woocommerce-wholesale-customer' ),
        'desc_tip' => __( 'Percent discount available to wholesale customers', 'woocommerce-wholesale-customer' ),
        'id'       => 'woocommerce_wholesale_discount',
        'type'     => 'text',
        'css'      => 'min-width:300px;',
        'std'      => '1',  // WC < 2.0
        'default'  => '0',  // WC >= 2.0
        'desc'     => __( 'Percent discount available to wholesale customers', 'woocommerce-wholesale-customer' ),

      );
	  
	  
	  // pages 
	  $pages = get_posts(array('post_type'=>'page','posts_per_page'=>-1));
	  $options = array('0'=>'Select page');
	 
	  foreach($pages as $page){
		 $options[$page->ID] = $page->post_title;
	  }
	  
	  
	  $updated_settings[] = array(
		'name'	=> __( 'Wholesale registration page', 'woocommerce-wholesale-customer' ),
		'id'	=> 'wholesale_registration_page',
		'type'	=> 'select',
		'default'=>'0',
		'options'=>$options
		
	  );

    }
    $updated_settings[] = $section;
  }

  return $updated_settings;
}




add_filter( 'init', 'wc_tax_exempt_wholesale_customers' );
function wc_tax_exempt_wholesale_customers() {
	if ( ! is_admin() ) {
		global $woocommerce;
		$userId = get_current_user_id();

		if ( current_user_can('wholesale_customer') && $userId != 0 ) {
			//var_dump(get_user_meta($userId,'whc_vat_exempt',true));
			if(get_user_meta($userId,'whc_vat_exempt',true) == 'Yes'){
				$woocommerce->customer->set_is_vat_exempt(true);
			}else{
				$woocommerce->customer->set_is_vat_exempt(false);
			}
			
		}elseif($userId == 0){
			//$woocommerce->customer->set_is_vat_exempt(false);
		}else {
			
			$woocommerce->customer->set_is_vat_exempt(false);
		}
	}
}




?>