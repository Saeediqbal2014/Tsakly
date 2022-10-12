<?php
class Calender extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model("calendar_model");
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
        
	}
	public function index()
	{
		$data = array(
			'title' => 'Calender'
		);
		$this->load->view('template/header',$data);
		$this->load->view('template/nav');
		$this->load->view('calender/Calender');
		$this->load->view('template/footer');
		
	}

	public function add_event() 
	{
		$this->calendar_model->add_event(
			array(
				"title" => $this->input->post("title"),
				"start" => $this->input->post("start"),
				"end" => $this->input->post("end")
			)
		);

	}

	public function get_events()
 	{
		$start = $this->input->get("start");
		$end = $this->input->get("end");
		$events = $this->calendar_model->get_events($start, $end);

		$data_events = array();

		foreach($events->result() as $r) {

			$data_events[] = array(
				"title" => $r->title,
				"end" => $r->end,
				"start" => $r->start
			);
		}

		echo json_encode(array("events" => $data_events));
		exit();
	}


	public function edit_event() 
    {
		$id = $this->input->post("id");
		$event = $this->calendar_model->get_event($id);
		// print_r($event); die();
		// if($event->num_rows() == 0) {
		// 	echo"Invalid Event";
		// 	exit();
		// }
		$field = array(
			"title" => $this->input->post("title"),
			"start" => $this->input->post("start"),
			"end" => $this->input->post("end")
		);

		$this->calendar_model->update_event($id, $field);
	

    }
	
	public function delete_event(){
		$id = $this->input->post("id");
		// print_r($id); die();
		$this->calendar_model->delete_event($id);
	}


}