<?php
	class PerusahaanController extends BackendController {
		public function __construct() {
			$this->views = 'modules/perusahaan/backend/views/perusahaan/';
		}

		public function profile() {
			$this->page_title = 'Profil Perusahaan';
			$this->crumbs = array('Perusahaan', 'Profil');
			
			$model = Perusahaan::model()->findByPk(1);
			
			if(isset($_POST['Perusahaan'])) {
				$model->setAttributes($_POST['Perusahaan']);
				if($model->save()) {
					Snl::app()->setFlashMessage('Data perusahaan berhasil diperbaharui.', 'info');
					$this->redirect('admin/perusahaan/profile');
				} else {
					Snl::app()->setFlashMessage('Kesalahan input.', 'danger');
				}
			}

			return $this->render('profile', array(
				'toolbar' => $this->toolbar(),
				'model' => $model
			));
		}

		
		

		// All ajax function
		public function validate() {
			$post = $_POST['post'];
			$data = array();
			$result = array();
			$model = new Perusahaan;

			if(count($post) > 0) {
				foreach ($post as $key => $value) {
					$name = str_replace(']', '', str_replace('[', '', str_replace($model->classname, '', $value['name'])));
					$data[$name] = $value['value'];
				}
			}

			$id = isset($data['perusahaan_id']) ? $data['perusahaan_id'] : 0;
			if($id > 0) {
				$model = Perusahaan::model()->findByPk($id);
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

		
	}