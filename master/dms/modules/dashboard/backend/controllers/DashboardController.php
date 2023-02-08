<?php
	class DashboardController extends BackendController {
		public function __construct() {
			$this->views = 'modules/dashboard/backend/views/dashboard/';
		}

		public function index() {
			$this->page_title = 'Dashboard';

			$logs = Logs::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND created_by = :id ORDER BY updated_on DESC LIMIT 3',
				'params'	=> array(':id' => Snl::app()->user()->user_id)
			));

			$folders = Folder::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND type = "folder" AND user_access IS NOT NULL AND created_by != :id',
				'params'	=> array(':id' => Snl::app()->user()->user_id)
			));

			return $this->render('index', array(
				'toolbar' 	=> $this->toolbar(),
				'logs'		=> $logs,
				'folders'	=> $folders
			));
		}

		// All ajax function
		
	}