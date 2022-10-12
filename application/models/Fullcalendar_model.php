<?php

class Fullcalendar_model extends CI_Model
{
    function fetch_all_event($id){
        return $this->db->where("user_id",$id)->order_by('id')->get('events');
    }

    function insert_event($data)
    {
        return $this->db->insert('events', $data);
    }

    function update_event($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }

    function delete_event($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('events');
    }
    
    function fetch_all_tasks()
    {
        $this->db->select('projects_tasks.*');
        $this->db->from('projects_tasks');
        $this->db->join('projects','projects.project_id=projects_tasks.project_id');
        return $this->db->get();
        
    }
    
    function fetch_all_subtasks()
    {
        $this->db->select('projects_subtasks.*');
        $this->db->from('projects_subtasks');
        $this->db->join('projects_tasks','projects_tasks.project_task_id=projects_subtasks.project_task_id');
        $this->db->join('projects','projects.project_id=projects_subtasks.project_id');
        return $this->db->get();
        
    }
    
    function getSubtaskDetails($subtask_id)
    {
         $this->db->select('projects_subtasks.*');
         $this->db->from('projects_subtasks');
         $this->db->where('projects_subtasks.project_subtask_id',$subtask_id);
         return $this->db->get()->row();
         
    }
    
}

?>