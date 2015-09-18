<?php
class Core_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_cate_list(){
        $get_root_cate_sql = @" SELECT * FROM mod_code WHERE codekind_key = 'CHAPTER' AND parent_id = '-1' ORDER BY code_key ASC";
        $query = $this->db->query($get_root_cate_sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();
            $result = $this->get_sub_cate($result);
            return $result;
        }

    }

    public function get_sub_cate($result){

        foreach ($result as $key => $value) {
         


            $get_chapter_sql = "SELECT id,cp_key FROM mod_chapter WHERE cp_kind = '$value->code_id' ORDER BY cp_key ASC ";
            //echo $get_chapter_sql."<br />";
            $chapter_query = $this->db->query($get_chapter_sql);
            $chapter_result = null;
            if($chapter_query->num_rows() > 0)
            {
                $chapter_result = $chapter_query->result();

                

            }

            $result[$key]->chapters = $chapter_result;


            $get_pcate_sql = @" SELECT * FROM mod_code WHERE codekind_key = 'CHAPTER' AND parent_id = '$value->code_id' ORDER BY code_key ASC ";
            $query = $this->db->query($get_pcate_sql);
            
            if($query->num_rows() > 0)
            {
                $cate_result = $query->result();


                $result[$key]->sub_cate = $this->get_sub_cate($cate_result);

                
            }


        }
        return $result;
    }

    public function get_chapter_detail($id){
        $get_chapter_sql = @" SELECT c.*,s.title as sample_title,s.content as sample_content,s.file_name as sample_file_name FROM mod_chapter c LEFT JOIN mod_cp_sample s ON c.id = s.cp_id WHERE c.id = '$id' ";
        //echo $get_chapter_sql;
        $query = $this->db->query($get_chapter_sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();
           // print_r($result);
            return $result;
        }
    }

    public function get_chapter_inputs($cp_id){
        $get_input_sql = @" SELECT * FROM mod_cp_input i WHERE i.cp_id = '$cp_id' ORDER BY CREATE_DATE DESC";
        //echo $get_chapter_sql;
        $query = $this->db->query($get_input_sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();
           // print_r($result);
            return $result;
        }
    }

    public function get_chapter_samples($cp_id){
        $get_sample_sql = @" SELECT *,(SELECT code_name FROM mod_code WHERE code_id = i.cps_kind ) AS kind_name FROM mod_cp_sample i WHERE i.cp_id = '$cp_id' ORDER BY cps_kind DESC";
        //echo $get_chapter_sql;
        $query = $this->db->query($get_sample_sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();
           // print_r($result);
            return $result;
        }
    }

    // public function get_chapter_samples2($cp_id,$cps_kind)){
    //     $get_sample_sql = @" SELECT *,(SELECT code_name FROM mod_code WHERE code_id = i.cps_kind ) AS kind_name FROM mod_cp_sample i WHERE i.cp_id = '$cp_id' ORDER BY cps_kind DESC";
    //     //echo $get_chapter_sql;
    //     $query = $this->db->query($get_sample_sql);
    //     //echo $sql;exit;
    //     if($query->num_rows() > 0)
    //     {
    //         $result = $query->result();
    //        // print_r($result);
    //         return $result;
    //     }
    // }

    public function get_chapter_list_by_kind($cp_kind){
        $get_chapter_list_sql = @" SELECT c.* FROM mod_chapter c WHERE c.cp_kind = '$cp_kind' ORDER BY c.cp_key ASC ";
        //echo $get_chapter_sql;
        $query = $this->db->query($get_chapter_list_sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();
           // print_r($result);
            return $result;
        }
    }

    public function get_fc_id($cp_id,$cps_kind){
        $sql = @" SELECT id FROM mod_form_collections c WHERE c.cps_kind = '$cps_kind' AND c.cp_id = '$cp_id' ";
        //echo $get_chapter_sql;
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->row();
           // print_r($result);
            return $result->id;
        }
    }

    public function get_kind_name($code_id){
        $get_code_name_sql = @" SELECT c.code_name FROM mod_code c WHERE c.code_id = '$code_id' ";
        //echo $get_chapter_sql;
        $query = $this->db->query($get_code_name_sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();
           // print_r($result);
            return $result;
        }
    }


    public function get_breadcrumb($code_id){


        $get_code_name_sql = @" SELECT c.parent_id,c.code_name FROM mod_code c WHERE c.code_id = '$code_id' ";

        
        
        //echo $get_chapter_sql;
        $query = $this->db->query($get_code_name_sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            //print_r($result);

            if($result[0]->parent_id != -1 ){
                return '&nbsp; &gt; &nbsp;'.$result[0]->code_name.$this->get_breadcrumb($result[0]->parent_id);
            }else{
                return '&nbsp; &gt; &nbsp;'.$result[0]->code_name;
            }
           // print_r($result);
            
        }

    }

    public function get_code($codekind_key,$lang_code,$parent_id=-1,$filter=""){
        $sql = @"select * from mod_code where codekind_key = '$codekind_key' 
        and parent_id = $parent_id and lang_code = '$lang_code' $filter ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }
    }

    public function get_series_menu($codekind_key,$lang_code,$parent_id=-1){
        // $sql = @"select * from mod_code where codekind_key = '$codekind_key' and parent_id = $parent_id and lang_code = '$lang_code' ";
        // $query = $this->db->query($sql);
        // //echo $sql;exit;
        // if($query->num_rows() > 0)
        // {
        //     $result = $query->result();

        //     return $result;
        // }
        return $this->get_code($codekind_key,$lang_code,$parent_id);
    }

    public function get_country(){
        return $this->get_code('COUNTRY','zh-TW');
    }

    public function get_country_info($code_id){
        $sql = @"select * from mod_country 
        where  country_id like '%;$code_id;%'   ";
        $query = $this->db->query($sql);
        
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }
    }

    public function get_series_info($code_id){
        $sql = @"select * from mod_code where code_id = '$code_id'  ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row;
        }
    }

    public function get_series_sub_detail($parent_id){
        $sql = @"select * from mod_code where parent_id  = '$parent_id' ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }
    }

    public function get_code_info($codekind_key,$code_key){
        $sql = @"select * from mod_code where codekind_key='$codekind_key' and code_key='$code_key' ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }
    }

    public function get_news_list($type,$lang){
        $sql = @"select * from mod_news where type='$type' and lang='$lang' ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }
    }

    public function get_products_list($serial_key){
        $sql = @"select * from mod_products where serial_key  = '$serial_key' ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }
    }

    public function get_product($id){
        $sql = @"select * from mod_products where id  = '$id' ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row;
        }
    }

    public function get_support($type_code_key,$lang_code){
        $sql = @"select * from mod_code where code_key='$type_code_key' and lang_code = '$lang_code'  ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $row = $query->row();

            return $row;
        }
    }

    public function get_support_list($type){ 
        $sql = @"select * from mod_sup where type = '$type' ";
        $query = $this->db->query($sql);
        //echo $sql;exit;
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        }
    }

    public function insert_mod_contact($insert_data){
        $sql = @"INSERT INTO mod_contact (
                                            com_name, 
                                            address,
                                            contact_person, 
                                            country,   
                                            tel,
                                            fax,
                                            email,
                                            website,
                                            engineernum,
                                            bothpercentt,
                                            bothpercentr,
                                            territoryplace,
                                            whichexhibition,
                                            wherelearnsturdyothers,
                                            comment,
                                            lang                                         
                                        ) 
                VALUES ( ?, ?, ?, ?, ?,?,?, ?, ?, ?, ?, ?, ?, ?, ?,?)"; 

        $para = array(
                $insert_data['com_name'], 
                $insert_data['address'],
                $insert_data['contact_person'],
                $insert_data['country'],  
                $insert_data['tel'],
                $insert_data['fax'],
                $insert_data['email'],
                $insert_data['website'],
                $insert_data['engineernum'],
                $insert_data['bothpercentt'],
                $insert_data['bothpercentr'],
                $insert_data['territoryplace'],
                $insert_data['whichexhibition'],
                $insert_data['wherelearnsturdyothers'],
                $insert_data['comment'],
                $insert_data['lang']
            );
        $success = $this->db->query($sql, $para);

        if($success)
        {
            return true;
        }

        return;
    }

    public function get_last_id(){
        $sql = "SELECT last_insert_id() as ID";
        $id_result= $this->db->query($sql);
        return $id_result->row()->ID; 
    }

    // public function get_element_type_id($name){
    //     $sql = "SELECT id FROM mod_element_types WHERE name=?";
    //     $para = array(
    //         $name
    //     );
    //     $id_result= $this->db->query($sql,$para);
    //     return $id_result->row()->id; 
    // }

    public function get_forms_json_by_fc_id($fc_id){
        $sql = "SELECT form_json FROM mod_forms WHERE fc_id=? order by `order` ";
        $para = array(
            $fc_id
        );
        $query = $this->db->query($sql,$para);
        if($query->num_rows() > 0)
        {
            $result = $query->result();

            return $result;
        } 
    }

    public function get_form($form_id){
        $sql = "SELECT * FROM mod_forms WHERE id=?";
        $para = array(
            $form_id
        );
        $query = $this->db->query($sql,$para);
        if($query->num_rows() > 0)
        {
            $result = $query->row();

            return $result;
        } 
    }

    // public function get_element($form_id){
    //     $sql = "SELECT * FROM mod_form_elements WHERE form_id=?";
    //     $para = array(
    //         $form_id
    //     );
    //     $query = $this->db->query($sql,$para);
    //     if($query->num_rows() > 0)
    //     {
    //         $result = $query->result();

    //         return $result;
    //     } 
    // }

    // public function get_compose($form_id){
    //     $sql = "SELECT * FROM mod_form_compose WHERE form_id=?";
    //     $para = array(
    //         $form_id
    //     );
    //     $query = $this->db->query($sql,$para);
    //     if($query->num_rows() > 0)
    //     {
    //         $result = $query->result();

    //         return $result;
    //     } 
    // }

    public function create_form_collection($cp_id,$cps_kind,$create_by){
        $sql = @"INSERT INTO mod_form_collections (
                                            cp_id, 
                                            cps_kind,
                                            create_date, 
                                            create_by                                     
                                        ) 
                VALUES ( ?,?, NOW(), ?)"; 

        $para = array(
                $cp_id, 
                $cps_kind,
                $create_by
            );

        $success = $this->db->query($sql, $para);
        // print_r($success);
        // die;
        if($success)
        {
            return $this->get_last_id();
        }

        return;
    }

    // public function create_form($fc_id,$name,$desc,$create_by,$form_type){
    //     $sql = @"INSERT INTO mod_forms (
    //                                         fc_id,
    //                                         name, 
    //                                         `desc`,
    //                                         create_date, 
    //                                         create_by,   
    //                                         form_type                                        
    //                                     ) 
    //             VALUES ( ?, ?, ?, NOW(), ?, ?)"; 

    //     $para = array(
    //             $fc_id,
    //             $name, 
    //             $desc,
    //             $create_by,
    //             $form_type
    //         );

    //     $success = $this->db->query($sql, $para);
    //     // print_r($success);
    //     // die;
    //     if($success)
    //     {
    //         return $this->get_last_id();
    //     }

    //     return;
    // }

    public function check_fc_id_exists($fc_id){
        $sql = @"SELECT COUNT(*) count FROM mod_form_collections where id = ?"; 

        $para = array(
                $fc_id
            );

        $query = $this->db->query($sql, $para);

        if($query->num_rows() > 0)
        {
            return true;
        } 

        return false;
    }

    public function create_form($fc_id,$name,$desc,$create_by,$form_json){
        $sql = @"INSERT INTO mod_forms (
                                            fc_id,
                                            name, 
                                            `desc`,
                                            form_json,
                                            create_date, 
                                            create_by                                    
                                        ) 
                VALUES ( ?, ?, ?, ?, NOW(), ?)"; 

        $para = array(
                $fc_id,
                $name, 
                $desc,
                $form_json,
                $create_by
            );

        $success = $this->db->query($sql, $para);
        // print_r($success);
        // die;
        if($success)
        {
            return $this->get_last_id();
        }

        return;
    }

    public function delete_form_by_fc_id($fc_id){
        $sql = @"DELETE FROM mod_forms WHERE fc_id=?"; 

        $para = array(
                $fc_id
            );

        $success = $this->db->query($sql, $para);
        

        return $success;
    }


    // public function create_compose($form_id,$name,$type,$create_by){
    //     $sql = @"INSERT INTO mod_form_compose (
    //                                         form_id, 
    //                                         `name`,
    //                                         type, 
    //                                         create_by,   
    //                                         create_date                                        
    //                                     ) 
    //             VALUES ( ?, ?, ?, ?, NOW())"; 

    //     $para = array(
    //             $form_id, 
    //             $name,
    //             $type,
    //             $create_by
    //         );

    //     $success = $this->db->query($sql, $para);
    //     if($success)
    //     {
    //         return $this->get_last_id();
    //     }

    //     return;
    // }

    // public function create_element($form_id,$element_type_id,$row_id,$col_id,$create_by){
    //     $sql = @"INSERT INTO mod_form_elements (
    //                                         form_id, 
    //                                         `element_type_id`,
    //                                         row_id, 
    //                                         col_id,
    //                                         create_by,   
    //                                         create_date                                        
    //                                     ) 
    //             VALUES ( ?, ?, ?, ?, ?, NOW())"; 

    //     $para = array(
    //             $form_id, 
    //             $element_type_id,
    //             $row_id,
    //             $col_id,
    //             $create_by
    //         );

    //     $success = $this->db->query($sql, $para);
    //     if($success)
    //     {
    //         return true;
    //     }

    //     return;
    // }
 

}