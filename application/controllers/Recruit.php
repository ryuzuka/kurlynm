<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruit extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_pc_prefix."recruit";
    }


    public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = "";
                
        // 공지사항
        //$data["noticeList"] = $this->main_model->getNoticeList();
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/recruit/index";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."recruit", $data);
        } else {
            $pagename = "mobile/recruit/index";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."recruit", $data);
        }
        
        $this->_footer();
    }

}
