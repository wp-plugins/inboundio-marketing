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
<div class="wrap">
<h2>Lead List</h2>
	<hr>
	<div class="container">
		<div class="cta_buttons">
			<a href="#" class="button button-primary button-large import_csv">Import Contacts</a>
			<a href="#" class="button button-primary button-large export_csv">Export Contacts</a>
		</div>
		<div class="CRM">
			<table class="wp-list-table widefat fixed stripe hover" id="lead_list">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email Address</th>
						<th>Contact</th>
						<th></th>
						<th><a href="#" class="delete_selected button button-primary button-large">Delete</a></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					global $wpdb;

					$table_name = $wpdb->prefix . "imp_leads"; 
					$rows = $wpdb->get_results( "SELECT * FROM $table_name");
					if($rows){
						foreach ($rows as $row) { ?>
						<tr>
							<td><?= $row->first_name ?></td>
							<td><?= $row->last_name ?></td>
							<td><?= $row->email_address ?></td>
							<td><?= $row->contact_number ?></td>

							<td><a href="#" class="delete_current" data-id="<?php echo $row->id; ?>">Delete</a></td>
							<td><input type="checkbox" value="<?php echo $row->id; ?>" class="delete_multiple"></td>
						</tr>
						<?php }
					}
					?>			
				</tbody>
			</table>
		</div>
	</div>
	<div class="modal_container">
		<div class="cancel"></div>
		<div class="modal">
			<div class="modal-title">
				<div class="row">
					<div class="col-xs-10">
						<span><b>Please upload the CSV</b></span>
					</div>
					<div class="col-xs-2">
						<a href="#" class="cancel cancel-btn"><i class="fa fa-times"></i> </a>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="format">
					<div class="">Please follow the following format in CSV</div>
					<div class="">FIRST NAME,LAST NAME,EMAIL,CONTACT</div>
					<div class="">Please dowload a sample file <a href="<?php echo plugins_url('/sample_csv/contacts.csv', __FILE__)?>">here</a></div>
				</div>
				<div class="file_upload_container">
					<form action="<?php echo plugins_url('/csv_uploader.php', __FILE__ )?>" id="my-awesome-dropzone" class="dropzone upload_image">
						<div class="fallback">
							<input name="file" type="file" multiple />
						</div>
					</form>
				</div>
				<input type="hidden" class="file_url">
				<input type="hidden" class="file_size">
				<div class="message_container">
					<span class="csv_message"></span>
					<p class="instruct_upload" style="display: none;">Click <b>X</b> to close. Else drag and drop more files to upload.</p>
					<input class="import_success_flag" type="hidden">
					<button class="done_button button button-primary">Import Contacts</button>
				</div>
			</div>
		</div>
	</div>

</div>