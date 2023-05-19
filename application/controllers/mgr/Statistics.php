<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('statistics_model');
		$this->load->model('member_model');
        $this->load->model('code_model');
        $this->load->helper('directory');
        $this->load->helper('paging');
		$this->load->helper("alert");
        
        $this->current_menu_code = "0701";
	}

    // 통계관리 - PC 접속
	public function connect_pc() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        $target_month = $this->input->get('target_month');
        if (!$target_month) {
            $target_month = date('Y-m');
        }
        
        $year = date('Y');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime($today." -1 day"));

        $data['yearStatistics'] = $this->statistics_model->getStatisticsPC(array('target'=>$year));
        $data['monthStatistics'] = $this->statistics_model->getStatisticsPC(array('target'=>$month));
        $data['todayStatistics'] = $this->statistics_model->getStatisticsPC(array('target'=>$today));
        $data['yesterdayStatistics'] = $this->statistics_model->getStatisticsPC(array('target'=>$yesterday));
        
        $statisticsList = $this->statistics_model->getStatisticsListPC(array('target_month'=>$target_month));

        $data['target_month'] = $target_month;
        $data['prev_month'] = date('Y-m', strtotime($target_month."-01 -1 month"));
        $data['next_month'] = date('Y-m', strtotime($target_month."-01 +1 month"));
        $data['statisticsList'] = $statisticsList;
        
        $data['pageName'] = 'mgr/statistics/connect_view';
		$this->load->view($this->global_layout_manager, $data);
        
		$this->_admin_footer();
    }
    
    
    // 통계관리 - PC 접속
	public function connect_mobile() {
        $this->current_menu_code = "0702";
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        $target_month = $this->input->get('target_month');
        if (!$target_month) {
            $target_month = date('Y-m');
        }
        
        $year = date('Y');
        $month = date('Y-m');
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime($today." -1 day"));

        $data['yearStatistics'] = $this->statistics_model->getStatisticsMobile(array('target'=>$year));
        $data['monthStatistics'] = $this->statistics_model->getStatisticsMobile(array('target'=>$month));
        $data['todayStatistics'] = $this->statistics_model->getStatisticsMobile(array('target'=>$today));
        $data['yesterdayStatistics'] = $this->statistics_model->getStatisticsMobile(array('target'=>$yesterday));

        $statisticsList = $this->statistics_model->getStatisticsListMobile(array('target_month'=>$target_month));

        $data['target_month'] = $target_month;
        $data['prev_month'] = date('Y-m', strtotime($target_month."-01 -1 month"));
        $data['next_month'] = date('Y-m', strtotime($target_month."-01 +1 month"));
        $data['statisticsList'] = $statisticsList;
        
        $data['pageName'] = 'mgr/statistics/connect_view';
		$this->load->view($this->global_layout_manager, $data);
        
		$this->_admin_footer();
    }
    
    
    // 통계관리 - 로그인
    public function login() {
        $this->current_menu_code = "0703";
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $limit_size = $this->input->get('limit_size');

        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;

        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 15;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $params = "limit_size=".$limit_size."&page=".$page."&s_field=".$s_field."&s_string=".$s_string;

        // 전체 데이터 수
        $total_count = $this->member_model->getLoginHistoryListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $historyList = $this->member_model->getLoginHistoryList($option);

        // Pagination
        $url = '/mgr/statistics/login' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['historyList'] = $historyList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['limit_size'] = $limit_size;
        $data['pagination'] = $pagination;
        
        $data['pageName'] = 'mgr/statistics/login_view';
		$this->load->view($this->global_layout_manager, $data);
        
		$this->_admin_footer();
    }
    
}