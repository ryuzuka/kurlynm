<?php

class Customer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
 
    /*################################ FRONT #########################################*/
    // 공지사항 가져오기
    public function getFrontNotice($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_notice A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 공지사항 LIst 수
    function getFrontNoticeListCount($option)
    {
        $this->db->from("tb_notice");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 공지사항 LIst
    public function getFrontNoticeList($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_notice A');
        $this->db->order_by("status", "DESC");
        $this->db->order_by("seq", "DESC");
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query()); exit;
        return $result;
    }
    
    // 공지사항 조회수
    public function updateNoticeView($option)
    {
        $this->db->set('view_count', 'view_count + 1', false);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_notice');
        //var_dump($this->db->last_query());
    }
    
    // 이벤트 가져오기
    public function getFrontEvent($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_event A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 이벤트 LIst 수
    function getFrontEventListCount($option)
    {
        $this->db->from("tb_event");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 이벤트 LIst
    public function getFrontEventList($option)
    {
        $this->db->select("date_format(now(), '%Y-%m-%d') between A.start_date AND A.end_date AS ing, A.*", FALSE);
        $this->db->from('tb_event A');
        $this->db->order_by("ing", "DESC");
        $this->db->order_by("seq", "DESC");
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query()); exit;
        return $result;
    }
    
    // 1:1문의 저장
    public function insertInquiry($option)
    {
        $this->db->set('question_name', $option['question_name']);
        $this->db->set('question_passwd', "HEX(AES_ENCRYPT('".$option['question_passwd']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('question_email', "HEX(AES_ENCRYPT('".$option['question_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('question_tel', "HEX(AES_ENCRYPT('".$option['question_tel']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('question_title', $option['question_title']);
        $this->db->set('question_content', $option['question_content']);
        if (isset($option['file_path_1']) && $option['file_path_1']) $this->db->set('file_path_1', $option['file_path_1']);
        if (isset($option['file_name_1']) && $option['file_name_1']) $this->db->set('file_name_1', $option['file_name_1']);
        if (isset($option['file_path_2']) && $option['file_path_2']) $this->db->set('file_path_2', $option['file_path_2']);
        if (isset($option['file_name_2']) && $option['file_name_2']) $this->db->set('file_name_2', $option['file_name_2']);
        if (isset($option['file_path_3']) && $option['file_path_3']) $this->db->set('file_path_3', $option['file_path_3']);
        if (isset($option['file_name_3']) && $option['file_name_3']) $this->db->set('file_name_3', $option['file_name_3']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_question');
        $result = $this->db->insert_id();
        return $result;
    }
    
    public function getFrontInquiryAuth($option)
    {
        $this->db->select("*", FALSE);
        $this->db->where('question_email', "HEX(AES_ENCRYPT('".$option['question_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->where('question_passwd', "HEX(AES_ENCRYPT('".$option['question_passwd']."', '".config_item('encryption_key')."'))", false);
        $this->db->from('tb_question');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 공지사항 LIst 수
    function getFrontInquiryListCount($option)
    {
        $this->db->from("tb_question");
        $this->db->where('question_email', "HEX(AES_ENCRYPT('".$option['question_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->where('question_passwd', "HEX(AES_ENCRYPT('".$option['question_passwd']."', '".config_item('encryption_key')."'))", false);
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 공지사항 LIst
    public function getFrontInquiryList($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_question A');
        $this->db->where('question_email', "HEX(AES_ENCRYPT('".$option['question_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->where('question_passwd', "HEX(AES_ENCRYPT('".$option['question_passwd']."', '".config_item('encryption_key')."'))", false);
        $this->db->order_by("seq", "DESC");
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query()); exit;
        return $result;
    }
    
    public function getFrontInquiry($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_question A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
}