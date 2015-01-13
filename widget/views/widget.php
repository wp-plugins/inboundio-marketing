<!-- This file is used to markup the public-facing widget. -->
<?php if ( $title ) { ?>
<div class="widget-header">
	<?php echo $title; ?> 
</div>
<?php }
else{
	?>
	<div class="widget-header">
	Subscribe to <?php echo bloginfo('name'); ?> 
	</div>
	<?php } ?>
	<div class="widget-body">
		<form class="new_contact" id="new_contact" name="new_contact">
			<label class="email_lbl" for="email">Email</label>
			<input class="form-control email_input" name="email" id="email" placeholder="Enter Email">
			<br>
			<label class="first_name_lbl" for="first_name">First Name</label>
			<input class="form-control" name="first_name" id="first_name" placeholder="Enter First Name">
			<br>
			<label class="last_name_lbl" for="last_name">Last Name</label>
			<input class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name">
			<br>
			<label class="contact_number_lbl" for="contact_number">Contact Number</label>
			<input class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number">
			<br>
			<input type="submit" value="Submit" name="submit" class="button button-primary button-large submit_btn">
		</form>
	</div>