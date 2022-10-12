<?php
class Reports extends CI_Controller
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

	public function index($data = '')
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			if ($data == null) {
				$data = array();
			}
			$data['title'] = 'Reports';
			$data['users'] = $this->bm->getAllWhere('users', 'status!=', '1', 'name', 'asc');
			$data['reports'] = $this->mm->getUsersReports();
			$data['types'] = $this->bm->getAll('roles');
			$i = 0;
			foreach ($data['reports'] as $key => $v) {
				$data['r_descriptions'][$i] = $this->bm->getAllWhere('r_descriptions', 'report_id', $v->report_id, 'report_id');
				$i++;
			}

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function new_report()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_create') == 1) {

			$data = array(
				'title' => 'Submit New Report'
			);
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/add');
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function insert_new_report()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_create') == 1) {
			$this->form_validation->set_rules('report_date', 'date', 'required');
			$this->form_validation->set_rules('from_time', 'time', 'required');
			$this->form_validation->set_rules('to_time', 'time', 'required');
			$this->form_validation->set_rules('editor1[]', 'report description', 'required');
			$this->form_validation->set_rules('report_status[]', 'report status', 'required');
			if ($this->form_validation->run()) {
				//attendance
				$uid = $this->session->userdata('id');
				$getRow = $this->bm->getAllWhere('attendance', 'user_id', $uid, 'attendance_id', 'desc', 1);
				if ($getRow != null) {
					$lastdate = date('Y-m-d', strtotime($getRow[0]->attendance_datetime));
					$curdate = date('Y-m-d');

					$arr = [];
					$from = strtotime($lastdate);
					$to = strtotime($curdate);
					for ($currentDate = $from; $currentDate < $to; $currentDate += (86400)) {
						$date = date('Y-m-d', $currentDate);
						$day = strtolower(date('l', strtotime($date)));
						if ($day == 'sunday') {
							$arr[] = [
								'lates' => '0',
								'absent' => '0',
								'leave_' => '0',
								'holiday' => $day,
								'attendance_datetime' => $date,
								'user_id' => $uid
							];
						} else if ($date != $lastdate) {
							$check = ['from_date<=' => date('m/d/Y', strtotime($date)), 'to_date>=' => date('m/d/Y', strtotime($date)), 'user_id' => $uid, 'leave_status' => '1'];
							$leaves = $this->bm->getRowsWithMultipleConditions('leaves', $check);
							if ($leaves != null) {
								$check1 = ['leave_date' => date('d-m-Y', strtotime($date)), 'leave_id' => $leaves[0]->leave_id];
								$leave_dates = $this->bm->getRowsWithMultipleConditions('leave_dates', $check1);
								if ($leave_dates[0]->leave_date_status == 1) {
									$arr[] = [
										'lates' => '0',
										'absent' => '0',
										'leave_' => '1',
										'holiday' => '',
										'attendance_datetime' => $date,
										'user_id' => $uid
									];
								} else {
									$arr[] = [
										'lates' => '0',
										'absent' => '1',
										'leave_' => '0',
										'holiday' => '',
										'attendance_datetime' => $date,
										'user_id' => $uid
									];
								}
							} else {
								$arr[] = [
									'lates' => '0',
									'absent' => '1',
									'leave_' => '0',
									'holiday' => '',
									'attendance_datetime' => $date,
									'user_id' => $uid
								];
							}
						}
					}
					if ($arr != null) {
						$this->bm->insert_batch('attendance', $arr);
					}
				}

				$user = $this->bm->getRow('users', 'user_id', $uid);
				$time = date("h:i", strtotime('+10 minutes', strtotime($user->user_time)));
				$close_time = strtotime($this->input->post('from_time'));
				if (strtotime($time) >= $close_time) {
					$total_count = '0';
				} else {
					$open_time = strtotime($user->user_time);
					$output = [];
					$l = 0;
					for ($i = $open_time; $i < $close_time; $i += 1800) {
						$output[$l] = date("H:i", $i);
						$l++;
					}

					$total_count = count($output);
				}

				$field = [
					'time_1' => $this->input->post('from_time'),
					'time_2' => $this->input->post('to_time'),
					'lates' => $total_count,
					'attendance_datetime' => date('Y-m-d'),
					'user_id' => $uid
				];

				$datas = $this->bm->getAllWhere('attendance', 'user_id', $uid, 'attendance_id');
				if ($datas != null) {
					foreach ($datas as $v) {
						if (date('d-m-Y', strtotime($v->attendance_datetime)) == date('d-m-Y')) {
							$i = 1;
							break;
						} else {
							$i = 0;
						}
					}
				}
				if ($i != 1) {
					$this->bm->insert('attendance', $field);
				}
				//attendance

				$field = array(
					'report_date' => $this->input->post('report_date'),
					'from_time' => $this->input->post('from_time'),
					'to_time' => $this->input->post('to_time'),
					'user_id' => $uid,
					'insert_datetime' => date('d-m-Y h:i:s')
				);
				$data = $this->bm->insert('reports', $field);
				if ($data > 0) {
					$arr = array();
					for ($i = 0; $i < count($this->input->post('report_status')); $i++) {
						$arr[$i] = array(
							'report_description' => $this->input->post('editor1')[$i],
							'report_status' => $this->input->post('report_status')[$i],
							'report_id' => $data
						);
					}

					$this->bm->insert_batch('r_descriptions', $arr);
					$this->session->set_flashdata('errorreport', 'New report has been inserted successfully..!');
					redirect('reports/new_report');
				} else {
					$this->session->set_flashdata('errorreport', 'Something wrong');
					redirect('Reports/new_report');
				}
			} else {
				//false  
				$this->new_report();
			}
		} else {
			redirect('dashboard');
		}
	}

	public function get_selected_Status_Users()
	{
		$id = $this->input->post('id');
		$data = $this->bm->getAllWhere('users', 'status', $id, 'user_id');
		echo json_encode($data);
	}

	public function getusersHours()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_wh') == 1) {
			$this->form_validation->set_rules('startDate', 'startDate', 'required');
			$this->form_validation->set_rules('endDate', 'endDate', 'required');
			$this->form_validation->set_rules('status', 'status', 'required');
			if ($this->form_validation->run()) {
				$status_user = $this->input->post('sel_user');
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');

				if ($status_user == null) {
					$getUsers = $this->input->post('status');
					$data = $this->bm->getAllWhere('users', 'status', $getUsers, 'user_id');
				} else {
					$getUsers = $this->input->post('sel_user');
					$data = $this->bm->getAllWhere('users', 'user_id', $getUsers, 'user_id');
				}



				$i = 0;
				foreach ($data as $key => $v) {
					$arr = array(
						'rep.report_date>=' => $startDate,
						'rep.report_date<=' => $endDate,
						'rep.user_id' => $v->user_id
					);
					$user_reports['reports'][$i] = $this->mm->getUserHours($arr);
					$i++;
				}
				$user_reports = array_map('array_filter', $user_reports);
				$user_reports = array_values($user_reports['reports']);

				$c = 0;
				foreach ($user_reports as $key => $v) {
					foreach ($v as $key1 => $v2) {
						$from = new DateTime($v2->from_time);
						$to = new DateTime($v2->to_time);
						$interval = $from->diff($to);
						$t = $interval->format('%H:%I:%S');

						$mydata[$c] = (object) array(
							'user_id' => $v2->user_id,
							'tothrs' => $t
						);
						$array_count_values[$c] = $mydata[$c]->user_id;
						$c++;
						# code...
					}
				}
				// print_r($array_count_values);
				if (@$array_count_values == null) {
					$data['report_users'] = '';
					$data['total_hours'] = '';
				} else {
					$array_count_values2 = array_count_values($array_count_values);

					$array_keys = array_keys($array_count_values2);

					$array_values = array_values($array_count_values2);


					$arr = 0;
					$data = array();
					foreach ($mydata as $key => $v) {

						for ($i = 0; $i < count($mydata); $i++) {
							// echo "hello";
							$a = @$array_keys[$arr];
							if ($a == $mydata[$i]->user_id) {
								$t = strtotime($mydata[$i]->tothrs);
								@$data['total_hours'][$arr] += ($t) + 60 * 30;
							}
						}

						$arr++;
					}

					$ui = 0;
					foreach ($array_keys as $key => $v) {
						$data['report_users'][$ui] = $this->bm->getrowSum('users', '*', 'user_id', $v);
						$ui++;
					}
				}

				$this->session->set_flashdata('errorreportsheet', 'Something wrong');
				$this->index($data);
			} else {

				$this->index();
			}
		} else {
			redirect('dashboard');
		}
	}

	public function getDateRangeReports()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_search') == 1) {
			$frm = $this->input->post('fromDate');
			$to = $this->input->post('toDate');
			$data = array(
				'title' => 'Reports',
				'users' => $this->bm->getAll('users'),
				'reports' => $this->mm->getUsersReportsDateRange($frm, $to)
			);

			$i = 0;
			foreach ($data['reports'] as $key => $v) {
				$data['r_descriptions'][$i] = $this->bm->getAllWhere('r_descriptions', 'report_id', $v->report_id, 'report_id');
				$i++;
			}

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/index', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function project_reports()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			$data['title'] = 'Reports';
			$data['projects'] = $this->mm->projectsReport();
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/projects_report', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}


	public function task_reports()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			$data['title'] = 'Reports';
			//$data['projects'] = $this->mm->projectsReport();
			$data['taskDetails'] = $this->mm->allTasksReportDetails();
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/task_reports', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}



	public function dateWiseProjectsReport()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			$first = $this->input->post('first_date');
			$last = $this->input->post('last_date');
			if (!empty($first) && !empty($last)) {
				$data['title'] = 'Reports';
				$f_date = date('m/d/Y', strtotime($first));
				$l_date = date('m/d/Y', strtotime($last));
				$data['f_date'] = $f_date;
				$data['l_date'] = $l_date;
				$data['projects'] = $this->mm->dateWiseProjectsReport($f_date, $l_date);
				// print_r($data['projects']);
				// die();
				$this->load->view('template/header', $data);
				$this->load->view('template/nav');
				$this->load->view('report/projects_report', $data);
				$this->load->view('template/footer');
			} else {
				redirect('Reports/project_reports');
			}
		} else {
			redirect('dashboard');
		}
	}

	public function view_task_reports($projTaskId)
	{

		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) {
			$data = array();
			$data['task'] = $this->mm->getTask($projTaskId);

			if ($this->session->userdata('task_p_show') == 1) {
				$arr = array('pt.project_task_id' => $id, 'ps.user_id' => $this->session->userdata('id'));
				$data['tasks'] = $this->mm->getTasks($arr);
			} else if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1) {

				$arr = array('project_task_id' => $projTaskId);

				$data['tasks'] = $this->bm->getRowsWithMultipleCond($projTaskId);
			}
			$data['title'] = 'Project Tasks';
			$data['id'] = $projTaskId;

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





				$data['TaskDetails'] = $this->bm->gettaskAndSubTaskDetails($projTaskId);
			}

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/tasks_view', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function searchTaskDetails()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {

			$search = $this->input->post('search');

			if (!empty($search)) {

				$data['taskDetails'] = $this->mm->searchWiseTasksReport($search);

				$this->load->view('template/header', $data);
				$this->load->view('template/nav');
				$this->load->view('report/task_reports', $data);
				$this->load->view('template/footer');
			} else {
				redirect('Reports/project_reports');
			}
		} else {
			redirect('dashboard');
		}
	}


	public function dateWiseTaskReport()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			$first = $this->input->post('first_date');
			$last = $this->input->post('last_date');
			if (!empty($first) && !empty($last)) {
				$data['title'] = 'Reports';
				$f_date = date('m/d/Y', strtotime($first));
				$l_date = date('m/d/Y', strtotime($last));
				$data['f_date'] = $f_date;
				$data['l_date'] = $l_date;
				$data['projects'] = $this->mm->dateWiseTasksReport($f_date, $l_date);
				// print_r($data['projects']);
				// die();
				$this->load->view('template/header', $data);
				$this->load->view('template/nav');
				$this->load->view('report/projects_report', $data);
				$this->load->view('template/footer');
			} else {
				redirect('Reports/project_reports');
			}
		} else {
			redirect('dashboard');
		}
	}

	public function transaction()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			$data['title'] = 'Reports';
			$data['groups'] = $this->mm->allGroups();
			$data['transactions'] = $this->mm->transaction_report();
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/transaction', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}

	public function fetch_transaction()
	{

		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			$data = $this->input->post();
			if (!empty($data) and isset($data)) {
				$d['transactions'] = $this->mm->filterTransactionsByDates($data);
			}

			$d['title'] = 'Reports';

			$d['groups'] = $this->mm->allGroups();
			$this->load->view('template/header', $d);
			$this->load->view('template/nav');
			$this->load->view('report/transaction', $d);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}


	public function view_project_task($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) {
			$data = array();
			$data['project'] = $this->mm->getProject($id);
			if ($this->session->userdata('task_p_show') == 1) {
				$arr = array('ps.project_id' => $id, 'ps.user_id' => $this->session->userdata('id'));
				$data['tasks'] = $this->mm->getTasks($arr);
			} else if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1) {

				$arr = array('project_id' => $id);
				$data['tasks'] = $this->bm->getRowsWithMultipleConditions('projects_tasks', $arr);
			}
			$data['title'] = 'Project Tasks';
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

				$data['projectDetails'] = $this->bm->getProjectDetails($id);
				$data['proj_id'] = $id;
			}

			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/project_tasks_view', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}




	public function sub_task_reports()
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('report_show') == 1 || $this->session->userdata('report_p_show') == 1 || $this->session->userdata('report_create') == 1 || $this->session->userdata('report_wh') == 1 || $this->session->userdata('report_search') == 1) {
			$data['title'] = 'Reports';
			$data['users'] = $this->mm->fetch_users();
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/sub_task_report', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}




	public function view_sub_task($id)
	{
		if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) {

			$data['title'] = 'Reports';
			$data['user_id'] = $id;
			$data['projects'] = $this->mm->fetch_projects_data($id);

			$sub_t = $this->mm->fetch_sub_tasks_d($id);

			$data['sub_t'] = $sub_t;


			// $data['sub_tasks'] = $this->mm->fetch_sub_tasks_data($id);			
			$this->load->view('template/header', $data);
			$this->load->view('template/nav');
			$this->load->view('report/sub_tasks_view', $data);
			$this->load->view('template/footer');
		} else {
			redirect('dashboard');
		}
	}


	public function getAllDailyWorkReports()
	{
		$data = [
			'title'			=>	"Daily Work Reports",
			'reports'		=>	"Data"	
		];
		// echo "Running";
		$this->load->view('template/header', $data);
		$this->load->view('template/nav');
		$this->load->view('report/daily-work-report');
		$this->load->view('template/footer');
	}
}
