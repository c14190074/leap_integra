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

		public function getjenispeminjaman() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$data = array();
					$model = JenisPeminjaman::model()->findAll(array('condition' => 'is_deleted = 0'));

					if($model != NULL) {
						foreach($model as $d) {
							$data[] = array(
								'jenis_peminjaman_id' 	=> $d->jenis_peminjaman_id,
								'jenis_peminjaman'		=> $d->jenis_peminjaman,
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

		public function createpermohonan() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$form_id = isset($this->params['form_id']) ? $this->params['form_id'] : 0;
					$jenis_peminjaman_id = isset($this->params['jenis_peminjaman_id']) ? $this->params['jenis_peminjaman_id'] : 0;
					
					$perihal = isset($this->params['perihal']) ? $this->params['perihal'] : '';
					$nrp = isset($this->params['nrp']) ? $this->params['nrp'] : '';
					$nama = isset($this->params['nama']) ? $this->params['nama'] : '';
					$universitas = isset($this->params['universitas']) ? $this->params['universitas'] : '';
					$keterangan = isset($this->params['keterangan']) ? $this->params['keterangan'] : '';
					$date_start = isset($this->params['date_start']) ? $this->params['date_start'] : '';
					$date_end = isset($this->params['date_end']) ? $this->params['date_end'] : '';
					$status = isset($this->params['status']) ? $this->params['status'] : 'draft';
					$is_open_for_notif = isset($this->params['is_open_for_notif']) ? $this->params['is_open_for_notif'] : 0;
					$alasan = isset($this->params['alasan']) ? $this->params['alasan'] : '';


					$permohonan = new Permohonan;
					$permohonan->form_id = $form_id;
					$permohonan->jenis_peminjaman_id = $jenis_peminjaman_id;
					$permohonan->perihal = $perihal;
					$permohonan->nrp = $nrp;
					$permohonan->nama = $nama;
					$permohonan->universitas = $universitas;
					$permohonan->keterangan = $keterangan;
					$permohonan->date_start = $date_start == '' ? Snl::app()->dateNow() :  date('Y-m-d H:i:s', strtotime($date_start));
					$permohonan->date_end = $date_end == '' ? Snl::app()->dateNow() :  date('Y-m-d H:i:s', strtotime($date_end));
					$permohonan->status = $status;
					$permohonan->is_open_for_notif = $is_open_for_notif;
					$permohonan->alasan = $alasan;
					$permohonan->created_by = $this->user_id;
					$permohonan->created_on = Snl::app()->dateNow();
					$permohonan->updated_by = $this->user_id;
					$permohonan->updated_on = Snl::app()->dateNow();
					$permohonan->is_deleted = 0;

					$user_access = array();

					if($permohonan->save()) {
						$result = array(
							'status' => 200,
						);

						$this->renderJSON($result);
					} else {
						$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($permohonan->errors)));
					}

				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}

		public function getpermohonan() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$search_keyword = isset($this->params['search_keyword']) ? $this->params['search_keyword'] : "";
					$data = array();

					if($search_keyword != '') {
						$model = Permohonan::model()->findAll(array(
							'condition' => 'is_deleted = 0 AND created_by = :user_id AND (perihal LIKE "%'.$search_keyword.'%" OR nrp LIKE "%'.$search_keyword.'%" OR nama LIKE "%'.$search_keyword.'%" OR universitas LIKE "%'.$search_keyword.'%" OR status LIKE "%'.$search_keyword.'%") ORDER BY updated_on DESC', 
							'params'	=> array(':user_id' => $this->user_id)
						));
					} else {
						$model = Permohonan::model()->findAll(array(
							'condition' => 'is_deleted = 0 AND created_by = :user_id ORDER BY updated_on DESC', 
							'params'	=> array(':user_id' => $this->user_id)
						));
					}
					

					
					if($model != NULL) {
						foreach($model as $d) {
							$form_model = Form::model()->findByPk($d->form_id);
							$jenis_peminjaman = '';

							if($d->jenis_peminjaman_id > 0) {
								$jenis_peminjaman_model = JenisPeminjaman::model()->findByPk($d->jenis_peminjaman_id);
								$jenis_peminjaman = $jenis_peminjaman_model->jenis_peminjaman;
							}

							$user_created = User::model()->findByPk($d->created_by);
							$user_updated = User::model()->findByPk($d->updated_by);

							$response_by = '-';

							if($d->response_by != '' && $d->response_by > 0) {
								$$user_response = User::model()->findByPk($d->response_by);
								$response_by = $user_response->fullname;
							}
							
							$data[] = array(
								'permohonan_id' => $d->permohonan_id,
								'form'			=> $form_model->form,
								'jenis_peminjaman' => $jenis_peminjaman,
								'perihal'		=> $d->perihal,
								'nrp'		=> $d->nrp,
								'nama'		=> $d->nama,
								'universitas'	=> $d->universitas,
								'keterangan'	=> $d->keterangan,
								'date_start'	=> date('d M Y', strtotime($d->date_start)),
								'date_end'		=> date('d M Y', strtotime($d->date_end)),
								'status'		=> ucwords(strtolower($d->status)),
								'is_open_for_notif'		=> $d->is_open_for_notif,
								'response_by'	=> $response_by,
								'alasan'		=> $d->alasan,
								'created_on'	=> date('d M Y', strtotime($d->created_on)),
								'created_by'	=> $user_created->fullname,
								'updated_on'	=> date('d M Y', strtotime($d->updated_on)),
								'updated_by'	=> $user_updated->fullname,
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

		public function getnumberofnotif() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$model = Permohonan::model()->findAll(array(
						'condition' => 'is_deleted = 0 AND is_open_for_notif = 0 AND created_by = :user_id ORDER BY updated_on DESC', 
						'params'	=> array(':user_id' => $this->user_id)
					));
					
					$ctr = 0;
					if($model != NULL) {
						$ctr = count($model);
					}

					$result = array(
						'status'	=> 200,
						'data'		=> $ctr,
					);

					$this->renderJSON($result);
				} else {
					$this->renderErrorMessage(405, 'MethodNotAllowed');
				}
			} else {
				$this->renderInvalidUserToken();
			}
		}

		public function getdetailpermohonan() {
			if($this->valid_user_token) {
				if($this->request_type == 'GET') {
					$permohonan_id = isset($this->params['permohonan_id']) ? $this->params['permohonan_id'] : 0;
					$data = array();

					$model = Permohonan::model()->findByPk($permohonan_id);		
					if($model != NULL) {
						$form_model = Form::model()->findByPk($model->form_id);
						$jenis_peminjaman = '';

						if($model->jenis_peminjaman_id > 0) {
							$jenis_peminjaman_model = JenisPeminjaman::model()->findByPk($model->jenis_peminjaman_id);
							$jenis_peminjaman = $jenis_peminjaman_model->jenis_peminjaman;
						}

						$user_created = User::model()->findByPk($model->created_by);
						$user_updated = User::model()->findByPk($model->updated_by);

						$response_by = '-';

						if($model->response_by != '' && $model->response_by > 0) {
							$$user_response = User::model()->findByPk($model->response_by);
							$response_by = $user_response->fullname;
						}
						
						$data[] = array(
							'permohonan_id' => $model->permohonan_id,
							'form'			=> $form_model->form,
							'jenis_peminjaman' => $jenis_peminjaman,
							'perihal'		=> $model->perihal,
							'nrp'		=> $model->nrp,
							'nama'		=> $model->nama,
							'universitas'	=> $model->universitas,
							'keterangan'	=> $model->keterangan,
							'date_start'	=> date('d M Y', strtotime($model->date_start)),
							'date_end'		=> date('d M Y', strtotime($model->date_end)),
							'status'		=> ucwords(strtolower($model->status)),
							'is_open_for_notif'		=> $model->is_open_for_notif,
							'response_by'	=> $response_by,
							'alasan'		=> $model->alasan,
							'created_on'	=> date('d M Y', strtotime($model->created_on)),
							'created_by'	=> $user_created->fullname,
							'updated_on'	=> date('d M Y', strtotime($model->updated_on)),
							'updated_by'	=> $user_updated->fullname,
						);
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

		public function updatestatus() {
			if($this->request_type == 'POST') {
				if($this->valid_user_token) {
					$permohonan_id = isset($this->params['permohonan_id']) ? $this->params['permohonan_id'] : 0;
					$status = isset($this->params['status']) ? $this->params['status'] : 'draft';
					$model = Permohonan::model()->findByPk($permohonan_id);

					if($model != NULL) {
 						$model->status = $status;
 						if($model->save()) {
							$result = array(
								'status' => 200,
							);

							$this->renderJSON($result);
						} else {
							$this->renderErrorMessage(400, 'InvalidResource', array('error' => $this->parseErrorMessage($model->errors)));
						}
					} else {
						$this->renderErrorMessage(403, 'UpdateStatus', array(
							'error' => $this->parseErrorMessage(array('DataPermohonan' => 'Data tidak ditemukan'))
						));
					}

				} else {
					$this->renderInvalidUserToken();
				}
			} else {
				$this->renderErrorMessage(405, 'MethodNotAllowed');
			}
		}
		
	}