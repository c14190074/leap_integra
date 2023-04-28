<?php
	class FormController extends ApiController {
		public function getallforms() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$data = array();
					$model = Form::model()->findAll(array('condition' => 'is_deleted = 0'));

					if($model != NULL) {
						foreach($model as $form) {
							$data[] = array(
								'form_id' 	=> $form->form_id,
								'form'		=> $form->form,
							);
						}
					}
					
					$result = array(
						'status'	=> 200,
						'data'		=> $data,
					);

					$this->renderJSON($result);
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}

		
	}