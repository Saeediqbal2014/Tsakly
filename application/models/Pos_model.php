<?php
class Pos_model extends CI_Model
{
    public function insert($table, $array)
    {
        return $this->db->insert($table, $array);
    }

    public function getAll($table)
    {
        return $this->db->select("*")->from($table)->get()->result();
    }

    public function getRow($table, $id)
    {
        return $this->db->select("*")->from($table)->where('id', $id)->get()->row();
    }

    public function update($table, $array, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($table, $array);
    }

    public function delete($table, $id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }

    public function getAllSell()
    {
        return $this->db->select('p.*,i.name as product, u.name as user')->from('purchase as p')
            ->join('item as i', 'p.item_id = i.id')
            ->join('users as u', 'p.user_id = u.user_id')
            ->get()->result();
    }

    public function getMyPurchase($val)
    {
        return $this->db->select('p.*,i.name as product, u.name as user')->from('purchase as p')
            ->join('item as i', 'p.item_id = i.id')
            ->join('users as u', 'p.user_id = u.user_id')
            ->where('p.user_id', $val)
            ->get()->result();
    }
}
