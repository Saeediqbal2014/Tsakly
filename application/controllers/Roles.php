<?php
class Roles extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') == null) {
			redirect('Login');
		} else {
			if ($this->session->userdata('user') != 1) {
				redirect('dashboard');
			}
		}
		$this->load->model('Basic_model', 'bm');
	}

	public function index()
	{
		$data = array(
			'title' => 'Roles',
			'roles' => $this->bm->getAll('roles', 'role_id')
		);
		$this->load->view('template/header', $data);
		$this->load->view('template/nav');
		$this->load->view('roles/index', $data);
		$this->load->view('template/footer');
	}

	public function insert_form()
	{
		$data = array(
			'title' => '	Create Role'
		);
		$this->load->view('template/header', $data);
		$this->load->view('template/nav');
		$this->load->view('roles/add');
		$this->load->view('template/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('role_name', 'role name', 'required|is_unique[roles.role_name]');
		if ($this->form_validation->run()) {
			$field = [
				'role_name' => $this->input->post('role_name')
			];
			$data = $this->bm->insert('roles', $field);
			if ($data > 0) {

				$arr = [];

				for ($i = 0; $i < count($this->input->post('label')); $i++) {
					$arr[$i] = [
						'p_label' => $this->input->post('label')[$i],
						'p_status' => $this->input->post('rank')[$i],
						'role_id' => $data
					];
				}
				// "<pre>";
				// print_r($arr); die();

				$this->bm->insert_batch('permissions', $arr);
				$this->session->set_flashdata('errorrole', 'New Role has been inserted successfully..!');
				redirect('roles');
			} else {
				$this->session->set_flashdata('errorrole', 'Something wrong');
				redirect('roles');
			}
		} else {
			//false  
			$this->insert_form();
		}
	}

	public function edit($id)
	{
		$arr = ['role_id' => $id];
		$data = [
			'title' => 'Edit Role',
			'edit' => $this->bm->getRow('roles', 'role_id', $id),
			'perm' => $this->bm->getRowsWithMultipleConditions('permissions', $arr)
		];
		
		$this->load->view('template/header', $data);
		$this->load->view('template/nav');
		$this->load->view('roles/edit', $data);
		$this->load->view('template/footer');
	}

	public function update()
	{
		$id = $this->input->post('id');
		$this->form_validation->set_rules('role_name', 'role name', 'required');
		if ($this->form_validation->run()) {
			$field = [
				'role_name' => $this->input->post('role_name')
			];
			// echo $id;
			// die();
			$data = $this->bm->update('roles', $field, 'role_id', $id);
			if ($data > 0) {
				$field1 = [
					'status_n' => $this->input->post('role_name')
				];
				$this->bm->update('users', $field1, 'status', $id);
				$this->bm->delete('permissions', 'role_id', $id);
				$arr = [];

				for ($i = 0; $i < count($this->input->post('label')); $i++) {
					$arr[$i] = [
						'p_label' => $this->input->post('label')[$i],
						'p_status' => $this->input->post('rank')[$i],
						'role_id' => $id
					];
				}
				// "<pre>";
				// print_r($arr); die();

				$this->bm->insert_batch('permissions', $arr);
				$this->session->set_flashdata('errorrole', 'Role has been updated successfully..!');
				redirect('roles');
			} else {
				$this->session->set_flashdata('errorrole', 'Something wrong');
				redirect('roles');
			}
		} else {
			//false  
			$this->edit($id);
		}
	}

	public function delete()
	{
		$id = $this->input->post('del');
		$data = array('title' => 'Delete Role');
		$this->bm->delete('roles', 'role_id', $id);
		$del = $this->bm->delete('permissions', 'role_id', $id);
		if ($del > 0) {
			$this->session->set_flashdata('errorrole', 'Role has been deleted successfully..!');
		} else {
			$this->session->set_flashdata('errorrole', 'Something wrong');
		}
		redirect('roles');
	}

	public function getPermissions()
	{
		$arr = ['role_id' => $this->input->post('id')];
		$data = $this->bm->getRowsWithMultipleConditions('permissions', $arr);
		
		echo json_encode($data);
	}
}
