<?php

defined('BASEPATH') OR exit('No dirrect access is allowed!');

class Dev extends CI_Controller {


    function index(){
        $this -> load -> view('dev_v');
    }

}