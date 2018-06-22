<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<h1>Register as wholesale customer</h1>
<form method="post" class="whc_register_form">


<div><p><input type="email" name="user_email" placeholder="Email" required ></p>
<p><input type="password"	name="password" value="" placeholder="Password" required></p>

<p><input type="text" name="first_name" placeholder="First name" required></p>

<p><input type="text"	name="last_name" placeholder="Last name" required></p>

<p><select name="whc_country" required>
	<option value="">Select country</option>
	<option value="irl">Ireland</option>
	<option value="nirl">Northern Ireland</option>
</select></p>

<p><input type="text" name="whc_company" placeholder="Company Name" required></p>

<p><input type="text" name="whc_vat" placeholder="VAT number" required></p>

<p><input type="text" name="whc_tel" placeholder="Telephone" required></p>

<p><textarea type="text" name="whc_address" placeholder="Address" required></textarea></p>

<p><input type="submit" value="Register" name="whc_submit"></p></div>

</form>
