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
<?php 
	global $wpdb;
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="stage_content send_email_container">

	<form class="email_form">
		<div class="left_email_container">
			<div class="subject_container">
				<label>Subject: </label>
				<input class="email_subject" id="email_subject" placeholder="A message from <?php echo get_bloginfo('name'); ?>">
			</div>

			<div class="recipient_container">
				<label>Recipients:</label>
				<select data-placeholder="Choose Recipients..." id="recipient_list" class="chosen-select" multiple style="width:400px;" tabindex="4">
					<option value=""></option>
					<?php 
					$table_name = $wpdb->prefix . "imp_leads"; 
					$rows = $wpdb->get_results( "SELECT * FROM $table_name");
					if($rows){
						foreach ($rows as $row) { ?>
						<option value="<?php echo $row->email_address?>"><?php echo $row->first_name." ".$row->last_name; ?></option>
						<?php }
					}
					?>
				</select>
			</div>

			<div>
				<label></label>
				<a href="#" class="button button-primary button-large select_all" id="select_all">Add All</a>
				<a href="#" class="button button-primary button-large remove_all" id="remove_all">Clear</a>
			</div>


		</div>
		<div class="right_email_container">



			<section class="send_mail_container">
				<button class="progress-button send_mail" data-style="rotate-angle-bottom" data-perspective data-horizontal>Send Mail</button>
			</section>

			<div class="notification success_message" style="display: none;">
				<i class="fa fa-check"></i> Emails Send Successfully.
			</div>
			<div class="notification error_message" style="display: none;">
				<i class="fa fa-times"></i> Error, Please Try Again.
			</div>
		</div>

		<div class="message_container">
			<label>Message: </label>
			<?php 

			$content = "";
			$editor_id = "message";
			$settings = array(
				'textarea_rows' => 40,
				'textarea_name' => 'content',
				'drag_drop_upload' => true,
							// 'media_buttons' => false,
				'tinymce' => array(
					'theme_advanced_buttons1' => 'formatselect,|,bold,italic,underline,|,' .
					'bullist,blockquote,|,justifyleft,justifycenter' .
					',justifyright,justifyfull,|,link,unlink,|' .
					',spellchecker,wp_fullscreen,wp_adv'
					)
				);
			wp_editor( $content, $editor_id, $settings ); 

			?>

		</div>
	</form>
</div>