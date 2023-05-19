<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_prefix."main";
	}

    
	public function index() {
        $this->session->sess_destroy();
        redirect("/");
    }

}
