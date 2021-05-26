<?php

defined('BASEPATH') OR exit('No dirrect access is allowed!');

class Anggota extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Anggota_m');
	}

    function index()        
        {
            $data['unit'] =  $this->Anggota_m->get_all_unit();
            $data['status'] =  $this->Anggota_m->get_all_status();
            $this->load->view('anggota_v',$data);           
        }

    function action()
    {

        if($this->input->post('data_action'))
        {
            $data_action = $this->input->post('data_action');

            if($data_action == 'fetch_all')
            {
                $api_url = base_url()."rest/Koperasi_Api/fetch_angt_all";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);
                echo $client;
                
                $output = '';

                if(count($result) > 0)
                {
                    foreach ($result as $row)
                    {
                        $output .= '
                        <tr class="text-center">
                            <td></td>
                            <td hidden>'.$row->id_angt.'</td>                           
                            <td>'.$row->kode_angt.'</td>
                            <td>'.$row->nama.'</td>
                            <td>'.$row->unit.'</td>
                            <td>'.$row->tgl_msk.'</td>
                            <td>'.$row->status.'</td>
                        </tr>
                        ';
                    }
                }
                else
                {
                    $output .= '
                    <tr>
                        <td colspan="6" align="center">Data tidak ditemukan</td>
                    </tr>
                    ';
                }
                echo $output;
            }

            if($data_action == "fetch_single")
            {
                $api_url = base_url()."rest/Koperasi_Api/fetch_angt_single";

                $form_data = array(
                    'id_angt' => $this->input->post('id_angt')
                );

                $client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

            }

            if($data_action == "Insert")
			{
				$api_url = base_url()."rest/Koperasi_Api/insert_angt";
			

				$form_data = array(
					'nama'		        =>	$this->input->post('nama'),
                    'id_unit'		    =>	$this->input->post('id_unit'),
                    'id_status'         =>  $this->input->post('id_status')
             
				);

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}

            if($data_action == "Edit")
            {
                $api_url = base_url()."rest/Koperasi_Api/update_angt";

                $form_data = array(
                    'id_angt'		    =>	$this->input->post('id_angt'),
                    'nama'		        =>	$this->input->post('nama'),
                    'id_unit'		    =>	$this->input->post('id_unit'),
                    'id_status'         =>  $this->input->post('id_status')
                );

                $client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;
            }

            if ($data_action == "Delete") 
            {
                $api_url = base_url()."rest/Koperasi_Api/delete_angt";

                $form_data = array(
                    'id_angt' => $this->input->post('id_angt')
                );

                $client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

            }
        }

    }
}

