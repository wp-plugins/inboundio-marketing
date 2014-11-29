(function( $ ) {
	'use strict';
	// send email scripts
	$(document).ready(function(){
		// Chosen JS
		var config = {
			'.chosen-select'           : {},
			'.chosen-select-deselect'  : {allow_single_deselect:true},
			'.chosen-select-no-single' : {disable_search_threshold:10},
			'.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			'.chosen-select-width'     : {width:"95%"}
		}

		for (var selector in config) {
			$(selector).chosen(config[selector]);
		}

		$('#select_all').on("click",function(event) {
			event.preventDefault();
			$('#recipient_list option').attr("selected", "selected");
			$('#recipient_list').trigger("chosen:updated");	
		});

		$('#remove_all').on("click",function(event) {
			event.preventDefault();
			$('#recipient_list option').removeAttr("selected");
			$('#recipient_list').trigger("chosen:updated");	
		});

		function get_editor_content(message) {

			if ( jQuery("#"+message+":hidden").length > 0)
			{
				return tinyMCE.get(message).getContent();
			}
			else
			{
				return jQuery('#'+message).val();
			}
		}
		$(".send_mail").on("click", function(event){
			event.preventDefault();
			var subject = $(".email_subject").val();
			var message = get_editor_content("message");
			var recipient_list = $("#recipient_list").chosen().val();

			var data = {
				action: 'send_mail',
				recipient_list: recipient_list,
				subject: subject,
				message: message
			};

			$.post(
				ajaxurl, data
				)
			.done(function(response) {
				$(".notification.success_message").delay( 1800 ).fadeIn("slow");
				$("#remove_all").delay( 1800 ).click();

				$(".notification.success_message").delay( 2800 ).fadeOut("slow");
				console.log(response);
			})
			.fail(function() {
				$(".notification.error_message").delay( 1800 ).fadeIn("slow");
				$("#remove_all").delay( 1800 ).click();

				$(".notification.error_message").delay( 1800 ).fadeOut("slow");
			});
		});

	});

})( jQuery );
