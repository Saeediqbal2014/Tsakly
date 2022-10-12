<?php
class Users extends CI_Controller
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
	}

	public function index()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_show') == 1 || $this->session->userdata('user_create') == 1 || $this->session->userdata('user_add') == 1) {
			$data = array(
				'title' => 'All Users',
				'cat' => $this->bm->getAll('categories'),
				'users' => $this->bm->getAllWhere('users', 'status!=', 1, 'user_id'),
			);
			$i = 0;
			foreach ($data['users'] as $key => $v) {
				$data['user_projects'][$i] = $this->mm->getRow('pu.user_id', $v->user_id);
				$i++;
			}

			$data["skills"] = $this->db->get("skills")->result();
			// $data["skills"] = $this->db->query("SELECT * FROM users WHERE status !=1 ");
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('users/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function insert_form()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_create') == 1 || $this->session->userdata('user_add') == 1 ) {
			$data = array(
				'title' => 'Add User',
				'designation' => $this->bm->getAll('categories'),
				'types' => $this->bm->getAll('roles')
			);
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('users/add', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function add()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_create') == 1) {
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]');
			$this->form_validation->set_message('is_unique', 'The email already registered');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
			$this->form_validation->set_rules('designation', 'designation', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('time', 'user time', 'required');
			$this->form_validation->set_rules('salary', 'Salary', 'required');
			$this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
			$this->form_validation->set_rules('username', 'Name', 'required');
			$this->form_validation->set_rules('contact_no', 'Contact No', 'required');
			if ($this->form_validation->run()) {
				// print_r($this->validation_errors); die();
				$cat_id = $this->input->post('designation');
				$status = $this->input->post('status');
				$role = $this->bm->getRow('roles', 'role_id', $status);
				$newdb = $this->input->post('dob');
				$newDate = date("d-m", strtotime($newdb));
				// print_r($newdb); die();
				$field = array(
					'img' => '',
					'email' => $this->input->post('email'),
					'name' => '',
					'password' => $this->input->post('password'),
					'contact_no' => '',
					'dob' => '',
					'cat_id' => $cat_id,
					'status' => $status,
					'status_n' => $role->role_name,
					'designation' => $this->input->post('designation'),
					'salary' => $this->input->post('salary'),
					'user_time' => $this->input->post('time'),
					'dob' => $this->input->post('dob'),
					'birth_date' => $newDate,
					'name' => $this->input->post('username'),
					'contact_no' => $this->input->post('contact_no'),
				);
				$data = $this->bm->insert('users', $field);
				if ($data > 0) {

					$field2 = array('designation' => $this->input->post('designation'));
					$this->db->insert('designations', $field2);
					$this->session->set_flashdata('erroruser', 'New user has been inserted successfully..!');
					redirect('users');
				} else {
					$this->session->set_flashdata('erroruser', 'Something wrong');
					redirect('users');
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
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_edit') == 1) {
			$data = array(
				'title' => 'Edit User',
				'designation' => $this->bm->getAll('designations'),
				'cat' => $this->bm->getAll('categories'),
				'skills' => $this->bm->getAll('skills'),
				'edit' => $this->bm->getRow('users', 'user_id', $id),
				'types' => $this->bm->getAll('roles'),
				'uskills' => $this->bm->getAllWhere('user_skills', 'user_id', $id, 'user_id'),
				'qualification' => $this->bm->getAllWhere('user_qualification', 'user_id', $id, 'user_id')
			);
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('users/edit', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function update()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_edit') == 1) {
			$id = $this->input->post('id');
			$ex = $this->input->post('ex_detail');
			if ($ex == '0') {
				$this->form_validation->set_rules('email', 'email', 'required|valid_email');
				$this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
				$this->form_validation->set_rules('designation', 'designation', 'required');
				$this->form_validation->set_rules('status', 'status', 'required');
				$this->form_validation->set_rules('salary', 'Salary', 'required');
				$this->form_validation->set_rules('time', 'user time', 'required');
			} else {
				$this->form_validation->set_rules('email', 'email', 'required|valid_email');
				$this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
				$this->form_validation->set_rules('designation', 'designation', 'required');
				$this->form_validation->set_rules('status', 'status', 'required');
				$this->form_validation->set_rules('time', 'user time', 'required');
				$this->form_validation->set_rules('username', 'username', 'required');
				$this->form_validation->set_rules('contact_no', 'contact number', 'required|integer');
				$this->form_validation->set_rules('dob', 'dob', 'required');
				$this->form_validation->set_rules('address', 'address', 'required');
				$this->form_validation->set_rules('cnic', 'CNIC', 'required');
				// $this->form_validation->set_rules('category', 'category', 'required');
				$this->form_validation->set_rules('skills[]', 'skills', 'required');
				$this->form_validation->set_rules('degree[]', 'degree', 'required');
				$this->form_validation->set_rules('grade[]', 'grade', 'required');
				$this->form_validation->set_rules('year[]', 'passing year', 'required');
			}

			if ($this->form_validation->run()) {
				if (empty($_FILES['user_img']['name'])) {
					$user_img = '';
				} else {
					$img_name = rand() . '.jpg';
					$config['upload_path'] = 'uploads/users';
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['file_name'] = $img_name;
					$this->load->library('image_lib');
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('user_img')) {
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];
						//two compress image
						$configer =  array(
							'image_library'   => 'gd2',
							'source_image'    =>  $uploadData['full_path'],
							'maintain_ratio'  =>  TRUE,
							'width'           =>  100,
							'height'          =>  100,
						);
						$this->image_lib->clear();
						$this->image_lib->initialize($configer);
						$this->image_lib->resize();

						$user_img = $filename;
					}
				}

				$status = $this->input->post('status');
				$role = $this->bm->getRow('roles', 'role_id', $status);
				if ($ex == '0') {

					$field = array(
						'email' => $this->input->post('email'),
						'password' => $this->input->post('password'),
						'designation' => $this->input->post('designation'),
						'status' => $status,
						'status_n' => $role->role_name,
						'salary' => $this->input->post('salary'),
						'user_time' => $this->input->post('time')

					);
				} else {
					$field = array(
						'img' => $user_img,
						'email' => $this->input->post('email'),
						'name' => $this->input->post('username'),
						'cnic' => $this->input->post('cnic'),
						'salary' => $this->input->post('salary'),
						'password' => $this->input->post('password'),
						'contact_no' => $this->input->post('contact_no'),
						'dob' => $this->input->post('dob'),
						'cat_id' => $this->input->post('designation'),
						'address' => $this->input->post('address'),
						'status' => $status,
						'status_n' => $role->role_name,
						'user_time' => $this->input->post('time')
					);
					$this->bm->delete('user_skills', 'user_id', $id);
					$this->bm->delete('user_qualification', 'user_id', $id);
					$arr = array();
					for ($i = 0; $i < count($this->input->post('skills')); $i++) {

						$arr[$i] = array(
							'skill_name' => $this->input->post('skills')[$i],
							'user_id' => $id
						);
					}

					$arr1 = array();
					for ($i1 = 0; $i1 < count($this->input->post('degree')); $i1++) {
						$arr1[$i1] = array(
							'degree_name' => $this->input->post('degree')[$i1],
							'grade_or_cgpa' => $this->input->post('grade')[$i1],
							'passing_year' => $this->input->post('year')[$i1],
							'user_id' => $id
						);
					}

					$arr2 = array();
					$o2 = 0;
					for ($i2 = 0; $i2 < count($this->input->post('skills')); $i2++) {

						$o = 0;
						$Ow = $this->bm->getAll('skills');
						for ($k = 0; $k < count($Ow); $k++) {
							if ($Ow[$k]->is_skill_name == $this->input->post('skills')[$i2]) {
								$o = 1;
							}
						}
						if ($o == 0) {
							$arr2[$o2] = array(
								'is_skill_name' => $this->input->post('skills')[$i2],
							);
							$o2++;
						}
					}
					$this->bm->insert_batch('user_skills', $arr);
					$this->bm->insert_batch('user_qualification', $arr1);
					if (!empty($arr2)) {
						$this->db->insert_batch('skills', $arr2);
					}
				}

				$data = $this->bm->update('users', $field, 'user_id', $id);

				if ($data > 0) {

					$o = 0;
					$Ow = $this->bm->getAll('designations');
					for ($k = 0; $k < count($Ow); $k++) {
						if ($Ow[$k]->designation == $this->input->post('designation')) {
							$o = 1;
						}
					}
					if ($o == 0) {
						$arr3 = array('designation' => $this->input->post('designation'));
					}

					if (!empty($arr3)) {
						$this->db->insert('designations', $arr3);
					}


					$this->session->set_flashdata('erroruser', 'User has been updated successfully..!');
					redirect('users');
				} else {
					$this->session->set_flashdata('erroruser', 'Something wrong');
					redirect('users');
				}
			} else {
				//false
				$this->edit($id);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function delete()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_del') == 1) {
			$id = $this->input->post('id2');
			$data = array(
				'title' => 'Delete User',
				'del' => $this->bm->delete('users', 'user_id', $id)
			);
			$this->session->set_flashdata('erroruser', 'User has been deleted successfully..!');
			$this->index();
		} else {
			redirect('dashboard');
		}
	}

	public function view_details()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_showdeatails') == 1) {
			$id = $this->input->post('id');
			$data =  array();
			$data['user'] = $this->bm->getRow('users', 'user_id', $id);

			$arr = array('user_id' => $data['user']->user_id);
			$data['skills'] = $this->bm->getRowsWithMultipleConditions('user_skills', $arr);
			$data['qualification'] = $this->bm->getRowsWithMultipleConditions('user_qualification', $arr);
			$data['cat'] = $this->bm->getRow('categories', 'cat_id', $data['user']->cat_id);

			echo json_encode($data);
		} else {
			redirect('dashboard');
		}
	}

	public function getbycategory()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('user_searches') == 1) {
			$cat_id = $this->input->post('category');
			$data = array(
				'title' => 'All Users',
				'cat' => $this->bm->getAll('categories'),
				'users' => $this->bm->getAllWhere('users', 'cat_id', $cat_id, 'user_id'),
			);

			$data["skills"] = $this->db->get("skills")->result();

			if($cat_id && isset($_POST["skill"]) && $_POST["skill"] != "empty")
			{
				$query = $this->db->select("*")
										  ->from("users as u")
										  ->join("user_skills as us","us.user_id = u.user_id")
										  ->join("skills as s","s.is_skill_name = us.skill_name")
										  ->where("s.is_skill_id",$_POST["skill"])
										  ->where("u.cat_id",$cat_id)
										  ->where("u.cat_id !=",1)
										  ->get();
				$data["users"] = ($query->num_rows() > 0) ? $query->result() : FALSE;
			}elseif($cat_id)
			{
				$data["users"] = $this->bm->getAllWhere('users', 'cat_id', $cat_id, 'user_id');
			}elseif(isset($_POST["skill"]) && $_POST["skill"] != "empty")
			{
				$query = $this->db->select("*")
										  ->from("users as u")
										  ->join("user_skills as us","us.user_id = u.user_id")
										  ->join("skills as s","s.is_skill_name = us.skill_name")
										  ->where("s.is_skill_id",$_POST["skill"])
										  ->where("u.cat_id !=",1)
										  ->get();
				$data["users"] = ($query->num_rows() > 0) ? $query->result() : FALSE;
			}
			
			$i = 0;
			if(!empty($data['users']))
			{
				foreach ($data['users'] as $key => $v) {
					$data['user_projects'][$i] = $this->mm->getRow('pu.user_id', $v->user_id);
					$i++;
				}
			}
			

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('users/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}
}
