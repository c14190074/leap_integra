<?php
	class FilesController extends BackendController {
		public function __construct() {
			$this->views = 'modules/files/backend/views/files/';
		}

		public function index() {
			$this->page_title = 'Files';

			$model = Folder::model()->findAll(array('condition' => 'is_deleted = 0'));

			return $this->render('index', array(
				'toolbar' => $this->toolbar(),
				'model' => $model
			));
		}

		public function createfolder() {
			if(isset($_POST['Folder'])) {
				$model = new Folder;
				$model->setAttributes($_POST['Folder']);

				if($model->save()) {
					Snl::app()->setFlashMessage('Folder baru berhasil ditambahkan.', 'success');
					$this->redirect('admin/files/index');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}
		}

		public function openfolder() {
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$id = SecurityHelper::decrypt($id);
			echo $id;
		}

		// All ajax function
		public function validate() {
			$post = $_POST['post'];
			$data = array();
			$result = array();
			$model = new Folder;

			if(count($post) > 0) {
				foreach ($post as $key => $value) {
					$name = str_replace(']', '', str_replace('[', '', str_replace($model->classname, '', $value['name'])));
					$data[$name] = $value['value'];
				}
			}

			$id = isset($data['folder_id']) ? $data['folder_id'] : 0;
			if($id > 0) {
				$model = Folder::model()->findByPk($id);
			}

			$model->setAttributes($data);
			if($model->validate()) {
				$result = array(
					'valid' => TRUE
				);
			} else {
				$result = array(
					'valid' => FALSE,
					'msg'	=> $model->errors
				);
			}

			echo json_encode($result);
		}
		
	}