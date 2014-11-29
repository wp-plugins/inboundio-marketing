(function( $ ) {
	'use strict';
	// new contact scripts
	$(document).ready(function(){
		// submiting new contact
		$(".new_contact").submit(function(event){
			var form_data = JSON.stringify($(".new_contact").serializeJSON());
			console.log(form_data);
			var data = {
				action : 'new_contact',
				form_data : form_data
			};

			$.post(ajaxurl, data)
			.success(function(){
				alert("Contact Saved");
			})
			event.preventDefault();
		});
	});

})( jQuery );
