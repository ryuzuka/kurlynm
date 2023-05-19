<?php
class Privates_model extends CI_Model {
 
    public function __construct()
    {        
        parent::__construct();
    }
    
    // 개인정보 보관기간 가져오기
    public function getPrivatesInfo()
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_privates A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // Update
    public function updatePrivates($option)
    {	
        $this->db->set("inquiry_day", $option["inquiry_day"]);
        $this->db->set("estimate_day", $option["estimate_day"]);
        $this->db->set("member_day", $option["member_day"]);
        $this->db->set("join_day", $option["join_day"]);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_id', $this->session->userdata('AID'));
        $this->db->update('tb_privates');
    }
    
    // 1:1문의 보관기간 초과 LIst 수
    function getInquiryCount($option)
    {
        $this->db->select("*", FALSE);
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), regist_date) > '.$option['inquiry_day']);
        $this->db->from("tb_question");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 견적문의 보관기간 초과 LIst 수
    function getEstimateCount($option)
    {
        $this->db->select("*", FALSE);
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), regist_date) > '.$option['estimate_day']);
        $this->db->from("tb_estimate_master");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 회원정보 보관기간 초과 LIst 수
    function getMemberCount($option)
    {
        $this->db->select("*", FALSE);
        $this->db->where('status', 'N');
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), regist_date) > '.$option['member_day']);
        $this->db->from("tb_member");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 1:1문의 보관기간 초과 삭제
    public function deletePrivatesInquiry($option)
    {
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), regist_date) > '.$option['inquiry_day']);
        $this->db->delete('tb_question');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 견적문의 보관기간 초과 삭제
    public function deletePrivatesEstimate($option)
    {
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), regist_date) > '.$option['estimate_day']);
        $this->db->delete('tb_estimate_master');
        
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), regist_date) > '.$option['estimate_day']);
        $this->db->delete('tb_estimate_detail');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 회원정보 보관기간 초과 삭제
    public function deletePrivatesMember($option)
    {
        $this->db->where('status', 'N');
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), regist_date) > '.$option['member_day']);
        $this->db->delete('tb_member');
        //var_dump($this->db->last_query()); exit;		
    }
}