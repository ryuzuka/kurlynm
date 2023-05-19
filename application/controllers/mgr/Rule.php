<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rule extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('rule_model');
        $this->load->model('code_model');
        $this->load->helper('directory');
        $this->load->helper('string');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "0501";
    }

    
    // 규정관리 - 개인정보처리방침
    public function private() {
        $data['current_menu_code'] = "0501";
        $this->_admin_header($data);

        $option = array(
            'rule_type' 	=> 'P',
        );
        
        // 데이터 목록
        $private = $this->rule_model->getRuleInfo($option);

        $data['private'] = $private;
        
        $data['pageName'] = 'mgr/rule/private_write';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    // 규정관리 - 개인정보처리방침 목록
    public function private_list() {
        $data['current_menu_code'] = "0501";
        $this->_admin_header($data);

        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 10;

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            'rule_type' 	=> 'P',
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page;

        // 전체 데이터 수
        $total_count = $this->rule_model->getRuleListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $privateList = $this->rule_model->getRuleList($option);

        // Pagination
        $url = '/mgr/rule/private_list' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['privateList'] = $privateList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/rule/private_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    // 규정관리 - 개인정보처리방침 등록
    public function private_insert() {
        $data['current_menu_code'] = "0501";
        $this->_admin_header($data);
        
        $option = $this->input->post();

        $option['rule_type'] = "P";
        $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

//      print_r($option); exit;

        $this->rule_model->insertRule($option);

        $this->session->set_flashdata('message', '정상 등록되었습니다.');
        redirect('mgr/rule/private');


        $this->_admin_footer();
    }

    // 규정관리 - 개인정보처리방침 보기
    public function private_info() {
        $data['current_menu_code'] = "0501";
        $this->_admin_header($data);

        $seq = $this->input->get('seq');
        $page = $this->input->get('page');
        
        $params = "page=".$page;

        // 정보 가져오기
        $data['private'] = $this->rule_model->getRule(array('seq' => $seq));

        $data['seq'] = $seq;
        $data['params'] = $params;
        $data['pageName'] = 'mgr/rule/private_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    // 규정관리 - 개인정보처리방침 수정
    public function private_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $option = $this->input->post();

        $option['rule_type'] = "P";
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->rule_model->updateRule($option);


        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/rule/private_list');

        $this->_admin_footer();
    }
    
    // 규정관리 - 개인정보처리방침 삭제
    public function private_delete() {
        $option = $this->input->post();
        //print_r($option); exit;
        
        $this->rule_model->deleteRule($option);

        $this->session->set_flashdata('message', '개인정보처리방침이 삭제되었습니다.');
        redirect('mgr/rule/private_list');
    }
    
    // 규정관리 - 택배표준약관
    public function terms() {
        $data['current_menu_code'] = "0502";
        $this->_admin_header($data);

        $option = array(
            'rule_type' 	=> 'T',
        );
        
        // 데이터 목록
        $terms = $this->rule_model->getRuleInfo($option);

        $data['terms'] = $terms;
        
        $data['pageName'] = 'mgr/rule/terms_write';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    // 규정관리 - 택배표준약관 목록
    public function terms_list() {
        $data['current_menu_code'] = "0502";
        $this->_admin_header($data);

        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 10;

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            'rule_type' 	=> 'T',
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page;

        // 전체 데이터 수
        $total_count = $this->rule_model->getRuleListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $termsList = $this->rule_model->getRuleList($option);

        // Pagination
        $url = '/mgr/rule/terms_list' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['termsList'] = $termsList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/rule/terms_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    // 규정관리 - 택배표준약관 등록
    public function terms_insert() {
        $data['current_menu_code'] = "0502";
        $this->_admin_header($data);
        
        $option = $this->input->post();

        $option['rule_type'] = "T";
        $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

//        print_r($option); exit;

        $this->rule_model->insertRule($option);

        $this->session->set_flashdata('message', '정상 등록되었습니다.');
        redirect('mgr/rule/terms');


        $this->_admin_footer();
    }

    // 규정관리 - 택배표준약관 보기
    public function terms_info() {
        $data['current_menu_code'] = "0502";
        $this->_admin_header($data);

        $seq = $this->input->get('seq');
        $page = $this->input->get('page');
        
        $params = "page=".$page;

        // 정보 가져오기
        $data['terms'] = $this->rule_model->getRule(array('seq' => $seq));

        $data['seq'] = $seq;
        $data['params'] = $params;
        $data['pageName'] = 'mgr/rule/terms_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    // 규정관리 - 택배표준약관 수정
    public function terms_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $option = $this->input->post();

        $option['rule_type'] = "T";
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->rule_model->updateRule($option);

        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/rule/terms_list');

        $this->_admin_footer();
    }
    
    // 규정관리 - 택배표준약관 삭제
    public function terms_delete() {
        $option = $this->input->post();
        //print_r($option); exit;
        
        $this->rule_model->deleteRule($option);

        $this->session->set_flashdata('message', '택배표준약관이 삭제되었습니다.');
        redirect('mgr/rule/terms_list');
    }
}