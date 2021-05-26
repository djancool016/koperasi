<?php
    class Transimp_m extends CI_Model
    {

        function __construct()
        {
            parent::__construct();
        }

        function fetch_all()
        {
            $this->db->select('*');
			$this->db->from('t_trans_simp');
            $this->db->join('t_jenis_trans', 't_jenis_trans.id_jenis_trans = t_trans_simp.id_jenis_trans','inner');
            $query = $this->db->get();
            return $query;

        }

        function insert_api($data)
        {
            $this->db->insert('t_trans_simp', $data);
        }

        function fetch_kode_simpan()
		{
			$query = $this->db->query('select kode_simpan from t_simpan');			
			return $query->result_array();
		}

        function update_kode_trans()
        {
            $query = "
			update t_trans_simp as a
			inner join t_kode b on a.id_kode = b.id_kode
			set a.kode_trans_simp = concat(b.kode,a.id_trans)";
			$this->db->query($query);
        }
        function get_all_jenis_trans(){
            $query = $this->db->query('select * from t_jenis_trans');			
			return $query->result();
        }

        function fetch_single($id){
			$this->db->where('id_trans', $id);
			$query = $this->db->get('t_trans_simp');
			return $query->result_array();
		}

		function update_api($id,$data){
			$this->db->where('id_trans', $id);
			$this->db->update('t_trans_simp',$data);
		}

        function delete_single($id)
		{
			$this->db->where('id_trans', $id);
			$this->db->delete('t_trans_simp');
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