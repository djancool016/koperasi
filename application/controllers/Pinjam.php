<?php

defined('BASEPATH') OR exit('No dirrect access is allowed!');

class Pinjam extends CI_Controller {


    function index(){
        $this -> load -> view('pinjam_v');
    }

    function action()
    {
        if ($this->input->post('data_action')) {
            $data_action = $this->input->post('data_action');

            if ($data_action == 'fetch_all') {
                $api_url = base_url()."rest/Koperasi_Api/fetch_pinjam_all";
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
                            <td hidden>'.$row->id_pinj.'</td>
                            <td>'.$row->kode_pinj.'</td>
                            <td>'.$row->kode_angt.'</td>
                            <td>'.$row->tgl_pinj.'</td>
                            <td>'.$row->tenor.'</td>
                            <td>'.$row->bunga_pinj.'</td>
                            <td>Rp. '.number_format($row->pinj).'</td>
                            <td>Rp. '.number_format($row->jml_bunga_pinj).'</td>
                            <td>Rp. '.number_format($row->jml_angs).'</td>
                            <td>'.$row->angs_ke.'</td>
                            <td>Rp. '.number_format($row->jml_msk).'</td>
                            <td>Rp. '.number_format($row->sisa_pinj).'</td>
                            <td></td>  
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
                $api_url = base_url()."rest/Koperasi_Api/fetch_pinjam_single";

                $form_data = array(
                    'id_pinj' => $this->input->post('id_pinj')
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
				$api_url = base_url()."rest/Koperasi_Api/insert_pinjam";
			

				$form_data = array(
					'kode_angt'		    =>	$this->input->post('kode_angt'),   
                    'tenor'		        =>	$this->input->post('kode_angt'),  
                    'bunga_pinj'		=>	$this->input->post('kode_angt'),  
                    'pinj'		        =>	$this->input->post('kode_angt'),                             
				);

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}

            //
        }
    }

    
    

}