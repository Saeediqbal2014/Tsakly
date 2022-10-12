<?php
class Main_model extends CI_Model
{
	function getAllProjectsUsers($user)
	{
		$this->db->select('p.*');
		$this->db->from('projects p');
		$this->db->join('projects_users pu', 'pu.project_id=p.project_id');
		$this->db->join('users u', 'pu.user_id=u.user_id');
		$this->db->where('u.user_id', $user);
		$this->db->order_by('p.project_id', 'desc');
		return $this->db->get()->result();
	}

	function getAllProjects($table, $order_by)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order_by, 'desc');
		return $this->db->get()->result();
	}

	public function getAllComments($projId)
	{
		$query = $this->db->select("COUNT(subtask_comment_id) as c")
			->from("subtask_comments as sc")
			->join("projects_tasks as pt", "sc.project_task_id = pt.project_task_id")
			->where("pt.project_id", $projId)
			->get();
		return ($query->num_rows() > 0) ? $query->result()[0]->c : 0;
	}

	public function searchWiseTasksReport($search)
	{
		if (empty($search)) {
			return array();
		}
		$result = $this->db->like('task_title', $search)
			->or_like('task_due_date', $search)
			->or_like('task_milestone', $search)
			->or_like('project_name', $search)
			->or_like('project_budget', $search)
			->or_like('task_priority', $search)
			->join("projects", "projects_tasks.project_id = projects.project_id")
			->get('projects_tasks');

		return $result->result();
	}
	public function allTasksReportDetails()
	{
		return $this->db->select('*')
			->from('projects_tasks pt')
			->join('projects p', 'p.project_id = pt.project_id')
			->order_by('pt.project_task_id ', 'desc')
			->get()
			->result();
	}



	function getAllcomment()
	{
		$query = $this->db->select("COUNT(subtask_comment_id) as c")
			->from("subtask_comments as sc")
			->join("projects_tasks as pt", "sc.project_task_id = pt.project_task_id")
			->where("pt.project_id", $id)
			->get()->result();

		return $query;
	}

	function getAllProComments($table, $order_by)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($order_by, 'desc');
		return $this->db->get()->result();
	}
	public function gettaskDueDate($id)
	{
		$this->db->select('*');
		$this->db->from('projects_tasks');
		$this->db->where('project_task_id', $id);
		return $this->db->get()->result();
	}

	function getAll($id)
	{
		$this->db->select('u.img,u.user_id,u.name,u.email,pu.user_role');
		$this->db->from('users u');
		$this->db->join('projects_users pu', 'pu.user_id=u.user_id');
		$this->db->where('pu.project_id', $id);
		return $this->db->get()->result();
	}

	function updateManageBudget($table, $arr)
	{
		for ($i = 0; $i < @count($arr['task_id']); $i++) {
			$this->db->where('project_task_id', $arr['task_id'][$i]);
			$this->db->update($table, array('task_milestone' => $arr['task_milestone'][$i]));
		}
		return true;
	}

	function updateManagesubBudget($table, $arr)
	{
		for ($i = 0; $i < @count($arr['subtask_id']); $i++) {
			$this->db->where('project_subtask_id', $arr['subtask_id'][$i]);
			$this->db->update($table, array('subtask_milestone' => $arr['subtask_milestone'][$i]));
		}
		return true;
	}

	function updateWithMultiConditions($table, $arr, $conditions)
	{
		$this->db->where($conditions);
		return $this->db->update($table, $arr);
	}

	function getUsersReports()
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('reports rp', 'u.user_id=rp.user_id');
		$this->db->order_by('u.user_id', 'desc');
		return $this->db->get()->result();
	}

	function getUsersReportsDateRange($frm, $to)
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('reports rp', 'u.user_id=rp.user_id');
		$this->db->where('rp.report_date>=', $frm);
		$this->db->where('rp.report_date<=', $to);
		$this->db->order_by('u.user_id', 'desc');
		return $this->db->get()->result();
	}

	function getUserHours($arr)
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('reports rep', 'u.user_id=rep.user_id');
		$this->db->where($arr);
		$this->db->order_by('u.user_id');
		return $this->db->get()->result();
	}

	function getUsersComents($column, $val)
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('subtask_comments sc', 'u.user_id=sc.user_id');
		$this->db->where('sc.project_task_id', $val);  // 'project_subtask_id', $id
		$this->db->where('sc.project_subtask_id', 0);
		$this->db->join('projects_tasks pt', 'pt.project_task_id = sc.project_task_id');
		$this->db->where('sc.user_id', $this->session->userdata('id'));
		$this->db->order_by('sc.subtask_comment_id', 'desc');
		return $this->db->get()->result();
	}

	function getUsersSubTaskComents($column, $val)
	{
		// print_r($val); die();
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('subtask_comments sc', 'u.user_id=sc.user_id', 'LEFT');
		$this->db->join('projects_tasks pt', 'pt.project_task_id = sc.project_task_id', 'LEFT');
		// 		$this->db->where('sc.user_id',$this->session->userdata('id'));
		$this->db->where('sc.project_subtask_id', $val);  // 'project_subtask_id', $id
		$this->db->order_by('sc.subtask_comment_id', 'desc');
		return $this->db->get()->result();
	}

	function getTasks($arr)
	{
		$this->db->select('*');
		$this->db->from('projects_tasks pt');
		$this->db->join('projects_subtasks ps', 'pt.project_task_id=ps.project_task_id');
		$this->db->where($arr);
		$this->db->group_by('pt.project_task_id');
		$this->db->order_by('pt.project_task_id', 'desc');
		return $this->db->get()->result();
	}

	function getSubTask($arr)
	{
		$this->db->select('*');
		$this->db->from('projects_tasks pt');
		$this->db->join('projects_subtasks ps', 'pt.project_task_id=ps.project_task_id');
		$this->db->where($arr);
		$this->db->group_by('pt.project_task_id');
		$this->db->order_by('pt.project_task_id', 'desc');
		return $this->db->get()->result();
	}
	function get_project_users($arr3)
	{
		$this->db->select('*');
		$this->db->from('projects_users pu');
		$this->db->join('users u', 'pu.user_id=u.user_id');
		$this->db->group_by('pu.user_id');
		$this->db->order_by('pu.user_id', 'desc');
		$this->db->where($arr3);
		$dt = $this->db->get()->result();
		// print_r($dt); die('Debug');
		return $dt;
	}

	function getAllCoN($st)
	{
		$this->db->select('*,n.id as noti_id');
		$this->db->from('notifications n');
		$this->db->join('projects_subtasks prs', 'n.related_id=prs.project_subtask_id');
		$this->db->order_by('n.id', 'desc');
		$this->db->where($st);
		return $this->db->get()->result();
	}

	function getUserForProject()
	{
		$status = array('0', '3');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->or_where_in('status', $status);
		$this->db->order_by('name', 'asc');
		return $this->db->get()->result();
	}

	function getRow($column, $val)
	{
		$this->db->select('count(pu.user_id)');
		$this->db->from('projects p');
		$this->db->join('projects_users pu', 'p.project_id=pu.project_id');
		$this->db->where($column, $val);
		return $this->db->get()->row();
	}

	function getRowdashP($sel, $column = '', $val = '')
	{
		$this->db->select($sel);
		$this->db->from('projects p');
		if ($column != null || $val != null) {
			$this->db->join('projects_users pu', 'p.project_id=pu.project_id');
			$this->db->where($column, $val);
		}
		return $this->db->get()->result();
	}

	function getRowdashT($sel, $arr)
	{
		$this->db->select($sel);
		$this->db->from('projects_tasks');
		$this->db->where($arr);
		return $this->db->get()->result();
	}

	function getRowdashS($sel, $arr)
	{
		$this->db->select($sel);
		$this->db->from('projects_subtasks');
		$this->db->where($arr);
		return $this->db->get()->result();
	}

	function getAllLeaves()
	{
		$this->db->select('*');
		$this->db->from('leaves l');
		$this->db->join('users u', 'u.user_id=l.user_id');
		$this->db->order_by('l.leave_id', 'desc');
		$this->db->where('l.leave_status', '0');
		return $this->db->get()->result();
	}
	function getTotalLeaves($user_id)
	{
		$this->db->select('*');
		$this->db->from('leaves');
		$this->db->order_by('leave_id', 'desc');
		$this->db->where('leave_status!=', '0');
		$this->db->where('user_id', $user_id);
		$a = $this->db->get()->result();
		if ($a != null) {
			$this->db->select('sum(with_pay) as with_pay,sum(without_pay) as without_pay,sum(app_leave) as app_leave,sum(rej_leave) as rej_leave');
			$this->db->from('leaves');
			$this->db->order_by('leave_id', 'desc');
			$this->db->where('leave_status!=', '0');
			$this->db->where('user_id', $user_id);
			return $this->db->get()->result_array();
		} else {
			$arr[0] = [
				'with_pay' => '0',
				'without_pay' => '0',
				'app_leave' => '0',
				'rej_leave' => '0'
			];
			return $arr;
		}
	}

	function getLoginDetail($email, $password)
	{
		$this->db->select('*');
		$this->db->from('roles r');
		$this->db->join('users u', 'u.status=r.role_id');
		$this->db->join('permissions p', 'p.role_id=r.role_id');
		$this->db->where('u.email', $email);
		$this->db->where('u.password', $password);
		$q = $this->db->get()->result();

		if ($q == 0 || $q == null) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('email', $email);
			$this->db->where('password', $password);
			return $this->db->get()->result();
		} else {
			return $q;
		}
	}

	function getUserAtd($user_id)
	{
		$this->db->select('sum(lates) as lates,sum(absent) as absents, sum(leave_) as leaves');
		$this->db->from('attendance');
		$this->db->where('user_id', $user_id);
		$q = $this->db->get()->row();
		if ($q->lates == '' && $q->absents == '' && $q->leaves == '') {
			$q = (object) [
				'lates' => '0',
				'absents' => '0',
				'leaves' => '0'
			];
			return $q;
		} else {
			return $q;
		}
	}

	function getUserAtd1($user_id, $data1, $data2)
	{
		$from = date('Y-m-d', strtotime($data1));
		$to = date('Y-m-d', strtotime($data2));
		$this->db->select('sum(lates) as lates,sum(absent) as absents, sum(leave_) as leaves');
		$this->db->from('attendance');
		$this->db->where('user_id', $user_id);
		$this->db->where('attendance_datetime>=', $from);
		$this->db->where('attendance_datetime<=', $to);
		$q = $this->db->get()->row();
		if ($q->lates == '' && $q->absents == '' && $q->leaves == '') {
			$q = (object) [
				'lates' => '0',
				'absents' => '0',
				'leaves' => '0',
			];
			return $q;
		} else {
			return $q;
		}
	}

	function fetch_user_email($sender_id)
	{
		$this->db->select('email')->from('users');
		$this->db->where('user_id', $sender_id);
		$q = $this->db->get();
		return $q->result_array();
	}



	function fetch_project_leader_email($p_id)
	{
		$this->db->select('*')->from('projects_users');
		$this->db->where('project_id', $p_id);
		$this->db->where('user_role', 1);
		$this->db->join('users', 'users.user_id = projects_users.user_id');
		$q = $this->db->get();
		return $q->result_array();
	}


	function fetch_admin_email()
	{
		$this->db->select('email')->from('users');
		$this->db->where('name', 'admin');
		$q = $this->db->get();
		return $q->result_array();
	}

	public function insertTransaction($data)
	{
		return $this->db->insert('transaction', $data);
	}

	public function allTransactions()
	{

		return $this->db->select('*, g.id as gid,g.name as gr_name,sg.id as sg_id, sg.name as sg_name , t.id as tid')
			->from('transaction t')
			->join('account_group g', 'g.id = t.group_id')
			->join('account_subgroup sg', 'sg.id = t.subgroup_id')
			->order_by('t.date', 'asc')
			->get()
			->result();
	}

	public function getTransaction($id)
	{
		return $this->db->select('*,t.id as tid, g.id as gid, g.name as gname,sg.name as sgname,sg.id as sgid')
			->from('transaction t')
			->join('account_group g', 'g.id = t.group_id')
			->join('account_subgroup sg', 'sg.id = t.subgroup_id')
			->where('t.id', $id)
			->get()
			->result();
	}

	public function updateTransaction($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('transaction', $data);
	}

	public function deleteTransaction($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('transaction');
	}

	public function fetchBalance()
	{
		return $this->db->get('balance')->result();
	}

	public function afterTransactionBalance($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('balance', $data);
	}

	public function allGroups()
	{
		return $this->db->get('account_group')->result();
	}
	public function allsubgroup()
	{
		return $this->db->get('account_subgroup')->result();
	}

	public function addGroup($data)
	{
		return $this->db->insert('account_group', $data);
	}

	public function getGroup($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('account_group')->result();
	}

	public function updateGroup($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('account_group', $data);
	}

	public function getGroupTransaction($id)
	{
		$this->db->where('group_id', $id);
		return $this->db->get('transaction')->result();
	}

	public function deleteGroup($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('account_group');
	}

	public function deleteGroupTransactions($id)
	{
		$this->db->where('group_id', $id);
		return $this->db->delete('transaction');
	}

	//Reports
	public function projectsReport()
	{
		return $this->db->select('*')
			->from('projects')
			->order_by('project_id', 'desc')
			->get()
			->result();
	}

	public function dateWiseProjectsReport($first, $last)
	{
		return $this->db->select('*')
			->from('projects')
			->order_by('project_id', 'desc')
			->where('start_date >=', $first)
			->where('start_date <=', $last)
			->get()
			->result();
	}

	public function dateWiseTasksReport($first, $last)
	{
		return $this->db->select('*')
			->from('projects')
			->order_by('project_id', 'desc')
			->where('start_date >=', $first)
			->where('start_date <=', $last)
			->get()
			->result();
	}
	public function filterTransactionsByDates($data)
	{
		$fdate 	= 	$data["from"];
		$tdate 	= 	$data["to"];
		$from 	= 	date("m/d/Y", strtotime($fdate));
		$to 	= 	date("m/d/Y", strtotime($tdate));

		$id = $data["group"];
		$q = "select * from transaction as t left join account_group as g on g.id=t.group_id where (STR_TO_DATE(t.date,'%m/%d/%y')  >= STR_TO_DATE('$from','%m/%d/%y') AND STR_TO_DATE(t.date,'%m/%d/%y') <= STR_TO_DATE('$to','%m/%d/%y') ) AND t.group_id='$id' order by t.id";
		$data = $this->db->query($q)->result();
		return $this->db->query($q)->result();
	}
	function transaction_report()
	{
		return $this->db->select('t.*,g.name')->from('transaction as t')->join('account_group as g', 't.group_id=g.id')->get()->result();
	}

	public function getProject($id)
	{
		return $this->db->select('*')
			->from('projects')
			->where('project_id', $id)
			->get()
			->result();
	}

	public function getTask($id)
	{
		return $this->db->select('*')
			->from('projects_tasks')
			->where('project_task_id ', $id)
			->get()
			->result();
	}



	public function fetch_users()
	{
		return $this->db->select('*')
			->from('users u')
			// ->join('projects_subtasks','u.user_id=projects_subtasks.user_id')
			->where('u.status !=', 1)
			// ->order_by('project_subtask_id', 'desc')
			->get()
			->result();
	}
	public function fetch_sub_task($users_id)
	{
		return $this->db->select('*')
			->from('projects_subtasks')
			->where('user_id', $users_id)
			->where('subtask_priority', 'complete')
			->get()
			->result_array();
	}




	public function fetch_projects_data($users_id)
	{
		return $this->db->select('*')
			->from('projects')
			// ->join('projects_tasks','projects.project_id=projects_tasks.project_id')
			// ->join('projects_subtasks','projects_subtasks.project_task_id=projects_tasks.project_task_id')	
			// ->where('user_id',$users_id)
			// ->where('subtask_priority','complete')			
			->get()
			->result_array();
	}






	public function fetch_projects_tasks_data($project_id)
	{
		return $this->db->select('*')
			->from('projects_tasks')
			// ->join('projects_tasks','projects.project_id=projects_tasks.project_id')
			// ->join('projects_subtasks','projects_subtasks.project_task_id=projects_tasks.project_task_id')	
			// ->where('user_id',$users_id)
			->where('project_id', $project_id)
			->get()
			->result_array();
	}





	public function fetch_sub_tasks_data($user_id, $task_id)
	{
		return $this->db->select('*')
			->from('projects_subtasks')
			->where('subtask_priority', 'complete')
			->where('project_task_id', $task_id)
			->where('user_id', $user_id)
			->get()
			->result_array();
	}


	function fetchrolespermissions()
	{

		return $this->db->select('*')
			->from('permissions p')
			->join('roles r', 'p.role_id=r.role_id')
			->where('p.role_id', 2)
			->get()
			->result_array();
	}



	public function fetch_sub_tasks_d($user_id)
	{
		return $this->db->select('*')
			->from('projects_subtasks')
			->where('subtask_priority', 'complete')
			->where('user_id', $user_id)
			->get()
			->result_array();
	}

	public function getUserAttendance()
	{
		return $this->db->select('attendance.*,users.name username')
			->from('attendance')
			->join('users', 'users.user_id=attendance.user_id')
			->where('time_1!=', '')
			->order_by('attendance_id', 'desc')
			->get()->result();
	}


	public function getAttendanceForUser($id)
	{
		return $this->db->select('attendance.*,users.name username')
			->from('attendance')
			->join('users', 'users.user_id=attendance.user_id')
			->where('time_1!=', '')
			->where('attendance.user_id', $id)
			->get()->result();
	}
}
