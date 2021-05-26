<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Koperasi_Api extends CI_Controller
{

    public function __construct(){
		parent::__construct();
		$this->load->model('Anggota_m');
        $this->load->model('Simpan_m');
        $this->load->model('Pinjam_m');
		$this->load->model('Transimp_m');
		$this->load->model('Tranangs_m');
		$this->load->library('form_validation');
	}

// ------------------------------ ANGGOTA API -------------------------------------

    function fetch_angt_all(){
        $data = $this->Anggota_m->fetch_all();
		echo json_encode($data->result_array());
    }

    function fetch_angt_single(){

		if($this -> input -> post('id_angt'))
		{
			$data = $this->Anggota_m->fetch_single($this->input->post('id_angt'));
			foreach($data as $row)
			{
				$output["nama"] = $row["nama"];
				$output["id_unit"] = $row["id_unit"];
				$output["id_status"] = $row["id_status"];
			}
			echo json_encode($output);			
		}
	}

    function insert_angt()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('id_unit', 'Telp', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'nama'			=>	$this->input->post('nama'),
				'id_unit'		=>	$this->input->post('id_unit'),			
			);

			$this->Anggota_m->insert_api($data);
			$this->Anggota_m->update_kode_angt();

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
				'nama_error'			=>	form_error('nama'),
				'id_unit_error'			=>	form_error('id_unit')
			);
		}
		echo json_encode($array);		
	}

    function update_angt()
	{
		$this->form_validation->set_rules('nama', 'Nama','required');
		$this->form_validation->set_rules('id_unit', 'Unit','required');
		$this->form_validation->set_rules('id_status', 'Status','required');

		if($this->form_validation->run())
		{
			$data = array(
				'nama' =>  $this->input->post('nama'),
				'id_unit' =>  $this->input->post('id_unit'),
				'id_status' =>  $this->input->post('id_status')
			);

			$this->Anggota_m ->update_api($this->input->post('id_angt'), $data);

			$array = array(
				'success' => true
			);
		}
		else
		{
			$array = array(
				'error' => true,
				'nama_error' => form_error("nama"),
				'id_unit_error' => form_error("id_unit"),
				'id_status_error' => form_error("id_status")
			);
		}
		echo json_encode($array);
	}

    function delete_angt(){
		if($this -> input -> post('id_angt'))
		{
			if($this->Anggota_m->delete_single($this->input->post('id_angt')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}
 
// ------------------------------ SIMPAN API  -------------------------------------

    function fetch_simpan_all(){
        $this->Simpan_m->update_nominal();
        $data = $this->Simpan_m->fetch_all();
        echo json_encode($data->result_array()); 		
    }

    function fetch_simpan_single(){

		if($this -> input -> post('id_simpan'))
		{
			$data = $this->Simpan_m->fetch_single($this->input->post('id_simpan'));
			echo json_encode($data);			
		}
	}

    function insert_simpan()
	{		
		$this->form_validation->set_rules('kode_angt', 'ID Anggota', 'callback_form_check_simpan');

		if($this->form_validation->run())
		{
			$data = array(
				'kode_angt'		=>	$this->input->post('kode_angt')
			);
      
			$this->Simpan_m->insert_api($data);
            $this->Simpan_m->update_kode_simpan();

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
                'kode_angt_error'		=>	form_error('kode_angt'),
			);
		}
		echo json_encode($array);		
	}

    function update_simpan()
	{
		
		$this->form_validation->set_rules('kode_angt', 'ID Anggota', 'callback_form_check_simpan');
		if($this->form_validation->run())
		{
			$data = array(
				'kode_angt' =>  $this->input->post('kode_angt')
			);

			$this->Simpan_m->update_api($this->input->post('id_simpan'), $data);

			$array = array(
				'success' => true
			);
		}
		else
		{
			$array = array(
				'error' => true,
				'kode_angt_error' => form_error("kode_angt")
			);
		}
		echo json_encode($array);
	}

    function delete_simpan(){
		if($this -> input -> post('id_simpan'))
		{
			if($this->Simpan_m->delete_single($this->input->post('id_simpan')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

    function form_check_simpan($data)
    {
        $array = $this->Simpan_m->fetch_kode_anggota();
        $arr = array_column($array,"kode_angt");
        

        if(!$data){
            $this->form_validation->set_message('form_check_simpan', 'ID belum diisi');
            return FALSE;
        }
        elseif (!in_array($data,$arr))
        {
                $this->form_validation->set_message('form_check_simpan', 'Anggota dengan ID '.$data.' tidak terdaftar');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }
// ------------------------------ PINJAM API  -------------------------------------

    function fetch_pinjam_all(){
        $this->Pinjam_m->update_data_pinjam();
        $this->Pinjam_m->update_nominal();
        $data = $this->Pinjam_m->fetch_all();
        echo json_encode($data->result_array()); 
    }

    function fetch_pinjam_single(){
        if($this -> input -> post('id_pinjam'))
		{
			$data = $this->Pinjam_m->fetch_single($this->input->post('id_pinjam'));
			foreach($data as $row)
			{
				$output["kode_pinj"] = $row["kode_pinj"];
			}
			echo json_encode($output);			
		}
    }

    function insert_pinjam()
	{
		$this->form_validation->set_rules('kode_angt', 'ID Anggota', 'callback_form_check_pinjam');
        $this->form_validation->set_rules('tenor', 'Tenor', 'required');
        $this->form_validation->set_rules('bunga_pinj', 'Bunga Pinjaman', 'required');
        $this->form_validation->set_rules('pinj', 'Jumlah Pinjaman', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'kode_angt'		=>	$this->input->post('kode_angt'),
                'tenor'		    =>	$this->input->post('tenor'),
                'bunga_pinj'	=>	$this->input->post('bunga_pinj'),
                'pinj'		    =>	$this->input->post('pinj')
			);
      
			$this->Pinjam_m->insert_api($data);
            $this->Pinjam_m->update_kode_pinjam();

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'					=>	true,
                'kode_angt_error'		=>	form_error('kode_angt'),
                'tenor_error'		    =>	form_error('tenor'),
                'bunga_pinj_error'		=>	form_error('bunga_pinj'),
                'pinj_error'		    =>	form_error('pinj'),
			);
		}
		echo json_encode($array);		
	}

    function update_pinjam(){
        
		$this->form_validation->set_rules('kode_angt', 'ID Anggota', 'callback_form_check_simpan');
		if($this->form_validation->run())
		{
			$data = array(
				'kode_angt' =>  $this->input->post('kode_angt')
			);

			$this->Pinjam_m->update_api($this->input->post('id_pinj'), $data);

			$array = array(
				'success' => true
			);
		}
		else
		{
			$array = array(
				'error' => true,
				'kode_angt_error' => form_error("kode_angt")
			);
		}
		echo json_encode($array);
    }

    function delete_pinjam(){
        if($this -> input -> post('id_pinj'))
		{
			if($this->Pinjam_m->delete_single($this->input->post('id_pinj')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
    }
    
    function form_check_pinjam($data)
    {
        $array = $this->Pinjam_m->fetch_kode_anggota();
        $arr = array_column($array,"kode_angt");
        

        if(!$data){
            $this->form_validation->set_message('form_check_pinjam', 'ID belum diisi');
            return FALSE;
        }
        elseif (!in_array($data,$arr))
        {
                $this->form_validation->set_message('form_check_pinjam', 'Anggota dengan ID '.$data.' tidak terdaftar');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }

// ------------------------------ TRANSAKSI SIMPAN API  -------------------------------------

	function fetch_transimp_all(){
		$data = $this->Transimp_m->fetch_all();
        echo json_encode($data->result_array());
	}

	function fetch_transimp_single(){
		if($this -> input -> post('id_trans'))
		{
			$data = $this->Transimp_m->fetch_single($this->input->post('id_trans'));
			
			foreach($data as $row)
			{
				$output["kode_trans_simp"] = $row["kode_trans_simp"];
				$output["kode_simpan"] = $row["kode_simpan"];
				$output["id_jenis_trans"] = $row["id_jenis_trans"];
				$output["nominal"] = $row["nominal"];
			}
			echo json_encode($output);			
		}
	}

	function insert_transimp(){
		$this->form_validation->set_rules('kode_simpan', 'No. Rek', 'callback_form_check_transimp');
		$this->form_validation->set_rules('id_jenis_trans', 'Jenis Simpanan', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'kode_simpan'		=>	$this->input->post('kode_simpan'),
				'id_jenis_trans'    =>	$this->input->post('id_jenis_trans'),
				'nominal'           =>	$this->input->post('nominal')    
			);
      
			$this->Transimp_m->insert_api($data);
            $this->Transimp_m->update_kode_trans();
			

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'						=>	true,
                'kode_simpan_error'			=>	form_error('kode_simpan'),
				'id_jenis_trans_error'		=>	form_error('id_jenis_trans'),
				'nominal_error'		        =>	form_error('nominal')
				
			);
		}
		echo json_encode($array);	
	}

	function update_transimp(){

		$this->form_validation->set_rules('kode_simpan', 'No. Rek','required');
		$this->form_validation->set_rules('nominal', 'Nominal','required');

		if($this->form_validation->run())
		{
			$data = array(
				'kode_simpan' =>  $this->input->post('kode_simpan'),
				'id_jenis_trans' =>  $this->input->post('id_jenis_trans'),
				'nominal' =>  $this->input->post('nominal'),
			);

			$this->Transimp_m ->update_api($this->input->post('id_trans'), $data);

			$array = array(
				'success' => true
			);
		}
		else
		{
			$array = array(
				'error' => true,
				'kode_simpan_error' => form_error("id_unit"),
				'id_jenis_trans_error' => form_error("id_jenis_trans"),
				'nominal_error' => form_error("id_status")
			);
		}
		echo json_encode($array);
	}

	function delete_transimp(){
		if($this -> input -> post('id_trans'))
		{
			if($this->Transimp_m->delete_single($this->input->post('id_trans')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

	function form_check_transimp($data){
		$array = $this->Transimp_m->fetch_kode_simpan();
		$arr = array_column($array,'kode_simpan');
		

		if(!$data){
			$this->form_validation->set_message('form_check_transimp', 'No. Rek is required');
			return FALSE;
		}
		elseif (!in_array($data,$arr))
		{
				$this->form_validation->set_message('form_check_transimp', 'No. Rek '.$data.' is not registered');
				return FALSE;
		}
		else
		{
				return TRUE;
		}
	}

// ------------------------------ TRANSAKSI ANGSURAN API  -------------------------------------

	function fetch_tranangs_all(){
		$data = $this->Tranangs_m->fetch_all();
        $this->Tranangs_m->update_kode_trans_angs();
        echo json_encode($data->result_array());
	}

	function fetch_tranangs_single(){
		if($this -> input -> post('id_trans'))
		{

			$data = $this->Tranangs_m->fetch_single($this->input->post('id_trans'));
			
			foreach($data as $row)
			{
				$output["kode_trans_angs"] = $row["kode_trans_angs"];
				$output["kode_pinj"] = $row["kode_pinj"];
				$output["nominal"] = $row["nominal"];
			}
			echo json_encode($output);			
		}
	}

	function insert_tranangs(){
		$this->form_validation->set_rules('kode_pinj', 'Kode Pinjam', 'callback_form_check_tranangs');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required');

		if($this->form_validation->run())
		{
			$data = array(
				'kode_pinj'		=>	$this->input->post('kode_pinj'),
				'nominal'           =>	$this->input->post('nominal')    
			);
      
			$this->Tranangs_m->insert_api($data);
            $this->Tranangs_m->update_kode_trans_angs();
			

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'						=>	true,
                'kode_pinj_error'			=>	form_error('kode_pinj'),
				'nominal_error'		        =>	form_error('nominal')
				
			);
		}
		echo json_encode($array);	
	}

	function update_tranangs(){
		$this->form_validation->set_rules('kode_pinj', 'Kode Pinjam', 'callback_form_check_tranangs');
		$this->form_validation->set_rules('nominal', 'Nominal','required');

		if($this->form_validation->run())
		{
			$data = array(
                'kode_pinj' =>  $this->input->post('kode_pinj'),
				'nominal' =>  $this->input->post('nominal'),
			);

			$this->Tranangs_m ->update_api($this->input->post('id_trans'), $data);

			$array = array(
				'success' => true
			);
		}
		else
		{
			$array = array(
				'error' => true,
                'kode_pinj_error' => form_error("kode_pinj"),
				'nominal_error' => form_error("nominal")
			);
		}
		echo json_encode($array);
	}

	function delete_tranangs(){
		if($this -> input -> post('id_trans'))
		{
			if($this->Tranangs_m->delete_single($this->input->post('id_trans')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}


	function form_check_tranangs($data)
	{
		$array = $this->Tranangs_m->fetch_kode_pinjam();
		$arr = array_column($array,'kode_pinj');
		

		if(!$data){
			$this->form_validation->set_message('form_check_tranangs', 'Kode Pinjam is required');
			return FALSE;
		}
		elseif (!in_array($data,$arr))
		{
				$this->form_validation->set_message('form_check_tranangs', 'Kode Pinjam '.$data.' is not registered');
				return FALSE;
		}
		else
		{
				return TRUE;
		}
	}

}


