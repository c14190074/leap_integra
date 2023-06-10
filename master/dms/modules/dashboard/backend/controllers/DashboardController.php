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

		public function test() {
			return $this->render('test');
		}

		public function testpdf() {
			return $this->render('test_pdf');
		}

		public function testemail() {
			return $this->render('test_email');
			// $model = User::model()->findByPk(Snl::app()->user()->user_id);
			// echo $model->sendEmailVerification();
			// echo Config::baseConfig()->email_sender;
		}

		public function testaccess() {
			echo SecurityHelper::encrypt(10);
			// $model = Folder::model()->findByPk(73);
			// $user_id = 2;

			// if($model != NULL) {
			// 	if($model->user_access != '') {
			// 		$user_access = json_decode($model->user_access);
			// 		print_r($user_access);
			// 		foreach($user_access as $index => $d) {
			// 			if($d->user == $user_id) {
			// 				unset($user_access[$index]);
			// 			}
						
			// 		}

			// 		$user_access = array_values($user_access);
			// 		echo "<br />";
			// 		print_r($user_access);
			// 	}						
			// }
		}
		
		// All ajax function
		
	}