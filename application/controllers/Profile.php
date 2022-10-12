<?php 
class Profile extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
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
		$this->load->model('Main_model','mm');
	}

	public function profile()
	{
		$id=$this->session->userdata('id');
		$data = array(
			'title' =>'Manage Profile',
			'designation' =>$this->bm->getAll('designations'),
			'cat' => $this->bm->getAll('categories'),
			'skills' => $this->bm->getAll('skills'),
			'edit' => $this->bm->getRow('users','user_id',$id),
			'uskills' => $this->bm->getAllWhere('user_skills','user_id',$id,'user_id'),
			'qualification' => $this->bm->getAllWhere('user_qualification','user_id',$id,'user_id')
			);
			$this->load->view('template/header',$data);
			$this->load->view('template/nav');
			$this->load->view('users/myprofile',$data);
			$this->load->view('template/footer');
	}

	public function update_profile()
	{
		$id=$this->session->userdata('id');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('contact_no', 'contact number', 'required|integer');  
		$this->form_validation->set_rules('dob','dob', 'required');
		$this->form_validation->set_rules('address','address', 'required');
		$this->form_validation->set_rules('cnic','CNIC', 'required');
		$this->form_validation->set_rules('category', 'category', 'required');  
        $this->form_validation->set_rules('skills[]', 'skills', 'required');
        $this->form_validation->set_rules('degree[]', 'degree', 'required');
        $this->form_validation->set_rules('grade[]', 'grade', 'required');
        $this->form_validation->set_rules('year[]', 'passing year', 'required');
        if($this->form_validation->run())  
        {  
        	if(empty($_FILES['user_img']['name'])){ $user_img = '';}
	        else
	        {
	        	$img_name=rand().'.jpg';
	            $config['upload_path'] = 'uploads/users';
	            $config['allowed_types'] = 'jpg|jpeg|png|gif';
	            $config['file_name'] = $img_name;
                $this->load->library('image_lib'); 
                $this->load->library('upload',$config); 
                if($this->upload->do_upload('user_img'))
                {
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

	        if($user_img != null)
	        {
	            $field = array(
	        		'img' => $user_img,
	        		'name' => $this->input->post('username'),
	        		'contact_no' => $this->input->post('contact_no'),
	        		'dob' => $this->input->post('dob'),
	        		'cat_id' => $this->input->post('category'),
	        		'address' => $this->input->post('address'),
	        		'cnic' => $this->input->post('cnic')

		        );

	        }
	        else
	        {
	        	$field = array(
	        		'name' => $this->input->post('username'),
	        		'contact_no' => $this->input->post('contact_no'),
	        		'dob' => $this->input->post('dob'),
	        		'cat_id' => $this->input->post('category'),
	        		'address' => $this->input->post('address'),
	        		'cnic' => $this->input->post('cnic')

		        );
	        }
            
	        $this->bm->delete('user_skills', 'user_id', $id);
		    $this->bm->delete('user_qualification', 'user_id', $id);
            $arr = array();

			for ($i=0; $i<count($this->input->post('skills')); $i++)
			{

				$arr[$i] = array(
					'skill_name' => $this->input->post('skills')[$i],
					'user_id' => $this->session->userdata('id')
				);
			}
			$arr1 = array();

			for ($i1=0; $i1<count($this->input->post('degree')); $i1++)
			{
				$arr1[$i1] = array(
					'degree_name' => $this->input->post('degree')[$i1],
					'grade_or_cgpa' => $this->input->post('grade')[$i1],
					'passing_year' => $this->input->post('year')[$i1],
					'user_id' => $this->session->userdata('id')
				);
			}

			$arr2 = array();
			$o2=0;
			for ($i2=0; $i2<count($this->input->post('skills')); $i2++)
			{

				$o=0;
				$Ow = $this->bm->getAll('skills');
				for ($k=0; $k<count($Ow) ; $k++) { 
					if ($Ow[$k]->is_skill_name == $this->input->post('skills')[$i2]){
					$o=1;	
					}
				}
				if ($o==0) {
					$arr2[$o2] = array(
					'is_skill_name' => $this->input->post('skills')[$i2],
				);
					$o2++;
				}
				
			}

           	$data = $this->bm->update('users', $field, 'user_id', $this->session->userdata('id'));
            
           	if($data > 0) 
            {    
            	$this->bm->insert_batch('user_skills', $arr);
	            $this->bm->insert_batch('user_qualification', $arr1);
	            if (!empty($arr2)) {
	            	$this->db->insert_batch('skills',$arr2);
	            }
	           	
               	$this->session->set_userdata('name', $this->input->post('username'));  
               	$this->session->set_userdata('img',$user_img);       
                $this->session->set_flashdata('errorprofile', 'Username has been updated successfully..!');
                redirect('profile/profile');  
            }  
            else  
            {  
                     $this->session->set_flashdata('errorprofile', 'Something wrong');  
                     redirect('profile/profile');  
            }
        }
        else  
        {  
            $this->session->set_flashdata('errorprofile1', 'Something wrong');  
            $this->profile();
        }
	        	
	}

	public function update_password()
	{
		$id=$this->session->userdata('id');
		$this->form_validation->set_rules('old_password', 'Old Password', "trim|required|callback_password_matches[$id]");
	    $this->form_validation->set_rules('new_password', 'New Password', "trim|required");
	   	$this->form_validation->set_rules('confirm_password', 'Confirm Password', "trim|required|matches[new_password]");
	   	if($this->form_validation->run())
	   	{
	   			$field = array(
	        		'password' => $this->input->post('confirm_password')
	        	);
				$data=$this->bm->update('users',$field,'user_id',$id);
	        	if($data > 0) 
                {                     
                     $this->session->set_flashdata('errorpass', 'Password has been updated successfully..!');
                     redirect('profile/profile');  
                }  
                else  
                {  
                     $this->session->set_flashdata('errorpass', 'Something wrong');  
                     redirect('profile/profile');  
                }  
        }  
        else  
        {  
            //false
        	$this->session->set_flashdata('errorpass1', 'Password has been updated successfully..!');
            $this->profile();  
       	}
	}

	public function password_matches($password, $pi)
	{
		$arr=array(
			'user_id' => $pi,
			'password' => $password
		);
	  if (!$this->bm->getRowsWithMultipleConditions('users',$arr))
	  {
	   
	   	$this->form_validation->set_message('password_matches', 'The password you entered does not match your old password.');
	   	return FALSE;
	  } 
	  else 
	  {
	   	return TRUE;
	  }
	  
	}
}