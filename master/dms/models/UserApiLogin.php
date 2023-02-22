<?php
	class UserApiLogin extends SnlActiveRecord {
		public $api_login_id, $user_id, $clock_in, $clock_out;

		public function __construct() {
		    $this->classname = 'UserApiLogin';
			$this->table_name = 'tbl_user_api_login';
			$this->primary_key = 'api_login_id';
		}

		public function rules() {
			return array();
		}

		public static function model() {
			$model = new UserApiLogin();
			return $model;
		}

		public function getLabel($field, $with_rule = FALSE) {
			$labels = array(
				'api_login_id' => 'Api Login ID',
				'user_id' => 'Userr ID',
				'clock_in' => 'Clock In',
				'clock_out' => 'Clock Out',
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
			return TRUE;
		}
	}