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
	                                

	                                <div class="form-group">
								        <label class="col-md-12"><?= $model_folder->getLabel('name', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_folder, 'name') ?>
								        </div>
								    </div>

								    <div class="form-group">
								        <label class="col-md-12"><?= $model_folder->getLabel('description', TRUE); ?></label>
								        <div class="col-md-12">
								            <?= Snl::chtml()->activeTextbox($model_folder, 'description') ?>
								        </div>
								    </div>

								    <div class="form-group">
								        <label class="col-md-12"><?= $model_folder->getLabel('user_access', TRUE); ?></label>
								        <div class="col-md-12">
								        	<select class="select2 form-control" name="Folder[user_access][]" multiple="multiple">
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
	                             
	                                <!-- <div class="text-center">
	                                    <button type="button" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Buat</button>
	                                </div> -->

	                                <div class="form-group">
								        <div class="col-md-12">
								            <button type="button" class="btn bg-gradient-info btn-lg w-100 mt-4 mb-0" onclick="submitform('app_form', 'Folder')">Buat</button>
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

</main>
	<!--   Core JS Files   -->
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/core/popper.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/core/bootstrap.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/plugins/perfect-scrollbar.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/plugins/smooth-scrollbar.min.js"></script>
	  <script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/plugins/chartjs.min.js"></script>
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
	<script src="<?= Snl::app()->config()->theme_url ?>assets_soft/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
    <script src="<?= Snl::app()->config()->theme_url ?>assets/js/local.js"></script>
</body>
</html>