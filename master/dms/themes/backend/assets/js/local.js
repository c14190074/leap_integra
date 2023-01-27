var initLoading = function() {
	$('.preloader').removeClass('hidden');
}

var destroyLoading = function() {
	$('.preloader').addClass('hidden');
}

var clearErrorMsg = function(form) {
	$('#'+form).find('.has-error').each(function() {
		$(this).removeClass('has-error');
	});

	$('#'+form).find('.help-block.with-errors').each(function() {
		$(this).html('');
	});
}

var setMsg = function(form, obj, msg) {
	if($('#'+form).find('#'+obj).length > 0) {
		$parentObj = $('#'+form).find('#'+obj).parent().closest('.form-group');

		if(!$parentObj.hasClass('has-error')) {
			$parentObj.addClass('has-error');
		}

		$parentObj.find('.help-block.with-errors').html('<ul class="list-unstyled"><li><span class="text-sm" style="color: red;">'+msg+'</span></li></ul>');
	}
}

function submitform(form, model) {
	initLoading();
	clearErrorMsg(form);

    var ajaxUrl = baseUrl + 'admin/'+model.toLowerCase()+'/validate?ajax=1';

    if(model.toLowerCase() == "folder") {
        ajaxUrl = baseUrl + 'admin/files/validate?ajax=1';
    }

	var post = $('#'+form).serializeArray();
	$.post(ajaxUrl, {post:post}, function(result) {
		console.log(result);
		result = $.parseJSON(result);
		if(result.valid) {
			$('#'+form).submit();
		} else {
			destroyLoading();
			$.each(result.msg, function(key, value) {
			  	setMsg(form, model+'_'+key, value);	
			});

            if(model.toLowerCase() != "folder") {
                swal("WARNING!", "Terjadi kesalahan input. Mohon periksa ulang data yang anda inputkan.");    
            }
			
		}
	});
}

function updateOrderStatus(order_id, status) {
    initLoading();
    
    var ajaxUrl = baseUrl + 'admin/order/updateorderstatus?ajax=1';
    $.post(ajaxUrl, {order_id:order_id, status:status}, function(result) {
        location.reload();
    });
}

$(document).ready(function() {
    Dropzone.autoDiscover = false;
            
    var myDropzone = new Dropzone("#my-dropzone", { 
        autoProcessQueue: false,
        maxFilesize: 1,
        acceptedFiles: ".doc,.docx,.pdf,.txt",
        success : function(file, response){
            $('#File_name').val(file.name);
            $('#app_form_upload').submit();
        }
    });

    $('body').on('click', '#upload-file-btn', function() {
        var form = "app_form_upload";
        var ajaxUrl = baseUrl + 'admin/files/validatefileattribute?ajax=1';
        var post = $('#app_form_upload').serializeArray();
        var model = "File";

        $.post(ajaxUrl, {post:post}, function(result) {
            console.log(result);
            result = $.parseJSON(result);
            if(result.valid) {
                myDropzone.processQueue();
            } else {
                destroyLoading();
                $.each(result.msg, function(key, value) {
                    setMsg(form, model+'_'+key, value); 
                });

                // if(model.toLowerCase() != "folder") {
                //     swal("WARNING!", "Terjadi kesalahan input. Mohon periksa ulang data yang anda inputkan.");    
                // }
            }
        });

    });

	

    $('body').on('click', '.edit-folder', function() {
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/getfolderdata?ajax=1&id='+folder_id;

        $.get(ajaxUrl, function(data, status){
            data = $.parseJSON(data);
            console.log(data.user_access);
            $('#Folder_folder_id').val(data.folder_id);
            $('#Folder_name').val(data.name);
            $('#Folder_description').val(data.description);
            $('.user-list').val(data.user_access).trigger('change');
            $('#modal-form').modal('show');
        });
        
    });

    $('body').on('click', '.delete-folder', function() {
        var folder_id = $(this).data('folder-id');

        Swal.fire({
          title: 'Apakah anda yakin untuk menghapus folder ini?',
          // showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          // denyButtonText: `Don't save`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            // initLoading();

            var ajaxUrl = baseUrl + 'admin/files/deletefolder?ajax=1';
            $.post(ajaxUrl, {folder_id:folder_id}, function(result) {
                // console.log(result);
                location.reload();
            });

          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info');
          }
        });
    });
});