<?php
	class Simpan_m extends CI_Model
	{		
		function __construct()
		{
			parent::__construct();
		}

		function fetch_all(){
			
			$this->db->order_by('kode_simpan', 'DESC');
			return $this->db->get('t_simpan');
        }

		function insert_api($data)
		{
			$this->db->insert('t_simpan', $data);
		}

		function update_kode_simpan()
		{
			$query = "
			update t_simpan as a
			inner join t_kode b on a.id_kode = b.id_kode
			set a.kode_simpan = concat(b.kode,a.id_simpan)";
			$this->db->query($query);
			
		}
		function fetch_kode_anggota()
		{
			$query = $this->db->query('select kode_angt from t_anggota');			
			return $query->result_array();
		}
		function fetch_single($id){
			$this->db->where('id_simpan', $id);
			$query = $this->db->get('t_simpan');
			return $query->result_array();
		}
		function update_api($id,$data){
			$this->db->where('id_simpan', $id);
			$this->db->update('t_simpan',$data);
		}

		function delete_single($id)
		{
			$this->db->where('id_simpan', $id);
			$this->db->delete('t_simpan');
			if($this->db->affected_rows() > 0)
				{
					return true;
				}
			else
				{
					return false;
				}
		}

		function update_nominal()
		{
			$query = "
			update t_simpan as a
			inner join t_trans_simp b on a.kode_simpan = b.kode_simpan
			set 
			a.pokok = 
				(
				SELECT SUM(nominal) 
				FROM t_trans_simp 
				WHERE id_jenis_trans = 1 AND kode_simpan = a.kode_simpan
				),
			a.wajib = 
				(
				SELECT SUM(nominal) 
				FROM t_trans_simp 
				WHERE id_jenis_trans = 2 AND kode_simpan = a.kode_simpan
				),
			a.sukarela = 
				(
				SELECT SUM(nominal) 
				FROM t_trans_simp 
				WHERE id_jenis_trans = 3 AND kode_simpan = a.kode_simpan
				),
			a.jumlah = a.pokok+a.wajib+a.sukarela";
			$this->db->query($query);
		}

		

			
	}

?>