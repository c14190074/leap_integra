<?php
	class Folder extends SnlActiveRecord {
		public $folder_id, $folder_parent_id, $name, $type, $format, $description, $user_access, $created_on, $created_by, $updated_on, $updated_by, $is_deleted;

		public function __construct() {
		    $this->classname = 'Folder';
			$this->table_name = 'tbl_folder';
			$this->primary_key = 'folder_id';
		}

		public function rules() {
			return array(
				'required'	=> array('name'),
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
				'name' => 'Nama Folder',
				'type' => 'Type',
				'format' => 'Format',
				'description' => 'Deskripsi',
				'user_access' => 'Siapa yang dapat mengakses?',
				'created_on' => 'Created On',
				'created_by' => 'Created By',
				'updated_on' => 'Updated On',
				'updated_by' => 'Updated By',
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
                        if($id == $user_id) {
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
			if($this->user_access != NULL) {
				$user_access = json_decode($this->user_access);
			}

			if($this->created_by == Snl::app()->user()->user_id || in_array(Snl::app()->user()->user_id, $user_access)) {
				return true;
			}

			return false;
		}

		public function isTheOwner() {
			if($this->created_by == Snl::app()->user()->user_id) {
				return true;
			}
			return false;
		}

	}