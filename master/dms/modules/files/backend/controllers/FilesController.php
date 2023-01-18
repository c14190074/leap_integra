<?php
	class FilesController extends BackendController {
		public function __construct() {
			$this->views = 'modules/files/backend/views/files/';
		}

		public function index() {
			$this->page_title = 'Files';
			return $this->render('index', array(
				'toolbar' => $this->toolbar(),
			));
		}

		// All ajax function
		
	}