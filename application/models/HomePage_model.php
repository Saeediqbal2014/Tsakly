<?php
class HomePage_model extends CI_Model
{

   public function selectAllData()
   {
       return $this->db->select('*')->get('students')->result();
   }
}






?>