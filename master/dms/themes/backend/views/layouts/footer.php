	        
	    <!-- footer -->
	    <?php if(!$isLoginPage) : ?>
	    <footer class="footer pt-3  ">
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
	                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
	                </li>
	                <li class="nav-item">
	                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
	                </li>
	                <li class="nav-item">
	                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
	                </li>
	                <li class="nav-item">
	                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
	                </li>
	              </ul>
	            </div>
	          </div>
	        </div>
	      </footer>
		<?php endif; ?>
	    <!-- End footer -->
	    </div> <!-- end of container-fluid py-4 -->
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