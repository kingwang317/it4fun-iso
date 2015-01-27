<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sample_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(SAMPLE_FOLDER, SAMPLE_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_cp_sample']); // table name
	}

	public function get_count($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_cp_sample a 
		LEFT JOIN mod_code b on a.cps_kind = b.code_id
		LEFT JOIN mod_chapter c on a.cp_id = c.id $filter ";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row->total_rows;
		}

		return 0;
	}

	public function get_list($dataStart, $dataLen, $filter)
	{
		$sql = @"SELECT a.*,b.code_name,c.title AS cp_title,c.cp_key FROM mod_cp_sample a 
		LEFT JOIN mod_code b on a.cps_kind = b.code_id
		LEFT JOIN mod_chapter c on a.cp_id = c.id
		$filter ORDER BY `cp_id`,`cps_kind` LIMIT $dataStart, $dataLen";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_record($id){
		$sql = @"SELECT * FROM mod_cp_sample where id='$id' LIMIT 1 ";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row;
		}

		return;
	}
 

	public function insert($insert_data)
	{
		$sql = @"INSERT INTO mod_cp_sample ( 
											cps_kind,
											title, 
											`cp_id`, 
											content,
											file_name,
										 	create_by
										) 
				VALUES ( ?, ?, ?, ?, ? ,? )"; 

		$para = array(
				$insert_data['cps_kind'], 
				$insert_data['title'],
				$insert_data['cp_id'],
				$insert_data['content'],
				$insert_data['file_name'],
				$insert_data['create_by']
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return $this->db->query("SELECT LAST_INSERT_ID() AS ID")->row()->ID;
		}

		return;
	}

	public function update($update_data)
	{
		$sql = @"UPDATE mod_cp_sample SET `cps_kind` 	= ?,
										title 	= ?,
										`cp_id` 	= ?,
										content = ?, 
										file_name	= ?
									 
				WHERE id = ?";
		$para = array(
				$update_data['cps_kind'], 
				$update_data['title'],
				$update_data['cp_id'],
				$update_data['content'],
				$update_data['file_name'], 
				$update_data['id']
			);
		$success = $this->db->query($sql, $para);
 
		 
		if($success)
		{
			return true;
		}

		return;
	} 

	public function do_multi_del($ids){
		$sql = @"DELETE FROM  mod_cp_sample WHERE id in ($ids) ";

		// $para = array($ids);
		$success = $this->db->query($sql);

		return $success;
	}

	public function del($id)
	{
		$sql = @"DELETE FROM mod_cp_sample WHERE id = ?";
		 
		$para = array($id);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	} 
	  
	
}