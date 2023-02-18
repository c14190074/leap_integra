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
					Logs::create_logs($folder_parent->folder_id, 'open', 'folder', 'membuka folder '.$folder_parent->name);
					
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
				'folder_id'	=> $folder_id,
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
						Logs::create_logs($model->folder_id, 'create', 'folder', 'membuat folder baru dengan nama '.$model->name);

						$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_id));
					} else {
						Logs::create_logs($model->folder_id, 'update', 'folder', 'mengubah attribut pada folder '.$model->name);

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
			$ids = array();
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
						array_push($ids, $_POST['Folder']['user_access'][$i]);
						$data = array(
							'user' 	=> $_POST['Folder']['user_access'][$i],
							'role'	=> $_POST['Folder']['access_role'][$i]
						);

						array_push($user_access, $data);
					}

				}

				// otomatis menambahkan akses kepada pemilik folder
				$folder_parent = Folder::model()->findByPk($model->folder_parent_id);
				if($folder_parent != NULL) {
					if(Snl::app()->user()->user_id != $folder_parent->created_by) {
						if(!in_array($folder_parent->created_by, $ids)) {
							$data = array(
								'user' 	=> $folder_parent->created_by,
								'role'	=> array('view')
							);

							array_push($user_access, $data);
						}
					}
				}

				if(count($user_access) > 0) {
					$model->user_access =  json_encode($user_access);
				}

				if($model->save()) {
					Logs::create_logs($model->folder_id, 'upload', 'file', 'mengunggah file baru '.$model->name);
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
				$model->is_revision = 0;
				$model->no_revision = $original_file->getNoRevisi() + 1;
				$model->new_file_id = 0;
				// $model->nomor = $original_file->nomor;
				// $model->perihal = $original_file->perihal;
				// $model->unit_kerja = $original_file->unit_kerja;
				$model->keyword = $original_file->keyword;
				$model->user_access = $original_file->user_access;
				$model->type = "file";
				

				if($model->save()) {
					$original_file->is_revision = 1;
					$original_file->new_file_id = $model->folder_id;
					$original_file->save();
					$original_file->setNewFileToAll();

					Logs::create_logs($model->folder_id, 'revisi', 'file', 'melakukan revisi dengan file baru '.$model->name);
					Snl::app()->setFlashMessage('File revisi berhasil ditambahkan.', 'info');
					$this->redirect('admin/files/index?folder='.SecurityHelper::encrypt($model->folder_parent_id));
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}
		}

		public function open() {
			$folder_id = isset($_GET['word']) ? SecurityHelper::decrypt($_GET['word']) : 0;

			$model = Folder::model()->findByPk($folder_id);
			if($model == NULL) {
				$this->redirect('admin/dashboard/index');
			}

			$filename = $model->name;
			$local_breadcrumbs = array();

			$data = array(
				'url' 	=> '#',
				'name' 	=> ucwords(strtolower($filename))
			);
			array_push($local_breadcrumbs, $data);

			$folder_parent = Folder::model()->findByPk($model->folder_parent_id);
			if($folder_parent != NULL) {
				$data = array(
					'url' 	=> 'index?folder='.SecurityHelper::encrypt($folder_parent->folder_id),
					'name' 	=> ucwords(strtolower($folder_parent->name))
				);
				array_push($local_breadcrumbs, $data);


				$local_parent_id = $folder_parent->folder_parent_id;
				while($local_parent_id > 0) {
					$folder_parent = Folder::model()->findByPk($local_parent_id);
					if($folder_parent != NULL) {
						$data = array(
							'url' 	=> 'index?folder='.SecurityHelper::encrypt($folder_parent->folder_id),
							'name' 	=> ucwords(strtolower($folder_parent->name))
						);
						array_push($local_breadcrumbs, $data);

						$local_parent_id = $folder_parent->folder_parent_id;
					}
				}				
			}

			Logs::create_logs($model->folder_id, 'open', 'file', 'membuka file '.$model->name);

			return $this->render('loadfile', array(
				'filename' 	=> $filename,
				'local_breadcrumbs' => array_reverse($local_breadcrumbs),
				
			));
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
						Logs::create_logs($model->folder_id, 'delete', 'file', 'menghapus file '.$model->name);
						Snl::app()->setFlashMessage('File '.$model->name.' berhasil dihapus.', 'info');
					} else {
						Logs::create_logs($model->folder_id, 'delete', 'menghapus folder '.$model->name);
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
			$folder_id = isset($_POST['folder_id']) ? $_POST['folder_id'] : 0;

			$user_model = User::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND status = 1 AND user_id != :id',
				'params'	=> array('id' => Snl::app()->user()->user_id)
			));

			echo $this->render('_user_role_option', array('model' => $user_model, 'folder_id' => $folder_id));
		}

		public function getrevisiform() {
			$folder_id = SecurityHelper::decrypt($_GET['folder_id']);
			$folder = Folder::model()->findByPk($folder_id);
			$model = new Folder;
			$model->original_id = $folder_id;
			$model->nomor = $folder->nomor;
			$model->perihal = $folder->perihal;
			$model->description = $folder->description;

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
		
		public function createlogfile() {
			$folder_id = SecurityHelper::decrypt($_POST['folder_id']);
			$act = $_POST['act'];
			$model = Folder::model()->findByPk($folder_id);

			if($act == 'open') {
				echo Logs::create_logs($model->folder_id, $act, 'file', 'melihat file '.$model->name);
			} else {
				echo Logs::create_logs($model->folder_id, $act, 'file', 'mengunduh file '.$model->name);
			}
		}

		public function getData() {
			$folder_id = isset($_GET['folder']) ? $_GET['folder'] : 0;
			$name = isset($_GET['name']) ? $_GET['name'] : "";
			$nomor = isset($_GET['nomor']) ? $_GET['nomor'] : "";
			$perihal = isset($_GET['perihal']) ? $_GET['perihal'] : "";
			$email = isset($_GET['email']) ? $_GET['email'] : "";
			$date = isset($_GET['date']) ? $_GET['date'] : "";
			$is_search_result = FALSE;


			if(Folder::getCountUserFolder(Snl::app()->user()->user_id) > 0) {
				if($name != "" || $nomor != "" || $perihal != "" || $email != "" || $date != "") {
					$keyword = '';
					if($name != "") {
						$keyword = $keyword . " AND name LIKE '%".$name."%'";
					}

					if($nomor != "") {
						$keyword = $keyword . " AND nomor LIKE '%".$nomor."%'";
					}

					if($perihal != "") {
						$keyword = $keyword . " AND perihal LIKE '%".$perihal."%'";
					}

					if($date != "") {
						$keyword = $keyword . " AND date_format(updated_on, '%Y-%m-%d') = '".$date."'";
					}

					if($email != "") {
						$ids = array();
						$users = User::model()->findAll(array(
							'condition' => 'is_deleted = 0 AND status = 1 AND status_email = 1 AND email LIKE "%'.$email.'%"'
						));

						if($users != NULL) {
							$data = Folder::model()->findAll(array(
								'condition' => 'folder_parent_id = :id AND is_deleted = 0 AND is_revision = 0 ORDER BY type DESC',
								'params'	=> array(':id' => $folder_id)
							));

							foreach($users as $usr) {
								foreach($data as $d) {
									if($d->hasAccess($usr->user_id)) {
										array_push($ids, $d->folder_id);
									}
								}
							}

							if(count($ids) > 0) {
								$keyword = $keyword . ' AND folder_id IN('.implode($ids, ', ').')';
							}
						}
					}

					$model = Folder::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND is_revision = 0'.$keyword.' ORDER BY type DESC',
					));

					$is_search_result = TRUE;

					// $model = Folder::model()->findAll(array(
					// 	'condition' => 'is_deleted = 0 AND is_revision = 0 AND (name LIKE "%'.$keyword.'%" OR nomor LIKE "%'.$keyword.'%" OR perihal LIKE "%'.$keyword.'%" OR unit_kerja LIKE "%'.$keyword.'%" OR keyword LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%") ORDER BY type DESC',
					// ));

				} else {
					$model = Folder::model()->findAll(array(
						'condition' => 'folder_parent_id = :id AND is_deleted = 0 AND is_revision = 0 ORDER BY type DESC',
						'params'	=> array(':id' => $folder_id)
					));

				}
			}

			if($model != NULL) {
				if(Folder::countNumberOfFile($model) == 0) {
					$model = NULL;
				}
			}

			echo $this->render('_index', array(
				'model' => $model,
				'is_search_result' => $is_search_result,
			));
		}

		public function getfilesetting() {
			$folder_id = SecurityHelper::decrypt($_GET['folder_id']);
			$model = Folder::model()->findByPk($folder_id);
			$revisions = Folder::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND new_file_id = :id ORDER BY folder_id DESC',
				'params'	=> array(':id' => $model->folder_id)
			));
			
			echo $this->render('_file_setting', array(
				'model' => $model,
				'revisions' => $revisions,
			));
		}

		public function rollback() {
			$active_file_id = SecurityHelper::decrypt($_POST['active_file_id']);
			$target_file_id = SecurityHelper::decrypt($_POST['target_file_id']);


			$active_model = Folder::model()->findByPk($active_file_id);
			$active_model->is_revision = 1;
			$active_model->new_file_id = $target_file_id;
			$active_model->is_deleted = $active_model->folder_id > $target_file_id ? 1 : 0;
			$active_model->save();


			$model = Folder::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND new_file_id = :id ORDER BY folder_id DESC',
				'params'	=> array(':id' => $active_file_id)
			));

			if($model != NULL) {
				foreach($model as $folder) {
					$folder->new_file_id = $target_file_id;

					if($folder->folder_id > $target_file_id) {
						$folder->is_deleted = 1;
					}

					if($folder->folder_id == $target_file_id) {
						$folder->is_revision = 0;
						$folder->new_file_id = NULL;
					}


					$folder->save();
				}
			}

			
			Snl::app()->setFlashMessage('Rollback telah berhasil dilakukan', 'info');
			echo Logs::create_logs($target_file_id, 'rollback', 'file', 'melakukan rollback pada file '.$active_model->name);

			echo true;
			
		}
	}