(function ($) {
	"use strict";
	$(function () {
		// Place your public-facing JavaScript here
		$(document).ready(function(){
			$(".new_contact").submit(function(event){
				event.preventDefault();
				
				var form_data = JSON.stringify($(".new_contact").serializeJSON());
				console.log(form_data);
				var data = {
					action : 'new_contact',
					form_data : form_data
				};

				$.post(ajaxurl, data)
				.success(function(){
					alert("Thank you for Subscribing");
					$(".new_contact")[0].reset();
				})
			});
			$(document).on("click",".widget-body input", function(){
				var element = $(this).attr("id");
				$("."+element+"_lbl").slideDown();
			});
		});
	});
}(jQuery));