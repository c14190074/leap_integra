<?php
	class UserController extends BackendController {
		public function __construct() {
			$this->views = 'modules/user/backend/views/user/';
		}

		public function login() {
			if(Snl::app()->isAdmin()) {
				$this->redirect('admin/dashboard/index');
			}

			$model = new User;

			if(isset($_POST['User'])) {
				$model->email = $_POST['User']['email'];
				$model->password = $_POST['User']['password'];
				$login_result = $model->validateLogin();

				if($login_result == 3) {
					$this->redirect('admin/dashboard/index');
				} else if($login_result == 1) {
					Snl::app()->setFlashMessage('User belum aktif!', 'danger');
				} else if($login_result == 2) {
					Snl::app()->setFlashMessage('Email belum terverifikasi!', 'danger');				
				} else {
					Snl::app()->setFlashMessage('Email atau password salah!', 'danger');
				}
			}
			
			return $this->render('login2', array(
				'model' => $model
			));
		}

		public function register() {
			if(Snl::app()->isAdmin()) {
				$this->redirect('admin/dashboard/index');
			}

			$model = new User;
			if(isset($_POST['User'])) {
				$model->setAttributes($_POST['User']);
				if($model->save()) {
					Snl::app()->setFlashMessage('User baru berhasil ditambahkan.', 'info');
					$this->redirect('admin/user/login');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}

			return $this->render('register', array(
				'model' => $model
			));
		}

		public function profile() {
			$this->page_title = 'Profil';
			$this->crumbs = array('User', 'Profil');
			
			$model = User::model()->findByPk(Snl::app()->user()->user_id);
			$model->password_repeat = $model->password;

			if(isset($_POST['User'])) {
				$model->setAttributes($_POST['User']);
				if($model->save()) {
					Snl::app()->setFlashMessage('Data user berhasil diperbaharui.', 'info');
					$this->redirect('admin/user/profile');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}

			return $this->render('profile', array(
				'toolbar' => $this->toolbar(),
				'model' => $model
			));
		}

		public function logout() {
			Snl::session()->unsetSession(SecurityHelper::encrypt('backendlogin'));
			$this->redirect('admin/user/login');
		}

		public function index() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}

			$this->page_title = LabelHelper::getLabel('manage_user');
			$this->crumbs = array('User', 'Index');
			$this->toolbarElement = '<a href="'.Snl::app()->baseUrl().'admin/user/create" class="btn btn-primary btn-sm pull-right m-l-20"><i class="glyphicon glyphicon-plus"></i></a>';

			return $this->render('index', array(
				'toolbar' => $this->toolbar(),
			));
		}

		public function create() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}

			$model = new User;
			if(isset($_POST['User'])) {
				$model->setAttributes($_POST['User']);

				if($model->save()) {
					$model->sendEmailVerification();
					Snl::app()->setFlashMessage('User baru berhasil ditambahkan.', 'info');
					$this->redirect('admin/user/index');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}

			$this->page_title = LabelHelper::getLabel('create_user');
			$this->crumbs = array('User', 'Create');
			$this->toolbarElement = '<a href="'.Snl::app()->baseUrl().'admin/user/index" class="btn btn-default btn-sm pull-right m-l-20"><i class="glyphicon glyphicon-remove"></i></a>';
			return $this->render('form', array(
				'toolbar' => $this->toolbar(),
				'model'   => $model
			));
		}

		public function update() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}

			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$model = User::model()->findByPk($id);
			$model->password_repeat = $model->password;

			if(isset($_POST['User'])) {
				$model->setAttributes($_POST['User']);
				if($model->save()) {
					Snl::app()->setFlashMessage('User '.$model->username.' berhasil diubah.', 'info');
					$this->redirect('admin/user/index');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}

			$this->page_title = LabelHelper::getLabel('edit_user');
			$this->crumbs = array('User', 'Edit');
			$this->toolbarElement = '<a href="'.Snl::app()->baseUrl().'admin/user/index" class="btn btn-default btn-sm pull-right m-l-20"><i class="glyphicon glyphicon-remove"></i></a>';
			return $this->render('form', array(
				'toolbar' => $this->toolbar(),
				'model'   => $model
			));
		}

		public function delete() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}
			
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$model = User::model()->findByPk($id);
			if($model !== NULL) {
				if($model->delete()) {
					Snl::app()->setFlashMessage('User dengan email '.$model->email.' berhasil dihapus.', 'info');
				} else {
					Snl::app()->setFlashMessage('Internal server error.', 'danger');
				}
			}

			$this->redirect('admin/user/index');
		}

		public function verify() {
			$id = isset($_GET['user']) ? SecurityHelper::decrypt($_GET['user']) : 0;
			if($id == 0) {
				Snl::app()->setFlashMessage('Link sudah digunakan!', 'danger', 'flashmessage', FALSE);
				$this->redirect('admin/user/login');
			}

			$model = User::model()->findByPk($id);
			if($model !== NULL) {
				if($model->status_email == 1) {
					Snl::app()->setFlashMessage('Link sudah digunakan!', 'danger', 'flashmessage', FALSE);
					$this->redirect('admin/user/login');
				}

				$model->status_email = 1;
				if($model->save()) {
					Snl::app()->setFlashMessage('Selamat! Email anda telah terverifikasi.', 'info', 'flashmessage', FALSE);
				} else {
					Snl::app()->setFlashMessage('Link sudah digunakan!', 'danger', 'flashmessage', FALSE);
				}

				$this->redirect('admin/user/login');
			}

			$this->redirect('admin/user/login');
		}

		public function uploadsign() {
			
			if(isset($_POST['submit-sign'])) {
				$model = User::model()->findByPk(Snl::app()->user()->user_id);
				

				$tempFile = $_FILES['file']['tmp_name'];

				$temp = explode(".", $_FILES["file"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($temp);

                $targetPath = 'uploads/documents/';
                $targetFile =  $targetPath. $newfilename;
			 
			    if(move_uploaded_file($tempFile,$targetFile)) {
			    	$model->ttd = $newfilename;
			    	$model->save();
			    	Snl::app()->setFlashMessage('Privy Sign telah berhasil diupdate', 'info', 'flashmessage', FALSE);
			    } else {
			    	Snl::app()->setFlashMessage('Gagal mengunggah file!', 'danger', 'flashmessage', FALSE);
			    }

			    $this->redirect('admin/user/profile');
			}
		}

		// All ajax function
		public function validate() {
			$post = $_POST['post'];
			$data = array();
			$result = array();
			$model = new User;

			if(count($post) > 0) {
				foreach ($post as $key => $value) {
					$name = str_replace(']', '', str_replace('[', '', str_replace($model->classname, '', $value['name'])));
					$data[$name] = $value['value'];
				}
			}

			$id = isset($data['user_id']) ? $data['user_id'] : 0;
			if($id > 0) {
				$model = User::model()->findByPk($id);
			}

			$model->setAttributes($data);
			if($model->validate()) {
				$result = array(
					'valid' => TRUE
				);
			} else {
				$result = array(
					'valid' => FALSE,
					'msg'	=> $model->errors
				);
			}

			echo json_encode($result);
		}

		public function search() {
			$gets = isset($_GET) ? $_GET : array();
			
			$data = array();
			$pageIndex = isset($_GET['pageIndex']) ? $_GET['pageIndex'] : 1;
			$pageSize = isset($_GET['pageSize']) ? $_GET['pageSize'] : 10;
			$sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'updated_on';
			$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'desc';
			$offset = ($pageIndex - 1) * $pageSize;
			$search_query = $this->parseSearchQuery(new User, $gets);
			if(!empty($search_query)) {
				$search_query = ' AND '.$search_query;
			}

			$total_search_query = $search_query." ORDER BY ".$sortField." ".$sortOrder;
			$model = User::model()->findAll(array('condition' => 'is_deleted = 0'.$search_query));

			$itemsCount = 0;

			if(is_countable($model)) {
				$itemsCount = count($model);
			}


			$search_query .= " ORDER BY ".$sortField." ".$sortOrder." LIMIT ".$pageSize." OFFSET ".$offset;
			$users = User::model()->findAll(array('condition' => 'is_deleted = 0'.$search_query));

			if($users !== NULL) {
				foreach ($users as $user) {
					$data[] = $user->getData();
				}
			}

			$json = array(
				"itemsCount" => $itemsCount,
				"data" => $data,
			);
			echo json_encode($json);
		}
	}