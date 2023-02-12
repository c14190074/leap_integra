	    <!-- footer -->
	    <?php if(!$isLoginPage) : ?>
	    <footer class="footer pt-3" style="display: none;">
	        <div class="container-fluid">
	          <div class="row align-items-center justify-content-lg-between">
	            <div class="col-lg-6 mb-lg-0 mb-4">
	              <div class="copyright text-center text-sm text-muted text-lg-start" style="opacity: 0;">
	                © <script>
	                  document.write(new Date().getFullYear())
	                </script>,
	                made with <i class="fa fa-heart"></i> by
	                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
	                for a better web.
	              </div>
	            </div>
	            <div class="col-lg-6">
	              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
	                <li class="nav-item">
	                  <a href="#" class="nav-link text-muted" target="_blank">Creative Tim</a>
	                </li>
	                <li class="nav-item">
	                  <a href="#" class="nav-link text-muted" target="_blank">About Us</a>
	                </li>
	                <li class="nav-item">
	                  <a href="#" class="nav-link text-muted" target="_blank">Blog</a>
	                </li>
	                <li class="nav-item">
	                  <a href="#" class="nav-link pe-0 text-muted" target="_blank">License</a>
	                </li>
	              </ul>
	            </div>
	          </div>
	        </div>
	      </footer>
		<?php endif; ?>


		<?php if($isLoginPage) : ?>
			<!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
			  <footer class="footer py-5">
			    <div class="container">
			      <div class="row">
			        <div class="col-lg-8 mb-4 mx-auto text-center">
			          <a href="https://integrasolusi.com/blog/home/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
			            Company
			          </a>
			         
			          <a href="https://integrasolusi.com/blog/" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
			            Blog
			          </a>

			           <a href="https://integrasolusi.com/web/kontak" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
			            Contact Us
			          </a>
			          
			        </div>
			        <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
			        	<a href="https://www.instagram.com/integrateknologisolusi/" target="_blank" class="text-secondary me-xl-4 me-4">
				            <span class="text-lg fab fa-instagram"></span>
				        </a>

			          <a href="https://www.youtube.com/channel/UCl7N-jXu4W2YQS1rYKuhh5w" target="_blank" class="text-secondary me-xl-4 me-4">
			            <span class="text-lg fab fa-youtube"></span>
			          </a>

			          <a href="https://www.facebook.com/integraoffice/?ref=aymt_homepage_panel&eid=ARBdf6TREqaGnIB6qumwUDW-N8RU-jarhGxGhMBV4BO3jVENmYaF9Tq43clzJTii3-67_1sHSCGZvo2N" target="_blank" class="text-secondary me-xl-4 me-4">
			            <span class="text-lg fab fa-facebook"></span>
			          </a>
			          
			        </div>
			      </div>
			      <div class="row" style="display: none;">
			        <div class="col-8 mx-auto text-center mt-1">
			          <p class="mb-0 text-secondary">
			            Copyright © <script>
			              document.write(new Date().getFullYear())
			            </script> Soft by Creative Tim.
			          </p>
			        </div>
			      </div>
			    </div>
			  </footer>
		<?php endif; ?>
	    <!-- End footer -->
	</div> <!-- end of container-fluid py-4 -->

	<?php if(Snl::app()->getSession(SecurityHelper::encrypt('backendlogin')) != FALSE) : ?>
	<!-- Pop up modal untuk create folder -->
	<?php
		$model_folder = new Folder;
		$model_folder->folder_parent_id = $parentfolderid;
		$user_model = User::model()->findAll(array(
			'condition' => 'is_deleted = 0 AND status = 1 AND user_id != :id',
			'params'	=> array('id' => Snl::app()->user()->user_id)
		));

	?>
	<div class="me-2" id="folder_form_modal">
	    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	                <div class="modal-body p-0">
	                    <div class="card card-plain">
	                        <div class="card-header pb-0 text-left">
	                            <h3 class="font-weight-bolder text-info text-gradient"><i class="fa fa-folder me-1"></i>Buat Folder</h3>
	                            
	                        </div>
	                        <div class="card-body">
	                            <form role="form text-left" id="app_form" action="<?= Snl::app()->baseUrl() ?>admin/files/createfolder" method="POST">
	                                <div class="form-group" style="display: none;">
								        <label class="col-md-12"><?= $model_folder->getLabel('folder_parent_id', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_folder, 'folder_parent_id') ?>
								        </div>
								    </div>

								    <div class="form-group" style="display: none;">
								        <label class="col-md-12"><?= $model_folder->getLabel('folder_id', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_folder, 'folder_id') ?>
								        </div>
								    </div>
	                                

	                                <div class="form-group">
								        <label class="col-md-12"><?= $model_folder->getLabel('name', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_folder, 'name') ?>
								        </div>
								    </div>

								    <div class="form-group">
								        <label class="col-md-12"><?= $model_folder->getLabel('description', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextarea($model_folder, 'description') ?>
								        </div>
								    </div>

								    <div class="form-group">
								        <label class="col-md-12"><?= $model_folder->getLabel('user_access', TRUE); ?></label>
								        <div class="col-md-12">
								        	<select class="select2 form-control user-list" name="Folder[user_access][]" multiple="multiple">
								            	<?php 
								            		if($user_model != NULL) {
								            			foreach($user_model as $d) {
								            				echo "<option value='".$d->user_id."'>".ucwords(strtolower($d->fullname))."</option>";
								            			}
								            		}
								            	?>
											</select>
								        </div>
								    </div>
	                                <div class="form-group">
								        <div class="col-md-12">
								            <button type="button" class="btn bg-gradient-info btn-lg w-100 mt-4 mb-0" onclick="submitform('app_form', 'Folder')">Submit</button>
								        </div>
								    </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


	<?php
		$model_file = new Folder;
		$model_file->folder_parent_id = $parentfolderid;

		$document_model = Folder::model()->findAll(array(
			'condition' => 'is_deleted = 0 AND type = :type AND created_by = :id',
			'params'	=> array(':id' => Snl::app()->user()->user_id, ':type' => 'file')
		));
	?>
	<!-- Pop up modal untuk upload file -->
	<div class="me-2" id="upload-file-container">
	    <div class="modal fade" id="modal-upload-form" role="dialog" aria-labelledby="modal-upload-form" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	            <div class="modal-content">
	                <div class="modal-body p-0">
	                    <div class="card card-plain">
	                        <div class="card-body">
	                            <form action="<?= Snl::app()->baseUrl() ?>admin/files/upload?ajax=1" class="dropzone" id="my-dropzone">
								    <div class="dz-message">
								        <h1 class="mb-0 "><i class="fa fa-file-text-o"></i></h1>
								        <p class="mb-2">Tarik file disini</p>
								        <p class="text-sm text-secondary mb-3">atau</p>
								        <button type="button" class="btn btn-default">Pilih Dokumen</button>
								    </div>
								</form>
								<p class="text-xs text-secondary mb-0">Format File: .docx dan .pdf</p>
								<p class="text-xs text-secondary">Ukuran Maksimal: 1 MB</p>
								<hr style="border-top: 1px solid aquamarine !important;" />

								<form role="form text-left" id="app_form_upload" action="<?= Snl::app()->baseUrl() ?>admin/files/savedocumentattribute" method="POST">
									<div class="form-group" style="display: none;">
								        <label class="col-md-12"><?= $model_file->getLabel('folder_parent_id', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'folder_parent_id') ?>
								        </div>
								    </div>

									<div class="form-group" style="display: block;">
								        <label class="col-md-12"><?= $model_file->getLabel('name', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'name') ?>
								        </div>
								    </div>

								    <div class="form-group" style="display: none;">
								        <label class="col-md-12"><?= $model_file->getLabel('format', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'format') ?>
								        </div>
								    </div>

								    <div class="form-group" style="display: none;">
								        <label class="col-md-12"><?= $model_file->getLabel('size', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'size') ?>
								        </div>
								    </div>

	                                <div class="form-group">
								        <label class="col-md-12"><?= $model_file->getLabel('nomor', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'nomor') ?>
								        </div>
								    </div>

								    <div class="form-group">
								        <label class="col-md-12"><?= $model_file->getLabel('perihal', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'perihal') ?>
								        </div>
								    </div>

								    
								    <div class="form-group">
								        <label class="col-md-12"><?= $model_file->getLabel('unit_kerja', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'unit_kerja') ?>
								        </div>
								    </div>

								    <div class="form-group">
								        <label class="col-md-12"><?= $model_file->getLabel('keyword', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_file, 'keyword') ?>
								        </div>
								    </div>

								    
								    <div class="form-group">
								        <label class="col-md-12"><?= $model_file->getLabel('related_document', TRUE); ?></label>
								        <div class="col-md-12">
								        	<select class="select2 form-control document-list" name="Folder[related_document][]" multiple="multiple">
								            	<?php 
								            		if($document_model != NULL) {
								            			foreach($document_model as $d) {
								            				echo "<option value='".$d->folder_id."'>".ucwords(strtolower($d->name))."</option>";
								            			}
								            		}
								            	?>
											</select>
								        </div>
								    </div>

								    <div class="form-group">
								        <label class="col-md-12"><?= $model_file->getLabel('description', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextarea($model_file, 'description') ?>
								        </div>
								    </div>

								    <div class="form-group">
										<div class="row">
											<div class="col-md-12">
												<div class="table-responsive" id="user-access-role">
												    <table class="table align-items-center mb-0">
												      <thead>
												        <tr>
												          <th class="text-xs font-weight-bolder opacity-7"><label><?= $model_file->getLabel('user_access', TRUE); ?></label></th>
												          <th class="text-xs font-weight-bolder opacity-7"><label>Akses</label></th>
												          <th class="text-xs font-weight-bolder opacity-7"><label>&nbsp;</label></th>
												        </tr>
												      </thead>

												      <tbody>
												      	<tr>
												      		<td class="w-40">
												      			<select class="form-control file-access-user" name="Folder[user_access][]" multiple="multiple">
													            	<?php 
													            		if($user_model != NULL) {
													            			foreach($user_model as $d) {
													            				if($d->hasFolderAccess($parentfolderid)) {
													            					echo "<option value='".$d->user_id."'>".ucwords(strtolower($d->fullname))."</option>";	
													            				}
													            			}
													            		}
													            	?>
																</select>
												      		</td>
												      		<td class="w-40">
												      			<select class="form-control role-list" name="Folder[access_role][0][]" multiple="multiple">
													            	<option value="view">Lihat</option>
													            	<option value="edit">Revisi</option>
																</select>

												      		</td>
												      		<td>
												      			<i class="fa fa-plus text-sm me-2 link-info append-user-role" role="button" data-folder-id="<?= $parentfolderid ?>"></i>
												      			<i class="fa fa-times text-sm me-2 link-danger remove-user-role" role="button"></i>
												      		</td>
												      	</tr>
												      </tbody>
												  </table>
												</div>
											</div>
										</div>
								    </div>


	                                <div class="form-group">
								        <div class="col-md-12 text-center">
								            <button type="button" class="btn bg-gradient-info mt-4 mb-0" id="upload-file-btn" data-is-revisi="0">Submit</button>

								            <button type="button" class="btn bg-gradient-warning mt-4 mb-0" data-dismiss="modal-upload-form" id="close-upload-form">Cancel</button>
								        </div>
								    </div>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Pop up modal untuk view attrbute file -->
	<div class="me-2" id="view-file-container"></div>

	<!-- Pop up modal untuk view attrbute file -->
	<div class="me-2" id="revisi-file-container"></div>

	<!-- Pop up modal untuk view attrbute folder -->
	<div class="me-2" id="folder-attribute-container"></div>

	<!-- Pop up modal untuk preview file docs -->
	<div class="modal fade" id="modal-load-docx" tabindex="-1" role="dialog" aria-labelledby="modal-load-docx" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	        <div class="modal-content">
	            <div class="modal-body p-0">
	                <div class="card card-plain">
	                    <div class="card-body" id="word-preview-cont">
	                    	
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- slide right -->
	<div class="fixed-plugin" id="right-slider-container">
	    <div class="card shadow-lg ">
	      
	    </div>
  	</div>
	<?php endif; ?>




</main>
	<!--   Core JS Files   -->
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/core/popper.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/core/bootstrap.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/plugins/perfect-scrollbar.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/plugins/smooth-scrollbar.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/plugins/chartjs.min.js"></script>


	  <!-- Docxtemplater -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.33.0/docxtemplater.js"></script>
    <script src="https://unpkg.com/pizzip@3.1.4/dist/pizzip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.js"></script>
    <script src="https://unpkg.com/pizzip@3.1.4/dist/pizzip-utils.js"></script>
    <!-- <script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script> -->


	<script>
        (function() {
            [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
                new CBPFWTabs(el);
            });
        })();

        $(document).ready(function() {
        	$('.select2').select2();

        	jQuery('.mydatepicker').datepicker({
        		autoclose: true,
        		format: 'dd MM yyyy',
        	});

        	if($('.textarea_editor').length > 0) {
                $('.textarea_editor').each(function() {
                    $(this).wysihtml5({
                    	html: true
                    });
                });
            }

        	if ($(".mymce").length > 0) {
	            tinymce.init({
	                selector: "textarea.mymce",
	                min_height: 300,
					height: 300,
					theme: 'modern',
					fontsize_formats: '8pt 9pt 10pt 11pt 12pt 26pt 36pt',
					plugins: [
					    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
					    'searchreplace wordcount visualblocks visualchars code fullscreen',
					    'insertdatetime media nonbreaking save table contextmenu directionality',
					    'emoticons paste textcolor colorpicker textpattern imagetools',
					    'autoresize'
					],
					toolbar1: 'fontselect fontsizeselect styleselect | bold italic underline  | alignleft aligncenter alignright alignjustify | forecolor backcolor emoticons fullscreen',
					toolbar2: 'bullist numlist outdent indent | link image media | print preview',
						image_advtab: true
	            });
	        }
        });
    </script>
    <script type="text/javascript">
    	var win = navigator.platform.indexOf('Win') > -1;
	    if (win && document.querySelector('#sidenav-scrollbar')) {
	      var options = {
	        damping: '0.5'
	      }
	      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	    }
    </script>
	<!-- Local Custom -->
	<script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/soft-ui-dashboard.js?v=1.0.7"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>assets/js/local.js"></script>
</body>
</html>