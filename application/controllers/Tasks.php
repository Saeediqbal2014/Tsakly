<?php 
class Tasks extends CI_Controller{
    function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('status') == null) {
      redirect('Login');
    } else {
      if ($this->session->userdata('category') == 0) {
        redirect('Skills');
      }
    }

    $this->load->model('Basic_model', 'bm');
    $this->load->model('Main_model', 'mm');
  }

  function index()
  {
    $user_id = $_SESSION["id"];
    $data = array(
        'title' => 'Tasks'
      );
      
      if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1 || $this->session->userdata('task_create') == 1) {
        $data = array();

        $data['title'] = 'All task';
        // $data['id'] = $id;
  
        // if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1 || $this->session->userdata('subtask_p_show') == 1) {
        //   $i = 0;
        //   // foreach ($data['tasks'] as $key => $v) {//
        //     if ($this->session->userdata('subtask_p_show') == 1) {
        //       $arrs = array('user_id' => $this->session->userdata('id'));
        //     } else if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1) {
        //       $arrs = array('user_id' => $this->session->userdata('id'));
        //     }
        //     // die("reached");
        //     $data['subtasks'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrs);
        //     $i++;
        //   // }//End FOreach
        // }
      }
    
      $subtasks = $this->db->query("SELECT * FROM projects_subtasks WHERE user_id=$user_id");
      if($subtasks->num_rows() > 0)
      {
        $data["tasks"] = $subtasks->result();
      }else{
           $data["tasks"] = '';
      }
      // echo"<pre>"; print_r($data["tasks"]); die();
      $this->load->view('template/header', $data);
      $this->load->view('template/nav');
      $this->load->view('tasks/user_tasks', $data);
      $this->load->view('template/footer');
  }//index ends

  public function subtask_view($id, $projectid)
	{
			$data = array(
				'title' => 'Subtask Details',
				'projectid' => $projectid,
				'subtask' => $this->bm->getAllWhere('projects_subtasks', 'project_subtask_id', $id, 'project_subtask_id'),
			);
			$data['subtask_user'] = $this->bm->getAllWhere('users', 'user_id', $data['subtask'][0]->user_id, 'user_id');

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('subtask/user_view', $data);
			$this->load->view('template/footer');
		
	}
}
?>