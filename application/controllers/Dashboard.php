<?php
class Dashboard extends CI_Controller
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
    $data = array(
      'title' => 'Dashboard'
    );
    $sel = 'p.project_id';
    $sel1 = 'project_task_id';
    $sel2 = 'project_subtask_id';

    if ($this->session->userdata('user') == 1) {
      $data['projects'] = $this->mm->getRowdashP($sel);
      $t = 0;
      foreach ($data['projects'] as $v) {
        $arr = ['project_id' => $v->project_id];
        $data['tasks'][$t] = $this->mm->getRowdashT($sel1, $arr);
        $t++;
      }

      $s = 0;
      foreach ($data['projects'] as $v) {
        $arr1 = ['project_id' => $v->project_id];
        $data['subtasks'][$s] = $this->mm->getRowdashS($sel2, $arr1);
        $s++;
      }
    } else if ($this->session->userdata('proj_show') == 1) {
      $data['projects'] = $this->mm->getRowdashP($sel);
      if ($this->session->userdata('task_show') == 1) {
        $t = 0;
        foreach ($data['projects'] as $v) {
          $arr = ['project_id' => $v->project_id];
          $data['tasks'][$t] = $this->mm->getRowdashT($sel1, $arr);
          $t++;
        }
      } else {
        $data['tasks'] = array(array((object) array()));
      }
      if ($this->session->userdata('subtask_show') == 1 || $this->session->userdata('subtask_p_show') == 1) {
        $s = 0;
        foreach ($data['projects'] as $v) {
          if ($this->session->userdata('subtask_show') == 1) {
            $arr1 = ['project_id' => $v->project_id];
          } else if ($this->session->userdata('subtask_p_show') == 1) {
            $arr1 = ['project_id' => $v->project_id, 'user_id' => $this->session->userdata('id')];
          }
          $data['subtasks'][$s] = $this->mm->getRowdashS($sel2, $arr1);
          $s++;
        }
      } else {
        $data['subtasks'] = array(array());
      }
    } else if ($this->session->userdata('proj_p_show') == 1) {
      $data['projects'] = $this->mm->getRowdashP($sel, 'pu.user_id', $this->session->userdata('id'));
      if ($this->session->userdata('task_show') == 1) {
        $t = 0;
        foreach ($data['projects'] as $v) {
          $arr = ['project_id' => $v->project_id];
          $data['tasks'][$t] = $this->mm->getRowdashT($sel1, $arr);
          $t++;
        }
      } else {
        $data['tasks'] = array(array());
      }
      if ($this->session->userdata('subtask_show') == 1 || $this->session->userdata('subtask_p_show') == 1) {
        $s = 0;
        foreach ($data['projects'] as $v) {
          if ($this->session->userdata('subtask_show') == 1) {
            $arr1 = ['project_id' => $v->project_id];
          } else if ($this->session->userdata('subtask_p_show') == 1) {
            $arr1 = ['project_id' => $v->project_id, 'user_id' => $this->session->userdata('id')];
          }
          $data['subtasks'][$s] = $this->mm->getRowdashS($sel2, $arr1);
          $s++;
        }
      } else {
        $data['subtasks'] = array(array());
      }
    } else {
      $data['projects'] = array();
      $data['tasks'] = array(array());
      $data['subtasks'] = array(array());
    }

    // print_r($this->session->userdata()); exit;
    $this->load->view('template/header', $data);
    $this->load->view('template/nav');
    $this->load->view('dashboard/index', $data);
    $this->load->view('template/footer');
  }


  public function notifications()
  {
    $arr = [
      'status' => '0',
      "noti_type" => 'subtask'
    ];
    $data = $this->mm->getAllCoN($arr);
    // echo"<pre>";
    // print_r($data);
    echo json_encode($data);
  }

  public function remove_notifications()
  {
    $id = $this->input->post('id');
    $arr = array(
      'status' => '1'
    );
    $this->bm->update('notifications', $arr, 'id', $id);
  }

  public function birthday()
  {
    //  $month = date('m');
    //  $date = date('d');
    // $date = date('d-m');

    $dddd = $this->bm->getAllWhere("users", "birth_date", date('d-m'), 'user_id');
    // print_r(date('d/m'));
    // $query = $this->db->query("SELECT * FROM users");
    // $ddd = ($query->num_rows() > 0) ? $query->result() : NULL;
    // // print_r($ddd); die();
    // foreach($ddd as $dd){
    // print_r($date); die(); 
    // $query = $this->db->query("SELECT * FROM users where birth_date = $date");

    // $data = ($query->num_rows() > 0) ? $query->result() : NULL;
    // print_r($data); die();
    foreach ($dddd as $df) {
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

      $data = "Today is " . $df->name . " birthday!";
      $pusher->trigger('my-channel', 'my-event', $data);
    }
    echo json_encode($dddd);
    // }
    // $newDate = date("Y-m-d", strtotime($orgDate));

  }

  public function project_alert()
  {
    //projects_alert_start
    if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_show') == 1) {
      $projects = $this->bm->getAll('projects');
    } else if ($this->session->userdata('proj_p_show') == 1) {
      $projects = $this->mm->getAllProjectsUsers($this->session->userdata('id'));
    }
    if ($this->session->userdata('user') == 1 || $this->session->userdata('proj_show') == 1 || $this->session->userdata('proj_p_show') == 1) {
      $m = 0;
      $arr = array();
      foreach ($projects as $key => $v) {
        $d = date('d-m-Y', strtotime($v->end_date));
        $nd = strtotime($d . '-' . $v->notify_days . ' days');
        $nd2 = date("d-m-Y", $nd);
        if ($nd2 == date('d-m-Y')) {
          $notifications[$m] = $this->bm->getRowsWithMultipleConditions('projects', array('project_id' => $v->project_id));
          $arr[$m] = array(
            'project_id' => $notifications[$m][0]->project_id,
            'project_name' => $notifications[$m][0]->project_name,
            'end_date' => $notifications[$m][0]->end_date
          );

          $m++;
        }
      }
    } else {
      $arr = array();
    }

    echo json_encode($projects);
    //projects_alert_end
  }

  public function task_alert()
  {
    //tasks_alert_start
    if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1) {
      $tasks = $this->bm->getAll('projects_tasks');
    } else if ($this->session->userdata('task_p_show') == 1) {
      $projects = $this->mm->getAllProjectsUsers($this->session->userdata('id'));
      $i = 0;
      foreach ($projects as $v) {
        $tasks[$i] = $this->bm->getRow('projects_tasks', $v->project_id, 'project_id');
        $i++;
      }
    }

    if ($this->session->userdata('user') == 1 || $this->session->userdata('task_show') == 1 || $this->session->userdata('task_p_show') == 1) {
      $m1 = 0;
      $arr1 = array();
      foreach ($tasks as $key1 => $v1) {
        $d1 = date('d-m-Y', strtotime($v1->task_due_date));
        $ntd = strtotime($d1 . '-' . $v1->task_notify_days . ' days');
        $ntd2 = date("d-m-Y", $ntd);
        if ($ntd2 == date('d-m-Y')) {
          $notifications1[$m1] = $this->bm->getRowsWithMultipleConditions('projects_tasks', array('project_task_id' => $v1->project_task_id));
          $arr1[$m1] = array(
            'task_id' => $notifications1[$m1][0]->project_task_id,
            'task_name' => $notifications1[$m1][0]->task_title,
            'task_end_date' => $notifications1[$m1][0]->task_due_date
          );
          $m1++;
        }
      }
    } else {
      $arr1 = array();
    }
    echo json_encode($arr1);
    //tasks_alert_end
  }

  public function subtask_alert()
  {
    //subtasks_alert_start
    if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1) {
      $subtasks = $this->bm->getAll('projects_subtasks');
      // print_r($subtasks); die();
    } else if ($this->session->userdata('subtask_p_show') == 1) {
      $subtasks = $this->bm->getAllWhere('projects_subtasks', 'user_id', $this->session->userdata('id'), 'project_subtask_id');
    }
    if ($this->session->userdata('user') == 1 || $this->session->userdata('subtask_show') == 1 || $this->session->userdata('subtask_p_show') == 1) {
      $m2 = 0;
      $arr2 = array();
      foreach ($subtasks as $key2 => $v2) {
        $d2 = date('d-m-Y', strtotime($v2->subtask_due_date));
        $nstd = strtotime($d2 . '-' . $v2->subtask_notify_days . ' days');
        $nstd2 = date("d-m-Y", $nstd);
        if ($nstd2 == date('d-m-Y')) {
          $notifications2[$m2] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', array('project_subtask_id' => $v2->project_subtask_id));
          $arr2[$m2] = array(
            'subtask_id' => $notifications2[$m2][0]->project_subtask_id,
            'project_id' => $notifications2[$m2][0]->project_id,
            'subtask_name' => $notifications2[$m2][0]->subtask_title,
            // 'subtask_end_date' => $notifications2[$m2][0]->subtask_getAllCoNdue_date
            'subtask_end_date' => $notifications2[$m2][0]->subtask_due_date
          );

          $m2++;
        }
      }
    } else {
      $arr2 = array();
    }
    echo json_encode($subtasks);
    //subtasks_alert_end
  }

  public function users_alert()
  {
    if ($this->session->userdata('user') == 1) {
      $arr = [
        'subtask_status_by' => '2',
        'subtask_status' => 'completed'
      ];
    } else if ($this->session->userdata('subtask_notify_') == 1) {
      $arr = [
        'subtask_status_by' => '1',
        'subtask_status' => 'completed'
      ];
    }

    $data = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arr);
    echo json_encode($data);
  }

  public function user_alert_by_admin()
  {
    $arr = [
      'subtask_status_by' => '20',
      'coordinator_status' => '0'
    ];
    $data = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arr);
    echo json_encode($data);
  }

  public function change_rejected_status_by_coordinator()
  {
    $id = $this->input->post('id');
    $field = [
      'coordinator_status' => '1',
      'subtask_status_by_name' => $this->session->userdata('name')
    ];
    $this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
  }

  public function user_alert_by_authors()
  {
    $arr = [
      'subtask_status_by' => '20',
      'employee_status' => '0',
      'user_id' => $this->session->userdata('id')
    ];
    $data['codr'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arr);
    $arr = [
      'subtask_status_by' => '30',
      'employee_status' => '0',
      'user_id' => $this->session->userdata('id')
    ];
    $data['adr'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arr);

    $arr = [
      'subtask_status_by' => '2',
      'employee_status' => '0',
      'user_id' => $this->session->userdata('id')
    ];
    $data['coda'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arr);
    $arr = [
      'subtask_status_by' => '3',
      'employee_status' => '0',
      'user_id' => $this->session->userdata('id')
    ];
    $data['ada'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arr);

    echo json_encode($data);
  }

  public function change_rejected_status_by_user()
  {
    $id = $this->input->post('id');
    $field = [
      'subtask_status_by' => '0',
      'employee_status' => '1',
      'subtask_status' => ''
    ];
    $this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
  }

  public function change_approved_status_by_user()
  {
    $id = $this->input->post('id');
    $field = [
      'employee_status' => '1'
    ];
    $this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
  }

  public function new_subtask_assign_to_user()
  {
    $arr = [
      'employee_status_2' => '0',
      'user_id' => $this->session->userdata('id')
    ];
    $data = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arr);
    echo json_encode($data);
  }

  public function change_status_of_new_subtask_assign_to_user()
  {
    $id = $this->input->post('id');
    $field = [
      'employee_status_2' => '1'
    ];
    $this->bm->update('projects_subtasks', $field, 'project_subtask_id', $id);
  }

  public function leave_alert()
  {
    $data = $this->bm->getAllWhere('leaves', 'leave_status', '0', 'leave_id');
    echo json_encode($data);
  }

  public function total_alert()
  {

    if ($this->session->userdata('user') == 1) {

      $leave = $this->bm->getAllWhere('leaves', 'leave_status', '0', 'leave_id');
      $arrro = [
        'status' => '0',
        "noti_type" => 'subtask'
      ];
      $data = $this->mm->getAllCoN($arrro);
      $birth = $this->bm->getAllWhere('users', 'dob', date('m/d/Y'), 'user_id');

      $arrsc = [
        'subtask_status_by' => '2',
        'subtask_status' => 'completed'
      ];
      $data1 = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrsc);
      //projects_alert_start
      $projects = $this->bm->getAll('projects');
      $m = 0;
      $arr = array();
      foreach ($projects as $key => $v) {
        $d = date('d-m-Y', strtotime($v->end_date));
        $nd = strtotime($d . '-' . $v->notify_days . ' days');
        $nd2 = date("d-m-Y", $nd);
        if ($nd2 == date('d-m-Y')) {
          $notifications[$m] = $this->bm->getRowsWithMultipleConditions('projects', array('project_id' => $v->project_id));
          $arr[$m] = array(
            'project_id' => $notifications[$m][0]->project_id,
            'project_name' => $notifications[$m][0]->project_name,
            'end_date' => $notifications[$m][0]->end_date
          );
        }
        $m++;
      }

      //tasks_alert_start
      $tasks = $this->bm->getAll('projects_tasks');
      $m1 = 0;
      $arr1 = array();
      foreach ($tasks as $key1 => $v1) {
        $d1 = date('d-m-Y', strtotime($v1->task_due_date));
        $ntd = strtotime($d1 . '-' . $v1->task_notify_days . ' days');
        $ntd2 = date("d-m-Y", $ntd);
        if ($ntd2 == date('d-m-Y')) {
          $notifications1[$m1] = $this->bm->getRowsWithMultipleConditions('projects_tasks', array('project_task_id' => $v1->project_task_id));
          $arr1[$m1] = array(
            'task_id' => $notifications1[$m1][0]->project_task_id,
            'task_name' => $notifications1[$m1][0]->task_title,
            'task_end_date' => $notifications1[$m1][0]->task_due_date
          );
        }

        $m1++;
      }

      //subtasks_alert_start
      $subtasks = $this->bm->getAll('projects_subtasks');
      $m2 = 0;
      $arr2 = array();
      foreach ($subtasks as $key2 => $v2) {
        $d2 = date('d-m-Y', strtotime($v2->subtask_due_date));
        $nstd = strtotime($d2 . '-' . $v2->subtask_notify_days . ' days');
        $nstd2 = date("d-m-Y", $nstd);
        if ($nstd2 == date('d-m-Y')) {
          $notifications2[$m2] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', array('project_subtask_id' => $v2->project_subtask_id));
          $arr2[$m2] = array(
            'subtask_id' => $notifications2[$m2][0]->project_subtask_id,
            'project_id' => $notifications2[$m2][0]->project_id,
            'subtask_name' => $notifications2[$m2][0]->subtask_title,
            'subtask_end_date' => $notifications2[$m2][0]->subtask_due_date
          );
        }
        $m2++;
      }

      $tot = count($data) + count($data1) + count($birth) + count($arr) + count($arr1) + count($arr2) + count($leave);
      $total = array(
        'total_not' => $tot
      );
    } else if ($this->session->userdata('subtask_notify_') == 0) {
      $arrscr = [
        'subtask_status_by' => '20',
        'employee_status' => '0',
        'user_id' => $this->session->userdata('id')
      ];
      $data['codr'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrscr);
      $arrsar = [
        'subtask_status_by' => '30',
        'employee_status' => '0',
        'user_id' => $this->session->userdata('id')
      ];
      $data['adr'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrsar);

      $arrsc = [
        'subtask_status_by' => '2',
        'employee_status' => '0',
        'user_id' => $this->session->userdata('id')
      ];
      $data['coda'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrsc);
      $arrsa = [
        'subtask_status_by' => '3',
        'employee_status' => '0',
        'user_id' => $this->session->userdata('id')
      ];
      $data['ada'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrsa);
      $arrsn = [
        'employee_status_2' => '0',
        'user_id' => $this->session->userdata('id')
      ];
      $data['new_subtask'] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrsn);

      if ($this->session->userdata('proj_notify') == 1) {

        $projects = $this->bm->getAll('projects');
        $m = 0;
        $arr = array();
        foreach ($projects as $key => $v) {
          $d = date('d-m-Y', strtotime($v->end_date));
          $nd = strtotime($d . '-' . $v->notify_days . ' days');
          $nd2 = date("d-m-Y", $nd);
          if ($nd2 == date('d-m-Y')) {
            $notifications[$m] = $this->bm->getRowsWithMultipleConditions('projects', array('project_id' => $v->project_id));
            $arr[$m] = array(
              'project_id' => $notifications[$m][0]->project_id,
              'project_name' => $notifications[$m][0]->project_name,
              'end_date' => $notifications[$m][0]->end_date
            );
          }
          $m++;
        }
      } else {
        $arr = array();
      }

      if ($this->session->userdata('task_notify') == 1) {
        //tasks_alert_start
        $tasks = $this->bm->getAll('projects_tasks');
        $m1 = 0;
        $arr1 = array();
        foreach ($tasks as $key1 => $v1) {
          $d1 = date('d-m-Y', strtotime($v1->task_due_date));
          $ntd = strtotime($d1 . '-' . $v1->task_notify_days . ' days');
          $ntd2 = date("d-m-Y", $ntd);
          if ($ntd2 == date('d-m-Y')) {
            $notifications1[$m1] = $this->bm->getRowsWithMultipleConditions('projects_tasks', array('project_task_id' => $v1->project_task_id));
            $arr1[$m1] = array(
              'task_id' => $notifications1[$m1][0]->project_task_id,
              'task_name' => $notifications1[$m1][0]->task_title,
              'task_end_date' => $notifications1[$m1][0]->task_due_date
            );
          }

          $m1++;
        }
      } else {
        $arr1 = array();
      }

      if ($this->session->userdata('subtask_notify') == 1) {
        //subtasks_alert_start
        $subtasks = $this->bm->getAll('projects_subtasks');
        $m2 = 0;
        $arr2 = array();
        foreach ($subtasks as $key2 => $v2) {
          $d2 = date('d-m-Y', strtotime($v2->subtask_due_date));
          $nstd = strtotime($d2 . '-' . $v2->subtask_notify_days . ' days');
          $nstd2 = date("d-m-Y", $nstd);
          if ($nstd2 == date('d-m-Y')) {
            $notifications2[$m2] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', array('project_subtask_id' => $v2->project_subtask_id));
            $arr2[$m2] = array(
              'subtask_id' => $notifications2[$m2][0]->project_subtask_id,
              'project_id' => $notifications2[$m2][0]->project_id,
              'subtask_name' => $notifications2[$m2][0]->subtask_title,
              'subtask_end_date' => $notifications2[$m2][0]->subtask_due_date
            );
          }
          $m2++;
        }
      } else {
        $arr2 = array();
      }

      if ($this->session->userdata('birthday_notify') == 1) {
        $birth = $this->bm->getAllWhere('users', 'dob', date('m/d/Y'), 'user_id');
      } else {
        $birth = array();
      }


      $tot = count($data['codr']) + count($data['adr']) + count($data['coda']) + count($data['ada']) + count($data['new_subtask']) + count($arr) + count($arr1) + count($arr2) + count($birth);
      $total = array(
        'total_not' => $tot
      );
    } else if ($this->session->userdata('subtask_notify_') == 1) {
      if ($this->session->userdata('proj_notify') == 1) {

        $projects = $this->bm->getAll('projects');
        $m = 0;
        $arr = array();
        foreach ($projects as $key => $v) {
          $d = date('d-m-Y', strtotime($v->end_date));
          $nd = strtotime($d . '-' . $v->notify_days . ' days');
          $nd2 = date("d-m-Y", $nd);
          if ($nd2 == date('d-m-Y')) {
            $notifications[$m] = $this->bm->getRowsWithMultipleConditions('projects', array('project_id' => $v->project_id));
            $arr[$m] = array(
              'project_id' => $notifications[$m][0]->project_id,
              'project_name' => $notifications[$m][0]->project_name,
              'end_date' => $notifications[$m][0]->end_date
            );
          }
          $m++;
        }
      } else {
        $arr = array();
      }

      if ($this->session->userdata('task_notify') == 1) {
        //tasks_alert_start
        $tasks = $this->bm->getAll('projects_tasks');
        $m1 = 0;
        $arr1 = array();
        foreach ($tasks as $key1 => $v1) {
          $d1 = date('d-m-Y', strtotime($v1->task_due_date));
          $ntd = strtotime($d1 . '-' . $v1->task_notify_days . ' days');
          $ntd2 = date("d-m-Y", $ntd);
          if ($ntd2 == date('d-m-Y')) {
            $notifications1[$m1] = $this->bm->getRowsWithMultipleConditions('projects_tasks', array('project_task_id' => $v1->project_task_id));
            $arr1[$m1] = array(
              'task_id' => $notifications1[$m1][0]->project_task_id,
              'task_name' => $notifications1[$m1][0]->task_title,
              'task_end_date' => $notifications1[$m1][0]->task_due_date
            );
          }

          $m1++;
        }
      } else {
        $arr1 = array();
      }

      if ($this->session->userdata('subtask_notify') == 1) {
        //subtasks_alert_start
        $subtasks = $this->bm->getAll('projects_subtasks');
        $m2 = 0;
        $arr2 = array();
        foreach ($subtasks as $key2 => $v2) {
          $d2 = date('d-m-Y', strtotime($v2->subtask_due_date));
          $nstd = strtotime($d2 . '-' . $v2->subtask_notify_days . ' days');
          $nstd2 = date("d-m-Y", $nstd);
          if ($nstd2 == date('d-m-Y')) {
            $notifications2[$m2] = $this->bm->getRowsWithMultipleConditions('projects_subtasks', array('project_subtask_id' => $v2->project_subtask_id));
            $arr2[$m2] = array(
              'subtask_id' => $notifications2[$m2][0]->project_subtask_id,
              'project_id' => $notifications2[$m2][0]->project_id,
              'subtask_name' => $notifications2[$m2][0]->subtask_title,
              'subtask_end_date' => $notifications2[$m2][0]->subtask_due_date
            );
          }
          $m2++;
        }
      } else {
        $arr2 = array();
      }

      if ($this->session->userdata('birthday_notify') == 1) {
        $birth = $this->bm->getAllWhere('users', 'dob', date('m/d/Y'), 'user_id');
      } else {
        $birth = array();
      }

      $arrsb = [
        'subtask_status_by' => '1',
        'subtask_status' => 'completed'
      ];
      $data = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrsb);

      $arrsr = [
        'subtask_status_by' => '30',
        'coordinator_status' => '0',
      ];
      $data1 = $this->bm->getRowsWithMultipleConditions('projects_subtasks', $arrsr);
      $tot = count($data) + count($data1) + count($birth) + count($arr) + count($arr1) + count($arr2);
      $total = array(
        'total_not' => $tot
      );
    }

    echo json_encode($total);
  }
}
