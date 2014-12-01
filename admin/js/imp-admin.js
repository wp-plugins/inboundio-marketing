(function( $ ) {
	'use strict';

	/**
	 * All of the code for your Dashboard-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

	 $(document).ready(function(){
	 	// Initializing DataTables
	 	$('#lead_list').DataTable({
	 		columnDefs: [ {
	 			targets: [ 0 ],
	 			orderData: [ 0, 1 ]
	 		}, {
	 			targets: [ 1 ],
	 			orderData: [ 1, 0 ]
	 		}, {
	 			targets: [ 4 ],
	 			orderData: [ 4, 0 ]
	 		} ]
	 	});
	 	// initializing dropzone
	 	// dropzone file upload
	 	Dropzone.options.myAwesomeDropzone = {
	 		accept: function(file, done) {
	 			console.log("uploaded");
	 			done();
	 		},
	 		init: function() {
	 			this.on("addedfile", function() {
	 				if (this.files[1]!=null){
	 					this.removeFile(this.files[0]);
	 				}
	 			});
	 		},
	 		success: function(file, response){
	 			console.log(response);
	 			var responses = response.split(" ");
	 			response = responses[0];
	 			var size = responses[2];

	 			$(".file_url").val(response);
	 			$(".file_size").val(size);
	 			$(".csv_message").html("CSV uploaded Succesfully");
	 			$(".instruct_upload").hide();
	 			if (file.previewElement) {
	 				return file.previewElement.classList.add("dz-success");
	 			}
	 		},
	 		fail: function(response){
	 			$(".csv_message").html("Error while uploading.");
	 		}
	 	};

	 	// show the import modal when import contact is clicked
	 	$(".import_csv").on("click", function(event){
	 		event.preventDefault();
	 		$(".modal_container").fadeIn();
	 	});
	 	$(".cancel").on("click", function(event){
	 		if($(".import_success_flag").val()=="1"){
	 			location.reload();
	 		}
	 		else{
	 			$(".modal_container").fadeOut();
	 		}
	 	});
	 	// importing into database
	 	$(".done_button").on("click", function(event){
	 		event.preventDefault();
	 		var length = 0;
	 		var file = $(".file_url").val();
	 		var size = $(".file_size").val();
	 		if(file == ""){
	 			$(".csv_message").html("no file found");
	 		}
	 		else{
	 			var data = {
	 				action: 'parse_csv',
	 				url: file,
	 				size: size 
	 			};
	 			$.post(ajaxurl,data)
	 			.success(function(response){
	 				response = response.substring(0, response.length - 1);
	 				$(".csv_message").html(response);
	 				$(".hide_modal_success").show();
	 				$(".instruct_upload").show();
	 				$(".import_success_flag").val(1);
	 			})
	 		}
	 	});
	 	// exporting to contact.csv
	 	$(".export_csv").on("click", function(event){
	 		event.preventDefault();
	 		var data = {
	 			action:'export_csv'
	 		};
	 		$.post(ajaxurl, data)
	 		.success(function(response){
	 			var filename = "contacts.csv";
	 			var blob = new Blob([response], { type: 'text/csv;charset=utf-8;' });
	 			if (navigator.msSaveBlob) { 
	 				navigator.msSaveBlob(blob, filename);
	 			} else {
	 				var link = document.createElement("a");
	 				if (link.download !== undefined) { 
	 					var url = URL.createObjectURL(blob);
	 					link.setAttribute("href", url);
	 					link.setAttribute("download", filename);
	 					link.style = "visibility:hidden";
	 					document.body.appendChild(link);
	 					link.click();
	 					document.body.removeChild(link);
	 				}
	 			}
	 		})
	 	});
	 	// delete contacts
	 	$(".delete_multiple").on("click", function(event){
	 		$(this).toggleClass("item_selected");
	 		$($($(this).parent()).parent()).toggleClass("selected");
	 	});
	 	$(".delete_selected").on("click", function(event){
	 		event.preventDefault();
	 		var ids = {};
	 		var contact_list = $(".item_selected");
	 		$(".item_selected").each(function(index){
	 			var id = $(this).val();
	 			ids[index] = id;
	 		});

	 		var json_id = JSON.stringify(ids);
	 		var data = {
	 			action: 'delete_multiple',
	 			ids: json_id
	 		};
	 		$.post(ajaxurl, data)
	 		.success(function(response){
	 			response = response.substring(0, response.length - 1);
	 			alert(response);
	 			$(".selected").each(function(index){
	 				$(this).slideUp("slow");
	 				$(".item_selected").toggleClass("item_selected");
	 			});
	 		});
	 	});

	 	$(".delete_current").on("click", function(event){
	 		event.preventDefault();
	 		var element = $(this);
	 		var row = $($(element).parent()).parent();
	 		var id = $(element).attr("data-id");
	 		console.log(id);
	 		var ids = {};
	 		ids[0] = id;
	 		var json_id = JSON.stringify(ids);

	 		var data = {
	 			action: 'delete_multiple',
	 			ids: json_id
	 		};

	 		$.post(ajaxurl, data)
	 		.success(function(response){
	 			response = response.substring(0, response.length - 1);
	 			alert(response);
	 			$(row).slideUp("slow");
	 		});
	 	});
	 });

})( jQuery );
