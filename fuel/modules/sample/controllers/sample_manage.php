<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Sample_manage extends Fuel_base_controller { 

	public $view_location = 'sample';
	public $nav_selected = 'sample/manage';
	public $module_name = 'sample';
	public $module_uri = 'fuel/sample/lists'; 

	function __construct()
	{
		parent::__construct();
		$this->_validate_user('sample');
		$this->load->module_model(SAMPLE_FOLDER, 'sample_manage_model');
		$this->load->module_model(CODEKIND_FOLDER, 'codekind_manage_model');
		$this->load->module_model(CHAPTER_FOLDER, 'chapter_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('session');	
		$this->load->library('comm');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url();
		//查詢條件資料
		$industry = $this->codekind_manage_model->get_code_list_for_other_mod("INDUSTRY",false);  
		$vars['industry'] = $industry;  
		//查詢條件處理
		$search_cps_kind = $this->input->get_post('search_cps_kind');    
		$search_cp_key = $this->input->get_post('search_cp_key'); 
		$search_title = $this->input->get_post('search_title'); 
		$filter = " WHERE 1=1 "; 
		if ("ALL" != $search_cps_kind) {
			$filter .= $this->set_session('a.cps_kind',$search_cps_kind);
		} 
		$filter .= $this->set_session('c.cp_key',$search_cp_key,'like'); 
		$filter .= $this->set_session('a.title',$search_title,'like'); 
		$vars['search_cps_kind'] = $search_cps_kind; 
		$vars['search_cp_key'] = $search_cp_key;  
		$vars['search_title'] = $search_title; 
		//列表基本設定
		$target_url = $base_url.'fuel/'.$this->module_name.'/lists/'; 
		$total_rows = $this->sample_manage_model->get_count($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config);  
		$results = $this->sample_manage_model->get_list($dataStart, $dataLen,$filter);  
		$vars['total_rows'] = $total_rows; 
		$vars['form_action'] = $base_url.'fuel/'.$this->module_name.'/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs); 
		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/'.$this->module_name.'/create';
		$vars['edit_url'] = $base_url.'fuel/'.$this->module_name.'/edit/';
		$vars['del_url'] = $base_url.'fuel/'.$this->module_name.'/del/';
		$vars['multi_del_url'] = $base_url.'fuel/'.$this->module_name.'/do_multi_del';
		$vars['results'] = $results;
		$vars['total_rows'] = $total_rows; 
		$vars['CI'] = & get_instance(); 
		$this->fuel->admin->render('_admin/'.$this->module_name.'_lists_view', $vars); 
	}

 
	function create()
	{
		//
		$cp_key = $this->input->get_post("cp_key");
		$cp_id = $this->input->get_post("cp_id");
		$vars['cp_key'] = $cp_key;
		$vars['cp_id'] = $cp_id;
		//新增頁面資料
		$industry = $this->codekind_manage_model->get_code_list_for_other_mod("INDUSTRY");
		$vars['industry'] = $industry;
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
		//上傳檔案處理
		$root_path = assets_server_path('sample_img/'.$post_arr['cps_kind']."/".$post_arr['cp_key']."/");
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
			$post_arr["file_name"] = 'sample_img/'.$post_arr['cps_kind']."/".$post_arr['cp_key']."/".$data["upload_data"]["file_name"]; 		 
		} else{ 
			 $post_arr["file_name"] = '';				 
		} 
		//新增動作處理
		$success = $this->sample_manage_model->insert($post_arr); 
		if($success)
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

	 
	function edit($id)
	{ 
		//撈取單比資料
		$record;
		if(isset($id))
		{
			$record = $this->sample_manage_model->get_record($id);
		} 
		//判斷單比資料是否存在
		if(!isset($id) || !isset($record))
		{
			$this->comm->plu_redirect(base_url().'fuel/'.$this->module_name.'/lists', 0, "找不到資料");
			die;
		}
		//編輯頁面資料
		$industry = $this->codekind_manage_model->get_code_list_for_other_mod("INDUSTRY");
		$vars['industry'] = $industry;
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
		$module_uri = base_url().$this->module_uri;
		//頁面POST資料
		$post_arr = $this->input->post();
		$post_arr['content'] = htmlspecialchars($this->input->get_post("content"));
		//上傳檔案處理
		$root_path = assets_server_path('chapter_img/'.$post_arr['cps_kind']."/".$post_arr['cp_key']."/");
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
			$post_arr["file_name"] = 'chapter_img/'.$post_arr['cps_kind']."/".$post_arr['cp_key']."/".$data["upload_data"]["file_name"]; 		 
		} else{ 
			$post_arr["file_name"] = $post_arr["exist_file_name"];				 
		} 
		//PK處理
		$post_arr["id"] = $id;
		//編輯處理
		$success = $this->sample_manage_model->update($post_arr); 
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

	function do_multi_del(){
		$result = array();
		$ids = $this->input->get_post("ids");
		if($ids)
		{
			$im_ids = implode(",", $ids);
			$success = $this->sample_manage_model->do_multi_del($im_ids);
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
			$success = $this->sample_manage_model->del($id);
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
				$this->session->set_userdata($key, $value);
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