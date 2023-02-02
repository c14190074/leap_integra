<?php
	class FilesController extends BackendController {
		public function __construct() {
			$this->views = 'modules/files/backend/views/files/';
		}

		public function index() {
			$this->page_title = 'Files';

			$model = NULL;
			$local_breadcrumbs = array();
			$folder_parent = NULL;
			$folder_id = isset($_GET['folder']) ? SecurityHelper::decrypt($_GET['folder']) : 0;
			$GLOBALS['parentfolderid'] = $folder_id;
			
			if(Folder::getCountUserFolder(Snl::app()->user()->user_id) > 0) {
				$model = Folder::model()->findAll(array(
					'condition' => 'folder_parent_id = :id AND is_deleted = 0 ORDER BY type DESC',
					'params'	=> array(':id' => $folder_id)
				));

				// untuk membuat breadcrumbs
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
			}

			$files = File::model()->findAll(array(
				'condition' => 'folder_id = :folder_id AND is_deleted = 0',
				'params'	=> array(':folder_id' => $folder_id)
			));
			
			return $this->render('index', array(
				'toolbar' 	=> $this->toolbar(),
				'model' 	=> $model,
				'folder_parent'	=> $folder_parent,
				'local_breadcrumbs' => array_reverse($local_breadcrumbs),
				'files'		=> $files
			));
		}

		public function createfolder() {
			if(isset($_POST['Folder'])) {
				$message_result = 'Folder baru berhasil ditambahkan.';
				$model = new Folder;
				if(isset($_POST['Folder']['folder_id']) && $_POST['Folder']['folder_id'] != "") {
					$model = Folder::model()->findByPk($_POST['Folder']['folder_id']);
					$message_result = 'Folder berhasil diubah.';
				}
				
				$model->setAttributes($_POST['Folder']);
				$model->type = "folder";
				$model->user_access = isset($_POST['Folder']['user_access']) ? json_encode($_POST['Folder']['user_access']) : NULL;
				
				if($model->save()) {
					Snl::app()->setFlashMessage($message_result, 'success');
					$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_id));
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}
		}

		public function savedocumentattribute() {
			$model = new Folder;
			if(isset($_POST['Folder'])) {
				$model->setAttributes($_POST['Folder']);
				$model->type = "file";
				$model->related_document = isset($_POST['Folder']['related_document']) ? json_encode($_POST['Folder']['related_document']) : NULL;


				if($model->save()) {
					Snl::app()->setFlashMessage('File baru berhasil ditambahkan.', 'success');
					$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_parent_id));
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}
		}

		// All ajax function
		public function upload() {
			if (!empty($_FILES)) {
			    $tempFile = $_FILES['file']['tmp_name'];
			    $targetPath = Snl::app()->rootDirectory() . 'uploads/documents/';
			    $targetFile =  $targetPath. $_FILES['file']['name'];
			 
			    move_uploaded_file($tempFile,$targetFile);
			    echo json_encode($tempFile);
			}
		}
		
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

		public function validatefileattribute() {
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

			$id = isset($data['file_id']) ? $data['file_id'] : 0;
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

		public function getfolderdata() {
			$folder_id = SecurityHelper::decrypt($_GET['id']);
			$model = Folder::model()->findByPk($folder_id);
			$data = array(
				'folder_id' => $model->folder_id,
				'name' 		=> $model->name,
				'description' => $model->description,
				'user_access' => $model->user_access != NULL ? json_decode($model->user_access) : [],
			);

			echo json_encode($data);
		}

		public function deletefolder() {
			$folder_id = SecurityHelper::decrypt($_POST['folder_id']);
			$type = isset($_POST['type']) ? $_POST['type'] : 'folder';
			$model = Folder::model()->findByPk($folder_id);

			if(!$model->hasChild()) {
				$model->is_deleted = 1;

				if($model->save()) {
					if($type == 'file') {
						Snl::app()->setFlashMessage('File '.$model->name.' berhasil dihapus.', 'success');
					} else {
						Snl::app()->setFlashMessage('Folder '.$model->name.' berhasil dihapus.', 'success');	
					}
					
					$result = array(
						'valid' => TRUE
					);
				} else {
					Snl::app()->setFlashMessage('Internal server error.', 'danger');
					$result = array(
						'valid' => FALSE
					);
				}				
			} else {
				Snl::app()->setFlashMessage('Folder '.$model->name.' tidak dapat dihapus karena terdapat file/folder di dalamnya.', 'danger');
				$result = array(
					'valid' => FALSE
				);
			}


			echo json_encode($result);
		}

		public function viewfile() {
			$folder_id = SecurityHelper::decrypt($_GET['folder_id']);
			$model = Folder::model()->findByPk($folder_id);
			$user_model = User::model()->findByPk($model->created_by);
			echo $this->render('_viewfile', array('model' => $model, 'user' => $user_model));
		}
		
		// public function getfilefromserver() {
		// 	// $filename="https://localhost/leap_integra/master/dms/uploads/documents/FileDoc.docx";
		// 	$filename="C:/xampp/htdocs/leap_integra/master/dms/uploads/documents/FileDoc.docx";
		//   	header("Content-disposition: attachment;filename=$filename");
		//   	echo($filename);
		// }
	}