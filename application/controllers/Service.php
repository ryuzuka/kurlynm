<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('site_model');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_pc_prefix."company";
    }


    public function delivery() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/service/delivery";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            $pagename = "mobile/service/delivery";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }
        
        $this->_footer();
    }

    public function coldchain() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/service/coldchain";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            $pagename = "mobile/service/coldchain";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }

        $this->_footer();
    }    

    public function system() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/service/system";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            $pagename = "mobile/service/system";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }

        $this->_footer();
    }        
}
