<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('site_model');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_pc_prefix."main";
    }


    public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = "";
        
        // 이벤트
        $data['eventList'] = $this->main_model->getMainEventList();
        
        // 대시보드
        $data['dashboard'] = $this->site_model->getDashboard();
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/main";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."main", $data);
        } else {
            $pagename = "mobile/main";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."main", $data);
        }
        
        $this->_footer();
    }

    public function terms()
    {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['terms'] = $this->main_model->getMainTerms();        
        $data['termsList'] = $this->main_model->getMainTermsList();
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $data['pageName'] = "front/terms";
            $this->load->view($this->global_layout_pc_prefix."main2", $data);
        } else {
            $data['pageName'] = "mobile/terms";
            $this->load->view($this->global_layout_mo_prefix."main2", $data);
        }
        
        $this->_footer();
    }
    
    public function terms_info()
    {   
        $option['seq'] = $this->input->post("seq");
        $terms = $this->main_model->getMainTermsInfo($option);
        
        echo $terms->content;
    }
    
    public function terms_prev()
    {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $option['seq'] = $this->input->get("seq");
        $data['terms'] = $this->main_model->getMainTermsInfo($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $data['pageName'] = "front/terms_prev";
            $this->load->view($this->global_layout_pc_prefix."main2", $data);
        } else {
            $data['pageName'] = "mobile/terms_prev";
            $this->load->view($this->global_layout_mo_prefix."main2", $data);
        }
        
        $this->_footer();
    }
    
    public function privacy()
    {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['privacy'] = $this->main_model->getMainPrivacy();        
        $data['privacyList'] = $this->main_model->getMainPrivacyList();
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $data['pageName'] = "front/privacy";
            $this->load->view($this->global_layout_pc_prefix."main2", $data);
        } else {
            $data['pageName'] = "mobile/privacy";
            $this->load->view($this->global_layout_mo_prefix."main2", $data);
        }
        
        $this->_footer();
    }
    
    public function privacy_info()
    {   
        $option['seq'] = $this->input->post("seq");
        $terms = $this->main_model->getMainPrivacyInfo($option);
        
        echo $terms->content;
    }
    
    public function privacy_prev()
    {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $option['seq'] = $this->input->get("seq");
        $data['privacy'] = $this->main_model->getMainPrivacyInfo($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $data['pageName'] = "front/privacy_prev";
            $this->load->view($this->global_layout_pc_prefix."main2", $data);
        } else {
            $data['pageName'] = "mobile/privacy_prev";
            $this->load->view($this->global_layout_mo_prefix."main2", $data);
        }
        
        $this->_footer();
    }
    
    public function notfound()
    {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $data['pageName'] = "front/notfound";
            $this->load->view($this->global_layout_pc_prefix."main2", $data);
        } else {
            $data['pageName'] = "mobile/notfound";
            $this->load->view($this->global_layout_mo_prefix."main2", $data);
        }
        
        $this->_footer();
    }    
}
