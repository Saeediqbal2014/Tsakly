<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fullcalendar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fullcalendar_model');
        if ($this->session->userdata('status') == null) {
            redirect('Login');
        } else {
            if ($this->session->userdata('category') == 0) {
                redirect('Skills');
            }
        }
    }

    function index()
    {
        $data = array(
            'title' => 'Calender'
        );
        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('calender/fullcalendar');
        $this->load->view('template/footer');
    }

    function load()
    {
        error_reporting(0);
        $id = $_SESSION["id"];
        $event_data = $this->fullcalendar_model->fetch_all_event($id);
        foreach ($event_data->result_array() as $row) {

            $data[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start_event'],
                'description' => $row['description'],
            );
        }
        echo json_encode($data);
    }

    function insert()
    {
        // print_r($this->input->post());
        // die();
        $data = array(
            'title'         =>  $this->input->post('title'),
            'start_event'   =>  $this->input->post('start_event'),
            'end_event'     =>  $this->input->post('end_event'),
            'description'   =>  $this->input->post('description'),
            "user_id"       =>  $_SESSION["id"]
        );
        $insert =  $this->fullcalendar_model->insert_event($data);
        if ($insert == true) {
            $this->session->set_flashdata('added', 'Event Added Succefully');
            redirect(base_url("events_calendar"));
        } else {
            $this->session->set_flashdata('error', 'Something Went Wrong');
            redirect(base_url("events_calendar"));
        }
    }

    function update()
    {
        if ($this->input->post('id')) {
            $data = array(
                'title'   => $this->input->post('title'),
                'description'  => $this->input->post('description'),
                'start_event' => $this->input->post('start'),
                'end_event'  => $this->input->post('end')
            );

            $this->fullcalendar_model->update_event($data, $this->input->post('id'));
        }
    }

    function delete()
    {
        if ($this->input->post('id')) {
            $this->fullcalendar_model->delete_event($this->input->post('id'));
        }
    }


    public function task_calendar()
    {
        // echo $_SESSION['user']; exit;

        $data = [

            'title' => 'Task Calender'

        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('calender/task_calendar');
        $this->load->view('template/footer');
    }

    public function getTasks()
    {
        $event_data = $this->fullcalendar_model->fetch_all_tasks();
        foreach ($event_data->result_array() as $row) {

            $data[] = [

                'id'            =>      $row['project_task_id'],
                'title'         =>      $row['task_title'],
                'start'         =>      date("Y-m-d", strtotime($row['task_due_date'])),
                'description'   =>      $row['task_description']

            ];
        }

        echo json_encode($data);
    }

    public function subtask_calendar()
    {
        $data = [
            'title' => 'Subtask Calender'
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/nav');
        $this->load->view('calender/subtask_calendar');
        $this->load->view('template/footer');
    }

    public function getSubTasks()
    {
        $event_data = NULL;
        if ($_SESSION['user'] != 1) {
            $event_data = $this->db->select('projects_subtasks.*')->from('projects_subtasks')
                ->join('projects_tasks', 'projects_tasks.project_task_id=projects_subtasks.project_task_id')
                ->join('projects', 'projects.project_id=projects_subtasks.project_id')->where("user_id", $_SESSION['user'])
                ->get();
        } else {
            $event_data = $this->fullcalendar_model->fetch_all_subtasks();
        }
        foreach ($event_data->result_array() as $row) {
            $data[] = [
                'id'                =>      $row['project_subtask_id'],
                'title'             =>      $row['subtask_title'],
                'start'             =>      $row['subtask_due_date'],
                'end'               =>      $row['subtask_due_date'],
                'description'       =>      $row['subtask_description']
            ];
        }

        echo json_encode($data);
    }

    public function getSubtaskDetails($subtask_id)
    {

        $subtask = $this->fullcalendar_model->getSubtaskDetails($subtask_id);

        $data['project_id'] = $subtask->project_id;

        echo json_encode($data);
    }
}
