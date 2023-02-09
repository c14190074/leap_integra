<?php
	class Logs extends SnlActiveRecord {
		public $logs_id, $file_target_id, $act, $type, $description, $created_on, $created_by, $updated_on, $updated_by, $is_deleted;

		public function __construct() {
		  $this->classname = 'Logs';
			$this->table_name = 'tbl_logs';
			$this->primary_key = 'logs_id';
		}

		public function rules() {
			return array(
				// 'required'	=> array('name'),
			);
		}

		public static function model() {
			$model = new Logs();
			return $model;
		}

		public function getLabel($field, $with_rule = FALSE) {
			$labels = array(
				'logs_id' => 'Log ID',
				'file_target_id' => 'File',
				'act' => 'Tindakan',
				'type' => 'Type',
				'description' => 'Deskripsi',
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

		public static function create_logs($file_target_id, $act = 'general', $type, $description) {
			$needLog = TRUE;
			$model = Logs::model()->findByAttribute(array(
				'condition' => 'file_target_id = :id AND is_deleted = 0 AND act = :act AND type = :type AND description = :description ORDER BY created_on DESC',
				'params'	=> array(
					':id' => $file_target_id,
					':act' => $act,
					':type' => $type,
					':description' => $description,
				)
			));

			if($model != NULL) {
				if(date('Y-m-d H:i', strtotime(Snl::app()->dateNow())) == date('Y-m-d H:i', strtotime($model->created_on))) {
					$needLog = FALSE;
				}
			}

			if($needLog) {
				$model = new Logs();
				$model->file_target_id = $file_target_id;
				$model->act = $act;
				$model->type = $type;
				$model->description = $description;

				if($model->save()) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return TRUE;
			}

		}

	}