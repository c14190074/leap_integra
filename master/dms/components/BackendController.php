<?php
	class BackendController extends Controller {
		public $toolbarElement;
		public $basicParams = array('module', 'action', 'ajax', 'pageIndex', 'pageSize', 'sortField', 'sortOrder');

		public function init() {
			$current_module = isset($_GET['module']) ? $_GET['module'] : '';
			$current_action = isset($_GET['action']) ? $_GET['action'] : '';
		    if(!Snl::app()->isAdmin()) {
		    	if($current_module == 'user' && $current_action == 'verify') {
		    		
		    	} else {
		    		$this->redirect('admin/user/login');
		    	}
		    	
		    }
		}

		public function toolbar() {
	    	return $this->render('themes/backend/views/layouts/toolbar.php', array(
	    		'page_title' => $this->page_title,
	    		'crumbs'	 => $this->crumbs,
	    		'toolbarElement' => $this->toolbarElement,
	    	), TRUE);
	    }

	    public function parseSearchQuery($model, $gets) {
	    	$search_query = '';
	    	foreach ($gets as $key => $value) {
				if($value != '' && in_array($key, $model->getTableFields())) {
					$search_query .= $key . ' LIKE "%'.$value.'%" AND ';
				}
			}

			return rtrim($search_query, ' AND ');
	    }
	}