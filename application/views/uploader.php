<div class="file_meneger">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#tab1">Upload</a></li>
		<li><a data-toggle="tab" href="#tab2">From Library</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1" class="tab-pane fade in active">
			<?php
				echo form_open_multipart('ajax_query/do_upload',array(
									'id' => 'upload',
								));
						?>
					<div id="drop">
						Drop Here
						<a>Browse</a>
						<input type="file" name="upl" multiple />
					</div>
						<ul>
							<!-- The file uploads will be shown here -->
						</ul>
				<?php echo form_close(); ?>
		</div>
		<div id="tab2" class="tab-pane fade media_list">
			<div class="row">
				<div class="col-xs-3 col-md-2">
					<a href="#" data-id="" class="thumbnail">
						<img src="http://placehold.it/150x150" alt="">
						<div class="caption">
							<strong>Name</strong>
						</div>
					</a>
				</div>
				<div class="col-xs-3 col-md-2">
					<a href="#" data-id="" class="thumbnail">
						<img src="http://placehold.it/150x150" alt="">
						<div class="caption">
							<strong>Name</strong>
						</div>
					</a>
				</div>
				<div class="col-xs-3 col-md-2">
					<a href="#" data-id="" class="thumbnail">
						<img src="http://placehold.it/150x150" alt="">
						<div class="caption">
							<strong>Name</strong>
						</div>
					</a>
				</div>
				<div class="col-xs-3 col-md-2">
					<a href="#" data-id="" class="thumbnail">
						<img src="http://placehold.it/150x150" alt="">
						<div class="caption">
							<strong>Name</strong>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
		
<script type="text/javascript">
	$(function(){

    var ul = $('#upload ul');

	    $('body').on('click','#drop a',function(){
	        $(this).parent().find('input').click();
	    })
	    // Initialize the jQuery File Upload plugin
	    $('#upload').fileupload({
	        // This element will accept file drag/drop uploading
	        dropZone: $('#drop'),

	        // This function is called when a file is added to the queue;
	        // either via the browse button, or via drag/drop:
	        add: function (e, data) {

	            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
	                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

	            // Append the file name and file size
	            tpl.find('p').text(data.files[0].name)
	                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

	            // Add the HTML to the UL element
	            data.context = tpl.appendTo(ul);

	            // Initialize the knob plugin
	            tpl.find('input').knob();

	            // Listen for clicks on the cancel icon
	            tpl.find('span').click(function(){

	                if(tpl.hasClass('working')){
	                    jqXHR.abort();
	                }

	                tpl.fadeOut(function(){
	                    tpl.remove();
	                });

	            });

	            // Automatically upload the file once it is added to the queue
	            var jqXHR = data.submit();
	        },

	        progress: function(e, data){

	            // Calculate the completion percentage of the upload
	            var progress = parseInt(data.loaded / data.total * 100, 10);

	            // Update the hidden input field and trigger a change
	            // so that the jQuery knob plugin knows to update the dial
	            data.context.find('input').val(progress).change();

	            if(progress == 100){
	                data.context.removeClass('working');
	            }
	        },

	        fail:function(e, data){
	            // Something has gone wrong!
	            data.context.addClass('error');
	        },
	        success:function(e, data){
	            var temp = jQuery.parseJSON(e);
	            var sector = $('body').attr('data-media-group-id');
	            $('#'+sector).find('.form-control').val(temp.url);
	            $('#rs_dialog').modal('hide');
	        }

	    });


	    // Prevent the default action when a file is dropped on the window
	    $(document).on('drop dragover', function (e) {
	        e.preventDefault();
	    });

	    // Helper function that formats the file sizes
	    function formatFileSize(bytes) {
	        if (typeof bytes !== 'number') {
	            return '';
	        }

	        if (bytes >= 1000000000) {
	            return (bytes / 1000000000).toFixed(2) + ' GB';
	        }

	        if (bytes >= 1000000) {
	            return (bytes / 1000000).toFixed(2) + ' MB';
	        }

	        return (bytes / 1000).toFixed(2) + ' KB';
	    }

	});
</script>