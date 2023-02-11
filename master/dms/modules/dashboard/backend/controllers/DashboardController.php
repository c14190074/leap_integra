<?php
	class DashboardController extends BackendController {
		public function __construct() {
			$this->views = 'modules/dashboard/backend/views/dashboard/';
		}

		public function index() {
			$this->page_title = 'Dashboard';

			$logs = Logs::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND created_by = :id AND (act != "open" OR type != "folder") ORDER BY updated_on DESC LIMIT 3',
				'params'	=> array(':id' => Snl::app()->user()->user_id)
			));

			$folders = Folder::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND type = "folder" AND user_access IS NOT NULL AND created_by != :id',
				'params'	=> array(':id' => Snl::app()->user()->user_id)
			));

			$recents = Logs::model()->findAll(array(
				// 'select'	=> 'logs_id, DISTINCT file_target_id, act, type, description, created_on, created_by, updated_on, updated_by, is_deleted',
				'condition' => 'is_deleted = 0 AND created_by = :id AND act = "open" AND logs_id IN (SELECT MAX(logs_id) FROM tbl_logs GROUP BY file_target_id) AND file_target_id IN (SELECT folder_id FROM tbl_folder WHERE is_deleted = 0) ORDER BY created_on DESC LIMIT 5',
				'params'	=> array(':id' => Snl::app()->user()->user_id)
			));

			return $this->render('index', array(
				'toolbar' 	=> $this->toolbar(),
				'logs'		=> $logs,
				'folders'	=> $folders,
				'recents'	=> $recents,
			));
		}

		// All ajax function
		
	}