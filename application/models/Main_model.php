<?php

class Main_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    // 프론티어 수
    function getFrontierCount()
    {
            $this->db->from("tb_frontier");
            $result = $this->db->count_all_results();
            //var_dump($this->db->last_query());
            return $result;
    }
    
    // 공지사항 LIst
    public function getNoticeList()
    {
        $this->db->select("A.*", FALSE);
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_notice A');
        $this->db->where('A.status', "Y");
        $this->db->limit(5,0);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    
    // 글 목록 가져오기(Front)
    public function getMainBoardList($option) {
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("regist_date", "DESC");
        $this->db->limit(4,0);
        $result = $this->db->get('tb_board')->result();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 택배표준약관
    public function getMainTerms() {
        $this->db->where('status', 'Y');
        $this->db->where('rule_type', 'T');
        $this->db->from('tb_rule');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }
    
    // 택배표준약관 이전리스트
    public function getMainTermsList() {
        $this->db->where('rule_type', 'T');
        $this->db->where('status', 'N');
        $this->db->where('is_show', 'Y');
        $this->db->from('tb_rule');
        $this->db->order_by("start_date", "DESC");
        $result = $this->db->get()->result();
        
        //var_dump($this->db->last_query());exit;
        return $result;
    }
    
    // 택배표준약관 정보
    public function getMainTermsInfo($option) {
        $this->db->where('seq', $option['seq']);
        $this->db->from('tb_rule');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 개인정보처리방침
    public function getMainPrivacy() {
        $this->db->where('status', 'Y');
        $this->db->where('rule_type', 'P');
        $this->db->from('tb_rule');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }
    
    // 택배표준약관 이전리스트
    public function getMainPrivacyList() {
        $this->db->where('rule_type', 'P');
        $this->db->where('status', 'N');
        $this->db->where('is_show', 'Y');
        $this->db->from('tb_rule');
        $this->db->order_by("start_date", "DESC");
        $result = $this->db->get()->result();
        
        //var_dump($this->db->last_query());exit;
        return $result;
    }
    
    // 택배표준약관 정보
    public function getMainPrivacyInfo($option) {
        $this->db->where('seq', $option['seq']);
        $this->db->from('tb_rule');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 공지사항 LIst
    public function getMainEventList()
    {
        $this->db->select("A.*", FALSE);
        $this->db->where("date_format(now(), '%Y-%m-%d') between A.start_date AND A.end_date=1");
        
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_event A');
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }    
}