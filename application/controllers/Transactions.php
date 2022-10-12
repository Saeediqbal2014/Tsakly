<?php
class Transactions extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('status') == null) {
      redirect('Login');
    }

    $this->load->model('Basic_model', 'bm');
    $this->load->model('Main_model', 'mm');
  }

  public function index()
  {
    if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_add') == 1 || $this->session->userdata('tran_edit') == 1  || $this->session->userdata('tran_show') == 1 || $this->session->userdata('tran_delete') == 1) {
      $data['title'] = 'Transactions';
      $data['transactions'] = $this->mm->allTransactions();

      $this->load->view('template/header', $data);
      $this->load->view('template/nav');
      $this->load->view('Transactions/index.php');
      $this->load->view('template/footer');
    } else {
      redirect('dashboard');
    }
  }

  public function add_trans()
  {
    if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_add') == 1) {
      $data['title'] = 'Add Transaction';
      $data['groups'] = $this->mm->allgroups();
      $data['projects'] = $this->mm->getAllProjects('projects', 'project_id');
      $this->load->view('template/header', $data);
      $this->load->view('template/nav');
      $this->load->view('Transactions/add_transaction');
      $this->load->view('template/footer');
    } else {
      redirect('dashboard');
    }
  }

  public function add_transaction()
  {
    if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_add') == 1) {

      $data['groups'] = $this->mm->allgroups();
      $balance = $this->mm->fetchBalance();
      $b_id = $balance[0]->id;
      $amount = $balance[0]->amount;
      $balance_type = $this->input->post('balance_type');
      $t_amount = $this->input->post('balance');
      $date = $this->input->post('date');

    
      $this->form_validation->set_rules('group', 'Group', 'required');
      $this->form_validation->set_rules('balance', 'Balance', 'required');
      $this->form_validation->set_rules('date', 'Date', 'required');
      $this->form_validation->set_rules('subg_group', 'Sub Group', 'required');
      $this->form_validation->set_rules('description', 'Description', 'required');

      if ($this->form_validation->run() == TRUE or FALSE) {
        $pr = 0;
        if (isset($_POST["project"])) {

          if (!empty($_POST["project"])) {
            $pr = $_POST["project"];
            $projects  =  $this->bm->getRow('projects', 'project_id', $pr);

            if ($balance_type == 'debit') {
              $paid_amount = $projects->pay_recieved + $t_amount;
              $blnce_data = array("pay_recieved" => $paid_amount);
              $this->bm->update('projects', $blnce_data, 'project_id', $pr);
            } else {
              $paid_amount = $projects->pay_recieved - $t_amount;
              $blnce_data = array("pay_recieved" => $paid_amount);
              $this->bm->update('projects', $blnce_data, 'project_id', $pr);
            }
          }
        }


        $data = array(
          'group_id'  => $this->input->post('group'),
          'subgroup_id'  => $this->input->post('subg_group'),
          'project_id'  => $pr,
          'description'  => $this->input->post('description'),
          'user_id'  =>  $this->session->userdata('id'),
          'date'  => $this->input->post('date'),
          'month'  => date('m')
        );
        // print_r($data); die();
        if ($balance_type == 'debit') {
          $new_balance = $amount + $t_amount;
          $data['debit']  = $this->input->post('balance');
          $data['credit']  = 0;
        } else {
          $new_balance = $amount - $t_amount;
          $data['credit']  = $this->input->post('balance');
          $data['debit']  = 0;
        }
        $result = $this->mm->insertTransaction($data);
        if ($result) {

          $data = array(
            'amount'  => $new_balance
          );
          $result = $this->mm->afterTransactionBalance($data, $b_id);

          $this->session->set_flashdata("insert", "Inserted successfully");
          redirect(base_url() . "Transactions");
        } else {
          $this->session->set_flashdata('error', 'Error #');
          echo '<script>window.history.back()</script>';
        } // If Data is Not inserted in DB
      } else {
        $this->add_trans();
      }
    } else {
      redirect('dashboard');
    }
  }


  public function getTrans($id)
  {
    if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_edit') == 1) {
      $data['title'] = 'Update Transaction';
      $data['transaction'] = $this->mm->getTransaction($id);
      $data['groups'] = $this->mm->allgroups();
      $data['projects'] = $this->mm->getAllProjects('projects', 'project_id');
      $this->load->view('template/header', $data);
      $this->load->view('template/nav');
      $this->load->view('Transactions/update_transaction', $data);
      $this->load->view('template/footer');
    } else {
      redirect('dashboard');
    }
  }

  public function updateTransaction()
  {
    if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_edit') == 1) {
      $balance = $this->mm->fetchBalance();
      $b_id = $balance[0]->id;
      $amount = $balance[0]->amount;
      $id = $this->input->post('trans_id');
      $old_debit = $this->input->post('old_debit');
      $old_credit = $this->input->post('old_credit');
      $balance_type = $this->input->post('balance_type');
      $t_amount = $this->input->post('balance');
      $old_amount = $amount + $old_credit - $old_debit;

      $data = array(
        'group_id'  => $this->input->post('group'),
        'description'  => $this->input->post('description'),
        'date' => $this->input->post('date')
      );
      if (isset($_POST["project"])) {

        if (!empty($_POST["project"])) {
          $pr = $_POST["project"];
          $prev_amnt = $_POST["prev_amnt"];
          $projects  =  $this->bm->getRow('projects', 'project_id', $pr);

          if ($balance_type == 'debit') {
            $n = $projects->pay_recieved - $prev_amnt;
            $paid_amount = $n + $t_amount;
            $blnce_data = array("pay_recieved" => $paid_amount);
            $this->bm->update('projects', $blnce_data, 'project_id', $pr);
          } else {
            $n = $projects->pay_recieved + $prev_amnt;
            $paid_amount = $n - $t_amount;
            $blnce_data = array("pay_recieved" => $paid_amount);
            $this->bm->update('projects', $blnce_data, 'project_id', $pr);
          }
        }
      } else {
        $pr = 0;
      }
      if ($balance_type == 'debit') {
        $new_balance = $old_amount + $t_amount;
        $data["credit"] = 0;
        $data["debit"] = $t_amount;
        
      } else {
        $new_balance = $old_amount - $t_amount;
        $data = array(
          'debit'  => 0,
          'credit'  => $t_amount,
        );
      }

      $data["subgroup_id"] = $this->input->post("subg_group");
      $result = $this->mm->updateTransaction($data, $id);
      if ($result) {

        $data = array(
          'amount'  => $new_balance
        );
        $result = $this->mm->afterTransactionBalance($data, $b_id);

        $this->session->set_flashdata('update', 'Update Successfully');
        redirect(base_url('Transactions'));
      } else {
        $this->session->set_flashdata('error', 'Error #');
        echo '<script>window.history.back()</script>';
      }
      if ($result) {
        $this->session->set_flashdata("insert", "Inserted successfully");
        redirect(base_url() . "Transactions");
      } else {
        $this->session->set_flashdata("message", "<script>alert('Something Went Wrong Please Try Again Later')</script>");
        echo "<script>window.history.back()</script>";
      } // If Data is Not inserted in DB
    } else {
      redirect('dashboard');
    }
  }

  public function delete_trans()
  {
    if ($this->session->userdata('user') == 1 || $this->session->userdata('tran_delete') == 1) {
    //   $balance = $this->mm->fetchBalance();
    //   $b_id = $balance[0]->id;
    //   $amount = $balance[0]->amount;
      $id = $this->input->post('t_id');
    //   echo $id; die();
    //   $transaction = $this->mm->getTransaction($id);
    //   $debit = $transaction[0]->debit;
    //   $credit = $transaction[0]->credit;
    //   $new_balance = $amount - $debit + $credit;
    //   $tran  =  $this->bm->getRow('transaction', 'id', $id);
    //   if ($tran->project_id != 0) {
    //     $pr = $tran->project_id;

    //     $projects  =  $this->bm->getRow('projects', 'project_id', $pr);
    //     if ($tran->debit != 0) {
    //       $prev_amnt = $tran->debit;
    //       $n = $projects->pay_recieved - $prev_amnt;
    //     } else {
    //       $prev_amnt = $tran->credit;
    //       $n = $projects->pay_recieved + $prev_amnt;
    //     }
    //     $blnce_data = array("pay_recieved" => $n);
    //     $this->bm->update('projects', $blnce_data, 'project_id', $pr);
    //   } else {
    //     echo "no";
    //   }
      // die();
      $data = array('title' => 'Delete Role');
      $this->mm->deleteTransaction($id);
    //   $data = array(
    //     'amount'  => $new_balance
    //   );
    //   $this->mm->afterTransactionBalance($data, $b_id);
      $this->session->set_flashdata('delete', 'Delete Successfully');
      redirect('Transactions');
    } else {
      redirect('dashboard');
    }
  }
  
  
  public function get_SubGroups_By_Group_Id($group_id){
      $sub_groups = $this->bm->get_SubGroups_By_Group_Id($group_id);
      echo json_encode($sub_groups);
  }
}
