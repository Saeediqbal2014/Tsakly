<?php

class Mainpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('HomePage_model');
        

    }

    public function index()
    {
        echo"Hello World";
    }

    public function fetchAlldata()
    {

       $data['AllData'] = $this->HomePage_model->selectAllData();
       echo"<pre>";
       print_r($data);

       
    }

    
}




?>