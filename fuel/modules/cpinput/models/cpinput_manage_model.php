<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cpinput_manage_model extends MY_Model {
	
	function __construct()
	{
		$CI =& get_instance();
		$CI->config->module_load(CPINPUT_FOLDER, CPINPUT_FOLDER);
		$tables = $CI->config->item('tables');
		parent::__construct($tables['mod_cp_input']); // table name
	}

	public function get_count($filter="")
	{
		$sql = @"SELECT COUNT(*) AS total_rows FROM mod_cp_input a 
		LEFT JOIN mod_chapter b on a.cp_id = b.id $filter ";
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
		$sql = @"SELECT * FROM (
		SELECT a.*,b.title AS cp_title,b.cp_key FROM mod_cp_input a  
		LEFT JOIN mod_chapter b on a.cp_id = b.id
		$filter ORDER BY `author`,`input_key` ASC , `version` DESC  LIMIT $dataStart, $dataLen ) x
		GROUP BY `author`,`input_key`;";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$result = $query->result();

			return $result;
		}

		return;
	}

	public function get_record($id){
		$sql = @"SELECT * FROM mod_cp_input where id='$id' LIMIT 1 ";
	
		$query = $this->db->query($sql);

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			return $row;
		}

		return;
	}
 

	public function insert($insert_data,$version=1)
	{
		$sql = @"INSERT INTO mod_cp_input ( 
											input_key,
											cp_id,
											title, 
											content,
											file_name,
											author, 
										 	create_date,
										 	version
										) 
				VALUES ( ?, ?, ?, ?, ?, ? , NOW(),?)"; 

		$para = array(
				$insert_data['input_key'], 
				$insert_data['cp_id'], 
				$insert_data['title'],
				$insert_data['content'],
				$insert_data['file_name'],
				$insert_data['author'],
				$version
			);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return $this->db->query("SELECT LAST_INSERT_ID() AS ID")->row()->ID;
		}

		return;
	}

	public function verify($update_data){
		$sql = @"UPDATE mod_cp_input SET  
										verify_by = ?, 
										verify_date	= NOW()
									 
				WHERE id = ?";
		$para = array(
				$update_data['verify_by'],  
				$update_data['id']
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
		$sql = @"SELECT MAX(version)+1 AS version FROM  mod_cp_input  WHERE input_key= ?";

		$para = array(
				$update_data['input_key']
			);

		$query = $this->db->query($sql,$para);

		$version = 1;

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			$version = $row->version;
		}

		$success = $this->insert($update_data,$version);
 
		 
		if($success)
		{
			return true;
		}

		return;
	} 

	public function do_multi_del($ids){
		$sql = @"DELETE FROM  mod_cp_input WHERE id in ($ids) ";

		// $para = array($ids);
		$success = $this->db->query($sql);

		return $success;
	}

	public function del($id)
	{
		$sql = @"DELETE FROM mod_cp_input WHERE id = ?";
		 
		$para = array($id);
		$success = $this->db->query($sql, $para);

		if($success)
		{
			return true;
		}

		return;
	} 
	  
	
}