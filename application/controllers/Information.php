<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('inquiry_model');
        $this->load->model('main_model');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_pc_prefix."information";
    }


    public function fee() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $lowest = $this->inquiry_model->getFeeHighPrice();
        
        $data['lowest'] = $lowest->price;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/information/fee";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."information", $data);
        } else {
            $pagename = "mobile/information/fee";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."information", $data);
        }

        $this->_footer();
    }

    // 실시간 요금 계산
    public function fee_calculate() {
        $delivery_count = $this->input->get("delivery_count");
        
        $option = array(
            'delivery_count' => $delivery_count,
        );
        
        $result = $this->inquiry_model->getFeePrice($option);
        
        $price = 0;
        
        if($result) {
            $price = $result->price;
        }
        
        echo $price;
    }
    
    // 견적 문의 폼
    public function estimate() {
        // 로그인 체크
        //$this->_require_login();
        
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['privacy'] = $this->main_model->getMainPrivacy();
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/information/estimate";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."information", $data);
        } else {
            $pagename = "mobile/information/estimate";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."information", $data);
        }

        $this->_footer();
    }
    
    // 견적 문의 등록
    public function estimate_insert() {
        // 로그인 체크
        //$this->_require_login($_SERVER['REQUEST_URI']);
        
        //var_dump($this->input->post()); exit;
        if (!$this->input->post('company_name')) {
            alert("비정상적인 접근입니다.");
        }
        
        // 견적 마스터 저장
        $option = array(
            'member_id' 		=> $this->session->userdata('MID'),
            'company_name'		=> $this->input->post("company_name"),
            'company_ceo'		=> $this->input->post("company_ceo"),
            'company_no'		=> $this->input->post("company_no"),
            'company_address'	=> $this->input->post("company_address"),
            'company_site'		=> $this->input->post("company_site"),
            'company_email'		=> $this->input->post("company_email"),
            'company_brand'		=> $this->input->post("company_brand"),
            'company_tel'		=> $this->input->post("company_tel"),
        );
        
        $estimate_seq = $this->inquiry_model->insertFrontEstimateMaster($option);
        
        // 견적 디테일 저장
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'release_date'		=> $this->input->post("release_date"),
            'release_week'		=> $this->input->post("release_week"),
            'release_time'		=> $this->input->post("release_time"),
            'release_method'	=> $this->input->post("release_method"),
            'pickup_time'		=> $this->input->post("pickup_time"),
            'pickup_type'		=> $this->input->post("pickup_type"),
            'pickup_etc'		=> $this->input->post("pickup_etc"),
            'pickup_address1'	=> $this->input->post("pickup_address1"),
            'pickup_address2'	=> $this->input->post("pickup_address2"),
            'release_content'	=> $this->input->post("release_content"),
            'early_day1_cnt'	=> str_replace(",", "", $this->input->post("early_day1_cnt")),
            'early_day2_cnt'	=> str_replace(",", "", $this->input->post("early_day2_cnt")),
            'early_day3_cnt'	=> str_replace(",", "", $this->input->post("early_day3_cnt")),
            'early_day4_cnt'	=> str_replace(",", "", $this->input->post("early_day4_cnt")),
            'early_day5_cnt'	=> str_replace(",", "", $this->input->post("early_day5_cnt")),
            'early_day6_cnt'	=> str_replace(",", "", $this->input->post("early_day6_cnt")),
            'early_day7_cnt'	=> str_replace(",", "", $this->input->post("early_day7_cnt")),
            'early_month1'		=> $this->input->post("early_month1"),
            'early_month1_cnt'	=> str_replace(",", "", $this->input->post("early_month1_cnt")),
            'early_month2'		=> $this->input->post("early_month2"),
            'early_month2_cnt'	=> str_replace(",", "", $this->input->post("early_month2_cnt")),
            'early_month3'		=> $this->input->post("early_month3"),
            'early_month3_cnt'	=> str_replace(",", "", $this->input->post("early_month3_cnt")),
            'delivery_month1'		=> $this->input->post("delivery_month1"),
            'delivery_month1_cnt'	=> str_replace(",", "", $this->input->post("delivery_month1_cnt")),
            'delivery_month2'		=> $this->input->post("delivery_month2"),
            'delivery_month2_cnt'	=> str_replace(",", "", $this->input->post("delivery_month2_cnt")),
            'delivery_month3'		=> $this->input->post("delivery_month3"),
            'delivery_month3_cnt'	=> str_replace(",", "", $this->input->post("delivery_month3_cnt")),
            'goods_title'		=> $this->input->post("goods_title"),
            'goods_type'		=> $this->input->post("goods_type"),
            'goods_etc'		=> $this->input->post("goods_etc"),
            'goods_length'		=> $this->input->post("goods_length"),
            'goods_weight'		=> $this->input->post("goods_weight"),
            'manager_name'		=> $this->input->post("manager_name"),
            'manager_tel'		=> $this->input->post("manager_tel"),
            'manager_email'		=> $this->input->post("manager_email"),
            'estimate_content'	=> $this->input->post("estimate_content"),
        );
        
        $this->inquiry_model->insertFrontEstimateDetail($option);

        redirect('/information/estimate_complete');
    }

    public function estimate_complete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/information/estimate_complete";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."information", $data);
        } else {
            $pagename = "mobile/information/estimate_complete";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."information", $data);
        }

        $this->_footer();
    }
    
    public function invoice() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/information/invoice";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."information", $data);
        } else {
            $pagename = "mobile/information/invoice";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."information", $data);
        }
        $this->_footer();
    }
    
    public function invoice_result() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['invooice_no'] = $this->input->get("invoice_no");
                
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/information/invoice_result";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."information", $data);
        } else {
            $pagename = "mobile/information/invoice_result";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."information", $data);
        }

        $this->_footer();
    }
    
    
    /* Mobile */
    // 견적 문의 1단계 생성
    public function estimate_step01() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "mobile/information/estimate_step01";
        $data['pageName'] = $pagename;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 1단계 저장
    public function estimate_step01_insert() {
        //var_dump($this->input->post()); exit;
        if (!$this->input->post('company_name')) {
            alert("비정상적인 접근입니다.");
        }
        
        // 견적 마스터 저장
        $option = array(
            'member_id' 		=> $this->session->userdata('MID'),
            'company_name'		=> $this->input->post("company_name"),
            'company_ceo'		=> $this->input->post("company_ceo"),
            'company_no'		=> $this->input->post("company_no"),
            'company_address'	=> $this->input->post("company_address"),
            'company_site'		=> $this->input->post("company_site"),
            'company_email'		=> $this->input->post("company_email"),
            'company_brand'		=> $this->input->post("company_brand"),
            'company_tel'		=> $this->input->post("company_tel"),
        );
        
        $estimate_seq = $this->inquiry_model->insertFrontEstimateStep01($option);

        redirect('/information/estimate_step02?estimate_seq='.$estimate_seq.'&current_step=1');
    }
    
    // 견적 문의 1단계 보기
    public function estimate_step01_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
        );
        
        $estimate = $this->inquiry_model->getEstimateMaster($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "mobile/information/estimate_step01_info";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['estimate'] = $estimate;
        
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 1단계 업데이트
    public function estimate_step01_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->post("estimate_seq");
        $current_step = $this->input->post("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'company_name'		=> $this->input->post("company_name"),
            'company_ceo'		=> $this->input->post("company_ceo"),
            'company_no'		=> $this->input->post("company_no"),
            'company_address'	=> $this->input->post("company_address"),
            'company_site'		=> $this->input->post("company_site"),
            'company_email'		=> $this->input->post("company_email"),
            'company_brand'		=> $this->input->post("company_brand"),
            'company_tel'		=> $this->input->post("company_tel"),
        );
        
        $this->inquiry_model->updateFrontEstimateStep01($option);
        
        if($current_step > 1) {
            redirect('/information/estimate_step02_info?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        } else {
            redirect('/information/estimate_step02?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        }
    }
    
    
    
    // 견적 문의 2단계 생성
    public function estimate_step02() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        $data['pageTitle'] = "컬리넥스트마일";        
        $pagename = "mobile/information/estimate_step02";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 2단계 저장
    public function estimate_step02_insert() {
        //var_dump($this->input->post()); exit;
        $estimate_seq = $this->input->post("estimate_seq");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        // 견적 마스터 저장
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'release_date'		=> $this->input->post("release_date"),
            'release_week'		=> $this->input->post("release_week"),
            'release_time'		=> $this->input->post("release_time"),
            'release_method'	=> $this->input->post("release_method"),
            'pickup_time'		=> $this->input->post("pickup_time"),
            'pickup_type'		=> $this->input->post("pickup_type"),
            'pickup_etc'		=> $this->input->post("pickup_etc"),
            'pickup_address1'	=> $this->input->post("pickup_address1"),
            'pickup_address2'	=> $this->input->post("pickup_address2"),
            'release_content'	=> $this->input->post("release_content"),
        );
        
        $this->inquiry_model->insertFrontEstimateStep02($option);

        redirect('/information/estimate_step03?estimate_seq='.$estimate_seq.'&current_step=2');
    }
    
    // 견적 문의 2단계 보기
    public function estimate_step02_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
        );
        
        $estimate = $this->inquiry_model->getEstimateDetail($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "mobile/information/estimate_step02_info";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['estimate'] = $estimate;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 2단계 업데이트
    public function estimate_step02_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->post("estimate_seq");
        $current_step = $this->input->post("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'release_date'		=> $this->input->post("release_date"),
            'release_week'		=> $this->input->post("release_week"),
            'release_time'		=> $this->input->post("release_time"),
            'release_method'	=> $this->input->post("release_method"),
            'pickup_time'		=> $this->input->post("pickup_time"),
            'pickup_type'		=> $this->input->post("pickup_type"),
            'pickup_etc'		=> $this->input->post("pickup_etc"),
            'pickup_address1'	=> $this->input->post("pickup_address1"),
            'pickup_address2'	=> $this->input->post("pickup_address2"),
            'release_content'	=> $this->input->post("release_content"),
        );
        
        $this->inquiry_model->updateFrontEstimateStep02($option);
        
        if($current_step > 2) {
            redirect('/information/estimate_step03_info?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        } else {
            redirect('/information/estimate_step03?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        }
    }
    
    // 견적 문의 3단계 생성
    public function estimate_step03() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        $data['pageTitle'] = "컬리넥스트마일";        
        $pagename = "mobile/information/estimate_step03";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 3단계 저장
    public function estimate_step03_insert() {
        //var_dump($this->input->post()); exit;
        $estimate_seq = $this->input->post("estimate_seq");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        // 견적 마스터 저장
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'early_day1_cnt'	=> str_replace(",", "", $this->input->post("early_day1_cnt")),
            'early_day2_cnt'	=> str_replace(",", "", $this->input->post("early_day2_cnt")),
            'early_day3_cnt'	=> str_replace(",", "", $this->input->post("early_day3_cnt")),
            'early_day4_cnt'	=> str_replace(",", "", $this->input->post("early_day4_cnt")),
            'early_day5_cnt'	=> str_replace(",", "", $this->input->post("early_day5_cnt")),
            'early_day6_cnt'	=> str_replace(",", "", $this->input->post("early_day6_cnt")),
            'early_day7_cnt'	=> str_replace(",", "", $this->input->post("early_day7_cnt")),
            'early_month1'		=> $this->input->post("early_month1"),
            'early_month1_cnt'	=> str_replace(",", "", $this->input->post("early_month1_cnt")),
            'early_month2'		=> $this->input->post("early_month2"),
            'early_month2_cnt'	=> str_replace(",", "", $this->input->post("early_month2_cnt")),
            'early_month3'		=> $this->input->post("early_month3"),
            'early_month3_cnt'	=> str_replace(",", "", $this->input->post("early_month3_cnt")),
            'delivery_month1'		=> $this->input->post("delivery_month1"),
            'delivery_month1_cnt'	=> str_replace(",", "", $this->input->post("delivery_month1_cnt")),
            'delivery_month2'		=> $this->input->post("delivery_month2"),
            'delivery_month2_cnt'	=> str_replace(",", "", $this->input->post("delivery_month2_cnt")),
            'delivery_month3'		=> $this->input->post("delivery_month3"),
            'delivery_month3_cnt'	=> str_replace(",", "", $this->input->post("delivery_month3_cnt")),
        );
        
        $this->inquiry_model->insertFrontEstimateStep03($option);

        redirect('/information/estimate_step04?estimate_seq='.$estimate_seq.'&current_step=3');
    }
    
    // 견적 문의 3단계 보기
    public function estimate_step03_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
        );
        
        $estimate = $this->inquiry_model->getEstimateDetail($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "mobile/information/estimate_step03_info";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['estimate'] = $estimate;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 3단계 업데이트
    public function estimate_step03_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->post("estimate_seq");
        $current_step = $this->input->post("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'early_day1_cnt'	=> str_replace(",", "", $this->input->post("early_day1_cnt")),
            'early_day2_cnt'	=> str_replace(",", "", $this->input->post("early_day2_cnt")),
            'early_day3_cnt'	=> str_replace(",", "", $this->input->post("early_day3_cnt")),
            'early_day4_cnt'	=> str_replace(",", "", $this->input->post("early_day4_cnt")),
            'early_day5_cnt'	=> str_replace(",", "", $this->input->post("early_day5_cnt")),
            'early_day6_cnt'	=> str_replace(",", "", $this->input->post("early_day6_cnt")),
            'early_day7_cnt'	=> str_replace(",", "", $this->input->post("early_day7_cnt")),
            'early_month1'		=> $this->input->post("early_month1"),
            'early_month1_cnt'	=> str_replace(",", "", $this->input->post("early_month1_cnt")),
            'early_month2'		=> $this->input->post("early_month2"),
            'early_month2_cnt'	=> str_replace(",", "", $this->input->post("early_month2_cnt")),
            'early_month3'		=> $this->input->post("early_month3"),
            'early_month3_cnt'	=> str_replace(",", "", $this->input->post("early_month3_cnt")),
            'delivery_month1'		=> $this->input->post("delivery_month1"),
            'delivery_month1_cnt'	=> str_replace(",", "", $this->input->post("delivery_month1_cnt")),
            'delivery_month2'		=> $this->input->post("delivery_month2"),
            'delivery_month2_cnt'	=> str_replace(",", "", $this->input->post("delivery_month2_cnt")),
            'delivery_month3'		=> $this->input->post("delivery_month3"),
            'delivery_month3_cnt'	=> str_replace(",", "", $this->input->post("delivery_month3_cnt")),
        );
        //print_r($option); exit;
        $this->inquiry_model->updateFrontEstimateStep03($option);
        
        if($current_step > 3) {
            redirect('/information/estimate_step04_info?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        } else {
            redirect('/information/estimate_step04?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        }
    }
    
    
    
    // 견적 문의 4단계
    public function estimate_step04() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        $data['pageTitle'] = "컬리넥스트마일";        
        $pagename = "mobile/information/estimate_step04";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 4단계 저장
    public function estimate_step04_insert() {
        //var_dump($this->input->post()); exit;
        $estimate_seq = $this->input->post("estimate_seq");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        // 견적 마스터 저장
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'goods_title'		=> $this->input->post("goods_title"),
            'goods_type'		=> $this->input->post("goods_type"),
            'goods_etc'         => $this->input->post("goods_etc"),
            'goods_length'		=> $this->input->post("goods_length"),
            'goods_weight'		=> $this->input->post("goods_weight"),
        );
        
        $this->inquiry_model->insertFrontEstimateStep04($option);

        redirect('/information/estimate_step05?estimate_seq='.$estimate_seq.'&current_step=4');
    }
    
    // 견적 문의 4단계 보기
    public function estimate_step04_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
        );
        
        $estimate = $this->inquiry_model->getEstimateDetail($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "mobile/information/estimate_step04_info";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['estimate'] = $estimate;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 4단계 업데이트
    public function estimate_step04_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->post("estimate_seq");
        $current_step = $this->input->post("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'goods_title'		=> $this->input->post("goods_title"),
            'goods_type'		=> $this->input->post("goods_type"),
            'goods_etc'     	=> $this->input->post("goods_etc"),
            'goods_length'		=> $this->input->post("goods_length"),
            'goods_weight'		=> $this->input->post("goods_weight"),
        );
        
        $this->inquiry_model->updateFrontEstimateStep04($option);
        
        if($current_step > 4) {
            redirect('/information/estimate_step05_info?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        } else {
            redirect('/information/estimate_step05?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        }
    }
    
    
    // 견적 문의 5단계
    public function estimate_step05() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        $data['privacy'] = $this->main_model->getMainPrivacy();
        
        $data['pageTitle'] = "컬리넥스트마일";        
        $pagename = "mobile/information/estimate_step05";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 5단계 저장
    public function estimate_step05_insert() {
        //var_dump($this->input->post()); exit;
        $estimate_seq = $this->input->post("estimate_seq");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        // 견적 마스터 저장
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'manager_name'		=> $this->input->post("manager_name"),
            'manager_tel'		=> $this->input->post("manager_tel"),
            'manager_email'		=> $this->input->post("manager_email"),
        );
        
        $this->inquiry_model->insertFrontEstimateStep05($option);

        redirect('/information/estimate_step06?estimate_seq='.$estimate_seq.'&current_step=5');
    }
    
    // 견적 문의 5단계 보기
    public function estimate_step05_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $data['privacy'] = $this->main_model->getMainPrivacy();
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
        );
        
        $estimate = $this->inquiry_model->getEstimateDetail($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "mobile/information/estimate_step05_info";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['estimate'] = $estimate;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 5단계 업데이트
    public function estimate_step05_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->post("estimate_seq");
        $current_step = $this->input->post("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'manager_name'		=> $this->input->post("manager_name"),
            'manager_tel'		=> $this->input->post("manager_tel"),
            'manager_email'		=> $this->input->post("manager_email"),
        );
        
        $this->inquiry_model->updateFrontEstimateStep05($option);
        
        if($current_step > 4) {
            redirect('/information/estimate_step06_info?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        } else {
            redirect('/information/estimate_step06?estimate_seq='.$estimate_seq.'&current_step='.$current_step);
        }
    }
    
    
    // 견적 문의 6단계
    public function estimate_step06() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        $data['pageTitle'] = "컬리넥스트마일";        
        $pagename = "mobile/information/estimate_step06";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 6단계 저장
    public function estimate_step06_insert() {
        //var_dump($this->input->post()); exit;
        $estimate_seq = $this->input->post("estimate_seq");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        // 견적 마스터 저장
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'estimate_content'	=> $this->input->post("estimate_content"),
        );
        
        $this->inquiry_model->insertFrontEstimateStep06($option);

        redirect('/information/estimate_step07?estimate_seq='.$estimate_seq.'&current_step=6');
    }
    
    // 견적 문의 5단계 보기
    public function estimate_step06_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->get("estimate_seq");
        $current_step = $this->input->get("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
        );
        
        $estimate = $this->inquiry_model->getEstimateDetail($option);
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "mobile/information/estimate_step06_info";
        $data['pageName'] = $pagename;
        $data['estimate_seq'] = $estimate_seq;
        $data['current_step'] = $current_step;
        $data['estimate'] = $estimate;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
    
    // 견적 문의 6단계 업데이트
    public function estimate_step06_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $estimate_seq = $this->input->post("estimate_seq");
        $current_step = $this->input->post("current_step");
        
        if (!$estimate_seq) {
            alert("비정상적인 접근입니다.");
        }
        
        $option = array(
            'estimate_seq'		=> $estimate_seq,
            'estimate_content'	=> $this->input->post("estimate_content"),
        );
        
        $this->inquiry_model->updateFrontEstimateStep06($option);
        
        redirect('/information/estimate_step07');
    }
    
    
    
    // 견적 문의 완료
    public function estimate_step07() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "컬리넥스트마일";        
        $pagename = "mobile/information/estimate_step07";
        $data['pageName'] = $pagename;
        $data['sub'] = "info";
        $this->load->view($this->global_layout_mo_prefix."information_sub", $data);
        
        $this->_footer();
    }
}
