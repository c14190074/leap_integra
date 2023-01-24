<?php
	class FilesController extends BackendController {
		public function __construct() {
			$this->views = 'modules/files/backend/views/files/';
		}

		public function index() {
			$this->page_title = 'Files';

			$local_breadcrumbs = array();
			$folder_parent = NULL;
			$folder_id = isset($_GET['folder']) ? SecurityHelper::decrypt($_GET['folder']) : 0;
			$GLOBALS['parentfolderid'] = $folder_id;
			
			$model = Folder::model()->findAll(array(
				'condition' => 'folder_parent_id = :id AND is_deleted = 0',
				'params'	=> array(':id' => $folder_id)
			));

			if($folder_id > 0) {
				$folder_parent = Folder::model()->findByPk($folder_id);

				$data = array(
					'url' 	=> 'index?folder='.SecurityHelper::encrypt($folder_parent->folder_id),
					'name' 	=> ucwords(strtolower($folder_parent->name))
				);
				array_push($local_breadcrumbs, $data);


				$local_parent_id = $folder_parent->folder_parent_id;
				while($local_parent_id > 0) {
					$local_parent_model = Folder::model()->findByPk($local_parent_id);
					if($local_parent_model != NULL) {
						$data = array(
							'url' 	=> 'index?folder='.SecurityHelper::encrypt($local_parent_model->folder_id),
							'name' 	=> ucwords(strtolower($local_parent_model->name))
						);
						array_push($local_breadcrumbs, $data);

						$local_parent_id = $local_parent_model->folder_parent_id;
					}
				}
			}

			return $this->render('index', array(
				'toolbar' 	=> $this->toolbar(),
				'model' 	=> $model,
				'folder_parent'	=> $folder_parent,
				'local_breadcrumbs' => array_reverse($local_breadcrumbs)
			));
		}

		public function createfolder() {
			if(isset($_POST['Folder'])) {
				$model = new Folder;
				$model->setAttributes($_POST['Folder']);
				
				if($model->save()) {
					Snl::app()->setFlashMessage('Folder baru berhasil ditambahkan.', 'success');
					$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_id));
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}
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