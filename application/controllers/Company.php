<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('site_model');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_pc_prefix."company";
    }


    public function aboutus() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";

        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/company/aboutus";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            $pagename = "mobile/company/aboutus";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }
        
        $this->_footer();
    }

    public function contact() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/company/contact";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            $pagename = "mobile/company/contact";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }
        
        $this->_footer();
    }    

    public function finance() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 10;
        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page;

        // 전체 데이터 수
        $total_count = $this->site_model->getFrontFinanceListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $financeList = $this->site_model->getFrontFinanceList($option);

        // Pagination
        $url = '/company/finance' . "?" . $params . "&page=";
        $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['financeList'] = $financeList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/company/finance";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            $pagename = "mobile/company/finance";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }

        $this->_footer();
    }        
}
