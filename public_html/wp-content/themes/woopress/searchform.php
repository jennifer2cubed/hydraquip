<?php
/**
 * The template for displaying search forms
 *
 */
?>

<form action="<?php echo home_url( '/' ); ?>" class="hide-input searchform" method="get">
	<div class="form-horizontal modal-form">
		<div class="form-group has-border">
			<div class="col-xs-10">
				<input type="text" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Search...', 'woopress' ); ?>" />
			    <input type="hidden" name="post_type" value="post" />
			</div>
		</div>
		<div class="form-group form-button">
			<button type="submit" class="btn medium-btn btn-black"><?php esc_attr_e( 'Search', 'woopress' ); ?></button>
		</div>
	</div>
</form>
