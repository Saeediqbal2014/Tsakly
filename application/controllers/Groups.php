<?php
class Groups extends CI_Controller
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
        // print_r($this->session->userdata('status')); die();
        if ($this->session->userdata('user') == 1 || $this->session->userdata('group_add') == 1 || $this->session->userdata('group_show') == 1 || $this->session->userdata('group_edit') == 1 || $this->session->userdata('group_delete') == 1) {
            $data['title'] = 'Groups';
            $data['groups'] = $this->mm->allGroups();

            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('Groups/index.php', $data);
            $this->load->view('template/footer');
        } else {
            redirect('dashboard');
        }
    }

    public function add_group()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('group_add') == 1) {
            $data['title'] = 'Add Group';
            // $data['groups'] = $this->mm->allgroups();
            // print_r($data['groups']); die();
            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('Groups/add_group_view');
            $this->load->view('template/footer');
        } else {
            redirect('dashboard');
        }
    }

    public function addGroup()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('group_add') == 1) {
            $this->form_validation->set_rules('group', 'Group Name', 'required|is_unique[account_group.name]');
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => ucwords($this->input->post('group'))
                );
                $result = $this->mm->addGroup($data);
                if ($result) {
                    $this->session->set_flashdata('insert', 'Inserted Successfully');
                    redirect('Groups');
                } else {
                    $this->session->set_flashdata('error', 'Error #');
                    echo '<script>window.history.back()</script>';
                }
            } else {
                $this->add_group();
            }
        } else {
            redirect('dashboard');
        }
    }


    public function getGroup($id)
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('group_edit') == 1) {
            $data['title'] = 'Update Group';
            $data['group'] = $this->mm->getGroup($id);
            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('Groups/update_group_view', $data);
            $this->load->view('template/footer');
        } else {
            redirect('dashboard');
        }
    }

    public function updateGroup()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('group_edit') == 1) {
            $name = $this->input->post('group');
            $id = $this->input->post('id');
            $this->form_validation->set_rules('group', 'Group Name', 'required|is_unique[account_group.name]');
            if ($this->form_validation->run()) {
                // print_r($name); die();
                $data = array(
                    'name'  => ucwords($name)
                );
                $result = $this->mm->updateGroup($data, $id);
                if ($result) {
                    $this->session->set_flashdata('update', 'Updated Successfully');
                    redirect('Groups');
                } else {
                    $this->session->set_flashdata('error', 'Error #');
                    echo '<script>window.history.back()</script>';
                }
            } else {
                $this->getGroup($id);
            }
        } else {
            redirect('dashboard');
        }
    }

    public function delete_group()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('group_delete') == 1) {
            $id = $this->input->post('g_id');
            // $data = $this->mm->getGroupTransaction($id);
            // print_r($data); die();
            $this->mm->deleteGroup($id);
            $this->mm->deleteGroupTransactions($id);
            $this->session->set_flashdata('dalete', 'Deleted Successfully');
            redirect('Groups');
        } else {
            redirect('dashboard');
        }
    }

    public function subgroup()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_add') == 1 || $this->session->userdata('subgroup_edit') == 1  || $this->session->userdata('subgroup_show') == 1) {
            $data['title'] = 'Sub Groups';
            $data['subgroup'] = $this->mm->allsubgroup();

            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('subgroups/index.php', $data);
            $this->load->view('template/footer');
        } else {
            redirect('dashboard');
        }
    }

    public function addsubgroup()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_add') == 1) {
            $this->form_validation->set_rules('name', 'Sub Group Name', 'required|is_unique[account_subgroup.name]');
            if ($this->form_validation->run()) {
                $data = array(
                    'name' => ucwords($this->input->post('name')),
                    "group_id" => $this->input->post("group"),
                );
                $result = $this->bm->insert('account_subgroup', $data);
                if ($result) {
                    $this->session->set_flashdata('insert', 'Inserted Successfully');
                    redirect('Groups/subgroup');
                } else {
                    $this->session->set_flashdata('error', 'Error #');
                    echo '<script>window.history.back()</script>';
                }
            } else {
                $this->add_subgroup();
            }
        } else {
            redirect('dashboard');
        }
    }



    public function add_subgroup()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_add') == 1) {
            $data['title'] = 'Add Sub Group';
            $data['groups'] = $this->mm->allgroups();
            // print_r($data['groups']); die();
            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('subgroups/add_subgroup_view');
            $this->load->view('template/footer');
        } else {
            redirect('dashboard');
        }
    }


    public function subgoupedit($id)
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_edit') == 1) {
            $data['title'] = 'Update Group';
            $data['subgroup'] = $this->bm->getRow('account_subgroup', 'id', $id);
            $data['groups'] = $this->mm->allgroups();
            // print_r($data);
            $this->load->view('template/header', $data);
            $this->load->view('template/nav');
            $this->load->view('subgroups/edit', $data);
            $this->load->view('template/footer');
        } else {
            redirect('dashboard');
        }
    }

    public function update_subgroup()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_edit') == 1) {
            $id = $this->input->post('id');
            $this->form_validation->set_rules('name', 'Sub group name', 'required');
            if ($this->form_validation->run()) {
                $field = array(
                    'name' => $this->input->post('name'),
                    'group_id' => $this->input->post('group')
                );
                $data = $this->bm->update('account_subgroup', $field, 'id', $id);
                if ($data > 0) {
                    $this->session->set_flashdata('update', 'task has been updated successfully..!');
                    redirect('Groups/subgroup');
                } else {
                    $this->session->set_flashdata('error', 'Something wrong');
                    redirect('Groups/subgroup');
                }
            } else {
                //false  
                $this->subgoupedit($id);
            }
        } else {
            redirect('dashboard');
        }
    }


    public function delete_subgroup()
    {
        if ($this->session->userdata('user') == 1 || $this->session->userdata('subgroup_delete') == 1) {
            $id = $this->input->post('id');
            $this->bm->delete('account_subgroup', 'id', $id);
            $this->session->set_flashdata('dalete', 'Deleted Successfully');
            redirect('Groups/subgroup');
        } else {
            redirect('dashboard');
        }
    }


    public function get_subg()
    {

        $id = $this->input->post("id");
        // echo $id;
        $data =  $this->bm->getAllWhere('account_subgroup', 'group_id', $id, 'name');
        echo json_encode($data);
    }
}
