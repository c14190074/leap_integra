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

		
		
	}