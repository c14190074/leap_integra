<?php
	class Folder extends SnlActiveRecord {
		public $folder_id, $folder_parent_id, $name, $is_revision, $no_revision, $original_id, $new_file_id, $nomor, $perihal, $unit_kerja, $keyword, $related_document, $type, $format, $size, $description, $user_access, $last_viewed, $last_downloaded, $created_on, $created_by, $updated_on, $updated_by, $is_deleted;

		public function __construct() {
		  $this->classname = 'Folder';
			$this->table_name = 'tbl_folder';
			$this->primary_key = 'folder_id';
		}

		public function rules() {
			return array(
				// 'required'	=> array('name'),
			);
		}

		public static function model() {
			$model = new Folder();
			return $model;
		}

		public function getLabel($field, $with_rule = FALSE) {
			$labels = array(
				'folder_id' => 'Folder ID',
				'folder_parent_id' => 'Folder Parent',
				'name' => 'Nama',
				'is_revision' => 'Apakah ada revisi?',
				'no_revision' => 'Revisi Ke',
				'original_id' => 'Original ID',
				'new_file_id' => 'File Baru',
				'nomor' => 'Nomor',
				'perihal' => 'Perihal',
				'unit_kerja' => 'Unit Kerja',
				'keyword' => 'Keyword',
				'related_document' => 'Dokumen Terkait',
				'type' => 'Type',
				'format' => 'Format',
				'size' => 'Size',
				'description' => 'Deskripsi',
				'user_access' => 'Siapa yang dapat mengakses?',
				'created_on' => 'Tanggal Dibuat',
				'created_by' => 'Dibuat Oleh',
				'updated_on' => 'Tanggal Diperbaharui',
				'updated_by' => 'Diperbaharui Oleh',
				'is_deleted' => 'Is Deleted',
			);

			$label = isset($labels[$field]) ? $labels[$field] : ucwords(str_replace('_', ' ', $field));

			if($with_rule) {
				if(isset($this->rules()['required'])) {
					foreach($this->rules()['required'] as $value) {
						if($value == $field) {
							return $label.' <span class="required">*</span>';
						}
					}
				}
			}

			return $label;
		}

		public function getData() {
			$data = array();
			$refclass = new ReflectionClass($this);
			foreach ($refclass->getProperties() as $property) {
			    $name = $property->name;
			    if ($property->class == $refclass->name) {
			    	$data[$property->name] = $this->$name;
			    }
			}

			return $data;
		}

		public function setAttributes($post = array()) {
			$attributes = $this->getData();
			foreach ($attributes as $key => $value) {
				if(isset($post[$key])) {
					$this->$key = $post[$key];
				}
			}
		}

		public function beforeSave() {
			if($this->type == 'folder') {
				if($this->name == "" || $this->name == NULL) {
					$this->name = "New Folder";
				}
			}

			if($this->isNewRecord) {
				$this->created_on = Snl::app()->dateNow();
				$this->updated_on = Snl::app()->dateNow();

				if(isset(Snl::app()->user()->user_id)) {
					$this->created_by = Snl::app()->user()->user_id;
					$this->updated_by = Snl::app()->user()->user_id;
				}
			} else {
				$this->updated_on = Snl::app()->dateNow();

				if(isset(Snl::app()->user()->user_id)) {
					$this->updated_by = Snl::app()->user()->user_id;
				}
			}
			return TRUE;
		}

		public static function getCountUserFolder($user_id) {
			$folder_ctr = 0;
			$model = Folder::model()->findAll(array(
				'condition' => 'is_deleted = 0'
			));

			if($model != NULL) {
				foreach($model as $m) {
					if($m->created_by == $user_id) {
						$folder_ctr++;
					}

					if($m->user_access != NULL) {
            $user_access = json_decode($m->user_access);
            foreach($user_access as $id) {
              if($user_id == $id->user) {
              	$folder_ctr++;
              }
            }                      
          } 
				}
			}

			return $folder_ctr;
		}

		public function hasAccess($id = 0) {
			$user_access = array();
			$user_ids = array();

			if($id == 0) {
				$id = Snl::app()->user()->user_id;
			}

			if($this->user_access != NULL) {
				$user_access = json_decode($this->user_access);
			}

			foreach($user_access as $d) {
				array_push($user_ids, $d->user);
			}

			if($this->created_by == $id || in_array($id, $user_ids)) {
				return true;
			}

			return false;
		}

		public function hasViewAccess($user_id = 0) {
			if($user_id == 0) {
				$user_id = Snl::app()->user()->user_id;
			}

			$user_access = array();
			if($this->user_access != NULL) {
				$user_access = json_decode($this->user_access);
			}

			foreach($user_access as $d) {
				if($d->user == $user_id) {
					foreach($d->role as $r) {
						if($r == "view") {
							return TRUE;
						}
					}
				}	
			}

			if($this->created_by == $user_id) {
				return TRUE;
			}

			return false;
		}

		public function hasEditAccess() {
			$user_access = array();
			if($this->user_access != NULL) {
				$user_access = json_decode($this->user_access);
			}

			foreach($user_access as $d) {
				if($d->user == Snl::app()->user()->user_id) {
					foreach($d->role as $r) {
						if($r == "edit") {
							return TRUE;
						}
					}
				}	
			}

			if($this->created_by == Snl::app()->user()->user_id) {
				return TRUE;
			}

			return false;
		}

		public function isTheOwner() {
			if($this->created_by == Snl::app()->user()->user_id) {
				return true;
			}
			return false;
		}

		public function hasChild() {
			$model = Folder::model()->findAll(array(
				'condition' => 'folder_parent_id = :id AND is_deleted = 0',
				'params'		=> array(':id' => $this->folder_id)
			));

			if($model != NULL) {
				return true;
			} else {
				return false;
			}
		}

		public static function countNumberOfFile($model = NULL, $user_id = 0) {
			$ctr = 0;
			if($model != NULL) {
				foreach($model as $folder) {
					if($folder->hasAccess($user_id)) {
						$ctr++;
					}
				}
			}

			return $ctr;
		}

		public function getRelatedDocuments() {
			$related_documents = array();
			if($this->related_document != NULL && $this->related_document != "") {
				$related_document_ids = json_decode($this->related_document);
				
				foreach($related_document_ids as $id) {
					$model = Folder::model()->findByPk($id);
					if($model->is_deleted == 0) {
						array_push($related_documents, '<span class="text-sm mb-0 show-right-slider is-related" data-action="viewfile" role="button" data-folder-id="'.SecurityHelper::encrypt($model->folder_id).'">'.$model->name.'</span>');
					}
				}
			}

			return $related_documents;
		}

		public function getNoRevisi() {
			$original_id = $this->original_id;
			$ctr = 0;
			while($original_id > 0 && $original_id != NULL) {
				$model = Folder::model()->findByPk($original_id);
				if($model != NULL) {
					$ctr++;
					$original_id = $model->original_id;
				}
			}

			return $ctr;
		}

		public static function hasSharedFolder($user_id) {
			$model = Folder::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND type = "folder" AND user_access IS NOT NULL AND created_by != :id',
				'params'	=> array(':id' => $user_id)
			));

			$ctr = 0;
			if($model == NULL) {
				return FALSE;
			} else {
				foreach($model as $folder) {
					if($folder->hasAccess($user_id)) {
						$ctr++;
					}
				}
			}

			return $ctr == 0 ? FALSE : TRUE;
		}

		public function getLocation() {
			$location = array();
			$location_elm = "";

			if($this->folder_parent_id > 0) {
				$id = $this->folder_parent_id;

				while ($id > 0) {
					$model = Folder::model()->findByPk($id);
					if($model != NULL) {
						$data = array(
							'url' 	=> 'index?folder='.SecurityHelper::encrypt($model->folder_id),
							'name' 	=> ucwords(strtolower($model->name))
						);

						array_push($location, $data);
						$id = $model->folder_parent_id;

					}
				}

				$location = array_reverse($location);
			}

			if(count($location) > 0) {
				$location_elm .= "<p class='mb-0 file-location-label' style='font-size: 0.7rem; color: #ff0000bd;'>Location: ";
				foreach($location as $l) {
					if(end($location) == $l) {
						$location_elm .= "<a class='text-secondary' href='".$l['url']."'>".$l['name']."</a>";
					} else {
						$location_elm .= "<a class='text-secondary' href='".$l['url']."'>".$l['name']."</a> / ";
					}
				}
				$location_elm .= "</p>";
			}

			return $location_elm;
		}

		public function setNewFileToAll() {
			$original_id = $this->original_id;

			while($original_id > 0 && $original_id != NULL) {
				$model = Folder::model()->findByPk($original_id);
				if($model != NULL) {
					$model->new_file_id = $this->new_file_id;
					$model->save();
					$original_id = $model->original_id;
				}
			}

		}

		public function sendEmailNotification() {
			$id = $this->folder_id;
			$ctr = 0;
			if($this->type == 'file') {
				$id = $this->folder_parent_id;
			}

			$url = Snl::app()->baseUrl() . 'admin/files/index?folder='.SecurityHelper::encrypt($id);
			$sender_name = Snl::app()->user()->fullname;
			$sender_email = Snl::app()->user()->email;

			
			if($this->user_access != NULL) {
				$users = json_decode($this->user_access);
				if(is_array($users) && count($users) > 0) {
					$mailObject = new MailHandler();
					$mailObject->init();

					foreach($users as $id) {
						$user_model = User::model()->findByPk($id->user);
						$recipient_name = ucwords(strtolower($user_model->fullname));

						$is_send = $mailObject->send($user_model->email, 'Sebuah '.ucwords(strtolower($this->type)).' dibagikan kepada anda: '.$this->name, Snl::app()->getSharedNotificationTemplate($url, $sender_name, $sender_email, $recipient_name, ucwords(strtolower($this->type))));

						if($is_send) {
							$ctr++;
						}
					}
				}
			}

			return $ctr;
		}

	}