<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
  //functions  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Main_model', 'mm');
    $this->load->model('Basic_model', 'bm');
    date_default_timezone_set("Asia/Karachi");
  }

  public function index()
  {
    if ($this->session->userdata('status') != '') {
      redirect('dashboard');
    } else {
      redirect('login/login');
    }
  }

  public function login()
  {
    $this->load->view("admin_login");
  }

  public function login_validation()
  {

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run()) {
      //true  
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      //model function  
      if ($data = $this->mm->getLoginDetail($email, $password)) {
        // echo "<pre>";


        if ($data[0]->status == 1) {

          $session_data = [
            'user' => '1',
            'status' => 'admin_active',
            'category' => $data[0]->cat_id,
            'id' => $data[0]->user_id,
            'name' => $data[0]->name,
            'img' => $data[0]->img
          ];
        } else {

          $session_data = [
            'status' => 'user_active',
            'category' =>  $data[0]->cat_id,
            'user' => $data[0]->user_id,
            'id' => $data[0]->user_id,
            'email' => $data[0]->email,
            'name' => $data[0]->name,
            'img' => $data[0]->img,

          ];

          foreach ($data as $d) {
            $session_data[$d->p_label] = $d->p_status;
          }


          // system('ipconfig /all');

          // // Capture the output into a variable  
          // $mycomsys = ob_get_contents();

          // // Clean (erase) the output buffer  
          // ob_clean();

          // $find_mac = "Physical";

          // $pmac = strpos($mycomsys, $find_mac);

          // $macaddress = substr($mycomsys, ($pmac + 36), 17);

          $attendance = array(
            "time_1" => date("H:i A"),
            "attendance_datetime" => date("d-m-y"),
            "user_id" => $data[0]->user_id,
            'ip' => $this->input->ip_address(),
            // "macaddress" => $macaddress
          );
        
          $session_data["att_id"] = $this->bm->insert('attendance', $attendance);
        }

        $this->session->set_userdata($session_data);
        redirect('dashboard');
      } else {
        $this->session->set_flashdata('error', 'Invalid Email and Password');
        redirect('login/login');
      }
    } else {
      //false  
      $this->login();
    }
  }
  public function logout()
  {
    $attendance = array(
      "time_2" => date("H:i A"),
    );
    $this->bm->update('attendance', $attendance, 'attendance_id', $_SESSION["att_id"]);
    $this->session->sess_destroy();
    redirect('login/login');
  }
}
