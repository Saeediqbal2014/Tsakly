<?php
class Quotation extends CI_Controller
{
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
		date_default_timezone_set("Asia/Karachi");
	}

	public function index()
	{
	//    print_r($this->session->userdata("quot_add")); die();
		if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_create') == 1 || $this->session->userdata('quot_show') == 1 || $this->session->userdata('quot_p_show') == 1) {
			$data = array();
			$data['title'] = 'Quotations';
			$status = $this->session->userdata('status');
			$userid = $this->session->userdata('id');
			if ($status == 'admin_active' || $this->session->userdata('quot_show') == 1) {
				$data['qutation'] = $this->bm->get_quot();
			} else if ($this->session->userdata('quot_p_show') == 1) {
				$data['qutation'] = $this->bm->get_quot();
			}
			
			
			
		

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('quotation/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}


	public function insert_form()
	{
		$data = array(
			'title' => '	Create Quotaion',
			'users' => $this->bm->getAllWhere('users', 'status!=', '1', 'name', 'asc')
		);
		$this->load->view('template/header', $data);
		$this->load->view('template/nav');
		$this->load->view('quotation/add');
		$this->load->view('template/footer');
	}


	public function get_salary()
	{
		$id = $this->input->post("id");
		$r = $this->bm->salary($id);
		echo json_encode($r);
	}

	public function add()
	{
		$data = $this->input->post();

		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_create') == 1) {
			$this->form_validation->set_rules('name', 'project name', 'required|is_unique[projects.project_name]');
			$this->form_validation->set_rules('duration', 'Duration', 'required');
			$this->form_validation->set_rules('cname', 'Client Name', 'required');
			$this->form_validation->set_rules('contact', 'Contact No', 'required');
			$this->form_validation->set_rules('amnt', 'Amount', 'required');
			$this->form_validation->set_rules('prct', 'Percentage', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('users[]', 'Employees', 'required');
			if ($this->form_validation->run()) {
				$client = array(
					"name" => $data["cname"],
					"contact" => $data["contact"],
				);
				$cl_id = $this->bm->insert('clients', $client);
				$ar = array(
					"project_name" => $data["name"],
					"description" => $data["description"],
					"duration" => $data["duration"],
					"percentage" => $data["prct"],
					"client_id" => $cl_id,
					"users" => implode(',', $data["users"]),
					"amount" => $data["salary_amnt"],
					"total_amnt" => $data["amnt"],
					"status" => 0
				);

				if ($this->bm->add_quot($ar)) {
					$this->session->set_flashdata('msg', 'New Quotation has been created successfully..!');
					redirect('quotation');
				}
			} else {
				//false  
				$this->insert_form();
			}
		} else {
			redirect('dashboard');
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_edit') == 1) {
			$data = array();
			$data['title'] = 'Edit Quotation';
			$data['edit'] =  $this->bm->getRow('quotation', 'id', $id);
			$data['users'] =  $this->bm->getAllWhere('users', 'status!=', '1', 'name', 'asc');
			$data['client'] =  $this->bm->getAllWhere('clients', 'id', $data["edit"]->client_id, 'name', 'asc');
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('quotation/edit', $data);
			$this->load->view('template/footer');
			
			
			
		} else {
			redirect('dashboard');
		}
	}
	public function view($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('quot_show') == 1) {
			$data = array();
			$data['title'] = 'View Quotation';
			$data['edit'] =  $this->bm->getRow('quotation', 'id', $id);
			$data['client'] =  $this->bm->getAllWhere('clients', 'id', $data["edit"]->client_id, 'name', 'asc');
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('quotation/view', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function update()
	{
		$data = $this->input->post();

		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) {
			$this->form_validation->set_rules('name', 'project name', 'required');
			$this->form_validation->set_rules('duration', 'Duration', 'required');
			$this->form_validation->set_rules('amnt', 'Amount', 'required');
			$this->form_validation->set_rules('prct', 'Percentage', 'required');
			$this->form_validation->set_rules('cname', 'Client Name', 'required');
			$this->form_validation->set_rules('contact', 'Contact No', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('users[]', 'Employees', 'required');
			if ($this->form_validation->run()) {
				$client = array(
					"name" => $data["cname"],
					"contact" => $data["contact"],
				);

				$id = $data["quot_id"];
				$clid = $data["cl_id"];
				$ar = array(
					"project_name" => $data["name"],
					"description" => $data["description"],
					"duration" => $data["duration"],
					"percentage" => $data["prct"],
					"users" => implode(',', $data["users"]),
					"amount" => $data["salary_amnt"],
					"total_amnt" => $data["amnt"],
					"status" => 0
				);
				$this->bm->update('clients', $client, 'id', $clid);
				if ($data = $this->bm->update('quotation', $ar, 'id', $id)) {
					$this->session->set_flashdata('msg', 'Quotation has been Updated successfully..!');
					redirect('quotation');
				} else {
					$this->session->set_flashdata('errorproject', 'Something wrong');
					redirect('quotation');
				}
			} else {
				//false  
				$this->insert_form();
			}
		} else {
			redirect('dashboard');
		}
	}

	public function delete()
	{
		$id = $this->input->post('del');
		$data = array('title' => 'Delete Role');
		$this->bm->delete('quotation', 'id', $id);

		$this->session->set_flashdata('msg', 'Quotation has been deleted successfully..!');

		redirect('quotation');
	}
}
