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
				if(isset($_GET['q']) && $_GET['q'] != "") {
					$keyword = strtolower($_GET['q']);
					
					$model = Folder::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND is_revision = 0 AND (name LIKE "%'.$keyword.'%" OR nomor LIKE "%'.$keyword.'%" OR perihal LIKE "%'.$keyword.'%" OR unit_kerja LIKE "%'.$keyword.'%" OR keyword LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%") ORDER BY type DESC',
						
					));

				} else {
					$model = Folder::model()->findAll(array(
						'condition' => 'folder_parent_id = :id AND is_deleted = 0 AND is_revision = 0 ORDER BY type DESC',
						'params'	=> array(':id' => $folder_id)
					));

				}

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

			return $this->render('index', array(
				'toolbar' 	=> $this->toolbar(),
				'model' 	=> $model,
				'folder_parent'	=> $folder_parent,
				'local_breadcrumbs' => array_reverse($local_breadcrumbs),
			));
		}

		public function createfolder() {
			$isNewRecord = TRUE;
			if(isset($_POST['Folder'])) {
				$message_result = 'Folder baru berhasil ditambahkan.';
				$model = new Folder;
				if(isset($_POST['Folder']['folder_id']) && $_POST['Folder']['folder_id'] != "") {
					$model = Folder::model()->findByPk($_POST['Folder']['folder_id']);
					$message_result = 'Folder berhasil diubah.';
					$isNewRecord = FALSE;
				}
				
				$model->setAttributes($_POST['Folder']);
				$model->type = "folder";
				$model->is_revision = 0;
				$model->user_access = NULL;
				// $model->user_access = isset($_POST['Folder']['user_access']) ? json_encode($_POST['Folder']['user_access']) : NULL;

				$user_access = array();
				if(isset($_POST['Folder']['user_access'])) {
					for($i = 0; $i < count($_POST['Folder']['user_access']); $i++) {
						$data = array(
							'user' 	=> $_POST['Folder']['user_access'][$i],
							'role'	=> array('view')
						);

						array_push($user_access, $data);
					}
					$model->user_access =  json_encode($user_access);
				}
				
				if($model->save()) {
					Snl::app()->setFlashMessage($message_result, 'info');
					if($isNewRecord) {
						Logs::create_logs($model->folder_id, 'folder', 'membuat folder baru dengan nama '.$model->name);

						$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_id));
					} else {
						Logs::create_logs($model->folder_id, 'folder', 'mengubah attribut pada folder '.$model->name);

						if($model->folder_parent_id == 0) {
							$this->redirect('admin/files/index');
						} else {
							$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_parent_id));
						}
					}
					
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}
		}

		public function savedocumentattribute() {
			$model = new Folder;
			if(isset($_POST['Folder'])) {
				// print_r($_POST['Folder']['access_role'][0]);
				// die();
				$model->setAttributes($_POST['Folder']);
				$model->type = "file";
				$model->is_revision = 0;
				$model->related_document = isset($_POST['Folder']['related_document']) ? json_encode($_POST['Folder']['related_document']) : NULL;
				$model->user_access = NULL;
				$user_access = array();
				if(isset($_POST['Folder']['user_access']) && isset($_POST['Folder']['access_role'])) {
					for($i = 0; $i < count($_POST['Folder']['user_access']); $i++) {
						$data = array(
							'user' 	=> $_POST['Folder']['user_access'][$i],
							'role'	=> $_POST['Folder']['access_role'][$i]
						);

						array_push($user_access, $data);
					}
					$model->user_access =  json_encode($user_access);
				}


				if($model->save()) {
					Logs::create_logs($model->folder_id, 'file', 'mengunggah file baru '.$model->name);
					Snl::app()->setFlashMessage('File baru berhasil ditambahkan.', 'info');
					$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_parent_id));
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}
		}

		public function revisidocument() {
			$model = new Folder;
			if(isset($_POST['Folder'])) {
				$model->setAttributes($_POST['Folder']);
				
				$original_file =Folder::model()->findByPk($model->original_id);
				$model->folder_parent_id = $original_file->folder_parent_id;
				$model->is_revision = 1;
				$model->no_revision = $original_file->getNoRevisi() + 1;
				$model->nomor = $original_file->nomor;
				$model->perihal = $original_file->perihal;
				$model->unit_kerja = $original_file->unit_kerja;
				$model->keyword = $original_file->keyword;
				$model->user_access = $original_file->user_access;
				$model->type = "file";
				

				if($model->save()) {
					Logs::create_logs($model->folder_id, 'file', 'melakukan revisi dengan file baru '.$model->name);
					Snl::app()->setFlashMessage('File revisi berhasil ditambahkan.', 'info');
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
			$user_ids = array();
			if($model->user_access != NULL) {
				$user_access_data = json_decode($model->user_access);
				foreach ($user_access_data as $d) {
					array_push($user_ids, $d->user);
				}
			}

			$data = array(
				'folder_id' => $model->folder_id,
				'name' 		=> $model->name,
				'description' => $model->description,
				'user_access' => $user_ids
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
						Logs::create_logs($model->folder_id, 'file', 'menghapus file '.$model->name);
						Snl::app()->setFlashMessage('File '.$model->name.' berhasil dihapus.', 'info');
					} else {
						Logs::create_logs($model->folder_id, 'folder', 'menghapus folder '.$model->name);
						Snl::app()->setFlashMessage('Folder '.$model->name.' berhasil dihapus.', 'info');	
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

			$model_revisi = Folder::model()->findAll(array(
				'condition' => 'original_id = :id AND is_revision = 1 AND is_deleted = 0',
				'params'	=> array(':id' => $model->folder_id)
			));

			$model_logs = Logs::model()->findAll(array(
				'condition' => 'file_target_id = :id AND is_deleted = 0 ORDER BY created_on DESC',
				'params'	=> array(':id' => $model->folder_id)
			));

			echo $this->render('_viewfile', array(
				'model' => $model, 
				'user' => $user_model,
				'model_revisi' 	=> $model_revisi,
				'model_logs' 	=> $model_logs,
			));
		}
		
		public function addroleoption() {
			$user_model = User::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND status = 1 AND user_id != :id',
				'params'	=> array('id' => Snl::app()->user()->user_id)
			));
			echo $this->render('_user_role_option', array('model' => $user_model));
		}

		public function getrevisiform() {
			$folder_id = SecurityHelper::decrypt($_GET['folder_id']);
			$folder = Folder::model()->findByPk($folder_id);
			$model = new Folder;
			$model->original_id = $folder_id;

			echo $this->render('_upload_file_revisi', array('model' => $model, 'folder' => $folder));
		}

		public function folderdetail() {
			$folder_id = SecurityHelper::decrypt($_GET['folder_id']);
			$model = Folder::model()->findByPk($folder_id);
			$user_model = User::model()->findByPk($model->created_by);

			$model_logs = Logs::model()->findAll(array(
				'condition' => 'file_target_id = :id AND is_deleted = 0 ORDER BY created_on DESC',
				'params'	=> array(':id' => $model->folder_id)
			));

			echo $this->render('_folder_detail', array(
				'model' => $model, 
				'user_model' => $user_model,
				'model_logs' 	=> $model_logs,
			));
		}
		

		// public function getfilefromserver() {
		// 	// $filename="https://localhost/leap_integra/master/dms/uploads/documents/FileDoc.docx";
		// 	$filename="C:/xampp/htdocs/leap_integra/master/dms/uploads/documents/FileDoc.docx";
		//   	header("Content-disposition: attachment;filename=$filename");
		//   	echo($filename);
		// }
	}