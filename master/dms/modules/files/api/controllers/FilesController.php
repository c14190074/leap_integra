<?php
	class FilesController extends ApiController {
		public function createfolder() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$parent_folder = isset($this->params['parent_folder']) ? $this->params['parent_folder'] : 0;
					$name = isset($this->params['name']) ? $this->params['name'] : 'New Folder';
					$description = isset($this->params['description']) ? $this->params['description'] : '';
					$users = isset($this->params['users']) ? $this->params['users'] : NULL;
					
					if($parent_folder == "") {
						$parent_folder = 0;
					}
					
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
							if(count($users) > 0) {
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
					$keyword = isset($this->params['keyword']) ? $this->params['keyword'] : '';
					$model = NULL;
					$data = array();

					if(Folder::getCountUserFolder($this->user_id) > 0) {
						$model = Folder::model()->findAll(array(
							'condition' => 'folder_parent_id = :id AND is_deleted = 0 AND is_revision = 0 ORDER BY type DESC',
							'params'	=> array(':id' => $folder_parent_id)
						));
					}

					if($keyword != "") {
						$model = Folder::model()->findAll(array(
							'condition' => "is_deleted = 0 AND is_revision = 0 AND (name LIKE '%".$keyword."%' OR perihal LIKE '%".$keyword."%' OR nomor LIKE '%".$keyword."%' OR description LIKE '%".$keyword."%') ORDER BY name, perihal, nomor",
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
									'is_owner' 		=> $folder->isTheOwner($this->user_id) ? "1" : "0",
									'file_url'		=> Snl::app()->baseUrl() . 'uploads/documents/'.$folder->name,
									'is_shared'		=> $folder->user_access == NULL ? "0" : "1",
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
									'is_owner' 		=> $model->isTheOwner($this->user_id) ? "1" : "0",
									'is_shared'		=> $model->user_access == NULL ? "0" : "1",
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
									'is_owner' 		=> $folder->isTheOwner($this->user_id) ? "1" : "0",
									'is_shared'		=> $folder->user_access == NULL ? "0" : "1",
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

		public function getrecentactivities() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$logs = NULL;
					$data = array();

					$logs = Logs::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND created_by = :id AND (act != "open" OR type != "folder") ORDER BY updated_on DESC LIMIT 3',
						'params'	=> array(':id' => $this->user_id)
					));

					if($logs != NULL) {
						foreach($logs as $log) {
							$log_created = User::model()->findByPk($log->created_by);

							$data[] = array(
								'name' 		=> ucwords(strtolower($log_created->fullname)),
								'created_on' 	=> date('d M Y h:i:s', strtotime($log->created_on)),
								'description' 		=> $log->description,
							);
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
									'is_shared'		=> $folder->user_access == NULL ? "0" : "1",
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

					$data = array();

					if($user_model != NULL) {
            			foreach($user_model as $d) {
            				if($d->hasFolderAccess($folder_id)) {
            					$data[] = array(
									'user_id' 	=> $d->user_id,
									'fullname' 	=> ucwords(strtolower($d->fullname)),
									'email' 	=> $d->email,
									
								);
            				}
            			}
            		}

					$result = array(
						'status' 	=> 200,
						'users'	=> $data,
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
            				$documents[] = array(
            					'folder_id' 	=> $d->folder_id,
            					'name'		=> ucwords(strtolower($d->name))
            				);
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

		public function getrelateddocumentbyfile() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$documents = array();

					$model = Folder::model()->findByPk($folder_id);

					if($model != NULL) {
						if($model->related_document != NULL) {
							$related_document = json_decode($model->related_document);
							foreach($related_document as $document_id) {
								$document_model = Folder::model()->findByPk($document_id);
								$documents[] = array(
									'folder_id' 		=> $document_model->folder_id,
									'folder_parent_id' 	=> $document_model->folder_parent_id,
									'name' 				=> $document_model->name,
									'nomor' 			=> $document_model->nomor,
									'perihal' 			=> $document_model->perihal,
									'type' 				=> $document_model->type,
									'format' 			=> $document_model->format,
									'size' 				=> $document_model->size,
									'description' 		=> $document_model->description,
									'created_by' 		=> $document_model->created_by,
									'created_on' 		=> $document_model->created_on,
									'updated_on' 		=> $document_model->updated_on,
									'updated_by' 		=> $document_model->updated_by,
									'user_access' 		=> $document_model->user_access,
								);
							}
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
						
						// if($user_access != NULL && $this->isJSON($user_access)) {
						// 	$user_access = json_decode($user_access);

						// 	foreach ($user_access as $key => $value) {
						// 		array_push($ids, $value->user);
						// 	}

						// 	$tmp_user_access = $user_access;
						// }


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

						// if(count($user_access) > 0) {
						// 	$model->user_access = json_encode($tmp_user_access);
						// }
						
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

		public function getfiledata() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$data = array();
					$model = Folder::model()->findByPk($folder_id);
					
					if($model != NULL) {
						$data[] = array(
							'folder_id' 		=> $model->folder_id,
							'folder_parent_id' 	=> $model->folder_parent_id,
							'name' 				=> $model->name,
							'nomor' 				=> $model->nomor,
							'perihal' 				=> $model->perihal,
							'type' 				=> $model->type,
							'format' 				=> $model->format,
							'size' 				=> $model->size,
							'description' 				=> $model->description,
							'created_by' 				=> $model->created_by,
							'created_on' 				=> $model->created_on,
							'updated_on' 				=> $model->updated_on,
							'updated_by' 				=> $model->updated_by,
							'user_access' 				=> $model->user_access,
						);
					}

					$result = array(
						'status' => 200,
						'data'	=> $data,
					);

					$this->renderJSON($result);
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}

		public function getrevisionfile() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$data = array();
					
					$revisions = Folder::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND new_file_id = :id ORDER BY folder_id DESC',
						'params'	=> array(':id' => $folder_id)
					));
					
					if($revisions != NULL) {
						foreach($revisions as $model) {
							$user_created = User::model()->findByPk($model->created_by);

							$data[] = array(
								'folder_id' 		=> $model->folder_id,
								'folder_parent_id' 	=> $model->folder_parent_id,
								'name' 				=> $model->name,
								'no_revision'		=> $model->no_revision == NULL ? 'Original' : 'Versi '.$model->no_revision,
								'updated_on' 		=> $model->updated_on,
								'created_by' 		=> $user_created->fullname,
								'email'				=> $user_created->email
							);
						}
					}

					$result = array(
						'status' => 200,
						'data'	=> $data,
					);

					$this->renderJSON($result);
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}

		public function rollback() {
			if($this->valid_user_token) {
				if($this->request_type == 'POST') {
					$active_file_id = isset($this->params['active_file_id']) ? $this->params['active_file_id'] : 0;
					$target_file_id = isset($this->params['target_file_id']) ? $this->params['target_file_id'] : 0;
					
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

					$result = array(
						'status' => 200,
					);

					$this->renderJSON($result);
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}

		}

		public function manageuseraccess() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$users = isset($this->params['users']) ? $this->params['users'] : NULL;
					$new_role = isset($this->params['role']) ? $this->params['role'] : 'view';
					$user_access = array();
					$current_user = array();

					$model = Folder::model()->findByPk($folder_id);
					if($model != NULL) {
						if($model->user_access != NULL) {
							$current_data = json_decode($model->user_access);
							foreach($current_data as $d) {
								$role_data = array();
								foreach($d->role as $role) {
									array_push($role_data, $role);
								}

								$data = array(
									'user' 	=> $d->user,
									'role'	=> $role_data,
								);
								array_push($current_user, $d->user);
								array_push($user_access, $data);
							}
						}

						if($users != NULL) {
							if($this->isJSON($users)) {
								$users = json_decode($users);
								foreach($users as $id) {
									$role_data = array();
									if(!in_array($id, $current_user)) {
										array_push($role_data, 'view');

										if($new_role == 'edit') {
											array_push($role_data, 'edit');
										}

										$data = array(
											'user' 	=> $id,
											'role'	=> $role_data
										);

										array_push($user_access, $data);
									} else {
										foreach($user_access as $index => $d) {
											if($d['user'] == $id) {
												unset($user_access[$index]);
											}
										}

										$user_access = array_values($user_access);

										array_push($role_data, 'view');
										if($new_role == 'edit') {
											array_push($role_data, 'edit');
										}

										$data = array(
											'user' 	=> $id,
											'role'	=> $role_data
										);

										array_push($user_access, $data);
									}

								}

								$model->user_access =  json_encode($user_access);
								if($model->save()) {
									$result = array(
										'status' => 200,
									);

									$this->renderJSON($result);
								} else {
									$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($model->errors)));
								}

							}
						} else {
							$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage(array('User ID' => 'Tidak ada data yang dikirim.'))));
						}
					} else {
						$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage(array('data' => 'Data tidak ditemukan.'))));
					}



				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}

		public function getuseraccessbyfile() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$data = array();
					
					$model = Folder::model()->findByPk($folder_id);
					
					if($model != NULL) {
						if($model->user_access != '') {
							$user_access = json_decode($model->user_access);
							foreach($user_access as $d) {
								$user_model = User::model()->findByPk($d->user);

								$data[] = array(
									'folder_id' => $model->folder_id."",
									'user_id' 	=> $d->user."",
									'fullname'		=> $user_model->fullname,
									'email'		=> $user_model->email,
									'role' 		=> implode(', ', $d->role),

								);
							}
						}						
					}

					$result = array(
						'status' => 200,
						'data'	=> $data,
					);

					$this->renderJSON($result);
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}

		public function deleteuseraccess() {
			if($this->valid_user_token) {
				if($this->request_type == 'POST') {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$user_id = isset($this->params['user_id']) ? $this->params['user_id'] : 0;
					
					$model = Folder::model()->findByPk($folder_id);
					$user_access = array();

					if($model != NULL) {
						if($model->user_access != '') {
							$current_data = json_decode($model->user_access);
							foreach($current_data as $d) {
								if($user_id != $d->user) {
									$role_data = array();
									foreach($d->role as $role) {
										array_push($role_data, $role);
									}

									$data = array(
										'user' 	=> $d->user,
										'role'	=> $role_data,
									);
									
									array_push($user_access, $data);
								}
							}

							$model->user_access = count($user_access) > 0 ? json_encode($user_access) : NULL;
							if($model->save()) {
								$result = array(
									'status' => 200,
								);

								$this->renderJSON($result);
							} else {
								$this->renderErrorMessage(403, 'DeleteFailed', array(
										'error' => $this->parseErrorMessage(array('file' => $model->errors))
									));
							}
						}						
					}

					
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}


		public function addrelateddocument() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$documents = isset($this->params['documents']) ? $this->params['documents'] : NULL;	
					$new_data = array();

					$model = Folder::model()->findByPk($folder_id);
					if($model != NULL) {
						if($model->related_document != NULL) {
							$current_data = json_decode($model->related_document);
							foreach($current_data as $d) {
								array_push($new_data, $d);
							}
						}

						if($documents != NULL) {
							if($this->isJSON($documents)) {
								$documents = json_decode($documents);
								foreach($documents as $document_id) {
									if(!in_array($document_id, $new_data)) {
										array_push($new_data, $document_id);
									}
								}

								$model->related_document = json_encode($new_data);
								if($model->save()) {
									$result = array(
										'status' => 200,
									);

									$this->renderJSON($result);
								} else {
									$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($model->errors)));
								}
							} else {
								$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage(array('Dokumen' => 'Data type must be json.'))));
							}
						} else {
							$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage(array('Dokumen' => 'Tidak ada data yang dikirim.'))));
						}


					} else {
						$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage(array('data' => 'Data tidak ditemukan.'))));
					}

				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}

		public function deleterelateddocument() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$document_id = isset($this->params['document_id']) ? $this->params['document_id'] : NULL;	
					
					$new_data = array();

					$model = Folder::model()->findByPk($folder_id);
					if($model != NULL) {
						if($model->related_document != NULL) {
							$current_data = json_decode($model->related_document);
							foreach($current_data as $d) {
								if($d != $document_id) {
									array_push($new_data, $d);
								}
							}
						}

						$model->related_document = json_encode($new_data);
						if($model->save()) {
							$result = array(
								'status' => 200,
							);

							$this->renderJSON($result);
						} else {
							$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($model->errors)));
						}


					} else {
						$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage(array('data' => 'Data tidak ditemukan.'))));
					}

				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}

		public function editfolder() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$name = isset($this->params['name']) ? $this->params['name'] : "Folder";
					$description = isset($this->params['description']) ? $this->params['description'] : "";

					$model = Folder::model()->findByPk($folder_id);
					if($model != NULL) {
						$model->name = $name;
						$model->description = $description;
						if($model->save()) {
							$result = array(
								'status' => 200,
							);

							$this->renderJSON($result);
						} else {
							$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($model->errors)));
						}


					} else {
						$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage(array('data' => 'Data tidak ditemukan.'))));
					}

				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}

		public function revisidocument() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$folder_id = isset($this->params['folder_id']) ? $this->params['folder_id'] : 0;
					$perihal = isset($this->params['perihal']) ? $this->params['perihal'] : '';
					$nomor = isset($this->params['nomor']) ? $this->params['nomor'] : '';
					$description = isset($this->params['description']) ? $this->params['description'] : '';
					
					$original_file =Folder::model()->findByPk($folder_id);

					if($original_file != NULL) {
						$tempFile = $_FILES['file']['tmp_name'];
					    $targetPath = Snl::app()->rootDirectory() . 'uploads/documents/';
					    $targetFile =  $targetPath. $_FILES['file']['name'];
					    $upload_status = move_uploaded_file($tempFile,$targetFile);

					    if($upload_status) {
					    	$file_name = $_FILES['file']['name'];
						    $file_size = Snl::app()->formatSizeUnits($_FILES['file']['size']);
						    $file_format = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

							$model = new Folder;
							$model->folder_parent_id = $original_file->folder_parent_id;
							$model->original_id = $original_file->folder_id;
							$model->no_revision = $original_file->getNoRevisi() + 1;
							$model->keyword = $original_file->keyword;
							$model->user_access = $original_file->user_access;
							$model->related_document = $original_file->related_document;

							$model->name = $file_name;
							$model->format = $file_format;
							$model->size = $file_size;

							$model->perihal = $perihal;
							$model->nomor = $nomor;
							$model->description = $description;
							$model->is_revision = 0;
							$model->new_file_id = 0;
							$model->type = "file";


							$model->created_by = $this->user_id;
							$model->created_on = Snl::app()->dateNow();
							$model->updated_by = $this->user_id;
							$model->updated_on = Snl::app()->dateNow();
							$model->is_deleted = 0;

							if($model->save()) {
								$original_file->is_revision = 1;
								$original_file->new_file_id = $model->folder_id;
								$original_file->save();
								$original_file->setNewFileToAll();

								$result = array(
									'status' => 200,
								);

								$this->renderJSON($result);
							} else {
								$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($model->errors)));
							}
					    } else {
							$this->renderErrorMessage(403, 'UploadFailed', array(
										'error' => $this->parseErrorMessage(array('file' => $upload_status))
									));
						}

					} else {
						$this->renderErrorMessage(403, 'FileRevision', array(
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
	}

