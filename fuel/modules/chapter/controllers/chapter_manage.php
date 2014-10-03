<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Chapter_manage extends Fuel_base_controller {
	public $view_location = 'chapter';
	public $nav_selected = 'chapter/manage';
	public $module_name = 'chapter manage';
	public $module_uri = 'fuel/chapter/lists';
	function __construct()
	{
		parent::__construct();
		$this->_validate_user('chapter');
		$this->load->module_model(CHAPTER_FOLDER, 'chapter_manage_model');
		$this->load->module_model(CODEKIND_FOLDER, 'codekind_manage_model');
		$this->load->helper('ajax');
		$this->load->library('pagination');
		$this->load->library('set_page');
		$this->load->library('session');	
		$this->load->library('comm');
	}
	
	function lists($dataStart=0)
	{
		$base_url = base_url();

		$search_type = $this->input->get_post('search_type'); 
		$search_lang = $this->input->get_post('search_lang'); 
		
		$filter = " WHERE 1=1  "; 

		if (!empty($search_type)) {
			$filter .= " AND type = '$search_type'"; 
			$this->session->set_userdata('search_type', $search_type);
		}else {
			$search_type = $this->session->userdata('search_type'); 
			$filter .= " AND type = '$search_type'";
		} 

		if (!empty($search_lang)) {
			$filter .= " AND lang = '$search_lang'"; 
			$this->session->set_userdata('search_lang', $search_lang);
		}else {
			$search_lang = $this->session->userdata('search_lang'); 
			$filter .= " AND lang = '$search_lang'";
		} 

		// print_r($filter);

		$target_url = $base_url.'fuel/news/lists/';

		$total_rows = $this->news_manage_model->get_total_rows($filter);
		$config = $this->set_page->set_config($target_url, $total_rows, $dataStart, 20);
		$dataLen = $config['per_page'];
		$this->pagination->initialize($config); 

		$results = $this->news_manage_model->get_news_list($dataStart, $dataLen,$filter);

		$type = $this->codekind_manage_model->get_code_list_for_other_mod("NEWSTYPE");
		$lang = $this->codekind_manage_model->get_code_list_for_other_mod("LANG_CODE");

		$vars['lang'] = $lang;
		$vars['type'] = $type;
		$vars['search_type'] = $search_type;
		$vars['search_lang'] = $search_lang;
		$vars['total_rows'] = $total_rows; 
		$vars['form_action'] = $base_url.'fuel/news/lists';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);

		$vars['page_jump'] = $this->pagination->create_links();
		$vars['create_url'] = $base_url.'fuel/news/create';
		$vars['edit_url'] = $base_url.'fuel/news/edit/';
		$vars['del_url'] = $base_url.'fuel/news/del/';
		$vars['multi_del_url'] = $base_url.'fuel/news/do_multi_del';
		$vars['results'] = $results;
		$vars['total_rows'] = $total_rows; 
		$vars['CI'] = & get_instance();

		$this->fuel->admin->render('_admin/news_lists_view', $vars);

	}

 
	function create()
	{
		$vars['form_action'] = base_url().'fuel/news/do_create';
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);		

		$vars['module_uri'] = base_url().$this->module_uri;
		$vars['view_name'] = "新增";

		$type = $this->codekind_manage_model->get_code_list_for_other_mod("NEWSTYPE");
		$vars['type'] = $type;

		$lang = $this->codekind_manage_model->get_code_list_for_other_mod("LANG_CODE");
		$vars['lang'] = $lang;
 

		$this->fuel->admin->render("_admin/news_create_view", $vars);
	}

	function do_create()
	{
		$post_arr = $this->input->post();
		$root_path = assets_server_path('news_img/'.$post_arr['type']."/".$post_arr['lang']."/");
		if (!file_exists($root_path)) {
		    mkdir($root_path, 0777, true);
		}
		 
		$module_uri = base_url().$this->module_uri;
		 
		$post_arr = $this->input->post();
		$config['upload_path'] = $root_path;
		$config['allowed_types'] = 'png';
		$config['max_size']	= '9999';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload',$config); 

	 	// $name = 'news_img/'.$post_arr['type']."/".$post_arr['title'].".png"; 

        if ($this->upload->do_upload('img'))
		{
			$data = array('upload_data'=>$this->upload->data()); 
			$post_arr["img"] = 'news_img/'.$post_arr['type']."/".$post_arr['lang']."/".$data["upload_data"]["file_name"];
			
		 
		} else{ 
			 $post_arr["img"] = '';				 
		} 
		$success = $this->news_manage_model->insert($post_arr);
			// $success = true;
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
		$news;
		if(isset($id))
		{
			$news = $this->news_manage_model->get_news_detail($id);
		} 

		if(!isset($id) || !isset($news))
		{
			$this->comm->plu_redirect(base_url().'fuel/news/lists', 0, "找不到資料");
			die;
		}

	 
		$vars['form_action'] = base_url()."fuel/news/do_edit/$id";
		$vars['form_method'] = 'POST';
		$crumbs = array($this->module_uri => $this->module_name);
		$this->fuel->admin->set_titlebar($crumbs);	

		$type = $this->codekind_manage_model->get_code_list_for_other_mod("NEWSTYPE");
		$vars['type'] = $type; 

		$lang = $this->codekind_manage_model->get_code_list_for_other_mod("LANG_CODE");
		$vars['lang'] = $lang;

	    $vars['news'] = $news; 
		$vars['module_uri'] = base_url().$this->module_uri;
	 
		$vars["view_name"] = "修改";
		$this->fuel->admin->render('_admin/news_edit_view', $vars);
	}

	function do_edit($id)
	{ 
		$module_uri = base_url().$this->module_uri;
		$post_arr = $this->input->post();
		$root_path = assets_server_path('news_img/'.$post_arr['type']."/".$post_arr['lang']."/");
		if (!file_exists($root_path)) {
		    mkdir($root_path, 0777, true);
		} 
		 
		$post_arr = $this->input->post();
		$config['upload_path'] = $root_path;
		$config['allowed_types'] = 'png';
		$config['max_size']	= '9999';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload',$config); 

	 	// $name = 'news_img/'.$post_arr['type']."/".$post_arr['title'].".png"; 

        if ($this->upload->do_upload('img'))
		{
			$data = array('upload_data'=>$this->upload->data()); 
			$post_arr["img"] = 'news_img/'.$post_arr['type']."/".$post_arr['lang']."/".$data["upload_data"]["file_name"];
		 
		} else{ 
			$post_arr["img"] = $post_arr["exist_img"];				 
		} 

		$post_arr["id"] = $id;
		$success = $this->news_manage_model->update($post_arr); 

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
			// $result['im_ids'] = $im_ids;

			$success = $this->news_manage_model->do_multi_del($im_ids);
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
			$success = $this->news_manage_model->del($id);

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

	 

}