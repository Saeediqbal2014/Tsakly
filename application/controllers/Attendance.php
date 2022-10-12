<?php 
/**
 * 
 */
class Attendance extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Basic_model','bm');
		$this->load->model('Main_model','mm');
	}

	public function index()
	{
		$data = [
				'title' => 'Take Leave',
				'users'=> $this->bm->getAllWhere('users','status!=','1','name','asc')
			];
		$i=0;
 		foreach ($data['users'] as $v)
		{
			$data['tot_atd'][$i]=$this->mm->getUserAtd($v->user_id);
			$i++;
		}

		// echo "<pre>";print_r($data);
		// exit();
		$this->load->view('template/header',$data);
		$this->load->view('template/nav');
		$this->load->view('attendance/index',$data);
		$this->load->view('template/footer');
	}
	public function daterange()
	{
		$date1 = $this->input->post('from');

		$date2 = $this->input->post('to');

		$data = [
				'title' => 'Take Leave',
				'users'=> $this->bm->getAllWhere('users','status!=','1','name','asc')
			];
		$i=0;
 		foreach ($data['users'] as $v)
		{
			$data['tot_atd'][$i]=$this->mm->getUserAtd1($v->user_id,$date1,$date2);
			$i++;
		}
		$this->load->view('template/header',$data);
		$this->load->view('template/nav');
		$this->load->view('attendance/index',$data);
		$this->load->view('template/footer');
	}

	public function getAtdDetails()
	{
		$uid=$this->input->post('id');
		$arr = ['user_id'=>$uid];
		$data=$this->bm->getRowsWithMultipleConditions('attendance',$arr);
		echo json_encode($data);
	}

	public function editAtdRow($id)
	{
		$data = [
				'title' => 'Edit Attendance',
			];
		$data2['data2']=$this->bm->getRow('attendance','attendance_id',$id);
		// print_r($data2);
		// exit();
		$this->load->view('template/header',$data);
		$this->load->view('template/nav');
		$this->load->view('attendance/edit',$data2);
		$this->load->view('template/footer');
	}
	public function update(){

				$lt = $this->input->post('lates');

				$lt2 = $this->input->post('lates2');



				$uid = $this->input->post('uid');
				$user=$this->bm->getRow('users','user_id',$uid);
				$time = date("h:i", strtotime('+10 minutes', strtotime($user->user_time)));
				$close_time = strtotime($this->input->post('from'));
				if(strtotime($time) >= $close_time)
				{
					$total_count ='0';
				}
				else
				{
					$open_time = strtotime($user->user_time);
				    $output = [];
				    $l=0;
				    for( $i=$open_time; $i<$close_time; $i+=1800)
				    {
				        $output[$l]= date("H:i",$i);
				        $l++;
				    }

				    $total_count=count($output);
				}
				$atd = $this->input->post('id');

				if ($lt != $lt2) {
					$field = [
					'time_1'=>$this->input->post('from'),
					'time_2'=>$this->input->post('to'),
					'lates'=>$this->input->post('lates'),
					'absent'=>$this->input->post('Absent'),
					'leave_'=>$this->input->post('Leave')
				]; 
				}
				else{
					$field = [
					'time_1'=>$this->input->post('from'),
					'time_2'=>$this->input->post('to'),
					'lates'=>$total_count,
					'absent'=>$this->input->post('Absent'),
					'leave_'=>$this->input->post('Leave')
				]; 
					
				}
				 
				$this->bm->update('attendance', $field , 'attendance_id', $atd);

	}


	public function form()
	{
		$data = [
				'title' => 'Take Leave',
			];

		// echo "<pre>";print_r($data);
		// exit();
		$this->load->view('template/header',$data);
		$this->load->view('template/nav');
		$this->load->view('demo/demo');
		$this->load->view('template/footer');
	}
}