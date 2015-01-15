<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Cpinput_manage extends Fuel_base_controller { 

	public $view_location = 'cpinput';
	public $nav_selected = 'cpinput/manage';
	public $module_name = 'cpinput';
	public $module_uri = 'fuel/cpinput/lists'; 

	function __construct()
	{
		parent::__construct();
		 $this->_validate_user('cpinput/manage');
		$this->load->module_model(CPINPUT_FOLDER, 'cpinput_manage_model');
		$this->load->module_model(CODEKIND_FOLDER, 'codekind_manage_model');
		$this->load->module_model(CHAPTER_FOLDER, 'chapter_manage_model');
		$this->load->module_model(FUEL_FOLDER, 'fuel_users_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('session');	
		$this->load->library('comm');
	}
	
	function lists($dataStart=0)
	{ 
		$base_url = base_url(); 
		//查詢條件處理  
		$user_info = $this->fuel_users_model->get_login_user_info(); 
		$is_verify_admin = $user_info['verify_admin'];
		$company = $user_info['company'];
		$user_name = $user_info['user_name'];
		$filter = " WHERE 1=1  "; 	
		if ($is_verify_admin == 'YES') {
			$filter .= " AND author COLLATE utf8_unicode_ci IN (SELECT user_name FROM fuel_users WHERE company = '$company'  ) ";
		}else{
			$filter .= " AND author = '$user_name' ";
		}
		$search_cp_key = $this->input->get_post('search_cp_key'); 
		$search_title = $this->input->get_post('search_title'); 
			 
		$filter .= $this->set_session('a.title',$search_title,'like'); 
		$vars['search_cp_key'] = $search_cp_key;  
		$vars['search_title'] = $search_title; 
		// print_r($filter);
		// die;
		//列表基本設定
		$target_url = $base_url.'fuel/parse/lists/'; 
		$total_rows = $this->cpinput_manage_model->get_count($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);  
		$results = $this->cpinput_manage_model->get_list($dataStart, $dataLen,$filter);  
		$vars['total_rows'] = $total_rows; 
		$vars['form_action'] = $base_url.'fuel/'.$this->module_name.'/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs); 
		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/cpinput/create';
		$vars['edit_url'] = $base_url.'fuel/cpinput/edit/';
		$vars['del_url'] = $base_url.'fuel/cpinput/del/';
		$vars['detail_url'] = $base_url.'fuel/cpinput/detail/';
		$vars['verify_url'] = $base_url.'fuel/cpinput/verify/';		
		$vars['multi_del_url'] = $base_url.'fuel/parse/do_multi_del';
		$vars['results'] = $results;
		$vars['is_verify_admin'] = $is_verify_admin;
		$vars['total_rows'] = $total_rows; 
		$vars['CI'] = & get_instance(); 
		$this->fuel->admin->render('_admin/'.$this->module_name.'_lists_view', $vars); 
	}

 
	function create()
	{
		$cp_key = $this->input->get_post("cp_key");
		$cp_id = $this->input->get_post("cp_id"); 
		$vars['cp_key'] = $cp_key;
		$vars['cp_id'] = $cp_id; 
		//新增頁面資料
		$chapter = $this->chapter_manage_model->get_chapter_list("");
		$vars['chapter'] = $chapter;
		//新增頁基本設定
		$vars['form_action'] = base_url().'fuel/'.$this->module_name.'/do_create';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);		 
		$vars['module_uri'] = base_url().$this->module_uri;
		$vars['view_name'] = "新增"; 
		$this->fuel->admin->render('_admin/'.$this->module_name.'_create_view', $vars);
	}

	function do_create()
	{ 
		$module_uri = base_url().$this->module_uri;  
		//頁面POST資料
		$post_arr = $this->input->post();
		$post_arr['content'] = htmlspecialchars($this->input->get_post("content")); 
		$user_info = $this->fuel_users_model->get_login_user_info(); 
		$post_arr['author'] = $user_info['user_name'];
		$post_arr['input_key'] = $user_info['company'].'_'.$post_arr['cp_id']; 
		//上傳檔案處理
		$root_path = assets_server_path('cpinput/'.$post_arr['cp_key']."/");
		if (!file_exists($root_path)) {
		    mkdir($root_path, 0777, true);
		} 
		$config['upload_path'] = $root_path;
		$config['allowed_types'] = '*';
		$config['max_size']	= '9999';
		$config['max_width']  = '1024';
		$config['max_height']  = '768'; 
		$this->load->library('upload',$config);  
        if ($this->upload->do_upload('file_name'))
		{
			$data = array('upload_data'=>$this->upload->data()); 
			$post_arr["file_name"] = 'cpinput/'.$post_arr['cp_key']."/".$data["upload_data"]["file_name"]; 		 
		} else{ 
			$post_arr["file_name"] = '';				 
		} 
		//新增動作處理
		$ID = $this->cpinput_manage_model->insert($post_arr);  
		if($ID>0)
		{
			$this->comm->plu_redirect($module_uri, 0, "新增成功");
			die();
		}
		else
		{
			$this->comm->plu_redirect($module_uri, 0, "新增失敗");
			die();
		}
		return;
	}

	function detail($id)
	{ 
		//撈取單比資料
		$record;
		if(isset($id))
		{
			$record = $this->cpinput_manage_model->get_record($id);
		} 
		//判斷單比資料是否存在
		if(!isset($id) || !isset($record))
		{
			$this->comm->plu_redirect(base_url().'fuel/'.$this->module_name.'/lists', 0, "找不到資料");
			die;
		}
		//編輯頁面資料
		$chapter = $this->chapter_manage_model->get_chapter_list("");
		$vars['chapter'] = $chapter;
	 	//編輯頁基本設定 
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	  
	    $vars['record'] = $record; 
		$vars['module_uri'] = base_url().$this->module_uri; 
		$vars["view_name"] = "審核";
		$this->fuel->admin->render('_admin/'.$this->module_name.'_detail_view', $vars);
	}

	function verify($id)
	{ 
		//撈取單比資料
		$record;
		if(isset($id))
		{
			$record = $this->cpinput_manage_model->get_record($id);
		} 
		//判斷單比資料是否存在
		if(!isset($id) || !isset($record))
		{
			$this->comm->plu_redirect(base_url().'fuel/'.$this->module_name.'/lists', 0, "找不到資料");
			die;
		}
		//編輯頁面資料
		$chapter = $this->chapter_manage_model->get_chapter_list("");
		$vars['chapter'] = $chapter;
	 	//編輯頁基本設定
		$vars['form_action'] = base_url().'fuel/'.$this->module_name."/do_verify/$id";
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	  
	    $vars['record'] = $record; 
		$vars['module_uri'] = base_url().$this->module_uri; 
		$vars["view_name"] = "審核";
		$this->fuel->admin->render('_admin/'.$this->module_name.'_verify_view', $vars);
	}

	 
	function edit($id)
	{ 
		//撈取單比資料
		$record;
		if(isset($id))
		{
			$record = $this->cpinput_manage_model->get_record($id);
		} 
		//判斷單比資料是否存在
		if(!isset($id) || !isset($record))
		{
			$this->comm->plu_redirect(base_url().'fuel/'.$this->module_name.'/lists', 0, "找不到資料");
			die;
		}
		//判斷單比資料是否已經審核
		if(isset($record->verify_by) && !empty($record->verify_by))
		{
			$this->comm->plu_redirect(base_url().'fuel/'.$this->module_name.'/lists', 0, "此筆資料已經審核，不得修改");
			die;
		}
		//編輯頁面資料
		$chapter = $this->chapter_manage_model->get_chapter_list("");
		$vars['chapter'] = $chapter;
	 	//編輯頁基本設定
		$vars['form_action'] = base_url().'fuel/'.$this->module_name."/do_edit/$id";
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	  
	    $vars['record'] = $record; 
		$vars['module_uri'] = base_url().$this->module_uri; 
		$vars["view_name"] = "修改";
		$this->fuel->admin->render('_admin/'.$this->module_name.'_edit_view', $vars);
	}

	function do_edit($id)
	{ 
		$module_uri = base_url().'fuel/cpinput/edit/'.$id; 
		//頁面POST資料
		$post_arr = $this->input->post();
		$post_arr['content'] = htmlspecialchars($this->input->get_post("content")); 
		$user_info = $this->fuel_users_model->get_login_user_info(); 
		$post_arr['author'] = $user_info['user_name'];
		$post_arr['input_key'] = $user_info['company'].'_'.$post_arr['cp_id']; 
		//上傳檔案處理
		$root_path = assets_server_path('cpinput/'.$post_arr['cp_key']."/");
		if (!file_exists($root_path)) {
		    mkdir($root_path, 0777, true);
		} 
		$config['upload_path'] = $root_path;
		$config['allowed_types'] = '*';
		$config['max_size']	= '9999';
		$config['max_width']  = '1024';
		$config['max_height']  = '768'; 
		$this->load->library('upload',$config);  
        if ($this->upload->do_upload('file_name'))
		{
			$data = array('upload_data'=>$this->upload->data()); 
			$post_arr["file_name"] = 'cpinput/'.$post_arr['cp_key']."/".$data["upload_data"]["file_name"]; 		 	 
		} else{ 
			$post_arr["file_name"] = $post_arr["exist_file_name"];				 
		} 
		//PK處理
		$post_arr["id"] = $id;
		//編輯處理
		$success = $this->cpinput_manage_model->update($post_arr); 
		if($success)
		{
			$this->comm->plu_redirect($module_uri, 0, "更新成功");
			die();
		}
		else
		{
			$this->comm->plu_redirect($module_uri, 0, "更新失敗");
			die();
		}
		return;
	} 

	function do_verify($id)
	{ 
		$module_uri = base_url().'fuel/cpinput/detail/'.$id; 
		//頁面POST資料
		$post_arr = array();		 
		$user_info = $this->fuel_users_model->get_login_user_info(); 
		$post_arr['verify_by'] = $user_info['user_name']; 
		//PK處理
		$post_arr["id"] = $id;
		//編輯處理
		$success = $this->cpinput_manage_model->verify($post_arr); 
		if($success)
		{
			$this->comm->plu_redirect($module_uri, 0, "審核成功");
			die();
		}
		else
		{
			$this->comm->plu_redirect($module_uri, 0, "審核失敗");
			die();
		}
		return;
	} 

	// function get_chapter(){ 
	// 	$result = $this->chapter_manage_model->get_chapter_list(""); 
	// 	echo json_encode($result);
	// 	die;
	// 	if(is_ajax())
	// 	{
	// 		echo json_encode($result);
	// 	}
	// } 

	function do_multi_del(){
		$result = array();
		$ids = $this->input->get_post("ids");
		if($ids)
		{
			$im_ids = implode(",", $ids);
			$success = $this->chapter_manage_model->do_multi_del($im_ids);
		}
		else
		{
			$success = false;
		}
		if(isset($success))
		{
			$result['status'] = 1;
		}
		else
		{
			$result['status'] = $ids;
		}
		if(is_ajax())
		{
			echo json_encode($result);
		}
	} 

	function do_del($id)
	{
		$response = array();
		if(!empty($id))
		{
			$success = $this->chapter_manage_model->del($id);
			if($success)
			{
				$response['status'] = 1;
			}
			else
			{
				$response['status'] = -1;
			}
		}
		else
		{
			$response['status'] = -1;
		}
		echo json_encode($response);
	}

	public function set_session($key, $value, $op="=")
	{ 
		$filter = "";
	    if ($value != "") {
	    	if ($op=="like") {
	    		$filter = " AND $key like '%$value%' ";
	    	}else 
	    	{
	    		$filter = " AND $key = '$value' ";
				$this->session->set_userdata($key, $value);
			}
		}else{
			// if (!isset($$value) ) {
			// 	$value = $this->session->userdata($key); 
			// 	if ($value != "") {
			// 		$value = $value;
			// 		$filter = " AND $key = '$value'";
			// 	} 
			// }else{
				$this->session->set_userdata($key, "");
			// }				
		}
		return $filter;
	}

}