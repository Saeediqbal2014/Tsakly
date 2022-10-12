<?php
class Categories extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('status') == null)
		{
		    redirect('Login');
		}
		else
		{
			if($this->session->userdata('category')==0)
			{
				redirect('Skills');
			}
		}
		$this->load->model('Basic_model','bm');
	}

	public function index()
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('cat_show')==1 || $this->session->userdata('cat_create')==1 || $this->session->userdata('cat_add')==1)
		{
			$data = array(
				'title' =>'All Categories',
				'categories'=>$this->bm->getAll('categories') 
			);
			$this->load->view('template/header',$data);
			$this->load->view('template/nav');
			$this->load->view('categories/index',$data);
			$this->load->view('template/footer');
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function insert_form()
	{	
		if($this->session->userdata('user')==1 || $this->session->userdata('cat_create')==1 || $this->session->userdata('cat_add')==1)
		{
			$data = array(
			'title' =>'Add Category'
			);
			$this->load->view('template/header',$data);
			$this->load->view('template/nav');
			$this->load->view('categories/add');
			$this->load->view('template/footer');
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function add()
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('cat_create')==1)
		{	
			$this->form_validation->set_rules('category', 'Category', 'required|is_unique[categories.cat_name]');  
	        if($this->form_validation->run())
	        {
	        	$field = array(
	        		'cat_name' => $this->input->post('category')
	        	);
	        	$data=$this->bm->insert('categories',$field);
	        	if($data > 0) 
                {                     
                     $this->session->set_flashdata('error', 'New category has been inserted successfully..!');
                     redirect('categories');  
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Something wrong');  
                     redirect('categories');  
                }  
           	}  
           	else  
           	{  
                //false  
                $this->insert_form();
           	}
        }
		else
		{
			redirect('dashboard');
		}   	  
	}

	public function edit($id)
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('cat_edit')==1)
		{
			$data = array(
				'title' =>'Edit Catgeory',
				'edit'=>$this->bm->getRow('categories','cat_id',$id)
			);
			$this->load->view('template/header',$data);
			$this->load->view('template/nav');
			$this->load->view('categories/edit',$data);
			$this->load->view('template/footer');
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function update()
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('cat_edi')==1)
		{

			$id=$this->input->post('id');
			$this->form_validation->set_rules('category', 'Category', 'required');  
	        if($this->form_validation->run())
	        {
	        	$field = array(
	        		'cat_name' => $this->input->post('category')
	        	);
				$data=$this->bm->update('categories',$field,'cat_id',$id);
	        	if($data > 0) 
                {                     
                     $this->session->set_flashdata('error', 'Category has been updated successfully..!');
                     redirect('categories');  
                }  
                else  
                {  
                     $this->session->set_flashdata('error', 'Something wrong');  
                     redirect('categories');  
                }  
           	}  
           	else  
           	{  
       			//false
               $this->edit($id);  
           	}  
		}
		else
		{
			redirect('dashboard');
		}
	}

	public function delete()
	{
		if($this->session->userdata('user')==1 || $this->session->userdata('cat_create')==1)
		{
			$id = $this->input->post('del');
			$data = array('title' => 'Delete Catgeory');
			$del=$this->bm->delete('categories','cat_id', $id);
			if ($del > 0)
			{
				$this->session->set_flashdata('error','Catgeory has been deleted successfully..!');
			}
			else
			{
				$this->session->set_flashdata('error','Something wrong');
			}
			redirect('categories');
		}
		else
		{
			redirect('dashboard');
		}
	}
}