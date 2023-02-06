<?php
	class Folder extends SnlActiveRecord {
		public $folder_id, $folder_parent_id, $name, $is_revision, $no_revision, $original_id, $nomor, $perihal, $unit_kerja, $keyword, $related_document, $type, $format, $size, $description, $user_access, $created_on, $created_by, $updated_on, $updated_by, $is_deleted;

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
					$this->name = "undifined";
				}
			}

			if($this->isNewRecord) {
				$this->created_on = Snl::app()->dateNow();
				$this->created_by = Snl::app()->user()->user_id;
				$this->updated_on = Snl::app()->dateNow();
				$this->updated_by = Snl::app()->user()->user_id;
			} else {
				$this->updated_on = Snl::app()->dateNow();
				$this->updated_by = Snl::app()->user()->user_id;
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

		public function hasAccess() {
			$user_access = array();
			$user_ids = array();
			if($this->user_access != NULL) {
				$user_access = json_decode($this->user_access);
			}

			foreach($user_access as $d) {
				array_push($user_ids, $d->user);
			}

			if($this->created_by == Snl::app()->user()->user_id || in_array(Snl::app()->user()->user_id, $user_ids)) {
				return true;
			}

			return false;
		}

		public function hasViewAccess() {
			$user_access = array();
			if($this->user_access != NULL) {
				$user_access = json_decode($this->user_access);
			}

			foreach($user_access as $d) {
				if($d->user == Snl::app()->user()->user_id) {
					foreach($d->role as $r) {
						if($r == "view") {
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

		public static function countNumberOfFile($model = NULL) {
			$ctr = 0;
			if($model != NULL) {
				foreach($model as $folder) {
					if($folder->hasAccess()) {
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
						array_push($related_documents, '<span class="text-sm mb-0 view-file-attribute" role="button" data-folder-id="'.SecurityHelper::encrypt($model->folder_id).'">'.$model->name.'</span>');
					}
				}
			}

			return $related_documents;
		}

		public function getNoRevisi() {
			$model = Folder::model()->findAll(array(
				'condition' => 'is_revision = 1 AND is_deleted = 0 AND original_id = :id',
				'params'		=> array(':id' => $this->folder_id)
			));

			return count($model);
		}

	}