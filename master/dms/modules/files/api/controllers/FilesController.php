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

					// if($model != NULL) {
					// 	if(Folder::countNumberOfFile($model, $this->user_id) == 0) {
					// 		$model = NULL;
					// 	}
					// }

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
									'type' 		=> ucwords(strtolower($folder->type)),
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

		public function viewfolderattribute() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$model = Folder::model()->findByPk($folder_id);
					$data = array();
					$user_access_string = "";

					if($model != NULL) {
						$user_model = User::model()->findByPk($model->created_by);
						if($model->user_access != NULL) {
	                      $user_email = array();
	                      $user_access = json_decode($model->user_access);

	                      foreach($user_access as $d) {
	                        $user_access_model = User::model()->findByPk($d->user);
	                        if($model->type == "file") {
	                          $tmp_str = $user_access_model->email . "(".implode(',', $d->role).")";
	                          array_push($user_email, $tmp_str);
	                        } else {
	                          array_push($user_email, $user_access_model->email);
	                        }
	                        
	                      }

	                      array_push($user_email, $user_model->email." (owner)");
	                      $user_access_string = implode( ", ", $user_email);
	                    } 

						$data = array(
							'name' 			=> $model->name,
							'description' 	=> $model->description,
							'user_access' 	=> $user_access_string,
							'created_by' 	=> ucwords(strtolower($user_model->fullname)),
							'created_on' 	=> date('d M Y H:i:s', strtotime($model->created_on)),
							'updated_on' 	=> date('d M Y H:i:s', strtotime($model->updated_on)),
						);
					}
					
					$result = array(
						'status' => 200,
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

		public function viewfileattribute() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_id = isset($this->params['file_id']) ? $this->params['file_id'] : 0;

					$model = Folder::model()->findByPk($folder_id);
					$data = array();
					$user_access_string = "";

					if($model != NULL) {
						$user_model = User::model()->findByPk($model->created_by);
						if($model->user_access != NULL) {
	                      $user_email = array();
	                      $user_access = json_decode($model->user_access);

	                      foreach($user_access as $d) {
	                        $user_access_model = User::model()->findByPk($d->user);
	                        if($model->type == "file") {
	                          $tmp_str = $user_access_model->email . "(".implode(',', $d->role).")";
	                          array_push($user_email, $tmp_str);
	                        } else {
	                          array_push($user_email, $user_access_model->email);
	                        }
	                        
	                      }

	                      array_push($user_email, $user_model->email." (owner)");
	                      $user_access_string = implode( ", ", $user_email);
	                    } 

						$data = array(
							'nomor' 	=> $model->nomor,
							'perihal' 	=> $model->perihal,
							'name' 		=> $model->name,
							'size' 		=> $model->size,
							'format' 	=> $model->format,
							'description' 	=> $model->description,
							'related_document' 	=> implode(', ', $model->getRelatedDocuments()),
							'user_access' 	=> $user_access_string,
							'delete_access' => $model->created_by == $this->user_id ? 1 : 0,
							'view_access' => $model->hasViewAccess($this->user_id) ? 1 : 0,
							'created_by' 	=> ucwords(strtolower($user_model->fullname)),
							'created_on' 	=> date('d M Y H:i:s', strtotime($model->created_on)),
							'updated_on' 	=> date('d M Y H:i:s', strtotime($model->updated_on)),
						);
					}
					
					$result = array(
						'status' => 200,
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

		public function getrecentfiles() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					// $folder_parent_id = isset($this->params['folder_parent_id']) ? $this->params['folder_parent_id'] : 0;
					$recents = NULL;
					$data = array();

					$recents = Logs::model()->findAll(array(
						// 'select'	=> 'logs_id, DISTINCT file_target_id, act, type, description, created_on, created_by, updated_on, updated_by, is_deleted',
						'condition' => 'is_deleted = 0 AND created_by = :id AND act = "open" AND logs_id IN (SELECT MAX(logs_id) FROM tbl_logs GROUP BY file_target_id) AND file_target_id IN (SELECT folder_id FROM tbl_folder WHERE is_deleted = 0) ORDER BY created_on DESC LIMIT 5',
						'params'	=> array(':id' => $this->user_id)
					));


					if($recents != NULL) {
						foreach($recents as $recent) {
							$model = Folder::model()->findByPk($recent->file_target_id);
							if($model->hasAccess($this->user_id)) {

								$user_created = User::model()->findByPk($model->created_by);
                            	$user_updated = User::model()->findByPk($model->updated_by);
                            	$user_access_string = 'Only you';

                            	if($model->user_access != NULL) {
			                      $user_email = array();
			                      $user_access = json_decode($model->user_access);

			                      foreach($user_access as $d) {
			                        $user_access_model = User::model()->findByPk($d->user);
			                        if($model->type == "file") {
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
									'folder_id' 		=> $model->folder_id,
									'folder_parent_id' 	=> $model->folder_parent_id,
									'name' 		=> $model->name,
									'nomor' 	=> $model->nomor,
									'perihal' 	=> $model->perihal,
									'type' 		=> ucwords(strtolower($model->type)),
									'format' 	=> $model->format,
									'size' 		=> $model->size,
									'description' 	=> $model->description,
									'created_by' 	=> ucwords(strtolower($user_created->fullname)),
									'created_on' 	=> date('d M Y H:i:s', strtotime($model->created_on)),
									'updated_on' 	=> date('d M Y H:i:s', strtotime($model->updated_on)),
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

		public function getsharedfolder() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$shared_folders = NULL;
					$data = array();

					$shared_folders = Folder::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND type = "folder" AND user_access IS NOT NULL AND created_by != :id',
						'params'	=> array(':id' => $this->user_id)
					));

					if($shared_folders != NULL && Folder::hasSharedFolder($this->user_id)) {
						foreach($shared_folders as $folder) {
							if($folder->hasAccess($this->user_id)) {
								$user_created = User::model()->findByPk($folder->created_by);
								$user_access_string = 'Only you';

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
									'type' 		=> ucwords(strtolower($folder->type)),
									'format' 	=> $folder->format,
									'size' 		=> $folder->size,
									'description' 	=> $folder->description,
									'created_by' 	=> ucwords(strtolower($user_created->fullname)),
									'created_on' 	=> date('d M Y H:i:s', strtotime($folder->created_on)),
									'updated_on' 	=> date('d M Y H:i:s', strtotime($folder->updated_on)),
									// 'updated_by' 	=> ucwords(strtolower($user_updated->fullname)),
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

		public function delete() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$folder_id = isset($this->params['file_id']) ? $this->params['file_id'] : 0;
					$model = Folder::model()->findByPk($folder_id);
					$type = 'Unknown';
					$msg = '';

					if($model != NULL) {
						$type = $model->type;
						if($model->isTheOwner($this->user_id)) {
							if(!$model->hasChild()) {
								$model->is_deleted = 1;
								if($model->save()) {
									if($type == 'file') {
										$msg = 'File berhasil dihapus';
									} else {
										$msg = 'Folder berhasil dihapus';
									}
									
									$result = array(
										'status' 	=> 200,
										'message' 	=> $msg
									);

									$this->renderJSON($result);
								} else {
									$this->renderErrorMessage(403, 'DeleteFailed', array(
										'error' => $this->parseErrorMessage(array($type => $model->errors))
									));
								}				
							} else {
								$this->renderErrorMessage(403, 'DeleteFailed', array(
										'error' => $this->parseErrorMessage(array($type => ucwords(strtolower($type)).' ini tidak dapat dihapus karena terdapat file di dalamnya'))
									)
								);
							}

						} else {
							$this->renderErrorMessage(403, 'DeleteFailed', array(
										'error' => $this->parseErrorMessage(array($type => 'Anda tidak memiliki akses untuk menghapus '.$type.' ini'))
									)
								);
						}

					} else {
						$this->renderErrorMessage(403, 'DeleteFailed', array(
									'error' => $this->parseErrorMessage(array($type => 'Data tidak ditemukan'))
								));
					}

				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}

		public function search() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$keyword = isset($this->params['keyword']) ? $this->params['keyword'] : '';
					$data = array();

					$model = Folder::model()->findAll(array(
						'condition' => "is_deleted = 0 AND is_revision = 0 AND (name LIKE '%".$keyword."%' OR perihal LIKE '%".$keyword."%' OR nomor LIKE '%".$keyword."%' OR description LIKE '%".$keyword."%') ORDER BY name, perihal, nomor",
					));

					if($model != NULL) {
						foreach($model as $folder) {
							if($folder->hasAccess($this->user_id)) {
								$user_created = User::model()->findByPk($folder->created_by);
                            	$user_updated = User::model()->findByPk($folder->updated_by);
                            	$user_access_string = 'Only you';

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
									'type' 		=> ucwords(strtolower($folder->type)),
									'format' 	=> $folder->format,
									'size' 		=> $folder->size,
									'description' 	=> $folder->description,
									'created_by' 	=> ucwords(strtolower($user_created->fullname)),
									'created_on' 	=> date('d M Y H:i:s', strtotime($folder->created_on)),
									'updated_on' 	=> date('d M Y H:i:s', strtotime($folder->updated_on)),
									'updated_by' 	=> ucwords(strtolower($user_updated->fullname)),
									'user_access'	=> $user_access_string,
									// 'file_location' => $folder->getLocation(),
									// 'related_document' => implode(', ', $folder->getRelatedDocuments()),
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

		public function getuseraccessbyfolder() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$user_model = User::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND status = 1 AND user_id != :id',
						'params'	=> array('id' => $this->user_id)
					));

					$users = array();

					if($user_model != NULL) {
            			foreach($user_model as $d) {
            				if($d->hasFolderAccess($folder_id)) {
            					$data = array(
            						'user_id' 	=> $d->user_id,
            						'fullname' 	=> $d->fullname,
            						'email' 	=> $d->email,
            					);
            					array_push($users, $data);
            				}
            			}
            		}

            		$result = array(
						'status' => 200,
						'data'	 => $users,
					);

					$this->renderJSON($result);

				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}

		public function getrelateddocumentbyuser() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$model = Folder::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND type = :type AND created_by = :id',
						'params'	=> array(':id' => $this->user_id, ':type' => 'file')
					));

					$documents = array();

					if($model != NULL) {
            			foreach($model as $d) {
            				$data = array(
            					'file_id' 	=> $d->folder_id,
            					'name'		=> ucwords(strtolower($d->name))
            				);

            				array_push($documents, $data);
            			}
            		}

            		$result = array(
						'status' => 200,
						'data'	 => $documents,
					);

					$this->renderJSON($result);

				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}

		public function upload() {
			if($this->valid_user_token) {
				if($this->request_type == 'POST') {
					$tempFile = $_FILES['file']['tmp_name'];
				    $targetPath = Snl::app()->rootDirectory() . 'uploads/documents/';
				    $targetFile =  $targetPath. $_FILES['file']['name'];
				    $upload_status = move_uploaded_file($tempFile,$targetFile);
				    $file_name = $_FILES['file']['name'];
				    $file_size = Snl::app()->formatSizeUnits($_FILES['file']['size']);
				    $file_format = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

				    $parent_folder = isset($this->params['parent_folder']) ? $this->params['parent_folder'] : 0;
					$perihal = isset($this->params['perihal']) ? $this->params['perihal'] : '';
					$nomor = isset($this->params['nomor']) ? $this->params['nomor'] : '';
					$description = isset($this->params['description']) ? $this->params['description'] : '';
					$related_document_ids = isset($this->params['related_document_ids']) ? $this->params['related_document_ids'] : NULL;
					$user_access = isset($this->params['user_access']) ? $this->params['user_access'] : NULL;
					$tmp_user_access = array();
					$ids = array();

					if($upload_status) {
						$model = new Folder;
						$model->folder_parent_id = $parent_folder;
						$model->name = $file_name;
						$model->perihal = $perihal;
						$model->nomor = $nomor;
						$model->description = $description;
						$model->format = $file_format;
						$model->size = $file_size;
						$model->type = "file";
						$model->is_revision = 0;
						$model->related_document = $related_document_ids;
						$model->user_access = NULL;
						$model->created_by = $this->user_id;
						$model->created_on = Snl::app()->dateNow();
						$model->updated_by = $this->user_id;
						$model->updated_on = Snl::app()->dateNow();
						$model->is_deleted = 0;
						
						if($user_access != NULL && $this->isJSON($user_access)) {
							$user_access = json_decode($user_access);

							foreach ($user_access as $key => $value) {
								array_push($ids, $value->user);
							}

							$tmp_user_access = $user_access;
						}


						// otomatis menambahkan akses kepada pemilik folder
						$folder_parent = Folder::model()->findByPk($model->folder_parent_id);
						if($folder_parent != NULL) {
							if($this->user_id != $folder_parent->created_by) {
								if(!in_array($folder_parent->created_by, $ids)) {
									$data = array(
										'user' 	=> $folder_parent->created_by,
										'role'	=> array('view')
									);

									array_push($tmp_user_access, $data);
								}
							}
						}

						if(count($user_access) > 0) {
							$model->user_access = json_encode($tmp_user_access);
						}
						
						if($model->save()) {
							$data = array(
								'file_id' 			=> $model->folder_id,
								'folder_parent_id' 	=> $model->folder_parent_id,
								'name' 				=> $model->name,
								'perihal' 			=> $model->perihal,
								'nomor' 			=> $model->nomor,
								'description' 		=> $model->description,
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
						$this->renderErrorMessage(403, 'UploadFailed', array(
									'error' => $this->parseErrorMessage(array('file' => $upload_status))
								));
					}

				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}
	}