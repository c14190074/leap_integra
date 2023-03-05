<?php
	class FilesController extends ApiController {
		public function createfolder() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$parent_folder = isset($this->params['parent_folder']) ? $this->params['parent_folder'] : 0;
					$name = isset($this->params['name']) ? $this->params['name'] : 'New Folder';
					$description = isset($this->params['description']) ? $this->params['description'] : '';
					$users = isset($this->params['users']) ? $this->params['users'] : NULL;
					
					$folder = new Folder;
					$folder->folder_parent_id = $parent_folder;
					$folder->name = $name;
					$folder->description = $description;
					$folder->type = "folder";
					$folder->is_revision = 0;
					$folder->user_access = NULL;
					$folder->created_by = $this->user_id;
					$folder->created_on = Snl::app()->dateNow();
					$folder->updated_by = $this->user_id;
					$folder->updated_on = Snl::app()->dateNow();
					$folder->is_deleted = 0;

					$user_access = array();

					if($users != NULL) {
						if($this->isJSON($users)) {
							$users = json_decode($users);
							foreach($users as $id) {
								$data = array(
									'user' 	=> $id,
									'role'	=> array('view')
								);

								array_push($user_access, $data);
							}

							$folder->user_access =  json_encode($user_access);
						}
					}

					if($folder->save()) {
						$data = array(
							'folder_id' 		=> $folder->folder_id,
							'folder_parent_id' 	=> $folder->folder_parent_id,
							'name' 				=> $folder->name,
							'description' 		=> $folder->description,
						);

						$result = array(
							'status' => 200,
							'data'	 => $data,
						);

						$this->renderJSON($result);
					} else {
						$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($folder->errors)));
					}

				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}

		
		public function getfiles() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_parent_id = isset($this->params['folder_parent_id']) ? $this->params['folder_parent_id'] : 0;
					$model = NULL;
					$data = array();

					if(Folder::getCountUserFolder($this->user_id) > 0) {
						$model = Folder::model()->findAll(array(
							'condition' => 'folder_parent_id = :id AND is_deleted = 0 AND is_revision = 0 ORDER BY type DESC',
							'params'	=> array(':id' => $folder_parent_id)
						));
					}

					if($model != NULL) {
						if(Folder::countNumberOfFile($model, $this->user_id) == 0) {
							$model = NULL;
						}
					}

					if($model != NULL) {
						foreach($model as $folder) {
							if($folder->hasAccess($this->user_id)) {
								$user_created = User::model()->findByPk($folder->created_by);
					        	$user_updated = User::model()->findByPk($folder->updated_by);
					        	$user_access_string = '';

					        	if($folder->user_access != NULL) {
					                $user_email = array();
					                $user_access = json_decode($folder->user_access);
					                foreach($user_access as $d) {
					                  $user_access_model = User::model()->findByPk($d->user);
					                  if($folder->type == "file") {
					                    $tmp_str = $user_access_model->email . "(".implode(',', $d->role).")";
					                    array_push($user_email, $tmp_str);
					                  } else {
					                    array_push($user_email, $user_access_model->email);
					                  }
					                  
					                }

					                array_push($user_email, $user_created->email." (owner)");
					                $user_access_string = implode( ", ", $user_email);
					              } 

					        	$data[] = array(
									'folder_id' 		=> $folder->folder_id,
									'folder_parent_id' 	=> $folder->folder_parent_id,
									'name' 		=> $folder->name,
									'nomor' 	=> $folder->nomor,
									'perihal' 	=> $folder->perihal,
									'type' 		=> $folder->type,
									'format' 	=> $folder->format,
									'size' 		=> $folder->size,
									'description' 	=> $folder->description,
									'created_by' 	=> ucwords(strtolower($user_created->fullname)),
									'created_on' 	=> date('d M Y H:i:s', strtotime($folder->created_on)),
									'updated_on' 	=> date('d M Y H:i:s', strtotime($folder->updated_on)),
									'updated_by' 	=> ucwords(strtolower($user_updated->fullname)),
									'user_access'	=> $user_access_string,
									//'related_document' => implode(', ', $folder->getRelatedDocuments()),
								);

							}
						}
					} 


					$result = array(
						'status' => 200,
						'total_data' => count($data),
						'data'	 => $data,
					);

					$this->renderJSON($result);
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}
	}