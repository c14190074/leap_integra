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

// function loadFile(url, callback) {
//     PizZipUtils.getBinaryContent(url, callback);
// }

// function gettext(fileurl) {
//     loadFile(
//         fileurl,
//         function (error, content) {
//             if (error) {
//                 throw error;
//             }
//             var zip = new PizZip(content);
//             var doc = new window.docxtemplater(zip, {linebreaks: true});
//             var text = doc.getFullText();
//             $('#modal-load-docx').find('.card-body').html(text);
//             $('#modal-view-file').modal('hide');
//             $('#modal-load-docx').modal('show');
//             // $('#showdocx').html(text);
//         }
//     );
// }

function loadFile(url, callback) {
    PizZipUtils.getBinaryContent(url, callback);
}
function generate(fileUrl) {
    loadFile(
        fileUrl,
        function (error, content) {
            if (error) {
                throw error;
            }
            var zip = new PizZip(content);
            var doc = new window.docxtemplater(zip, {
                paragraphLoop: true,
                linebreaks: true,
            });

            // Render the document (Replace {first_name} by John, {last_name} by Doe, ...)
            // doc.render({
            //     first_name: "John",
            //     last_name: "Doe",
            //     phone: "0652455478",
            //     description: "New Website",
            // });

            // var blob = doc.getZip().generate({
            //     type: "blob",
            //     mimeType:
            //         "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            //     // compression: DEFLATE adds a compression step.
            //     // For a 50MB output document, expect 500ms additional CPU time
            //     compression: "DEFLATE",
            // });
            // Output the document using Data-URI
            // saveAs(blob, "output.docx");
            $('#modal-load-docx').find('.card-body').html(doc.getFullText());
            $('#modal-view-file').modal('hide');
            $('#modal-load-docx').modal('show');
        }
    );
};


// function PreviewWordDoc() {
//     //Read the Word Document data from the File Upload.
//     // var doc = document.getElementById("files").files[0];
//     var ajaxUrl = baseUrl + 'admin/files/getfilefromserver?ajax=1';
//     $.get(ajaxUrl, function(data, status){
//         console.log(data);
//         var doc = data;
//         if (doc != null) {
//             //Set the Document options.
//             var docxOptions = Object.assign(docx.defaultOptions, {
//                 useMathMLPolyfill: true
//             });
//             //Reference the Container DIV.
//             var container = document.querySelector("#word-preview-cont");

//             //Render the Word Document.
//             docx.renderAsync(doc, container, null, docxOptions);
//             $('#modal-view-file').modal('hide');
//             $('#modal-load-docx').modal('show');
//         }
//     });

// }


$(document).ready(function() {
    Dropzone.autoDiscover = false;
            
    var myDropzone = new Dropzone("#my-dropzone", { 
        autoProcessQueue: false,
        maxFilesize: 1,
        acceptedFiles: ".doc,.docx,.pdf,.txt",
        success : function(file, response){
            // console.log(file);
            $('#upload-file-container').find('#Folder_name').val(file.name);
            $('#Folder_format').val(getFileExtension(file.name));
            $('#Folder_size').val(formatBytes(file.size));
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

    $('body').on('click', '.view-file', function() {
        var folder_id = $(this).data('folder-id');
        var ajaxUrl = baseUrl + 'admin/files/viewfile?ajax=1&folder_id='+folder_id;
        $.get(ajaxUrl, function(data, status){
            $('#view-file-container').html(data);
            $('#modal-view-file').modal('show');
        });
    });


    $('body').on('click', '#btn-open-file', function() {
        var fileUrl = $(this).data('url');
        var fileFormat = $(this).data('format');

        if(fileFormat == 'docx') {
            generate(fileUrl);
        } else {
            window.open(fileUrl, '_blank');
        }
    });

    $('body').on('click', '#btn-download-file', function() {
        var fileUrl = $(this).data('url');
        window.open(fileUrl, '_blank');
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
                // console.log(result);
                location.reload();
            });

          } else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info');
          }
        });
    });
    
});