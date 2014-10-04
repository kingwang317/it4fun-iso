<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chapter_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(CHAPTER_FOLDER, CHAPTER_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_chapter']); // table name
	}

	public function get_count($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_chapter $filter ";
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
		$sql = @"SELECT a.*,b.code_name FROM mod_chapter a 
		LEFT JOIN mod_code b on a.cp_kind = b.code_id
		$filter ORDER BY `cp_kind`,`cp_key` LIMIT $dataStart, $dataLen";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_chapter_list($filter)
	{
		$sql = @"SELECT a.title,a.id,a.cp_key FROM mod_chapter a 
		$filter ORDER BY `cp_kind`,`cp_key` ";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_record($id){
		$sql = @"SELECT * FROM mod_chapter where id='$id' LIMIT 1 ";
	
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
		$sql = @"INSERT INTO mod_chapter ( 
											cp_key,
											title, 
											`description`, 
											parse,
											file_name,
											cp_kind
										 
										) 
				VALUES ( ?, ?, ?, ?, ?,?)"; 

		$para = array(
				$insert_data['cp_key'], 
				$insert_data['title'],
				$insert_data['description'],
				$insert_data['parse'],
				$insert_data['file_name'],
				$insert_data['cp_kind']
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	}

	public function update($update_data)
	{
		$sql = @"UPDATE mod_chapter SET `cp_key` 	= ?,
										title 	= ?,
										`description` 	= ?,
										parse = ?, 
										file_name	= ?, 
										cp_kind	= ?
									 
				WHERE id = ?";
		$para = array(
				$update_data['cp_key'], 
				$update_data['title'],
				$update_data['description'],
				$update_data['parse'],
				$update_data['file_name'],
				$update_data['cp_kind'],
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
		$sql = @"DELETE FROM  mod_chapter WHERE id in ($ids) ";

		// $para = array($ids);
		$success = $this->db->query($sql);

		return $success;
	}

	public function del($id)
	{
		$sql = @"DELETE FROM mod_chapter WHERE id = ?";
		 
		$para = array($id);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	} 
	  
	
}