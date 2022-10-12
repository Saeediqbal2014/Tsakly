<?php

/**
 * 
 */
class Logs extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model', 'bm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
	    $id = $this->session->userdata('user');
	   // echo 
		$data = [
			'title' => 'Logs',
			'logs' => $this->mm->getUserAttendance()
		];
		
		$user_data = [
			'title' => 'Attendance',
			'logs' => $this->mm->getAttendanceForUser($id)
		];
		if($this->session->userdata('status') == "user_active" && $this->session->userdata('attendance_p_show') == 1){
		    $this->load->view('template/header', $user_data);
    		$this->load->view('template/nav');
    		$this->load->view('logs/users_att');
    		$this->load->view('template/footer');
		}else{
    		$this->load->view('template/header', $data);
    		$this->load->view('template/nav');
    		$this->load->view('logs/index');
    		$this->load->view('template/footer');
		}
	}
	public function daterange()
	{

		$date = date_create($this->input->post('from'));
		$date1 = date_format($date, "d-m-y");
		$date2 = date_create($this->input->post('to'));
		$date2 = date_format($date2, "d-m-y");
		$data = [
			'title' => 'Logs',
			'logs' => $this->bm->getlogsdaterange($date1, $date2)
		];
		// print_r($data["logs"]);
		$this->load->view('template/header', $data);
		$this->load->view('template/nav');
		$this->load->view('logs/index', $data);
		$this->load->view('template/footer');
	}
}
