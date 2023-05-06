<?php
	class Permohonan extends SnlActiveRecord {
		public $permohonan_id, $form_id, $jenis_peminjaman_id, $pdf_filename, $perihal, $nrp, $nama, $universitas, $keterangan, $date_start, $date_end, $status, $is_open_for_notif, $response_by, $alasan, $created_on, $created_by, $updated_on, $updated_by, $is_deleted;
		

		public function __construct() {
		    $this->classname = 'Permohonan';
			$this->table_name = 'tbl_permohonan';
			$this->primary_key = 'permohonan_id';
		}

		public function rules() {
			return array(
				'required'	=> array('permohonan'),
				// 'unique'	=> array('email'),
				// 'repeat'	=> array('password'),
				// 'email'		=> array('email')
				// 'integer'	=> array('status')
			);
		}

		public static function model() {
			$model = new Permohonan();
			return $model;
		}

		public function getLabel($field, $with_rule = FALSE) {
			$labels = array(
				'permohonan_id' => 'Permohonan ID',
				'form_id' => 'Form',
				'jenis_peminjaman_id' => 'Jenis Peminjaman',
				'perihal' => 'Perihal',
				'nrp' => 'NRP',
				'nama' => 'Nama',
				'universitas' => 'Universitas',
				'keterangan' => 'Keterangan',
				'date_start' => 'Tanggal Mulai',
				'date_end' => 'Tanggal Berakhir',
				'status' => 'Status',
				'response_by' => 'Response By',
				'alasan' => 'Alasan',
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
				$this->updated_on = Snl::app()->dateNow();

				if(isset(Snl::app()->user()->user_id)) {
					$this->created_by = Snl::app()->user()->user_id;
					$this->updated_by = Snl::app()->user()->user_id;
				}
			} else {
				$this->updated_on = Snl::app()->dateNow();
				if(isset(Snl::app()->user()->user_id)) {
					$this->updated_by = Snl::app()->user()->user_id;
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
	}