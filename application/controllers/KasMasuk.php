<?php

defined('BASEPATH') OR exit('No dirrect access is allowed!');

class KasMasuk extends CI_Controller {


    function index(){
        $this->load->helper('url');
        $this -> load -> view('kasmasuk_v');
    }

}