<?php
class Leave extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
		if($this->session->userdata('status') == null)
		{
		    redirect('Login');
		}
		else
		{
			if($this->session->userdata('category')==0)
			{
				redirect('Skills');
			}
		}
		$this->load->model('Basic_model','bm');
		$this->load->model('Main_model','mm');
	}

	public function index($val='')
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('leave_show')==1 || $this->session->userdata('leave_p_show')==1 || $this->session->userdata('leave_add')==1 || $this->session->userdata('leave_r_show')==1)
		{
			$data = [
				'title' => 'Leave',
				'box' => $val,
				'leaves' => $this->mm->getAllLeaves(),
				'users' => $this->bm->getAllWhere('users','status!=','1','name','asc')
			];
			$i=0;
			foreach ($data['users'] as $key => $v)
			{
				$data['t_leaves'][$i]=$this->mm->getTotalLeaves($v->user_id);
				$i++;
			}
	        // echo"<pre>";print_r($data);exit();
			$this->load->view('template/header',$data);
			$this->load->view('template/nav');
			$this->load->view('leave/index',$data);
			$this->load->view('template/footer');
		}
		else
		{
			redirect('dashboard');
		}	
		
	}

	public function take_leave()
	{

		if($this->session->userdata('user')==1 || $this->session->userdata('leave_add')==1)
		{
			$data = [
				'title' => 'Take Leave'
			];

			$this->load->view('template/header',$data);
			$this->load->view('template/nav');
			$this->load->view('leave/take_leave');
			$this->load->view('template/footer');
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function take_new_leave()
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('leave_add')==1)
		{
			$with_pay = 0;
			$without_pay = 0;
			$this->form_validation->set_rules('from_date', 'date', 'required'); 
			$this->form_validation->set_rules('to_date', 'date', 'required');  
			$this->form_validation->set_rules('leave_days', 'leave days', 'required');  
			$this->form_validation->set_rules('reason', 'reson of leave', 'required');  
	        if($this->form_validation->run())
	        {
				if($this->input->post('type') == "with_pay"){
					$with_pay = 1;
				}elseif($this->input->post('type') == "without_pay"){
					$without_pay = 1;
				}
	        	$field = [
		        		'from_date' 		=> 	$this->input->post('from_date'),
		        		'to_date' 			=> 	$this->input->post('to_date'),
		        		'leave_days' 		=> 	$this->input->post('leave_days'),
		        		'reason_of_leave' 	=> 	$this->input->post('reason'),
		        		'user_id' 			=> 	$this->session->userdata('id'),
						'with_pay'			=>	$with_pay,
						'without_pay'		=>	$without_pay,
		        		'insert_datetime' 	=> 	date('Y-m-d h:i:s')
		        	];
	            
					// require APPPATH . 'views/vendor/autoload.php';

					// $options = array(
					//   'cluster' => 'us2',
					//   'useTLS' => true
					// );
					// $pusher = new Pusher\Pusher(
					//   '7fbdecba1e9ae72cccd1',
					//   '0387b9da491d8a31fd19',
					//   '1245173',
					//   $options
					// );
				  
					// $data = "Leaves has been added!";
					// $pusher->trigger('my-channel', 'my-event', $data);
					
		        $dt=$this->bm->insert('leaves',$field);
		        if($dt > 0)
		        {
		        	$arr = [];
	                $from = strtotime($this->input->post('from_date')); 
	                $to = strtotime($this->input->post('to_date')); 
	                for ($currentDate = $from; $currentDate <= $to;$currentDate += (86400))
	                {                                
		                $Store = date('d-m-Y', $currentDate); 
		                $arr[] = [
		                  	'leave_date'=>$Store,
		                  	'leave_id'=>$dt
		                ];
	                } 
	                $this->bm->insert_batch('leave_dates', $arr);
		        	$this->session->set_flashdata('errorrleave', 'New leave request has been sent to management successfully..!');
	                redirect('leave/take_leave');  
	            }  
	            else  
	            {  
	                 $this->session->set_flashdata('errorrleave', 'Something wrong');  
	                 redirect('leave/take_leave');  
	            }  
	        }
	        else
	        {
	        	$this->take_leave();
	        }
	    }
	    else
	    {
	    	redirect('dashboard');
	    }
	}

	public function get_leave_dates()
	{
		$id = $this->input->post('id');
		
		$arr = ['leave_id'=>$id,'leave_date_status' => '0'];
		// print_r($arr);	die();
		$data = $this->bm->getRowsWithMultipleConditions('leave_dates',$arr);
		// print_r($data); die();
		echo json_encode($data);
	}

	public function approve_leave_dates()
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('leave_app')==1)
		{

			$lid = $this->input->post('leave_id');
			$id = $this->input->post('id');
			$st = $this->input->post('st');
			$wp = [];
			$wop = [];
			$wp1 = 0;
			$wop1 = 0;
			for ($i=0;$i<count($st);$i++)
			{ 
				if($st[$i] == 1)
				{
					$wop[] = $st[$i];
					$wop1=count($wop);
				}
				else
				{
					$wp[] = $st[$i];
					$wp1=count($wp);
				}
			}		
			$data = $this->bm->getrow('leaves','leave_id', $lid);

			$field  = [
				'with_pay' => $data->with_pay + $wp1,
				'without_pay' => $data->without_pay + $wop1,
				'app_leave' => $data->app_leave + 1,
				'leave_status' => '1'
			];
			$this->bm->update('leaves',$field,'leave_id',$lid);
			for ($i=0;$i<count($st);$i++)
			{ 
				$arr = ['leave_date_status' => $st[$i]];
				$this->bm->update('leave_dates',$arr,'leave_date_id',$id[$i]);
			}

			$owarr=['leave_id'=>$lid,'leave_date_status'=>'2'];
			$mydataOw = $this->bm->getRowsWithMultipleConditions('leave_dates',$owarr);
			$owarrl=['user_id'=>$data->user_id,'absent'=>'1',];
			$mydataOw2 = $this->bm->getRowsWithMultipleConditions('attendance',$owarrl);

			echo"<br><br><pre>";print_r($mydataOw);
			print_r($mydataOw2);
			
			// echo date('Y-m-d h:i:s', strtotime($mydataOw[0]->leave_date));
			 
			
				for ($i=0; $i<count($mydataOw); $i++)
				{ 
					for ($m=0; $m<count($mydataOw2); $m++) {
					
						$date = date('Y-m-d', strtotime($mydataOw2[$m]->attendance_datetime));
						
						$attendance_datetime = date('Y-m-d', strtotime($mydataOw[$i]->leave_date));
						if ($date == $attendance_datetime ) {
							
						$arr2 = array(
							'absent' => '0',
							'leave_' => '1'
						);
				
						
							
						$this->bm->update('attendance', $arr2 , 'attendance_id', $mydataOw2[$m]->attendance_id);
						}
						
						
					}
						
				}
			
			


			$this->session->set_flashdata('errorleave','Leave has been approved successfully..!');
			redirect('leave');
		}
		else
		{
			redirect('dashboard');
		}	
	}

	public function reject_leave_dates($id)
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('leave_rej')==1)
		{
			$arr = ['leave_date_status' => '1'];
			$this->bm->update('leave_dates',$arr,'leave_id',$id);
			$data = $this->bm->getrow('leaves','leave_id', $id);
			$field  = [
				'rej_leave' => $data->rej_leave + 1,
				'leave_status' => '1'
			];
			$this->bm->update('leaves',$field,'leave_id',$id);
			$this->session->set_flashdata('errorleave','Leave has been rejected successfully..!');
			redirect('leave');
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function getAllLeaveDates()
	{
		$id = $this->input->post('id');
		$arr = ['user_id' => $id,'leave_status!=' => '0'];
		$data['leaves'] = $this->bm->getRowsWithMultipleConditions('leaves', $arr);
		$i=0;
		foreach ($data['leaves'] as $key => $v)
		{
			$data['t_leaves'][$i] = $this->bm->getAllWhere('leave_dates', 'leave_id', $v->leave_id,'leave_id');
			$i++;
		}
		echo json_encode($data);

	}

}