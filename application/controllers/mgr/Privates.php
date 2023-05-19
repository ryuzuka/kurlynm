<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privates extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->model('privates_model');
        $this->load->helper('paging');
        $this->load->helper("alert");
    }
    
    public function privates_term() {
        $data['current_menu_code'] = "0601";
        $this->_admin_header($data);

        $mode = "";

        // 정보 가져오기
        $data['privates'] = $this->privates_model->getPrivatesInfo();

        $data['pageName'] = 'mgr/privates/privates_term';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }
    
    // 개인정보 보관 기간 수정
    public function privates_term_update() {
        $data['current_menu_code'] = "0601";
        $this->_admin_header($data);

        $option = $this->input->post();
        
        $this->privates_model->updatePrivates($option);

        $this->session->set_flashdata('message', '보관기간이 수정되었습니다.');
        redirect('mgr/privates/privates_term');
    }
    
    // 개인정보 삭제 화면
    public function privates_delete() {
        $data['current_menu_code'] = "0602";
        $this->_admin_header($data);

        $privates = $this->privates_model->getPrivatesInfo();
        
        $option = array(
            'inquiry_day'		=> $privates->inquiry_day,
            'estimate_day'		=> $privates->estimate_day,
            'member_day'		=> $privates->member_day,
        );
        
        // 정보 가져오기
        $data['inquiryCount'] = $this->privates_model->getInquiryCount($option);
        $data['estimateCount'] = $this->privates_model->getEstimateCount($option);
        $data['memberCount'] = $this->privates_model->getMemberCount($option);

        $data['privates'] = $privates;
        $data['pageName'] = 'mgr/privates/privates_delete';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }
    
    // 개인정보 삭제 처리
    public function privates_delete_proc() {
        $data['current_menu_code'] = "0602";
        $this->_admin_header($data);

        $title = "";
        
        $privates = $this->privates_model->getPrivatesInfo();
        
        $option = array(
            'inquiry_day'		=> $privates->inquiry_day,
            'estimate_day'		=> $privates->estimate_day,
            'member_day'		=> $privates->member_day,
        );
        
        if($this->input->post("mode") == "inquiry") {
            $title = "1:1문의";
            $this->privates_model->deletePrivatesInquiry($option);
        } else if($this->input->post("mode") == "estimate") {
            $title = "견적문의";
            $this->privates_model->deletePrivatesEstimate($option);
        } else if($this->input->post("mode") == "member") {
            $title = "회원";
            $this->privates_model->deletePrivatesMember($option);
        }
        
        $this->session->set_flashdata('message', $title.' 개인정보가 삭제되었습니다.');
        redirect('mgr/privates/privates_delete');
    }
}