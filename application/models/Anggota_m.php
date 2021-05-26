<?php
	class Anggota_m extends CI_Model
	{		
		function __construct()
		{
			parent::__construct();
		}

		function fetch_all(){
			$this->db->select('*');
			$this->db->from('t_anggota');
			$this->db->join('t_unit', 't_unit.id_unit = t_anggota.id_unit','inner');
			$this->db->join('t_status', 't_status.id_status = t_anggota.id_status', 'inner');
			$query = $this->db->get();
			return $query;
        }

		function insert_api($data)
		{
			$this->db->insert('t_anggota', $data);
		}

		function fetch_single($id){
			$this->db->where('id_angt', $id);
			$query = $this->db->get('t_anggota');
			return $query->result_array();
		}

		function update_api($id,$data){
			$this->db->where('id_angt', $id);
			$this->db->update('t_anggota',$data);
		}

		function delete_single($id)
		{
			$this->db->where('id_angt', $id);
			$this->db->delete('t_anggota');
			if($this->db->affected_rows() > 0)
				{
					return true;
				}
			else
				{
					return false;
				}
		}
		function update_kode_angt()
		{
			$query = "
			update t_anggota as a
			inner join t_kode k on a.id_kode = k.id_kode
			set a.kode_angt = concat(k.kode,a.id_angt)";
			$this->db->query($query);
			
		}
		function get_all_unit(){
			$query = $this->db->query('select id_unit, unit from t_unit');			
			return $query->result();
		}
		function get_all_status(){
			$query = $this->db->query('select id_status, status from t_status');			
			return $query->result();
		}

			
	}

?>