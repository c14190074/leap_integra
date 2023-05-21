<?php
	class FormController extends BackendController {
		public function __construct() {
			$this->views = 'modules/form/backend/views/form/';
		}

		public function index() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}

			$this->page_title = LabelHelper::getLabel('Manage Form Pengajuan');
			$this->crumbs = array('Form', 'Index');
			$this->toolbarElement = '<a href="'.Snl::app()->baseUrl().'admin/user/create" class="btn btn-primary btn-sm pull-right m-l-20"><i class="glyphicon glyphicon-plus"></i></a>';

			return $this->render('index', array(
				'toolbar' => $this->toolbar(),
			));
		}

		public function create() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}

			$model = new Form;
		
			if(isset($_POST['Form'])) {
				$model->setAttributes($_POST['Form']);

				if($model->save()) {
					$ctr_form_type = count($_POST['Form']['type']);
					if($ctr_form_type > 0) {
						for($i=0; $i<$ctr_form_type; $i++) {
							if($_POST['Form']['type'][$i] != '') {
								$form_type = new JenisPeminjaman();
								$form_type->form_id = $model->form_id;
								$form_type->jenis_peminjaman = $_POST['Form']['type'][$i];
								$form_type->save();
							}
						}
					}

					Snl::app()->setFlashMessage('Form baru berhasil ditambahkan.', 'info');
					$this->redirect('admin/form/index');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
				

			}

			$this->page_title = LabelHelper::getLabel('Manage Form Pengajuan');
			$this->crumbs = array('Form', 'Create');
			$this->toolbarElement = '<a href="'.Snl::app()->baseUrl().'admin/form/index" class="btn btn-default btn-sm pull-right m-l-20"><i class="glyphicon glyphicon-remove"></i></a>';
			return $this->render('form', array(
				'toolbar' => $this->toolbar(),
				'model'   => $model,
				'form_type_data' => null
			));
		}

		public function update() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}

			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$model = Form::model()->findByPk($id);
			$form_type_data = JenisPeminjaman::model()->findAll(array(
				'condition' => 'is_deleted = 0 AND form_id = :form_id',
				'params'	=> array(':form_id' => $model->form_id)
			)); 
			
			if(isset($_POST['Form'])) {
				$model->setAttributes($_POST['Form']);
				if($model->save()) {
					JenisPeminjaman::model()->updateByAttribute(array(
						'update'		=> 'is_deleted = 1',
						'condition' => 'form_id = :form_id',
						'params'	=> array(':form_id' => $model->form_id)
					));

					$ctr_form_type = count($_POST['Form']['type']);
					if($ctr_form_type > 0) {
						for($i=0; $i<$ctr_form_type; $i++) {
							if($_POST['Form']['type'][$i] != '') {
								// $old_form_type = JenisPeminjaman::model()->findByAttribute(array(
								// 	'condition' => 'form_id = :form_id AND is_deleted = 0 AND jenis_peminjaman = :jenis_peminjaman',
								// 	'params'	=> array(':form_id' => $model->form_id, ':jenis_peminjaman' => $_POST['Form']['type'][$i])
								// ));

								// if($old_form_type == NULL) {
									$form_type = new JenisPeminjaman();
									$form_type->form_id = $model->form_id;
									$form_type->jenis_peminjaman = $_POST['Form']['type'][$i];
									$form_type->save();
								// }
		
							}
						}
					}

					Snl::app()->setFlashMessage('Form '.$model->form.' berhasil diubah.', 'info');
					$this->redirect('admin/form/index');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}

			$this->page_title = LabelHelper::getLabel('Edit Form Pengajuan');
			$this->crumbs = array('Form', 'Edit');
			$this->toolbarElement = '<a href="'.Snl::app()->baseUrl().'admin/form/index" class="btn btn-default btn-sm pull-right m-l-20"><i class="glyphicon glyphicon-remove"></i></a>';
			return $this->render('form', array(
				'toolbar' => $this->toolbar(),
				'model'   => $model,
				'form_type_data' => $form_type_data
			));
		}

		public function delete() {
			if(!Snl::app()->user()->is_superadmin) {
				$this->redirect('admin/dashboard/index');
			}
			
			$id = isset($_GET['id']) ? $_GET['id'] : 0;
			$model = Form::model()->findByPk($id);
			if($model !== NULL) {
				if($model->delete()) {
					Snl::app()->setFlashMessage('Form '.$model->form.' berhasil dihapus.', 'info');
				} else {
					Snl::app()->setFlashMessage('Internal server error.', 'danger');
				}
			}

			$this->redirect('admin/user/index');
		}

		

		// All ajax function
		public function validate() {
			$post = $_POST['post'];
			$data = array();
			$result = array();
			$model = new Form;

			if(count($post) > 0) {
				foreach ($post as $key => $value) {
					$name = str_replace(']', '', str_replace('[', '', str_replace($model->classname, '', $value['name'])));
					$data[$name] = $value['value'];
				}
			}

			$id = isset($data['user_id']) ? $data['user_id'] : 0;
			if($id > 0) {
				$model = Form::model()->findByPk($id);
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
			$search_query = $this->parseSearchQuery(new Form, $gets);
			if(!empty($search_query)) {
				$search_query = ' AND '.$search_query;
			}

			$total_search_query = $search_query." ORDER BY ".$sortField." ".$sortOrder;
			$model = Form::model()->findAll(array('condition' => 'is_deleted = 0'.$search_query));

			$itemsCount = 0;

			if(is_countable($model)) {
				$itemsCount = count($model);
			}


			$search_query .= " ORDER BY ".$sortField." ".$sortOrder." LIMIT ".$pageSize." OFFSET ".$offset;
			$forms = Form::model()->findAll(array('condition' => 'is_deleted = 0'.$search_query));

			if($forms !== NULL) {
				foreach ($forms as $form) {
					$user_created = User::model()->findByPk($form->created_by);
					$user_updated = User::model()->findByPk($form->updated_by);
					$data[] = [
						'form_id' => $form->form_id,
						'form' => $form->form,
						'created_on' => Snl::app()->dateTimeFormat($form->created_on),
						'created_by' => $user_created->fullname,
						'updated_on' => Snl::app()->dateTimeFormat($form->updated_on),
						'updated_by' => $user_updated->fullname,
					];
				}
			}

			$json = array(
				"itemsCount" => $itemsCount,
				"data" => $data,
			);
			echo json_encode($json);
		}
	}