<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->model('Code_model');
        $this->load->helper('directory');
        $this->load->helper('paging');
		$this->load->helper("alert");

        $this->current_menu_code = "00";
	}


	public function index() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        // 전체 가입자수
//        $total_user = $this->User_model->getUserListCount(array('s_string'=>""));
//        
//        // Recruit Apply 데이터 현황
//        $status = $this->Recruit_model->getRecruitApplyStatus();
//        
//        // 지원 Division 별 Recruit Apply 데이터 현황
//        $statusCE = $this->Recruit_model->getDivisionRecruitApplyStatus(array('division'=>"CE"));
//        $pass3WeekCE = $this->Recruit_model->get3WeekPassList(array('division'=>"CE"));
//        $statusHP = $this->Recruit_model->getDivisionRecruitApplyStatus(array('division'=>"HP"));
//        $pass3WeekHP = $this->Recruit_model->get3WeekPassList(array('division'=>"HP"));
//        $statusOther = $this->Recruit_model->getDivisionRecruitApplyStatus(array('division'=>"Other"));
//        $pass3WeekOther = $this->Recruit_model->get3WeekPassList(array('division'=>"Other"));
//        
//        // 지난 4주간 Recruit Apply - 합격자 현황
//        $pass4Week = $this->Recruit_model->get4WeekPassList();
//        
//        $data['total_user'] = $total_user;
//        $data['status'] = $status;
//        $data['statusCE'] = $statusCE;
//        $data['pass3WeekCE'] = $pass3WeekCE;
//        $data['statusHP'] = $statusHP;
//        $data['pass3WeekHP'] = $pass3WeekHP;
//        $data['statusOther'] = $statusOther;
//        $data['pass3WeekOther'] = $pass3WeekOther;
//        $data['pass4Week'] = $pass4Week;

        //$data['pageName'] = 'mgr/site/notice';
		//$this->load->view($this->global_layout_manager, $data);

        
        
		redirect('mgr/site/notice');

        
        
//        if(!function_exists('password_hash')){
//            $this->load->helper('password');
//        }
//        
//        $hash = password_hash("abcd12#$", PASSWORD_BCRYPT);
//        echo $hash;


        
		$this->_admin_footer();
    }

}
