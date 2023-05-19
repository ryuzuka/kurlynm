<?php
class Rule_model extends CI_Model {
 
    public function __construct()
    {        
        parent::__construct();
    }
    
    // 개인정보처리방침 노출 중인 정보 가져오기
    public function getRuleInfo($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.status', 'Y');
        $this->db->where('A.rule_type', $option['rule_type']);
        $this->db->from('tb_rule A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 개인정보처리방침 정보 가져오기
    public function getRule($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_rule A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 개인정보처리방침 LIst 수
    function getRuleListCount($option)
    {
        $this->db->from("tb_rule");
        $this->db->where('rule_type', $option['rule_type']);
        $this->db->where('status', 'N');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 개인정보처리방침 LIst
    public function getRuleList($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_rule A');
        $this->db->where('A.rule_type', $option['rule_type']);
        $this->db->where('A.status', 'N');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $this->db->order_by("A.start_date", "DESC");
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 개인정보처리방침 정보 저장
    public function insertRule($option)
    {
        if($option['status'] == "Y") {
            $this->db->set('status', 'N');
            $this->db->where('rule_type', $option['rule_type']);
            $this->db->update('tb_rule');
        }
        
        $this->db->set('rule_type', $option['rule_type']);
        $this->db->set('content', $option['content']);
        $this->db->set('start_date', $option['start_date']);
        $this->db->set('end_date', $option['end_date']);
        $this->db->set('status', 'Y');
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_rule');
        $result = $this->db->insert_id();
        return $result;
    }


    // 정보 수정
    public function updateRule($option)
    {
        if($option['status'] == "Y") {
            $this->db->set('status', 'N');
            $this->db->where('rule_type', $option['rule_type']);
            $this->db->update('tb_rule');            
        }
        
        $this->db->set('content', $option['content']);
        $this->db->set('start_date', $option['start_date']);
        $this->db->set('end_date', $option['end_date']);
        $this->db->set('status', $option['status']);
        $this->db->set('is_show', $option['is_show']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_rule');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 삭제
    public function deleteRule($option)
    {
        $this->db->where('seq', $option['seq']);
        $this->db->delete('tb_rule');
        //var_dump($this->db->last_query()); exit;		
    }    
}