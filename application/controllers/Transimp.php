<?php

defined('BASEPATH') OR exit('No dirrect access is allowed');

class Transimp extends CI_Controller{

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Transimp_m');
	}

    function index()
    {
        $data['jenis'] = $this->Transimp_m->get_all_jenis_trans();
        $this->load-> view('transimp_v',$data);
    }

    function action()
    {
        if ($this->input->post('data_action')) {
            $data_action = $this->input->post('data_action');

            if ($data_action == 'fetch_all') {
                $api_url = base_url()."rest/Koperasi_Api/fetch_transimp_all";
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
                            <td hidden>'.$row->id_trans.'</td>
                            <td>'.$row->kode_trans_simp.'</td>
                            <td>'.$row->kode_simpan.'</td>
                            <td>'.$row->jenis_trans.'</td>
                            <td>'.date("d/m/Y H:i", strtotime($row->tgl)).'</td>
                            <td>Rp. '.number_format($row->nominal).'</td>
                        </tr>
                        ';
                    }
                } else {
                    $output .= '
                    <tr>
                        <td colspan="6" align="center">Data tidak ditemukan</td>
                    </tr>
                    ';
                }
                echo $output;
            }

            if($data_action == "Insert")
			{
				$api_url = base_url()."rest/Koperasi_Api/insert_transimp";
			

				$form_data = array(
					'kode_simpan'		 =>	$this->input->post('kode_simpan'),
                    'id_jenis_trans'     =>	$this->input->post('id_jenis_trans'),
                    'nominal'		     =>	$this->input->post('nominal')          
				);

				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_POST, true);
				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				echo $response;

			}
            if($data_action == "fetch_single")
            {
                $api_url = base_url()."rest/Koperasi_Api/fetch_transimp_single";

                $form_data = array(
                    'id_trans' => $this->input->post('id_trans')
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
                $api_url = base_url()."rest/Koperasi_Api/update_transimp";

                $form_data = array(
                    'id_trans'		        =>	$this->input->post('id_trans'),
                    'kode_simpan'		    =>	$this->input->post('kode_simpan'),
                    'id_jenis_trans'		=>	$this->input->post('id_jenis_trans'),
                    'nominal'               =>  $this->input->post('nominal')
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
                $api_url = base_url()."rest/Koperasi_Api/delete_transimp";

                $form_data = array(
                    'id_trans' => $this->input->post('id_trans')
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

