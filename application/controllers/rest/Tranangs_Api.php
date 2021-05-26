<?php

defined('BASEPATH') or exit ('Dirrect access is not allowed');

class Tranangs_Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tranangs_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = $this->Tranangs_m->fetch_all();
        $this->Tranangs_m->update_kode_trans_angs();
        echo json_encode($data->result_array());
    }

    function insert()
	{
		
		$this->form_validation->set_rules('kode_pinj', 'Kode Pinjam', 'callback_form_check');
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

    function form_check($data)
	{
		$array = $this->Tranangs_m->fetch_kode_pinjam();
		$arr = array_column($array,'kode_pinj');
		

		if(!$data){
			$this->form_validation->set_message('form_check', 'Kode Pinjam is required');
			return FALSE;
		}
		elseif (!in_array($data,$arr))
		{
				$this->form_validation->set_message('form_check', 'Kode Pinjam '.$data.' is not registered');
				return FALSE;
		}
		else
		{
				return TRUE;
		}
	}

    function fetch_single(){

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

    function update()
	{

        $this->form_validation->set_rules('kode_pinj', 'Kode Pinjam', 'callback_form_check');
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
    function delete(){
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
}
?>