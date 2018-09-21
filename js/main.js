(function($){
	$('body').on('click','.dialog_open',function(e){
		e.preventDefault();

		$('#rs_dialog').modal('show');
		var dataTemp = {
			data: $(this).attr('data-json'),
			title: $(this).attr('data-title'),
			url: $(this).attr('data-url'),
		}
		$('#rs_dialog .rs_dialog_title').text(dataTemp.title);
		$('#rs_dialog .rs_dialog_body').load(dataTemp.url,dataTemp,function(){
			var dataScriptUrl = $('#file_uploader_script').attr('src');
			$('#file_uploader_script').attr('src',dataScriptUrl);
		});
	});
	$('body').on('click','.media_upload .dialog_open',function(){
		$('body').attr('data-media-group-id',$(this).closest('.media_upload').attr('id'));
	});

	$("#btn_new_item").on('click',function(){
		var html = '<div class="form-group">'+
                '<div class="col-md-6 col-sm-6 col-xs-12">'+
                  '<input name="items_name[]" class="form-control col-md-7 col-xs-12" type="text" placeholder="Label">'+
                '</div>'+
                '<div class="col-md-6 col-sm-6 col-xs-12">'+
                  '<input name="items_price[]" class="form-control col-md-7 col-xs-12" type="number" placeholder="Amount">'+
                '</div>'+
              '</div>';
        $("#invoice_items").append(html);
	});



	/*$('.rs_country').on('change',function(e){
		var obj = {
			data:$(this).val()
		}
		$.post(rs_obj.url+'Ajax_query/get_city/'+obj.data,function(res){
			console.log(res);
		})
	})*/
	$('select').select2();

	$('.datepicker').daterangepicker({
	        singleDatePicker: true,
	        showDropdowns: true,
	        locale: {
          	format: 'DD/MM/YYYY'
        		}
	    });
	$(".btn_schedule_select_btn").on('click', function(event) {
		$('.rs_single_schedule').removeClass('bg-red');
		$(this).closest('.rs_single_schedule').addClass('bg-red');
	});
	$('body').on('click', '#form_add_prescription', function(event) {
		event.preventDefault();
		var jsonData = $.parseJSON($("#rs_form_prescription").attr('data-json'));
		var data={
			'data':$("#rs_form_prescription").attr('data-json'),
			'prescription':$('#prescription').val(),
			'apionment_id':jsonData.apionment_id
		};
		$.post(rs_obj.url+'Doctors/AddprescriptionSave', data, function(res) {
			location.reload();
		});
	});
}(jQuery))