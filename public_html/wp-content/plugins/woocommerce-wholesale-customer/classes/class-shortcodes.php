<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class WHC_shortcodes{
	
	
	
	public function __construct(){
		
		add_shortcode('whc_register', array($this, 'registration_form'));
		
	}
	
	public function registration_form(){
		
		ob_start();
		if(isset($_POST['whc_submit'])){
			$this->register_validation($_POST);
			
			$_POST['user_email']   =   sanitize_email( $_POST['user_email'] );
			$_POST['password']   =   esc_attr( $_POST['password'] );
			$_POST['fname'] =   sanitize_text_field( $_POST['fname'] );
			$_POST['lname']  =   sanitize_text_field( $_POST['lname'] );
			$_POST['whc_country'] = sanitize_text_field( $_POST['whc_country'] );
			$_POST['whc_vat'] 	= sanitize_text_field( $_POST['whc_vat'] );
			$_POST['whc_company'] 	= sanitize_text_field( $_POST['whc_company'] );
			$_POST['whc_tel'] 	= sanitize_text_field( $_POST['whc_tel'] );
			$_POST['whc_address'] 	= sanitize_text_field( $_POST['whc_address'] );
		
			$this->complete_registration($_POST);
		
		}
		
		
			include(WHC_DIR.'templates/form-register.php');
		return ob_get_clean();
	}
	
	
	
	
	
	
	public function register_validation($_post){
		
		global $reg_errors;
		$reg_errors = new WP_Error;
		
		if ( empty( $_post['password'] ) || empty( $_post['user_email']) || empty( $_post['first_name']) || empty( $_post['last_name'] ) ) {
			$reg_errors->add('field', 'Required form field is missing');
		}
		
		if ( 6 > strlen( $_post['password'] ) ) {
			$reg_errors->add( 'password_length', 'password too short. At least 6 characters is required' );
		}
		
		if ( email_exists( $_post['user_email'] ) )
		$reg_errors->add('email', 'Sorry, that email already exists!');
		
		if ( !is_email( $_post['user_email'] ) ) {
			$reg_errors->add( 'email_invalid', 'Email is not valid' );
		}
		
		
		if ( is_wp_error( $reg_errors ) ) {
 
			foreach ( $reg_errors->get_error_messages() as $error ) {
			 
				echo '<div>';
				echo '<strong>ERROR</strong>:';
				echo $error . '<br/>';
				echo '</div>';
				 
			}
		 
		}
		
	}
	
	
	
	public function complete_registration($_post) {
		global $reg_errors;
		if ( 1 > count( $reg_errors->get_error_messages() ) ) {
			$userdata = array(
			'user_login'    =>   $_post['user_email'],
			'user_email'    =>   $_post['user_email'],
			'user_pass'     =>   $_post['password'],
			'first_name'    =>   $_post['first_name'],
			'last_name'     =>   $_post['last_name'],
			);
			$user = wp_insert_user( $userdata );
			
			if(!is_wp_error($user)){
				
				$wp_user_object = new WP_User($user);
				$wp_user_object->set_role('wholesale_customer');
					update_user_meta($user, 'wholesale_status','UNAPPROVED');
					update_user_meta($user, 'whc_country', $_post['whc_country']);
					update_user_meta($user, 'whc_vat', $_post['whc_vat']);
					update_user_meta($user, 'whc_company', $_post['whc_company']);
					update_user_meta($user, 'whc_tel', $_post['whc_tel']);
					update_user_meta($user, 'whc_address', $_post['whc_address']);
					
					
					$content = '
						Wholesale customer registered.
						User ID: '.$user.'
						User email: '.$_post['user_email'].'
						User country: '.$_post['whc_country'].'
					';
					$headers = array('Content-Type: text/html; charset=UTF-8','From: Me Myself <zeb@2cubed.ie>');
					$sent = wp_mail('zeb@2cubed.ie', 'Wholesale customer registration', $content,$headers, null);
					error_log('Email debug');
					error_log($sent);
					error_log(print_r($sent,true));
					
					
				echo 'Registration complete. Goto <a href="' . get_site_url() . '/my-account/">login page</a>.';
			}else{
				echo '<div>';
				echo '<strong>ERROR</strong>:';
				echo '<br/>';
				echo '</div>';
			}
			
			   
		}
	}

	
}

$WHC_shortcodes = new WHC_shortcodes;