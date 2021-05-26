<?php

class Pinjam_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function fetch_all(){
			
        $this->db->order_by('kode_pinj', 'DESC');
        return $this->db->get('t_pinjam');
    }

    function insert_api($data)
    {
        $this->db->insert('t_pinjam', $data);
    }

    function fetch_kode_anggota()
    {
        $query = $this->db->query('select kode_angt from t_anggota');			
        return $query->result_array();
    }

    function update_kode_simpan()
    {
        $query = "
        update t_pinjam as a
        inner join t_kode b on a.id_kode = b.id_kode
        set a.kode_pinj = concat(b.kode,a.id_pinj)";
        $this->db->query($query);
        
    }

    function update_data_pinjam()
    {
        $query = "
        update t_pinjam as a
        set 
        a.jml_pinj = a.pinj + a.jml_bunga_pinj,
        a.jml_bunga_pinj = a.bunga_pinj * pinj / 100,
        a.jml_angs = a.jml_pinj / a.tenor,
        a.sisa_pinj = a.jml_pinj - a.jml_msk      
        ";
        $this->db->query($query);
    }

    function update_nominal()
		{
			$query = "
			update t_pinjam as a
			inner join t_trans_angs b on a.kode_pinj = b.kode_pinj
			set 
            a.angs_ke = 
                (
                SELECT COUNT(b.kode_pinj) 
				FROM t_trans_angs
				WHERE kode_pinj = a.kode_pinj
                ),
			a.jml_msk = 
				(
				SELECT SUM(nominal) 
				FROM t_trans_angs
				WHERE kode_pinj = a.kode_pinj
                ),
            a.sisa_pinj = a.jml_pinj-a.jml_msk";
			$this->db->query($query);
		}
  
    

}

?>