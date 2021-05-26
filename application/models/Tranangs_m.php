<?php

class Tranangs_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function fetch_all()
    {
        $this->db->select('*');
        $this->db->from('t_trans_angs');
        $query = $this->db->get();
        return $query;
    }

    function insert_api($data)
    {
        $this->db->insert('t_trans_angs', $data);
    }

    function fetch_kode_pinjam()
    {
        $query = $this->db->query('select kode_pinj from t_pinjam');			
        return $query->result_array();
    }

    function update_kode_trans_angs()
    {
        $query = "
        update t_trans_angs as a
        inner join t_kode b on a.id_kode = b.id_kode
        set a.kode_trans_angs = concat(b.kode,a.id_trans)";
        $this->db->query($query);
    }

    function fetch_single($id){
        $this->db->where('id_trans', $id);
        $query = $this->db->get('t_trans_angs');
        return $query->result_array();
    }

    function update_api($id,$data){
        $this->db->where('id_trans', $id);
        $this->db->update('t_trans_angs',$data);
    }

    function delete_single($id)
    {
        $this->db->where('id_trans', $id);
        $this->db->delete('t_trans_angs');
        if($this->db->affected_rows() > 0)
            {
                return true;
            }
        else
            {
                return false;
            }
    }
}

?>