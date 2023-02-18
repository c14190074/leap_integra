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

function focused(e) {
    e.parentElement.classList.contains("input-group") && e.parentElement.classList.add("focused");
}
function defocused(e) {
    e.parentElement.classList.contains("input-group") && e.parentElement.classList.remove("focused");
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

function formatBytes(bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

function getFileExtension(filename) {
    return (/[.]/.exec(filename)) ? /[^.]+$/.exec(filename) : undefined;
}


$(document).ready(function() {
    Dropzone.autoDiscover = false;

    $('#user-access-role').find('tbody').find('tr:last-child').find('.file-access-user').select2({ 
        searchInputPlaceholder: 'Search User'
    });

    $("#alert-msg").fadeTo(2000, 500).slideUp(500, function() {
      $("#alert-msg").slideUp(500);
    });
    
    var myDropzoneRevisi;
    var myDropzone = new Dropzone("#my-dropzone", { 
        autoProcessQueue: false,
        maxFilesize: 1,
        uploadMultiple: false,
        acceptedFiles: ".doc,.docx,.pdf,.txt",
        init: function() {
          this.on("addedfile", function(file) {
            var filelogo = baseUrl + 'uploads/wordlogo.png';

            if(getFileExtension(file.name) == 'pdf') {
                filelogo = baseUrl + 'uploads/pdflogo.png';
            }

            $('#upload-file-container').find('.dz-image img').attr('src', filelogo);
            $('#upload-file-container').find('.dz-progress span').html('Loading');

          })
        },
        success : function(file, response){
            $('#upload-file-container').find('#Folder_name').val(file.name);
            $('#upload-file-container').find('#Folder_format').val(getFileExtension(file.name));
            $('#upload-file-container').find('#Folder_size').val(formatBytes(file.size));
            $('#upload-file-container').find('#app_form_upload').submit();
        }
    });

    
    // UPLOAD FILE
    $('body').on('click', '#upload-file-btn', function() {
        initLoading();
        var form = "app_form_upload";
        var ajaxUrl = baseUrl + 'admin/files/validatefileattribute?ajax=1';
        var post = $('#app_form_upload').serializeArray();
        var model = "File";
        var is_revisi = $(this).data('is-revisi');

        $.post(ajaxUrl, {post:post}, function(result) {
            console.log(result);
            result = $.parseJSON(result);
            if(result.valid) {
                if(is_revisi == 1) {
                    if (!myDropzoneRevisi.files || !myDropzoneRevisi.files.length) {
                        Swal.fire('Anda belum memilih file untuk diunggah', '', 'info');
                    } else {
                        myDropzoneRevisi.processQueue();    
                    }
                } else {
                    if (!myDropzone.files || !myDropzone.files.length) {
                        Swal.fire('Anda belum memilih file untuk diunggah', '', 'info');
                    } else {
                        myDropzone.processQueue(); 
                    }
                }
            } else {
                destroyLoading();
                $.each(result.msg, function(key, value) {
                    setMsg(form, model+'_'+key, value); 
                });

            }
        });

    });

    $('body').on('click', '#close-upload-form', function() {
        $('#modal-upload-form').modal('hide');
        // myDropzone.off('error');
        myDropzone.removeAllFiles(true);
        // myDropzone.disable();

        $('#user-access-role').find('tbody').find("tr:gt(0)").remove();
        $('#user-access-role').find('tbody').find('tr:last-child').find('.file-access-user').select2("val", "");
    });


    // FUNGSI-FUNGSI TERKAIT FOLDER
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
            initLoading();

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


    // FUNGSI-FUNGSI TERKAIT FILE
    $('body').on('click', '#btn-open-file', function() {
        var fileUrl = $(this).data('url');
        var fileFormat = $(this).data('format');
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/createlogfile?ajax=1';

        if(fileFormat == 'docx') {
            fileUrl = baseUrl + 'admin/files/open?word='+folder_id;
            window.location.replace(fileUrl);
        } else {
            $.post(ajaxUrl, {folder_id:folder_id, act:'open'}, function(result) {
                window.open(fileUrl, '_blank');
            });
        }
    });

    $('body').on('click', '#btn-download-file', function() {
        var fileUrl = $(this).data('url');
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/createlogfile?ajax=1';

        $.post(ajaxUrl, {folder_id:folder_id, act:'download'}, function(result) {
            window.open(fileUrl, '_blank');
        });
    });

    $('body').on('click', '#btn-delete-file', function() {
        var folder_id = $(this).data('folder-id');

        Swal.fire({
          title: 'Apakah anda yakin untuk menghapus file ini?',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
        }).then((result) => {
          if (result.isConfirmed) {
            var ajaxUrl = baseUrl + 'admin/files/deletefolder?ajax=1';
            $.post(ajaxUrl, {folder_id:folder_id, type:'file'}, function(result) {
                location.reload();
            });

          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info');
          }
        });
    });


    // EDIT USER ACCESS
    $('body').on('click', '#btn-edit-user-access', function() {
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/getuseraccessform?ajax=1&folder_id='+folder_id;
        $.get(ajaxUrl, function(data, status){
            $('.modal').modal('hide');
            $('#user-access-form-container').html(data);

            var edit_access_ids = $('#edit-access-ids').val();
            var view_access_ids = $('#view-access-ids').val();

            // alert(edit_access_ids);
            $('#form_edit_access').find('.file-access-user').each(function(i, obj) {
                $(this).select2();
            });

            if(edit_access_ids != "") {
                edit_access_ids = JSON.parse("[" + edit_access_ids + "]");
                $('#form_edit_access').find('tbody').find('tr:first-child').find('.file-access-user').val(edit_access_ids).trigger('change');
            }

            if(view_access_ids != "") {
                view_access_ids = JSON.parse("[" + view_access_ids + "]");
                $('#form_edit_access').find('tbody').find('tr:last-child').find('.file-access-user').val(view_access_ids).trigger('change');
            }

            $('#modal-user-access-form').modal('show');
        });
    });

    $('body').on('click', '#close-edit-access-form', function() {
        $('#modal-user-access-form').modal('hide');
        $('#user-access-form-container').html('');
    });


    $('body').on('click', '.append-user-role', function() {
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/addroleoption?ajax=1';
        var form_type = $(this).data('form-type');

        $.ajax({
           url: ajaxUrl,
           type: 'post',
           data: {request: 2, folder_id: folder_id, form_type: form_type},
           success: function(response){
                // Append element
                form_id = 'user-access-role';

                if(form_type == 'edit') {
                    form_id = 'form_edit_access';
                }

                $('#'+form_id).find('tbody').append(response);
                var ctr = $('#'+form_id).find('tbody').children().length - 1;
                $('#'+form_id).find('tbody').find('tr:last-child').find('.file-access-user').attr('name', 'Folder[user_access]['+ctr+'][]');
                $('#'+form_id).find('tbody').find('tr:last-child').find('.role-list').attr('name', 'Folder[access_role]['+ctr+'][]');

                $('#'+form_id).find('tbody').find('tr:last-child').find('.file-access-user').select2({ 
                    searchInputPlaceholder: 'Search User'
                });
             
           }
        });
    });

    $('body').on('click', '.remove-user-role', function() {
        var form_type = $(this).data('form-type');
        form_id = 'user-access-role';

        if(form_type == 'edit') {
            form_id = 'form_edit_access';
        }

        if($('#'+form_id).find('tbody').children().length > 1) {
            $(this).parent().parent().remove();    
        }
    });
    
    // FUNGSI-FUNGSI UNTUK REVISI FILE
    $('body').on('click', '#btn-revisi-file', function() {
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/getrevisiform?ajax=1&folder_id='+folder_id;
        $.get(ajaxUrl, function(data, status){
            $('.modal').modal('hide');
            $('#revisi-file-container').html(data);

            myDropzoneRevisi = new Dropzone("#my-dropzone-revisi", { 
                autoProcessQueue: false,
                maxFilesize: 1,
                acceptedFiles: ".doc,.docx,.pdf",
                init: function() {
                  this.on("addedfile", function(file) {
                    var filelogo = baseUrl + 'uploads/wordlogo.png';

                    if(getFileExtension(file.name) == 'pdf') {
                        filelogo = baseUrl + 'uploads/pdflogo.png';
                    }

                    $('#revisi-file-container').find('.dz-image img').attr('src', filelogo);
                    $('#revisi-file-container').find('.dz-progress span').html('Loading');

                  })
                },
                success : function(file, response){
                    console.log(file);
                    $('#modal-revisi-form').find('#Folder_name').val(file.name);
                    $('#modal-revisi-form').find('#Folder_format').val(getFileExtension(file.name));
                    $('#modal-revisi-form').find('#Folder_size').val(formatBytes(file.size));
                    $('#modal-revisi-form').find('#app_form_upload').submit();
                }
            });

            $('#modal-revisi-form').modal('show');
        });
    });

    $('body').on('click', '#close-revisi-form', function() {
        $('#modal-revisi-form').modal('hide');
        myDropzoneRevisi.removeAllFiles(true);
        
    });

    // FUNGSI-FUNGSI TERKAIT FILE SETTING / ATUR FILE
    $('body').on('click', '#btn-file-setting', function() {
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/getfilesetting?ajax=1&folder_id='+folder_id;
        $.get(ajaxUrl, function(data, status){
            $('.modal').modal('hide');
            $('#file-setting-container').html(data);
            $('#modal-file-setting').modal('show');

        });
    });

    $('body').on('click', '#close-setting-from', function() {
        $('#modal-file-setting').modal('hide');
    });

    
    $('body').on('click', '.btn-rollback', function() {
        var target_file_id = $(this).data('folder-id');
        var active_file_id = $(this).data('active-file');

        Swal.fire({
          title: 'Apakah anda yakin untuk melakukan rollback pada dokumen ini?',
          showCancelButton: true,
          confirmButtonText: 'Ya, Rollback',
        }).then((result) => {
          if (result.isConfirmed) {
            initLoading();

            var ajaxUrl = baseUrl + 'admin/files/rollback?ajax=1';
            $.post(ajaxUrl, {target_file_id:target_file_id, active_file_id:active_file_id}, function(result) {
                location.reload();
            });

          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info');
          }
        });

    });
    
    // FUNGSI UNTUK MENAMPILKAN RIGHT SLIDER
    if (document.querySelector('.fixed-plugin')) {
      var fixedPlugin = document.querySelector('.fixed-plugin');
      var fixedPluginButton = document.querySelector('.show-right-slider');
      
      // if (fixedPluginButton) {
        $('body').on('click', '.show-right-slider', function() {
            if (!fixedPlugin.classList.contains('show')) {
                var folder_id = $(this).data('folder-id');
                var action_url = $(this).data('action');
                var ajaxUrl = baseUrl + 'admin/files/'+action_url+'?ajax=1&folder_id='+folder_id;

                $.get(ajaxUrl, function(data, status){
                    $('#right-slider-container').find('.card').html(data);
                    fixedPlugin.classList.add('show');    
                });

                
            } else {
                fixedPlugin.classList.remove('show');
            }            
        });
      // }

      $('body').on('click', '.fixed-plugin-close-button', function() {
        fixedPlugin.classList.remove('show');
      });

      document.querySelector('body').onclick = function(e) {
        if(!$(this).hasClass('modal-open') && $('.swal2-container').length < 1) {
            if (e.target != fixedPluginButton && e.target != fixedPluginButtonNav && e.target.closest('.fixed-plugin .card') != fixedPluginCard) {
              fixedPlugin.classList.remove('show');
            }
        }
      }
    }
});