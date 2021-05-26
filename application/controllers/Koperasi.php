<?php

defined('BASEPATH') OR exit('No dirrect access is allowed!');

class Koperasi extends CI_Controller {


    function index(){
        $this->load->helper('url');
        $this -> load -> view('koperasi_v');
    }

}