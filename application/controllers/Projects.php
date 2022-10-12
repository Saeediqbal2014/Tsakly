<?php
class Projects extends CI_Controller
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
		$this->load->library('email');
	}

	public function index()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_show') == 1 || $this->session->userdata('proj_p_show') == 1 || $this->session->userdata('proj_create') == 1) {
			$data = array();
			$data['title'] = 'All Projects';
			$status = $this->session->userdata('status');
			$userid = $this->session->userdata('id');
			$arr = array('count(project_task_id) as c');


            
           
			$commentsCount = array('count(subtask_comment_id) as com');

			if ($status == 'admin_active' || $this->session->userdata('proj_show') == 1) {
				$data['projects'] = $this->mm->getAllProjects('projects', 'project_id');


				// $data['proComment'] = $this->mm->getAllProComments('subtask_comments', 'subtask_comment_id');

				// $data['comments'] = $this->mm->getAllcomment();

				$comment1 = isset($data['proComment'][0]->project_subtask_id);
				
				$p = 0;



				foreach ($data['projects'] as $key => $v) {
					$data['pro_users'][$p] = $this->mm->getAll($v->project_id);
					$data['tasks'][$p][0] =  $this->bm->getrowSum('projects_tasks', $arr, 'project_id', $v->project_id);


                    $data['comments'][$p][0] = $this->mm->getAllComments($v->project_id);
                    // print_r($data['comments'][$p][0]); die();

					$p++;
				}

				
				


			} else if ($this->session->userdata('proj_p_show') == 1) {
				$data['projects'] = $this->mm->getAllProjectsUsers($userid);
				$p = 0;
				foreach ($data['projects'] as $key => $v) {
					$data['pro_users'][$p] = $this->mm->getAll($v->project_id);
					$data['tasks'][$p][0] =  $this->bm->getrowSum('projects_tasks', $arr, 'project_id', $v->project_id);
					 $data['comments'][$p][0] = $this->mm->getAllComments($v->project_id);
					$p++;
				}
			}


			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('projects/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function insert_form($id = null)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_add') == 1) {
			$data = array(
				'title' => 'Add Project',
				'users' => $this->bm->getAllWhere('users', 'status!=', '1', 'name', 'asc')
			);
			$data['edit'] =  $this->bm->getRow('quotation', 'id', $id);
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('projects/add', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function add()
	{

		$qid = $this->input->post("quot_id");


		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_create') == 1) {
			$config['upload_path']          = './uploads/projects/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['encrypt_name'] 		= TRUE;
	   
			$this->upload->initialize($config);

			$this->form_validation->set_rules('name', 'project name', 'required|is_unique[projects.project_name]');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('priority', 'priority', 'required');
			$this->form_validation->set_rules('budget', 'budget', 'required|min_length[1]');
			$this->form_validation->set_rules('startDate', 'start date', 'required');
			$this->form_validation->set_rules('endDate', 'end date', 'required');
			$this->form_validation->set_rules('notify_days', 'days ', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('users[]', 'Employees', 'required');
			if ($this->form_validation->run()) {

				
				$field = array(
					'project_name' => $this->input->post('name'),
					'project_budget' => $this->input->post('budget'),
					'start_date' => $this->input->post('startDate'),
					'end_date' => $this->input->post('endDate'),
					'notify_days' => $this->input->post('notify_days'),
					'description' => $this->input->post('description'),
					'project_status' => $this->input->post('priority'),
					'status_c_or_i' => $this->input->post('status')
				);
				require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
				$data = "Project has been added!";
				$pusher->trigger('my-channel', 'my-event', $data);
				
				$data = $this->bm->insert('projects', $field);

				if(!empty($_FILES["images"]["name"][0]))
				{
					$count = count($_FILES["images"]["name"]);
					for($i=0; $i < $count; $i++)
					{
						$name = $_FILES["images"]["name"][$i];
						if(move_uploaded_file($_FILES['images']['tmp_name'][$i],$config['upload_path'].$name))
						{
							$array = array(
									"img" 	     => $_FILES["images"]["name"][$i],
									"project_id" => $data);
							$add_images = $this->bm->insert('projects_images', $array);
							
							if(!$add_images)
							{
								$this->session->set_flashdata("errorproject","<div class='alert alert-danger'>Something Went Wrong While Uplaoding Images Please Try Again.</div>");
								redirect('projects');
							}
						}
						
					}
				}
				// $budget =  $this->input->post('budget');
				// $balance = $this->bm->getRow("balance", "id", 1);
				// $newbalance = (int)$balance->amount + (int)$budget;
				// $blnce_data = array("amount" => $newbalance);
				// $this->bm->update('balance', $blnce_data, 'id', $balance->id);
				if ($data > 0) {
					$arr = array();
					if (!empty($qid)) {
						// $this->bm->delete('quotation','id', $qid);
						$this->bm->update('quotation', array("status" => 1), 'id', $qid);
					}
					for ($i = 0; $i < count($this->input->post('users')); $i++) {
						$arr[$i] = array(
							'user_id' => $this->input->post('users')[$i],
							'project_id' => $data
						);
						$email_user = $this->bm->getRow('users', 'user_id', $this->input->post('users')[$i]);
						$this->email->from('technikalideas@gmail.com', 'Muhammad Ajmal');
						$this->email->to($email_user->email);

						$this->email->subject('New Project.');
						$this->email->message("You are added a new Project by " . $_SESSION["name"] . ". Please Visit your portal to check your Project thank you!");

						$this->email->send();
					}

					$this->bm->insert_batch('projects_users', $arr);
					$this->session->set_flashdata('errorproject', 'New project has been created successfully..!');
					redirect('projects');
				} else {
					$this->session->set_flashdata('errorproject', 'Something wrong');
					redirect('projects');
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
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) {
			$data = array();
			$data['title'] = 'Edit Project';
			$data['edit'] =  $this->bm->getRow('projects', 'project_id', $id);
			$data['users'] = $this->bm->getAllWhere('users', 'status!=', '1', 'user_id');
			$data['edit_user'] = $this->bm->getAllWhere('projects_users', 'project_id', $data['edit']->project_id, 'project_user_id');
			
			$query2 = $this->db->where("project_id",$id)->get("projects_images");
			$data["images"] = ($query2->num_rows() > 0) ? $query2->result() : 0;

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('projects/edit', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function update()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_edit') == 1) {
			$config['upload_path']          = './uploads/projects/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['encrypt_name'] 		= TRUE;
	   
			$this->upload->initialize($config);
			
			$id = $this->input->post('id');
			$this->form_validation->set_rules('name', 'project name', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			$this->form_validation->set_rules('priority', 'priority', 'required');
			if ($this->session->userdata('user') == 1) {
				$this->form_validation->set_rules('budget', 'budget', 'required|integer');
			}
			$this->form_validation->set_rules('startDate', 'start date', 'required');
			$this->form_validation->set_rules('endDate', 'end date', 'required');
			$this->form_validation->set_rules('notify_days', 'days ', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('users[]', 'Employees', 'required');

			if ($this->form_validation->run()) {
				$field = array(
					'project_name' => $this->input->post('name'),
					'project_budget' => $this->input->post('budget'),
					'start_date' => $this->input->post('startDate'),
					'end_date' => $this->input->post('endDate'),
					'notify_days' => $this->input->post('notify_days'),
					'description' => $this->input->post('description'),
					'project_status' => $this->input->post('priority'),
					'status_c_or_i' => $this->input->post('status')
				);
				// $budget =  $this->input->post('budget');
				// $balance = $this->bm->getRow("balance", "id", 1);

				// $prj = $this->bm->getRow("projects", 'project_id', $id);
				// $prev_amount = (int)$balance->amount - (int)$prj->project_budget;
				// $newbalance = (int)$prev_amount + (int)$budget;
				// $blnce_data = array("amount" => $newbalance);
				// $this->bm->update('balance', $blnce_data, 'id', $balance->id);



				$data = $this->bm->update('projects', $field, 'project_id', $id);
				if ($data > 0) {

					if(!empty($_FILES["images"]["name"][0]))
					{
						$count = count($_FILES["images"]["name"]);
						for($i=0; $i < $count; $i++)
						{
							$name = $_FILES["images"]["name"][$i];
							if(move_uploaded_file($_FILES['images']['tmp_name'][$i],$config['upload_path'].$name))
							{
								$array = array(
										"img" 	     => $_FILES["images"]["name"][$i],
										"project_id" => $id);
								$add_images = $this->bm->insert('projects_images', $array);
								
								if(!$add_images)
								{
									$this->session->set_flashdata("errorproject","<div class='alert alert-danger'>Something Went Wrong While Uplaoding Images Please Try Again.</div>");
									redirect('projects');
								}
							}
							
						}
					}
					$this->bm->delete('projects_users', 'project_id', $id);
					$arr = array();

					for ($i = 0; $i < count($this->input->post('users')); $i++) {
						$arr[$i] = array(
							'user_id' => $this->input->post('users')[$i],
							'project_id' => $id
						);
					}

					$this->bm->insert_batch('projects_users', $arr);
					$this->session->set_flashdata('errorproject', 'Project has been updated successfully..!');
					redirect('projects');
				} else {
					$this->session->set_flashdata('errorproject', 'Something wrong');
					redirect('projects');
				}
			} else {
				//false  
				$this->edit($id);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function delete($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_del') == 1) {


			// $balance = $this->bm->getRow("balance", "id", 1);

			// $prj = $this->bm->getRow("projects", 'project_id', $id);
			// $newbalance = (int)$balance->amount - (int)$prj->project_budget;
			// $blnce_data = array("amount" => $newbalance);
			// $this->bm->update('balance', $blnce_data, 'id', $balance->id);


			$data = array(
				'title' => 'Delete Project',
				'project_user_del' => $this->bm->delete('projects_tasks', 'project_id', $id),
				'project_user_del' => $this->bm->delete('projects_images', 'project_id', $id),
				'project_user_del' => $this->bm->delete('projects_subtasks', 'project_id', $id),
				'project_user_del' => $this->bm->delete('projects_users', 'project_id', $id),
				'project_del' => $this->bm->delete('projects', 'project_id', $id),
			);




			$this->session->set_flashdata('errorproject', 'Project has been deleted successfully..!');
			redirect('projects');
		} else {
			redirect('dashboard');
		}
	}

	public function view_details($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_show') == 1 || $this->session->userdata('proj_p_show') == 1) {
			$arr = array('count(project_task_id) as c');
			// $arr2 = array('count(subtask_comment_id) as c');
			$data = array(
				'title' => 'View Project Details',
				'projectID' => $id,
				'project' => $this->bm->getRow('projects', 'project_id', $id, 'project_id'),
				'emp' => $this->mm->getAll($id),
				'tasks' => $this->bm->getrowSum('projects_tasks', $arr, 'project_id', $id),
				// 'comments' => $this->bm->getrowSum('subtask_comments', $arr2, 'project_id', $id)
				// 'milestone' => $this->bm->getAllWhere('projects_milestone','project_id', $id,'project_milestone_id')
			);

			$query = $this->db->select("COUNT(subtask_comment_id) as c")
							  ->from("subtask_comments as sc")
							  ->join("projects_tasks as pt","sc.project_task_id = pt.project_task_id")
							  ->where("pt.project_id",$id)
							  ->get();
			$data["comments"] = ($query->num_rows() > 0) ? $query->result()[0]->c : 0;

			// echo"<pre>";
			// print_r($data['comments']);
			

			

			$query2 = $this->db->where("project_id",$id)->get("projects_images");
			$data["images"] = ($query2->num_rows() > 0) ? $query2->result() : 0;



			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('projects/view', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function project_leader($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_leader') == 1) {
			$user_id = $this->input->post('user_id');
			$conditions = array(
				'user_id' => $user_id,
				'project_id' => $id
			);
			$field = array(
				'user_role' => 1
			);
			$field1 = array(
				'user_role' => 0
			);
			$this->bm->update('projects_users', $field1, 'project_id', $id);
			$email_user = $this->bm->getRow('users', 'user_id', $user_id);
			$this->email->from('technikalideas@gmail.com', 'Muhammad Ajmal');
			$this->email->to($email_user->email);

			$this->email->subject('Project Leader.');
			$this->email->message("You are promoted by " . $_SESSION["name"] . ". You are now a project leader Please Visit your portal to check your Project thank you!");

			$this->email->send();
			$data = $this->mm->updateWithMultiConditions('projects_users', $field, $conditions);

			if ($data > 0) {
				echo "done";
			} else {
				echo "wrong";
			}
		} else {
			redirect('dashboard');
		}
	}

	public function insert_form_of_new_member($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_mu') == 1) {
			$data = array(
				'title' =>  'Add New Team Member',
				'id' => $id,
				'users' => $this->bm->getAllWhere('users', 'status!=', '1', 'user_id'),
				'edit_user' => $this->bm->getAllWhere('projects_users', 'project_id', $id, 'project_user_id')
			);

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('projects/new_member', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function add_team_member()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_mu') == 1) {
			$id = $this->input->post('id');
			$this->form_validation->set_rules('users[]', 'Employees', 'required');

			if ($this->form_validation->run()) {
				$this->bm->delete('projects_users', 'project_id', $id);
				$arr = array();

				for ($i = 0; $i < count($this->input->post('users')); $i++) {
					$arr[$i] = array(
						'user_id' => $this->input->post('users')[$i],
						'project_id' => $id
					);
					$email_user = $this->bm->getRow('users', 'user_id', $this->input->post('users')[$i]);
					$this->email->from('technikalideas@gmail.com', 'Muhammad Ajmal');
					$this->email->to($email_user->email);

					$this->email->subject('Team Member.');
					$this->email->message("You are added as a team member by " . $_SESSION["name"] . ". Please Visit your portal to check your Project thank you!");

					$this->email->send();
				}

				$data = $this->bm->insert_batch('projects_users', $arr);
				if ($data > 0) {
					$this->session->set_flashdata('errornewmember', 'Employees has been updated successfully..!');
					redirect('projects/view_details/' . $id);
				} else {
					$this->session->set_flashdata('errornewmember', 'Something wrong');
					redirect('projects/view_details/' . $id);
				}
			} else {
				//false  
				$this->insert_form_of_new_member($id);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function tasks($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1 || $this->session->userdata('task_add') == 1) {
			$data = array();
			if ($this->session->userdata('task_p_show') == 1) {
				$arr = array('ps.project_id' => $id, 'ps.user_id' => $this->session->userdata('id'));
				$data['tasks'] = $this->mm->getTasks($arr);
			} else if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1) {
				$arr = array('project_id' => $id);
				$data['tasks'] = $this->bm->getRowsWithMultipleConditions('projects_tasks', $arr);
			}
			$data['title'] = 'All task';
			$data['id'] = $id;

			if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1 || $this->session->userdata('subtask_p_show') == 1) {
				$i = 0;
				foreach ($data['tasks'] as $key => $v) {
					if ($this->session->userdata('subtask_p_show') == 1) {
						$arrs = array('project_task_id' => $v->project_task_id, 'user_id' => $this->session->userdata('id'));
					} else if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1) {
						$arrs = array('project_task_id' => $v->project_task_id);
					}

					$data['subtasks'][$i] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrs);
					$i++;
				}
			}

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('tasks/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function insert_form_of_new_task($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_add') == 1) {
			$arr = array('project_budget');
			$arr2 = array('SUM(task_milestone) as tasks_budget,count(project_task_id) as c');
			$data = array(
				'title' => 'Add new task',
				'id' => $id,
				'project_budget' => $this->bm->getrowSum('projects', $arr, 'project_id', $id),
				'tasks_budget' => $this->bm->getrowSum('projects_tasks', $arr2, 'project_id', $id)
			);
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('tasks/add', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function manage_tasks_budget($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_mb') == 1) {
			$arr = array('project_budget');
			$data = array(
				'title' => 'Manage Project Budget',
				'id' => $id,
				'tasks' => $this->bm->getAllWhere('projects_tasks', 'project_id', $id, 'project_task_id'),
				'project_budget' => $this->bm->getrowSum('projects', $arr, 'project_id', $id)
			);

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('tasks/manage', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function update_task_budget()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_mb') == 1) {
			$project_id = $this->input->post('project_id');

			$this->form_validation->set_rules('task_milestone[]', 'task milestone', 'required');

			if ($this->form_validation->run()) {
				$fields = array(
					'task_id' => $this->input->post('task_id'),
					'task_milestone' => $this->input->post('task_milestone')
				);

				$update = $this->mm->updateManageBudget('projects_tasks', $fields);
				if ($update > 0) {
					$this->session->set_flashdata('errormanagetask', 'Task budget manage successfully');
					redirect('projects/tasks/' . $project_id);
				} else {
					$this->session->set_flashdata('errormanagetask', 'Connection Timeout..!');
					redirect('projects/tasks/' . $project_id);
				}
			} else {
				//false  
				$this->manage_tasks_budget($project_id);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function add_task()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_add') == 1) {
			$id = $this->input->post('id');
			$rev = $this->input->post('Revised');
			$this->form_validation->set_rules('title', 'task title', 'required');
			if ($rev == 1) {
			} else {
				$this->form_validation->set_rules('milestone', 'task milestone', 'required');
			}
			$this->form_validation->set_rules('due_date', 'task due date', 'required');
			$this->form_validation->set_rules('priority', 'task priority', 'required');
			$this->form_validation->set_rules('description', 'task description', 'required');
			if ($this->form_validation->run()) {

				if ($rev == 1) {
					$arr = array('project_budget');
					$project_budget = $this->bm->getrowSum('projects', $arr, 'project_id', $id);
					$data = $this->bm->getAllWhere('projects_tasks', 'project_id', $id, 'project_task_id');
					$c = count($data) + 1;
					$per_task = $project_budget->project_budget / $c;

					$milestone = array(
						'task_milestone' => $per_task
					);

					// echo $per_task*$c;
					foreach ($data as $key1 => $v1) {
						$this->bm->update('projects_tasks', $milestone, 'project_task_id', $v1->project_task_id);
					}
				} else {
					$per_task = $this->input->post('milestone');
				}

				$field = array(
					'task_title' => $this->input->post('title'),
					'task_milestone' => $per_task,
					'task_due_date' => $this->input->post('due_date'),
					'task_priority' => $this->input->post('priority'),
					'task_description' => $this->input->post('description'),
					'project_id' => $id
				);

				require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Task has been added!";
					$pusher->trigger('my-channel', 'my-event', $data);

				$data = $this->bm->insert('projects_tasks', $field);
				$proj_users = $this->bm->getAllWhere('projects_users', 'project_id', $id, 'project_user_id');
				foreach ($proj_users as $pro) {
					$email_user = $this->bm->getRow('users', 'user_id', $pro->user_id);
					$this->email->from('technikalideas@gmail.com', 'Muhammad Ajmal');
				// 	print_r($email_user); die();
					$this->email->to($email_user->email);

					$this->email->subject('New Task.');
					$this->email->message("<p>New Task Added by <b>" . $_SESSION["name"] . "</b>. <br/> Please Visit your portal to check your task thank you!</p>");

					$this->email->send();
				}

				if ($data > 0) {
					$this->session->set_flashdata('errortask', 'Task has been created successfully..!');
					redirect('projects/tasks/' . $id);
				} else {
					$this->session->set_flashdata('errortask', 'Something wrong');
					redirect('projects/tasks/' . $id);
				}
			} else {
				//false  
				$this->insert_form_of_new_task($id);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function task_edit($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_edit') == 1) {
			$arr = array('project_budget');
			$data = array(
				'title' => 'Edit task',
				'id' => $id,
				'edit' =>  $this->bm->getRow('projects_tasks', 'project_task_id', $id),
				// 'tasks' => $this->bm->getAllWhere('projects_tasks','project_id', $id,'project_task_id'),
				'project_budget' => $this->bm->getrowSum('projects', $arr, 'project_id', $id)
			);

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('tasks/edit', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function task_update()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_edit') == 1) {
			$id = $this->input->post('id');
			$project_id = $this->input->post('project_id');
			$this->form_validation->set_rules('title', 'task title', 'required');
			$this->form_validation->set_rules('milestone', 'task milestone', 'required');
			$this->form_validation->set_rules('due_date', 'task due date', 'required');
			$this->form_validation->set_rules('priority', 'task priority', 'required');
			$this->form_validation->set_rules('description', 'task description', 'required');
			if ($this->form_validation->run()) {
				$field = array(
					'task_title' => $this->input->post('title'),
					'task_milestone' => $this->input->post('milestone'),
					'task_due_date' => $this->input->post('due_date'),
					'task_priority' => $this->input->post('priority'),
					'task_description' => $this->input->post('description')
				);
				$data = $this->bm->update('projects_tasks', $field, 'project_task_id', $id);
				if ($data > 0) {
					$this->session->set_flashdata('errortask', 'task has been updated successfully..!');
					redirect('projects/tasks/' . $project_id);
				} else {
					$this->session->set_flashdata('errortask', 'Something wrong');
					redirect('projects/tasks/' . $project_id);
				}
			} else {
				//false  
				$this->task_edit($id);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function task_delete()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_del') == 1) {
			$id = $this->input->post('id');
			$del = $this->input->post('del');
			$data = array(
				'title' => 'Delete Project',
				'project_del_task' => $this->bm->delete('projects_tasks', 'project_task_id', $del),
				'project_del_subtask' => $this->bm->delete('projects_subtasks', 'project_task_id', $del)
			);
			$this->session->set_flashdata('errortask', 'Task has been deleted successfully..!');
			$this->tasks($id);
		} else {
			redirect('dashboard');
		}
	}

	public function task_view($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) {
			$data = array(
				'title' => 'Task Details',
				'task' => $this->bm->getRow('projects_tasks', 'project_task_id', $id)
			);
			// print_r($data); die();

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('tasks/view', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function insert_form_of_new_subtask($id, $project_id)
	{

		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_add') == 1) {
			$arr = array('task_milestone');
			$arr2 = array('SUM(subtask_milestone) as subtasks_budget,count(project_subtask_id) as c');
			$arr3 = array('pu.project_id' => $project_id);
			// print_r($arr3); die();
			$data = array(
				'title' => 'Add new subtask',
				'task_id' => $id,
				'project_id' => $project_id,
				'taskDetails' => $this->mm->gettaskDueDate($id),
				// 'users' => $this->bm->getAllWhere('users','status',0,'user_id'),
				'project_users' => $this->mm->get_project_users($arr3),
				'task_budget' => $this->bm->getrowSum('projects_tasks', $arr, 'project_task_id', $id),
				'subtask_budget' => $this->bm->getrowSum('projects_subtasks', $arr2, 'project_task_id', $id)
			);
			// print_r($data['project_users']); die();
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('subtask/add');
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function add_subtask()
	{ 


		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_add') == 1) {
			$taskid = $this->input->post('task_id');
			$projectid = $this->input->post('project_id');
			$rev = $this->input->post('Revised'); 
			// $this->form_validation->set_rules('toDate', 'to Date', 'required');
			$this->form_validation->set_rules('title', 'task title', 'required');

			
			if ($rev == 1) {
			} else {

				$this->form_validation->set_rules('milestone', 'task milestone', 'required');
			}

			$this->form_validation->set_rules('due_date', 'task due date', 'required');
			$this->form_validation->set_rules('priority', 'task priority', 'required');
			$this->form_validation->set_rules('description', 'task description', 'required');
			$this->form_validation->set_rules('users', 'Employee', 'required');


			if ($this->form_validation->run()) {
                // $this->validation->errors 	         
				if ($rev == 1) {
						
					$arr = array('task_milestone');
					$task_budget = $this->bm->getrowSum('projects_tasks', $arr, 'project_task_id', $taskid);
					$data = $this->bm->getAllWhere('projects_subtasks', 'project_task_id', $taskid, 'project_subtask_id');
					$c = count($data) + 1;
					$per_task = $task_budget->task_milestone / $c;

					$milestone = array(
						'subtask_milestone' => $per_task
					);

					



					// echo $per_task*$c;
					foreach ($data as $key1 => $v1) {
						$this->bm->update('projects_subtasks', $milestone, 'project_subtask_id', $v1->project_subtask_id);
					}
				} else {
					$per_task = $this->input->post('milestone');
				}

				$field = array(
					'subtask_title' => $this->input->post('title'),
					'subtask_milestone' => $per_task,
					'subtask_due_date' => $this->input->post('due_date'),
					'start_at' => date("m/d/Y"),
					'subtask_priority' => $this->input->post('priority'),
					'subtask_description' => $this->input->post('description'),
					'user_id' => $this->input->post('users'),
					'project_task_id' => $taskid,
					'project_id' => $projectid
				);
				require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask has been added!";
					$pusher->trigger('my-channel', 'my-event', $data);
				$data = $this->bm->insert('projects_subtasks', $field);


				if ($data > 0) {
					// if ($this->session->userdata('user') != 1) {
					$notif = array(

						'noti_type' => "subtask",
						'related_id' => $data,
						'noti_by' => $_SESSION["name"],
						'assign_to' => $this->input->post('users'),
						'msg' => "new Subtask assigned to you please check it.",

					);
					$this->bm->insert('notifications', $notif);
					$u_id = $this->input->post('users');

					$email_user = $this->bm->getRow('users', 'user_id', $u_id);

					$this->email->from('technikalideas@gmail.com', 'Muhammad Ajmal');
					$this->email->to($email_user->email);

					$this->email->subject('New Subtask Added.');
					$this->email->message('New Subtask Added by ' . $_SESSION["name"] . '. Please Visit your portal to check your task thank you!');

					$this->email->send();
					// }
					$this->session->set_flashdata('errortask', 'Subtask has been created successfully..!');
					redirect('projects/tasks/' . $projectid);
				} else {
					$this->session->set_flashdata('errortask', 'Something wrong');
					redirect('projects/tasks/' . $projectid);
				}
			} else {
				//false  
				        
				$this->insert_form_of_new_subtask($taskid, $projectid);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function manage_subtasks_budget($id, $projectid)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_mb') == 1) {
			$arr = array('task_milestone');
			$data = array(
				'title' => 'Manage Task Budget',
				'id' => $id,
				'project_id' => $projectid,
				'subtasks' => $this->bm->getAllWhere('projects_subtasks', 'project_task_id', $id, 'project_subtask_id'),
				'task_budget' => $this->bm->getrowSum('projects_tasks', $arr, 'project_task_id', $id)
			);

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('subtask/manage', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function update_subtask_budget()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_mb') == 1) {
			$task_id = $this->input->post('task_id');
			$project_id = $this->input->post('project_id');

			$this->form_validation->set_rules('subtask_milestone[]', 'task milestone', 'required');

			if ($this->form_validation->run()) {
				$fields = array(
					'subtask_id' => $this->input->post('subtask_id'),
					'subtask_milestone' => $this->input->post('subtask_milestone')
				);

				$update = $this->mm->updateManagesubBudget('projects_subtasks', $fields);
				if ($update > 0) {
					$this->session->set_flashdata('errortask', 'Subtask budget manage successfully ');
					redirect('projects/tasks/' . $project_id);
				} else {
					$this->session->set_flashdata('errormanagetask', 'Connection Timeout..!');
					redirect('projects/manage_subtasks_budget/' . $task_id . '/' . $project_id);
				}
			} else {
				//false  
				$this->manage_subtasks_budget($task_id, $project_id);
			}
		} else {
			redirect('dashboard');
		}
	}



	public function subtask_edit($id, $project_id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_edit') == 1) {
			$arr = array('pu.project_id' => $project_id);
			$data = array(
				'title' => 'Edit Subtask',
				'tasks' => $project_id,
				'edit' =>  $this->bm->getRow('projects_subtasks', 'project_subtask_id', $id),
				'project_users' => $this->mm->get_project_users($arr)
			);

			// print_r($data);exit();
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('subtask/edit', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function subtask_update()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_edit') == 1) {
			$id = $this->input->post('id');
			$projectid = $this->input->post('project_id');
			$this->form_validation->set_rules('title', 'task title', 'required');
			$this->form_validation->set_rules('milestone', 'task milestone', 'required');
			$this->form_validation->set_rules('due_date', 'task due date', 'required');
			$this->form_validation->set_rules('priority', 'task priority', 'required');
			$this->form_validation->set_rules('description', 'task description', 'required');
			$this->form_validation->set_rules('users', 'Employee', 'required');
			if ($this->form_validation->run()) {
				$field = array(
					'subtask_title' => $this->input->post('title'),
					'subtask_milestone' => $this->input->post('milestone'),
					'subtask_due_date' => $this->input->post('due_date'),
					'subtask_priority' => $this->input->post('priority'),
					'subtask_description' => $this->input->post('description'),
					'user_id' => $this->input->post('users')
				);
				$data = $this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
				if ($data > 0) {
					$this->session->set_flashdata('errortask', 'Subtask has been updated successfully..!');
					redirect('projects/tasks/' . $projectid);
				} else {
					$this->session->set_flashdata('errortask', 'Something wrong');
					redirect('projects/tasks/' . $projectid);
				}
			} else {
				//false  
				$this->subtask_edit($id, $projectid);
			}
		} else {
			redirect('dashboard');
		}
	}

	public function subtask_delete()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_del') == 1) {
			$id = $this->input->post('id');
			$del = $this->input->post('del');
			$data = array(
				'title' => 'Delete Subtask',
				'project_del_subtask' => $this->bm->delete('projects_subtasks', 'project_subtask_id', $del)
			);
			$this->session->set_flashdata('errortask', 'Subtask has been deleted successfully..!');
			redirect("projects/tasks/" . $id);
		} else {
			redirect('dashboard');
		}
	}

	public function subtask_view($id, $projectid)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1 || $this->session->userdata('subtask_p_show') == 1) {
			$data = array(
				'title' => 'Subtask Details',
				'projectid' => $projectid,
				'subtask' => $this->bm->getAllWhere('projects_subtasks', 'project_subtask_id', $id, 'project_subtask_id'),
			);
			
            if($data['subtask'] != "" || $data['subtask'][0] != ""){
                $data['subtask_user'] = $this->bm->getAllWhere('users', 'user_id', $data['subtask'][0]->user_id, 'user_id');
            }else{
              echo "This subtask user has been removed or deleted!";  
            }
            // print_r($data); die();
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('subtask/view', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function task_comments()
	{
		$id = $this->input->post('id');


		$data = $this->mm->getUsersComents('project_task_id', $id);
       
		echo json_encode($data);
	}

	public function subtask_comments()
	{
		$id = $this->input->post('id');
		$data = $this->mm->getUsersSubTaskComents('project_subtask_id', $id);
		echo json_encode($data);
	}
	
	
	public function subtask_comments_insert()
	{
		 $image = $_FILES['file'];
	    
	    $img = '';
	    
	    if(@$image['name'] != '')
	    {
	        
	        $img = $this->bm->uploadFile($image,'uploads/subtask_comments');
	        
	    }
		
		date_default_timezone_set('Asia/Karachi');
		
		$field = [
		
			'project_subtask_id' => $this->input->post('id'),
			'project_task_id' => $this->input->post('project_task_id'),
			'user_id' => $this->session->userdata('id'),
			'description' => $this->input->post('comment'),
			'dateTime' => date('d-m-Y h:i:sa'),
			'file' => $img
			
		];
		
		$this->bm->insert('subtask_comments', $field);
		return true;
		
	}
	// public function task_comments()
	// {
	// 	$id = $this->input->post('id');
	// 	$data = $this->mm->getUsersComents('project_subtask_id', $id);


	// 	echo json_encode($data);
	// }

    public function download_comment_files($id)
    {
        
        $this->load->helper('download');
        
        $fileinfo = $this->bm->getRow('subtask_comments', 'subtask_comment_id', $id);
        
        $file = $fileinfo->file;
        
        force_download($file, NULL);
        
	}
	
	public function task_comments_insert()
	{
	    
	    $image = $_FILES['file'];
	    
	    $img = '';
	    
	    if(@$image['name'] != '')
	    {
	        
	        $img = $this->bm->uploadFile($image,'uploads/task_comments');
	        
	    }
		
		date_default_timezone_set('Asia/Karachi');
		
		$field = [
		
			'project_task_id' => $this->input->post('id'),
			'user_id' => $this->session->userdata('id'),
			'description' => $this->input->post('comment'),
			'dateTime' => date('d-m-Y h:i:sa'),
			'file' => $img
			
		];
		
		$this->bm->insert('subtask_comments', $field);
		return true;
		
	}
	public function subtask_status()
	{
		$id = $this->input->post('id');
		$data = $this->bm->getRow('projects_subtasks', 'project_subtask_id', $id);
		echo json_encode($data);
	}

	public function change_subtask_status()
	{
		$id = $this->input->post('id');
		$st = $this->input->post('st');
		$field = [
			'subtask_status_by' => '1',
			'coordinator_status' => '0',
			'admin_status' => '0',
			'subtask_status' => $st,
			'subtask_status_by_name' => $this->session->userdata('name')
		];
		        	
		$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
	}

	public function change_subtask_status_by_coordinator($id, $projectid, $st)
	{
		if ($st == 'rej') {
			$field = [
				'subtask_status_by' => '20',
				'employee_status' => '0',
				'admin_status' => '0',
				'subtask_status' => '',
				'subtask_status_by_name' => $this->session->userdata('name')
			];
		    	require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Rejected by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$n = $this->session->userdata('name');
			$this->session->set_flashdata('errorsubtaskview', $n . ' has been rejected the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		} else {
			$field = [
				'subtask_status_by' => '2',
				'employee_status' => '0',
				'admin_status' => '0',
				'subtask_status' => 'completed',
				'subtask_status_by_name' => $this->session->userdata('name')
			];
			require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Approved by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$n = $this->session->userdata('name');
			$this->session->set_flashdata('errorsubtaskview', $n . ' has been approved the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		}
		die();
	}

	public function change_subtask_status_by_admin($id, $projectid, $st , $name)
	{
		if ($st == 'rej') {
			$field = [
				'subtask_status_by' => '30',
				'employee_status' => '0',
				'coordinator_status' => '0',
				'subtask_status' => '',
				'subtask_status_by_name' => $this->session->userdata('name')

			];
			require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Rejected by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$this->session->set_flashdata('errorsubtaskview',  $name . ' has been rejected the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		} else {
			$field = [
				'subtask_status_by' => '3',
				'employee_status' => '0',
				'coordinator_status' => '0',
				'subtask_status' => 'completed',
				'subtask_status_by_name' => $this->session->userdata('name')

			];
			require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Approved by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$this->session->set_flashdata('errorsubtaskview', $name . ' has been approved the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		}
		die();
	}


	public function change_subtask_status1($id, $projectid, $st , $name)
	{
		if ($st == 'rej') {
			$field = [
				'subtask_status_by' => '90',
				'employee_status' => '0',
				'coordinator_status' => '0',
				'subtask_status' => '',
				'subtask_status_by_name' => $this->session->userdata('name')

			];
			require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Rejected by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$this->session->set_flashdata('errorsubtaskview',  $name . ' has been rejected the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		} else {
			$field = [
				'subtask_status_by' => '60',
				'employee_status' => '0',
				'coordinator_status' => '0',
				'subtask_status' => 'completed',
				'subtask_status_by_name' => $this->session->userdata('name')

			];
			require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Approved by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$this->session->set_flashdata('errorsubtaskview', $name . ' has been approved the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		}
		die();
	}


	public function change_subtask_status2($id, $projectid, $st , $name)
	{
		if ($st == 'rej') {
			$field = [
				'subtask_status_by' => '20',
				'employee_status' => '0',
				'coordinator_status' => '0',
				'subtask_status' => '',
				'subtask_status_by_name' => $this->session->userdata('name')

			];
			require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Rejected by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$this->session->set_flashdata('errorsubtaskview',  $name . ' has been rejected the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		} else {
			$field = [
				'subtask_status_by' => '10',
				'employee_status' => '0',
				'coordinator_status' => '0',
				'subtask_status' => 'completed',
				'subtask_status_by_name' => $this->session->userdata('name')

			];
			 require APPPATH . 'views/vendor/autoload.php';

					$options = array(
					  'cluster' => 'us2',
					  'useTLS' => true
					);
					$pusher = new Pusher\Pusher(
					  '7fbdecba1e9ae72cccd1',
					  '0387b9da491d8a31fd19',
					  '1245173',
					  $options
					);
				  
					$data = "Subtask Approved by ".$this->session->userdata('name');
					$pusher->trigger('my-channel', 'my-event', $data);
			$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
			$this->session->set_flashdata('errorsubtaskview', $name . ' has been approved the subtask work');
			redirect('projects/subtask_view/' . $id . '/' . $projectid);
		}
		die();
	}



	public function complete_subtask($id, $p_id, $sender_id)
	{


		$result = $this->mm->fetch_user_email($sender_id);
        
		$sender_email = $result[0]['email'];
        
		$result1 = $this->mm->fetch_project_leader_email($p_id);
        // print_r($p_id); die();
		$leader_email = $result1[0]['email'];

		$result2 = $this->mm->fetch_admin_email();
        
		$admin_email = $result2[0]['email'];




		$this->email->from($sender_email);
		$this->email->to($leader_email);

		$this->email->subject('Subtask is Complete');
		$this->email->message('SubTask is complete  from' . $sender_email);

		$this->email->send();



		$this->email->from($sender_email);
		$this->email->to($admin_email);

		$this->email->subject('Subtask is Complete');
		$this->email->message('SubTask is complete  from' . $sender_email);

		$this->email->send();



		$field = [
			'employee_status' => '0',
			'admin_status' => '0',
			'subtask_status' => 'completed',
			'subtask_priority' => 'complete',
			'complete_at' => date('m-d-Y'),
			'subtask_status_by_name' => $this->session->userdata('name')
		];
		$this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
		redirect("projects/tasks/" . $p_id);
	}

	public function DeleteImage()
	{
		if(isset($_POST["action"]) && $_POST["action"] == "DelImage")
		{
			$pm_id = $_POST["pm_id"];
			$delete = $this->db->query("DELETE FROM projects_images WHERE pm_id = $pm_id ");
			echo ($delete) ? "success" : "false";
		}
	}
	
	function delete_comments($id)
	{
	    
	    $this->bm->delete('subtask_comments', 'subtask_comment_id', $id);
	    return true;
	    
	}
}
