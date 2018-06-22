<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

?>
<div class="before-checkout-form">
	<?php
		do_action( 'woocommerce_before_checkout_form', $checkout );
	?>
</div>
<?php

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'woopress' ) );
	return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	
	<div class="row">
		<div class="col-lg-6 col-md-6">
			<?php if ( sizeof( $checkout->get_checkout_fields() ) > 0 ) : ?>
		
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		
				<div class="col2-set" id="customer_details">
		
					<div class="col-1">
		
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						
						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
					</div>
						
				</div>
			<?php endif; ?>
		</div>
		<div class="col-lg-6 col-md-6">
			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="order-review">
				<h3 id="order_review_heading" class="step-title"><span><?php esc_html_e( 'Your order', 'woopress' ); ?></span></h3>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<br><br>
<?php echo do_shortcode('[partner_logo]'); ?>
<br>
<?php echo do_shortcode('[products_short_display]'); ?>






