<?php

/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.inboundio.com
 * @since      1.0.0
 *
 * @package    imp
 * @subpackage imp/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h2>Add subscriber</h2>
<hr>
<span>Want to subscribe more than one person at a time? Import a list through <a href="admin.php?page=imp">Import Contacts</a> </span>

<form class="new_contact" id="new_contact" name="new_contact">
	<label for="email">Email</label>
	<input class="form-control" name="email" id="email">
	<br><br>
	<label for="first_name">First Name</label>
	<input class="form-control" name="first_name" id="first_name">
	<br><br>
	<label for="last_name">Last Name</label>
	<input class="form-control" name="last_name" id="last_name">
	<br><br>
	<label for="contact_number">Contact Number</label>
	<input class="form-control" name="contact_number" id="contact_number">
	<br><br>
	<input type="submit" value="Submit" name="submit" class="button button-primary button-large submit_btn">
</form>