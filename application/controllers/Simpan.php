<?php

defined('BASEPATH') OR exit('No dirrect access is allowed!');

class Simpan extends CI_Controller {


    function index(){
        $this -> load -> view('simpan_v');
    }

    function action()
    {

        if ($this->input->post('data_action')) {
            $data_action = $this->input->post('data_action');

            if ($data_action == 'fetch_all') {
                $api_url = base_url()."rest/Koperasi_Api/fetch_simpan_all";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);
                $result = json_decode($response);
                echo $client;
                
                $output = '';

                if (count($result) > 0) {
                    foreach ($result as $row) {
                        $output .= '
                        <tr class="text-center">
                            <td></td>
                            <td hidden>'.$row->id_simpan.'</td>
                            <td>'.$row->kode_simpan.'</td>
                            <td>'.$row->kode_angt.'</td>
                            <td>Rp. '.number_format($row->pokok).'</td>
                            <td>Rp. '.number_format($row->wajib).'</td>
                            <td>Rp. '.number_format($row->sukarela).'</td>
                            <td>Rp. '.number_format($row->jumlah).'</td>
                        </tr>
                        ';
                    }
                } else {
                    $output .= '
                    <tr>
                        <td colspan="7" align="center">Data tidak ditemukan</td>
                    </tr>
                    ';
                }
                echo $output;
            }

            if($data_action == "fetch_single")
            {
                $api_url = base_url()."rest/Koperasi_Api/fetch_simpan_single";

                $form_data = array(
                    'id_simpan' => $this->input->post('id_simpan')
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
				$api_url = base_url()."rest/Koperasi_Api/insert_simpan";
			

				$form_data = array(
					'kode_angt'		    =>	$this->input->post('kode_angt'),        
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
                $api_url = base_url()."rest/Koperasi_Api/update_simpan";

                $form_data = array(
                    'id_simpan'		    =>	$this->input->post('id_simpan'),
                    'kode_angt'         =>  $this->input->post('kode_angt')
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
                $api_url = base_url()."rest/Koperasi_Api/delete_simpan";

                $form_data = array(
                    'id_simpan' => $this->input->post('id_simpan')
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