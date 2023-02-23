<?php
	class User extends SnlActiveRecord {
		public $user_id, $is_superadmin, $fullname, $email, $password, $phone, $address, $position, $status, $status_email, $secret_key, $encryption_key, $encryption_iv, $created_on, $created_by, $updated_on, $updated_by, $is_deleted;
		public $password_repeat;

		public function __construct() {
		    $this->classname = 'User';
			$this->table_name = 'tbl_user';
			$this->primary_key = 'user_id';
		}

		public function rules() {
			return array(
				'required'	=> array('fullname', 'email', 'password', 'phone'),
				'unique'	=> array('email'),
				'repeat'	=> array('password'),
				'email'		=> array('email')
				// 'integer'	=> array('status')
			);
		}

		public static function model() {
			$model = new User();
			return $model;
		}

		public function getLabel($field, $with_rule = FALSE) {
			$labels = array(
				'user_id' => 'User ID',
				'is_superadmin' => 'Superadmin?',
				'fullname' => 'Nama Lengkap',
				'email' => 'Email',
				'password' => 'Password',
				'phone' => 'No. Telp',
				'address' => 'Alamat',
				'status' => 'Status',
				'status_email' => 'Status Email',
				'secret_key' => 'Secret Key',
				'encryption_key' => 'Encryption Key',
				'encryption_iv' => 'Encryption IV',
				'created_on' => 'Created On',
				'created_by' => 'Created By',
				'updated_on' => 'Updated On',
				'updated_by' => 'Updated By',
				'is_deleted' => 'Is Deleted',
				'password_repeat' => 'Ulangi Password',
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
			// $this->secret_key = md5($this->username);
			$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$digits = 16;

			if($this->isNewRecord) {
				$this->status_email = 0;
				$this->created_on = Snl::app()->dateNow();
				$this->created_by = Snl::app()->user()->user_id;
				$this->updated_on = Snl::app()->dateNow();
				$this->updated_by = Snl::app()->user()->user_id;

				$this->encryption_key = rand(pow(10, $digits-1), pow(10, $digits)-1);
				$this->encryption_iv = substr(str_shuffle($permitted_chars), 0, 16);

				$this->password = SecurityHelper::encrypt($this->password, $this->encryption_key, $this->encryption_iv);
			} else {
				$this->updated_on = Snl::app()->dateNow();
				$this->updated_by = Snl::app()->user()->user_id;

				if($this->encryption_key == "" || $this->encryption_iv == "") {
					$this->encryption_key = rand(pow(10, $digits-1), pow(10, $digits)-1);
					$this->encryption_iv = substr(str_shuffle($permitted_chars), 0, 16);
				}

				$old_password = User::getOldPassword($this->user_id);
				if($old_password != $this->password) {
					$this->password = SecurityHelper::encrypt($this->password, $this->encryption_key, $this->encryption_iv);
				}
			}
		}

		public function delete() {
			$this->is_deleted = 1;
			if($this->save()) {
				return TRUE;
			}

			return FALSE;
		}

		public function validateLogin() {
			$model = User::model()->findByAttribute(array(
				'condition' => 'email = :email AND is_deleted = 0',
				'params'	=> array(':email' => $this->email)
			));

			if($model == NULL) {
				return 0;
			} else {
				if(SecurityHelper::decrypt($model->password, $model->encryption_key, $model->encryption_iv) == $this->password) {
					if($model->status == 0) {
						return 1;
					}

					if($model->status_email == 0) {
						return 2;
					}

					if($model->status == 1 && $model->status_email == 1) {
						$this->generateSessionLogin($model);
						return 3;	
					}
					
				}
			}

			return 0;
		}

		public function generateSessionLogin($model) {
			$data = new stdClass();
			$data->user_id 		= $model->user_id;
			$data->is_superadmin = $model->is_superadmin;
			$data->email 	= $model->email;
			$data->fullname = $model->fullname;
			$data->phone 	= $model->phone;
			$data->address 	= $model->address;
			$data->status_email = $model->status_email;
			$data->status 		= $model->status;

			Snl::session()->createSession(SecurityHelper::encrypt('backendlogin'), json_encode($data));
		}

		public static function getOldPassword($id) {
			$model = User::model()->findByPk($id);
			if($model !== NULL) {
				return $model->password;
			}

			return '';
		}

		public function validateApiLogin($generate_session = FALSE) {
			$model = User::model()->findByAttribute(array(
				'condition' => 'email = :email AND status = :status AND is_deleted = 0',
				'params'	=> array(':email' => $this->email, ':status' => 1)
			));

			if($model == NULL) {
				return 0;
			} else {
				if(SecurityHelper::decrypt($model->password, $model->encryption_key, $model->encryption_iv) == $this->password) {
					$this->user_id = $model->user_id;
					return 1;
				}
			}

			return 0;
		}

		public function getApiLoginInformation($with_address = TRUE) {
			$result = array(
				'user_id'		=> $this->user_id,
				//'is_superadmin'	=> $this->is_superadmin,
				'email'			=> $this->email,
				'fullname'		=> ucwords(strtolower($this->fullname)),
				//'encryption_key'=> $this->encryption_key,
				//'encryption_iv'	=> $this->encryption_iv,
			);

			return $result;
		}

		public function hasFolderAccess($folder_id) {
			$model = Folder::model()->findByPk($folder_id);
			if($model != NULL) {
				return $model->hasAccess($this->user_id);
			}
			
			return FALSE;
		}

		public function sendEmailVerification() {
			$url = Snl::app()->baseUrl() . 'admin/user/verify?user='.SecurityHelper::encrypt($this->user_id);
			$mailObject = new MailHandler();
			$mailObject->init();
			return $mailObject->send($this->email, 'DMS Email Verification', Snl::app()->getVerificationEmailTemplate($url, ucwords(strtolower($this->fullname))));
		}
	}