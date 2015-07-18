<?php
class Question extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
		$this->load->model('core_model');
		$this->load->helper('url');
	}


	function index()
	{	
		$lang_code = $this->uri->segment(1);

		$index_list = $this->core_model->get_cate_list();
		// echo "<pre>"; 
		// print_r($index_list);
		// exit;
		$vars['index_list'] = $index_list;
		$vars['views'] = 'gri';
		$vars['base_url'] = base_url();

		$this->fuel->pages->render("gri",$vars);

	}

	function GriForm()
	{
		$lang_code = $this->uri->segment(1);

		$vars['views'] = 'GriForm';
		$vars['base_url'] = base_url();

		$this->fuel->pages->render("GriForm",$vars);
	}

	function ShowGriForm($fc_id)
	{
		$lang_code = $this->uri->segment(1); 

		$forms = $this->core_model->get_forms_json_by_fc_id($fc_id); 
		// print_r($forms);
		// die;

		$result = array();

		foreach ($forms as $f ) { 
			array_push($result, json_decode($f->form_json));
		}
 

		$vars['views'] = 'ShowGriForm';
		$vars['base_url'] = base_url();
		$vars['result'] = json_encode($result);

		// $vars['form'] = $form;
		// $vars['element'] = $element;
		// $vars['col'] = json_encode($col);
		// $vars['row'] = json_encode($row);
		// $vars['val'] = json_encode($val);

		$this->fuel->pages->render("GriForm",$vars);
	}

	function do_form_design_save(){
		// if(is_ajax())
		if(true)
		{  
			$post_arr = $this->input->post();
			$get_arr = $this->input->get();
			$cp_id = isset($get_arr['cp_id'])?$get_arr['cp_id']:-1;
			$fc_id = isset($get_arr['fc_id'])?$get_arr['fc_id']:-1;
			// $cp_id = 1;
			// $fc_id = 1;
			$cps_kind = 2;
			$user = 'bowen';

			if ($fc_id == -1 || !$this->core_model->check_fc_id_exists($fc_id)) {
				$fc_id = $this->core_model->create_form_collection($cp_id,$cps_kind,$user);
			}else{
				$this->core_model->delete_form_by_fc_id($fc_id);
			}
			
			foreach ($post_arr['data'] as $form) {
				$this->core_model->create_form($fc_id,$form["QT"],$form["HT"],$user,json_encode($form));				 
			}
			$result['status'] = 1; 
			$result['fc_id'] = $fc_id; 
			echo json_encode($result);
		}
		else
		{
			// redirect(site_url(), 'refresh');
			$result['status'] = -1;
			$result['msg'] = "發生錯誤,請再試一次";
			echo json_encode($result);
		}
		die();
	}

	function get_chapter(){
		// if(is_ajax())
		if(true)
		{  
			//cps_kind
			//資訊業 2
			//化工業 73
			//食品業 72
			//金融業 74

			$cps_kind = 2;//先寫死

			$get_arr = $this->input->get();
			$code_id = -1;
			$parent_id = -2;
			$cp_id = -1;
			$level = $get_arr['Level'];

			if (array_key_exists('code_id',$get_arr)) {
				$code_id = $get_arr['code_id'];
			}
			if (array_key_exists('parent_id',$get_arr)) {
				$parent_id = $get_arr['parent_id'];
			}
			if (array_key_exists('cp_id',$get_arr)) {
				$cp_id = $get_arr['cp_id'];
			}

			$chapter_result = array();

			// print_r($code_id);
			// echo '<br/>';
			// print_r($parent_id);
			// echo '<br/>';
			// print_r($cp_id);
			// echo '<br/>';
			// array_push($row, $r);

			if ($cp_id <> -1) {
				$chapter = $this->core_model->get_chapter_detail($cp_id);
				foreach ($chapter as $key) {
					$fc_id = $this->core_model->get_fc_id($cp_id,$cps_kind);
					array_push($chapter_result, $this->formatGriObj($key,$cps_kind,$fc_id ));
				}				
			}else if ($parent_id == -1) {
				$code_array = $this->core_model->get_series_sub_detail($code_id);
				foreach ($code_array as $key) {
					$chapter = $this->core_model->get_chapter_list_by_kind($key->code_id);
					foreach ($chapter as $key2) {
						$fc_id = $this->core_model->get_fc_id($key2->id,$cps_kind);
						array_push($chapter_result, $this->formatGriObj($key2,$cps_kind,$fc_id ));
					}
				}
			}else if ($code_id <> -1) {
				$code_array = array();
				if ($level == 1) {
					$ary = $this->core_model->get_series_sub_detail($code_id);
					foreach ($ary as $key) {
						$fc_id = $this->core_model->get_fc_id($key->id,$cps_kind);
						array_push($code_array, $key->code_id,$fc_id );
					}					
				}else if ($level == 2) {
					$ary = $this->core_model->get_chapter_list_by_kind($code_id);
					// foreach ($ary as $key) {
					// 	array_push($code_array, $key->code_id);
					// }
					foreach ($ary as $key) {
						// $c->desc = htmlspecialchars_decode($key->description);
						$fc_id = $this->core_model->get_fc_id($key->id,$cps_kind);
						array_push($chapter_result, $this->formatGriObj($key,$cps_kind,$fc_id ));
					}					
				}
				foreach ($code_array as $key) {
					$chapter = $this->core_model->get_chapter_list_by_kind($key);
					foreach ($chapter as $key) {
						// $c->desc = htmlspecialchars_decode($key->description);
						$fc_id = $this->core_model->get_fc_id($key->id,$cps_kind);
						array_push($chapter_result, $this->formatGriObj($key,$cps_kind,$fc_id));
					}
				}
				
			}


			$r = new stdClass();
			$r->data = $chapter_result;
			// $r->fc_id = $fc_id;

			// $user = 'bowen';
			// $fs_id = $this->core_model->create_form_collection($cp_id,$cps_kind,$user);
			// foreach ($post_arr['data'] as $form) {
			// 	$this->core_model->create_form2($fs_id,$form["QT"],$form["HT"],$user,json_encode($form));				 
			// }
			// $result['status'] = 1; 
			// $result['result'] = json_encode($r); 
			echo json_encode($r); 
		}
		else
		{
			// redirect(site_url(), 'refresh');
			$result['status'] = -1;
			$result['msg'] = "發生錯誤,請再試一次";
			echo json_encode($result);
		}
		die();
	}

	function formatGriObj($row,$cps_kind,$fc_id=-1){
		$c = new stdClass();
		$c->cp_id = $row->id;
		$c->Title = $row->title."<br />
        <ul class='ulMenu list-inline'>
          <li><a href='#' data-toggle='modal' data-target='#myModal'  cp_id='$row->id' cps_kind='$cps_kind' >indicator</a></li>
          <li>|</li>
          <li><a href='#' data-toggle='modal' data-target='#myModal1' cp_id='$row->id' cps_kind='$cps_kind' >implantation</a></li>
          <li>|</li>
          <li><a href='#' data-toggle='modal' data-target='#myModal2' cp_id='$row->id' cps_kind='$cps_kind' >composition</a></li>
          <li>|</li>
          <li><a href='#' data-toggle='modal' data-target='#myModal3' cp_id='$row->id' cps_kind='$cps_kind' fc_id='$fc_id' >design</a></li>
        </ul>";
		$c->Numbers = $row->cp_key;
		$c->Status = '';
		$c->Annotation = '';
		$c->Person = '';
		$c->Modified = '';
		$c->Pages = '';
		return $c;
	}

	function get_content($id,$type){
		// if(is_ajax())
		if(true)
		{  
			$get_arr = $this->input->get();
		 	$content = new stdClass();
		 	
			if ($type == 'indicator') {				
				$result = $this->core_model->get_chapter_detail($id);
				$content->Title = $result[0]->title;
				$content->Desc = htmlspecialchars_decode($result[0]->description);
			}else if ($type == 'implantation') {
				$result = $this->core_model->get_chapter_detail($id);
				$content->Title = $result[0]->title;
				$content->Desc = htmlspecialchars_decode($result[0]->parse);
			}
			else if ($type == 'design') {
				$result = array();
				$fc_id = isset($get_arr['fc_id'])?$get_arr['fc_id']:-1;
				if ($fc_id <> -1) {
					$forms = $this->core_model->get_forms_json_by_fc_id($fc_id); 					
					foreach ($forms as $f ) { 
						array_push($result, json_decode($f->form_json));
					}					
				}		
				$content->data = $result;	
				$content->get_arr = $get_arr;	
			}
		  
			echo json_encode($content); 
		}
		else
		{
			// redirect(site_url(), 'refresh');
			$result['status'] = -1;
			$result['msg'] = "發生錯誤,請再試一次";
			echo json_encode($result);
		}
		die();
	}

	// function do_form_ave(){
	// 	// if(is_ajax())
	// 	if(true)
	// 	{  
	// 		$post_arr = $this->input->post();
	// 		$cp_id = 1;
	// 		$cps_kind = 1;
	// 		$user = 'bowen';
	// 		$fs_id = $this->core_model->create_form_collection($cp_id,$cps_kind,$user);
	// 		foreach ($post_arr['data'] as $form) {
	// 			$this->core_model->create_form2($fs_id,$form["QT"],$form["HT"],$user,json_encode($form));				 
	// 		}
	// 		$result['status'] = 1; 
	// 		echo json_encode($result);
	// 	}
	// 	else
	// 	{
	// 		// redirect(site_url(), 'refresh');
	// 		$result['status'] = -1;
	// 		$result['msg'] = "發生錯誤,請再試一次";
	// 		echo json_encode($result);
	// 	}
	// 	die();
	// }

	function do_user_save(){
		// if(is_ajax())
		if(true)
		{  
			$post_arr = $this->input->post();
			$user = 'bowen';
			$user_id = 1;
			// $fs_id = $this->core_model->create_form_collection($cp_id,$cps_kind,$user);
			// foreach ($post_arr['data'] as $form) {
			// 	$this->core_model->create_form2($fs_id,$form["QT"],$form["HT"],$user,json_encode($form));				 
			// }
			$result['status'] = 1; 
			echo json_encode($result);
		}
		else
		{
			// redirect(site_url(), 'refresh');
			$result['status'] = -1;
			$result['msg'] = "發生錯誤,請再試一次";
			echo json_encode($result);
		}
		die();
	}


	// function ShowGriForm($form_id)
	// {
	// 	$lang_code = $this->uri->segment(1); 

	// 	$form = $this->core_model->get_form($form_id);
	// 	$element = $this->core_model->get_element($form_id);
	// 	$compose = $this->core_model->get_compose($form_id);

	// 	$row = array();
	// 	$col = array();
	// 	// $val = array('2','3');

	// 	foreach ($compose as $key) {
	// 		if ($key->type == 'C') {
	// 			array_push($col, $key->name);
	// 		} 
	// 	}

	// 	foreach ($compose as $key) {
	// 		if ($key->type == 'R') {
	// 			$r = new stdClass();
	// 			$r->Name = $key->name;
	// 			$r->Val = array();
	// 			array_push($row, $r);
	// 		}
	// 	}
	// 	// print_r($form);
	// 	// print_r($element);
	// 	// print_r($row);
	// 	// print_r($col);

	// 	// print_r(json_encode($row));

	// 	$vars['views'] = 'ShowGriForm';
	// 	$vars['base_url'] = base_url();
	// 	$vars['form'] = $form;
	// 	$vars['element'] = $element;
	// 	$vars['col'] = json_encode($col);
	// 	$vars['row'] = json_encode($row);
	// 	// $vars['val'] = json_encode($val);

	// 	$this->fuel->pages->render("GriForm",$vars);
	// }

	// function ShowUserForm($form_id)
	// {
	// 	$lang_code = $this->uri->segment(1); 

	// 	$form = $this->core_model->get_form($form_id);
	// 	$element = $this->core_model->get_element($form_id);
	// 	$compose = $this->core_model->get_compose($form_id);

	// 	$row = array();
	// 	$col = array();
	// 	// $val = array('2','3');

	// 	foreach ($compose as $key) {
	// 		if ($key->type == 'C') {
	// 			array_push($col, $key->name);
	// 		}else if ($key->type == 'R') {
	// 			$r = new stdClass();
	// 			$r->Name = $key->name;
	// 			$r->Val = array();
	// 			array_push($row, $r);
	// 		}
	// 	}
	// 	// print_r($form);
	// 	// print_r($element);
	// 	// print_r($row);
	// 	// print_r($col);

	// 	// print_r(json_encode($row));

	// 	$vars['views'] = 'ShowGriForm';
	// 	$vars['base_url'] = base_url();
	// 	$vars['form'] = $form;
	// 	$vars['element'] = $element;
	// 	$vars['col'] = json_encode($col);
	// 	$vars['row'] = json_encode($row);
	// 	$vars['val'] = json_encode($val);

	// 	$this->fuel->pages->render("GriForm",$vars);
	// }

	// function do_form_ave(){
	// 	// if(is_ajax())
	// 	if(true)
	// 	{  
	// 		$post_arr = $this->input->post();
			
	// 		// foreach ($post_arr['data'] as $key) {
	// 		// 	print_r($key);
	// 		// }
	// 		// die;
	// 		// $this->code_model->insert_mod_contact($post_arr);
	// 		$cp_id = 1;
	// 		$cps_kind = 1;
	// 		$user = 'bowen';

	// 		$fs_id = $this->core_model->create_form_collection($cp_id,$cps_kind,$user);

			

	// 		foreach ($post_arr['data'] as $form) {
	// 			// print_r($form);
	// 			// echo '<br/>';
	// 			// print_r(json_encode($form));
	// 			// echo '<br/>';

	// 			$this->core_model->create_form2($fs_id,$form["QT"],$form["HT"],$user,json_encode($form));
	// 			// $form_id = $this->core_model->create_form($fs_id,$form["QT"],$form["HT"],$user,1);
	// 			// if ($form['FormType'] == 'Grid') {
	// 			// 	$this->grid_parse($form_id,$form["Row"],$form["Col"],$user);
	// 			// }else if ($form['FormType'] == 'Option') {
	// 			// 	$this->option_parse($form_id,$form["opt"],$user);
	// 			// }
				 
	// 		}

	// 		$result['status'] = 1; 
	// 		// $result['data'] = $post_arr;
	// 		// $result['QT'] = $post_arr["QT"]; 
	// 		// $result['HT'] = $post_arr["HT"]; 
	// 		echo json_encode($result);
	// 	}
	// 	else
	// 	{
	// 		// redirect(site_url(), 'refresh');
	// 		$result['status'] = -1;
	// 		$result['msg'] = "發生錯誤,請再試一次";
	// 		echo json_encode($result);
	// 	}

	// 	die();
	// }

	// function option_parse($form_id,$opt_ary,$user){
				
	// 	foreach ($opt_ary as $key) {
	// 		$compose_id = $this->core_model->create_compose($form_id,$key['val'],'R',$user);
	// 		$element_type_id = $this->core_model->get_element_type_id($key['InputType']);
	// 		$this->core_model->create_element($form_id,$element_type_id,$compose_id,0,$user);
	// 	}
	// }

	// function grid_parse($form_id,$row_ary,$col_ary,$user){
	// 	$row_array = array();
	// 	$col_array = array();
		
	// 	// if (array_key_exists('Row',$post_arr)) {
	// 	// $row = $form["Row"]; 
	// 	foreach ($row_ary as $key) {
	// 		// print_r($key);
	// 		$compose_id = $this->core_model->create_compose($form_id,$key['Name'],'R',$user);
	// 		array_push($row_array, $compose_id);
	// 	}
	// 	// }

	// 	// if (array_key_exists('Col',$post_arr)) {
	// 	// $col = $form["Col"]; 
	// 	foreach ($col_ary as $key) {
	// 		$compose_id = $this->core_model->create_compose($form_id,$key,'C',$user);
	// 		array_push($col_array, $compose_id);
	// 	}
	// 	// }

	// 	$element_type_id = $this->core_model->get_element_type_id('text');

	// 	foreach ($row_array as $row) {
	// 		if (sizeof($col_array) > 0) {
	// 			foreach ($col_array as $col ) {
	// 				$this->core_model->create_element($form_id,$element_type_id,$row,$col,$user);
	// 			}
	// 		}else{
	// 			$this->core_model->create_element($form_id,$element_type_id,$row,0,$user);
	// 		}
	// 	}
	// }

	 
	
}