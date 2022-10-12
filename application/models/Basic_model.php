<?php
class Basic_model extends CI_Model
{
  function insert($table, $arr)
  {
    $this->db->insert($table, $arr);

    return $this->db->insert_id();
  }


  function getlogsdaterange($frm, $to)
  {
      
    $this->db->select('attendance.*,users.name username');
    $this->db->from('attendance');
	$this->db->join('users','users.user_id=attendance.user_id');
    $this->db->where('attendance_datetime	>=', $frm);
    $this->db->where('attendance_datetime	<=', $to);
    $this->db->order_by('attendance_datetime	', 'desc');
    return $this->db->get()->result();
        
	    
  }

  public function getProjectDetails($id)
  {
    $this->db->select('*');
    $this->db->from('projects p');
    $this->db->join('projects_users pu','pu.project_id=p.project_id','left');
    $this->db->join('users u','u.user_id=pu.user_id','left');
    $this->db->where('p.project_id',$id);
    return $this->db->get()->result_array();
  }

  public function gettaskAndSubTaskDetails($id)
  {
    $this->db->select('*');
    $this->db->from('projects_tasks pt');
    $this->db->join('projects_subtasks ps','ps.project_subtask_id=pt.project_id','left');
    $this->db->join('projects p','p.project_id=pt.project_id','left');
    $this->db->join('users u','u.user_id=ps.user_id','left');
    $this->db->where('pt.project_task_id',$id);
    return $this->db->get()->result_array();
  }

  public function getUserName($userId)
  {
    // print_r($userId); die();
    $this->db->select('*');
    $this->db->from('users u');
    $this->db->join('projects_subtasks ps','ps.user_id=u.user_id','left');
    $this->db->where('u.user_id',$userId);
     
    $dg = $this->db->get()->result_array();
    // print_r($dg);die($dg);
    return $dg;
  }


  function update($table, $arr, $column, $val)
  {

    $this->db->where($column, $val);

    return $this->db->update($table, $arr);
  }

  function salary($id)
  {

    return $this->db->select("salary")->where("user_id", $id)->get("users")->result();
  }



  function delete($table, $column, $val)
  {

    $this->db->where($column, $val);

    return $this->db->delete($table);
  }



  function getRow($table, $column, $val)

  {

    $record = $this->db->get_where($table, array($column => $val))->result();
    if (!empty($record)) {

      return $record[0];
    } else {

      return $record;
    }
  }



  function getRowsWithMultipleConditions($table, $arr, $limit = "")
  {

    if ($limit != '') {


      $this->db->limit($limit);
    }
            
     
    
    $db = $this->db->get_where($table, $arr)->result();
    // print_r($db); die();
    return $db;
  }

  public function getRowsWithMultipleCond($id)
  {
    $this->db->select("*");
    $this->db->from("projects_tasks pt");
    $this->db->where("ps.project_task_id",$id);
    $this->db->join(" projects_subtasks ps","ps.project_task_id = pt.project_task_id","left");
    $this->db->join("users u","u.user_id = ps.user_id","left");
    return $this->db->get()->result();
    
  }



  function getAll($table, $order_by = '', $limit = '')

  {

    if ($order_by !== '') {

      $this->db->order_by($order_by, 'desc');
    }
    if ($limit !== '') {

      $this->db->limit($limit);
    }
    // print_r($table); die();

    $dd = $this->db->get($table)->result();
    // print_r($dd); die();
    return $dd;
  }



  function getAllWhere($table, $column, $val, $order_by, $order_val = '', $limit = '')

  {

    if ($limit !== '') {

      $this->db->limit($limit);
    }
    // print_r($column); die();
    $this->db->where($column, $val);

    if ($order_val !== '') {
      $this->db->order_by($order_by, $order_val);
    } else {
      $this->db->order_by($order_by, 'desc');
    }
    // print_r($table); die();

    return $this->db->get($table)->result();
  }

  function insert_batch($table, $arr)
  {
    $this->db->insert_batch($table, $arr);
    // print_r($this->db->error()); die(); 
    return $this->db->insert_id();
  }


  function uploadImage($image_arr, $path)
  {

    if ($image_arr['name'] == "") {

      return false;
    }

    // validate if file is image

    $image_size = getimagesize($image_arr["tmp_name"]);



    if ($image_size !== false) {

      // generate a unique image name using mili seconds

      $image_name = "$path/" . date('U') . '_' . $image_arr['name'];

      if (move_uploaded_file($image_arr["tmp_name"], $image_name)) {

        // file is uploaded

        return $image_name;
      }
    }

    return false;
  }



  function uploadFile($file_arr, $path)
  {

    if ($file_arr['name'] == "") {

      return false;
    }

    $file_name = "$path/" . date('U') . '_' . $file_arr['name'];

    if (move_uploaded_file($file_arr["tmp_name"], $file_name)) {

      // file is uploaded

      return $file_name;
    }
  }

  function getrowSum($table, $arr, $column, $val)
  {
    $this->db->select($arr);
    $this->db->from($table);
    $this->db->where($column, $val);
    return $this->db->get()->row();
  }

   function getrowSum1($table, $arr, $column, $val)
  {
    $this->db->select($arr);
    $this->db->from($table);
    $this->db->where($column, $val);
    return $this->db->get()->row();
  }

  function add_quot($data)
  {
    return $this->db->insert("quotation", $data);
  }

  function get_quot()
  {
    return $this->db->select("*")->get("quotation")->result();
  }
  
  public function get_SubGroups_By_Group_Id($group_id){
      $this->db->select('*');
      $this->db->from('account_subgroup');
      $this->db->where('group_id',$group_id);
      return $this->db->get()->result();
  }
  
  public function get_user_for_project($project_id){
      $this->db->select('*');
      $this->db->from('projects_users');
      $this->db->where('project_id',$project_id);
      return $this->db->get()->result();
  }
  
  public function get_empss_name_by_id($id,$proj_id){
    $this->db->select('*');
    $this->db->from('projects_users as pu');
    $this->db->join('users','pu.user_id = users.user_id');
    $this->db->where('pu.project_id',$proj_id);
    return $this->db->get()->result();
  }
}
