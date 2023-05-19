<?php
class Inquiry_model extends CI_Model {
 
    public function __construct()
    {        
        parent::__construct();
    }

    // 최저 요금 정보 가져오기
    public function getFeeHighPrice()
    {
        $query = "
            SELECT price
            FROM tb_fee
            ORDER BY price DESC
        ";
        $result = $this->db->query($query)->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 요금 정보 가져오기
    public function getFeePrice($option)
    {
        $query = "
            SELECT price
            FROM tb_fee
            WHERE ".$option['delivery_count']." between start_count AND end_count
        ";
        $result = $this->db->query($query)->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 문의 정보 가져오기
    public function getEstimate($option)
    {
        $this->db->select("A.seq as estimate_seq, A.status as estimate_status, A.*, B.manager_name, AES_DECRYPT(UNHEX(A.answer_email), '".config_item('encryption_key')."') AS dec_answer_email, AES_DECRYPT(UNHEX(A.company_tel), '".config_item('encryption_key')."') AS dec_company_tel, AES_DECRYPT(UNHEX(A.company_email), '".config_item('encryption_key')."') AS dec_company_email, B.*, AES_DECRYPT(UNHEX(B.manager_tel), '".config_item('encryption_key')."') AS dec_manager_tel, AES_DECRYPT(UNHEX(B.manager_email), '".config_item('encryption_key')."') AS dec_manager_email", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_estimate_master A');
        $this->db->join('tb_estimate_detail B', 'A.seq = B.estimate_seq');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 LIst 수
    function getEstimateListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) {
            if ($option['s_field'] == "manager_name") {
                $this->db->like($option['s_field'], $option['s_string'], FALSE);
            } else {
                $this->db->where($option['s_field'], "HEX(AES_ENCRYPT('".$option['s_string']."', '".config_item('encryption_key')."'))", FALSE);
            }
        }
        
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "question_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "answer_date") {
                $this->db->where('A.answer_date >=', $option['start_date']);
                $this->db->where('A.answer_date <=', $option['end_date']);
            }
        }
        if (isset($option['s_status']) && $option['s_status']) $this->db->where('A.status ', $option['s_status']);
        $this->db->from("tb_estimate_master A");
        $this->db->join('tb_estimate_detail B', 'A.seq = B.estimate_seq');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 LIst
    public function getEstimateList($option)
    {
        $this->db->select("A.*, B.manager_name, AES_DECRYPT(UNHEX(B.manager_tel), '".config_item('encryption_key')."') AS dec_manager_tel, AES_DECRYPT(UNHEX(B.manager_email), '".config_item('encryption_key')."') AS dec_manager_email", FALSE);
        
        if (isset($option['s_string']) && $option['s_string']) {
            if ($option['s_field'] == "manager_name") {
                $this->db->like($option['s_field'], $option['s_string'], FALSE);
            } else {
                $this->db->where($option['s_field'], "HEX(AES_ENCRYPT('".$option['s_string']."', '".config_item('encryption_key')."'))", FALSE);
            }
        }

        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "question_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "answer_date") {
                $this->db->where('A.answer_date >=', $option['start_date']);
                $this->db->where('A.answer_date <=', $option['end_date']);
            }
        }
        if (isset($option['s_status']) && $option['s_status']) $this->db->where('A.status ', $option['s_status']);
        $this->db->order_by("A.seq", "DESC");
        $this->db->from('tb_estimate_master A');
        $this->db->join('tb_estimate_detail B', 'A.seq = B.estimate_seq');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 정보 저장
    public function insertEstimate($option)
    {
        $this->db->set('question_cd', $option['question_cd']);
        $this->db->set('member_id', $option['member_id']);
        $this->db->set('question_title', $option['question_title']);
        $this->db->set('question_content', $option['question_content']);
        if (isset($option['file_path']) && $option['file_path']) $this->db->set('file_path', $option['file_path']);
        if (isset($option['file_name']) && $option['file_name']) $this->db->set('file_name', $option['file_name']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_estimate');
        $result = $this->db->insert_id();
        return $result;
    }


    // 견적문의 정보 수정
    public function updateEstimate($option)
    {
        $this->db->set('answer_id', $option['answer_id']);
        $this->db->set('answer_email', "HEX(AES_ENCRYPT('".$option['answer_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('answer_title', $option['answer_title']);
        $this->db->set('answer_content', $option['answer_content']);
        if (isset($option['answer_filepath']) && $option['answer_filepath']) $this->db->set('answer_filepath', $option['answer_filepath']);
        if (isset($option['answer_filename']) && $option['answer_filename']) $this->db->set('answer_filename', $option['answer_filename']);
        $this->db->set('status', 'Y');
        $this->db->set('answer_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_estimate_master');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    
    // 문의 정보 가져오기
    public function getQuestion($option)
    {
        $this->db->select("A.*, AES_DECRYPT(UNHEX(A.question_email), '".config_item('encryption_key')."') AS dec_question_email, AES_DECRYPT(UNHEX(A.question_tel), '".config_item('encryption_key')."') AS dec_question_tel", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_question A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 LIst 수
    function getQuestionListCount($option)
    {
        if (isset($option['s_field']) && $option['s_field']) { 
            if(isset($option['s_string']) && $option['s_string']) {
                $this->db->like($option['s_field'], $option['s_string']);
            }
        } else {
            if(isset($option['s_string']) && $option['s_string']) {
                $this->db->or_like("question_title", $option['s_string']);
                $this->db->or_like("question_name", $option['s_string']);
            }
        }
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "question_date") {
                $this->db->where('regist_date >=', $option['start_date']);
                $this->db->where('regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "answer_date") {
                $this->db->where('answer_date >=', $option['start_date']);
                $this->db->where('answer_date <=', $option['end_date']);
            }
        }
        if (isset($option['s_status']) && $option['s_status']) $this->db->where('status ', $option['s_status']);
        $this->db->from("tb_question");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 LIst
    public function getQuestionList($option)
    {
        $this->db->select("A.*, AES_DECRYPT(UNHEX(A.question_email), '".config_item('encryption_key')."') AS dec_question_email, AES_DECRYPT(UNHEX(A.question_tel), '".config_item('encryption_key')."') AS dec_question_tel", FALSE);
        if (isset($option['s_field']) && $option['s_field']) { 
            if(isset($option['s_string']) && $option['s_string']) {
                $this->db->like($option['s_field'], $option['s_string']);
            }
        } else {
            if(isset($option['s_string']) && $option['s_string']) {
                $this->db->or_like("question_title", $option['s_string']);
                $this->db->or_like("question_name", $option['s_string']);
            }
        }
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "question_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "answer_date") {
                $this->db->where('A.answer_date >=', $option['start_date']);
                $this->db->where('A.answer_date <=', $option['end_date']);
            }
        }
        if (isset($option['s_status']) && $option['s_status']) $this->db->where('status ', $option['s_status']);
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_question A');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 정보 저장
    public function insertQuestion($option)
    {
        $this->db->set('question_cd', $option['question_cd']);
        $this->db->set('member_id', $option['member_id']);
        $this->db->set('question_title', $option['question_title']);
        $this->db->set('question_content', $option['question_content']);
        if (isset($option['file_path']) && $option['file_path']) $this->db->set('file_path', $option['file_path']);
        if (isset($option['file_name']) && $option['file_name']) $this->db->set('file_name', $option['file_name']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_question');
        $result = $this->db->insert_id();
        return $result;
    }


    // 문의 정보 수정
    public function updateQuestion($option)
    {
        $this->db->set('answer_id', $option['answer_id']);
        $this->db->set('answer_content', $option['answer_content']);
        $this->db->set('status', $option['status']);
        $this->db->set('answer_date', 'now()', false);
        $this->db->set('answer_ip', $_SERVER['REMOTE_ADDR']);
        if ($option['mode'] == "N") {
            $this->db->set('update_id', $this->session->userdata('AID'));
            $this->db->set('update_date', 'now()', false);
        }
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_question');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 비밀번호 재발급 업데이트
    public function updateInquiryPasswd($option)
    {
        $this->db->set('question_passwd', "HEX(AES_ENCRYPT('".$option['question_passwd']."', '".config_item('encryption_key')."'))", false);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_question');
    }
    
    
    
    /* ################################# FRONT #####################################*/
    // 견적문의 마스터 저장
    public function insertFrontEstimateMaster($option)
    {
        $this->db->set('member_id', $option['member_id']);
        $this->db->set('company_name', $option['company_name']);
        $this->db->set('company_ceo', $option['company_ceo']);
        $this->db->set('company_no', $option['company_no']);
        $this->db->set('company_address', $option['company_address']);
        $this->db->set('company_site', $option['company_site']);
        $this->db->set('company_email', "HEX(AES_ENCRYPT('".$option['company_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('company_brand', $option['company_brand']);
        $this->db->set('company_tel', "HEX(AES_ENCRYPT('".$option['company_tel']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_estimate_master');
        $result = $this->db->insert_id();
        return $result;
    }
    
    // 견적문의 디테일 저장
    public function insertFrontEstimateDetail($option)
    {
        $this->db->set('estimate_seq', $option['estimate_seq']);
        
        $this->db->set('release_date', $option['release_date']);
        $this->db->set('release_week', $option['release_week']);
        $this->db->set('release_time', $option['release_time']);
        $this->db->set('release_method', $option['release_method']);
        $this->db->set('pickup_time', $option['pickup_time']);
        $this->db->set('pickup_type', $option['pickup_type']);
        $this->db->set('pickup_etc', $option['pickup_etc']);
        $this->db->set('pickup_address1', $option['pickup_address1']);
        $this->db->set('pickup_address2', $option['pickup_address2']);
        $this->db->set('release_content', $option['release_content']);
        
        $this->db->set('early_day1_cnt', $option['early_day1_cnt']);
        $this->db->set('early_day2_cnt', $option['early_day2_cnt']);
        $this->db->set('early_day3_cnt', $option['early_day3_cnt']);
        $this->db->set('early_day4_cnt', $option['early_day4_cnt']);
        $this->db->set('early_day5_cnt', $option['early_day5_cnt']);
        $this->db->set('early_day6_cnt', $option['early_day6_cnt']);
        $this->db->set('early_day7_cnt', $option['early_day7_cnt']);
        
        $this->db->set('early_month1', $option['early_month1']);
        $this->db->set('early_month1_cnt', $option['early_month1_cnt']);
        $this->db->set('early_month2', $option['early_month2']);
        $this->db->set('early_month2_cnt', $option['early_month2_cnt']);
        $this->db->set('early_month3', $option['early_month3']);
        $this->db->set('early_month3_cnt', $option['early_month3_cnt']);
        
        $this->db->set('delivery_month1', $option['delivery_month1']);
        $this->db->set('delivery_month1_cnt', $option['delivery_month1_cnt']);
        $this->db->set('delivery_month2', $option['delivery_month2']);
        $this->db->set('delivery_month2_cnt', $option['delivery_month2_cnt']);
        $this->db->set('delivery_month3', $option['delivery_month3']);
        $this->db->set('delivery_month3_cnt', $option['delivery_month3_cnt']);
        
        $this->db->set('goods_title', $option['goods_title']);
        $this->db->set('goods_type', $option['goods_type']);
        $this->db->set('goods_etc', $option['goods_etc']);
        $this->db->set('goods_length', $option['goods_length']);
        $this->db->set('goods_weight', $option['goods_weight']);
        
        $this->db->set('manager_name', $option['manager_name']);
        $this->db->set('manager_tel', "HEX(AES_ENCRYPT('".$option['manager_tel']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('manager_email', "HEX(AES_ENCRYPT('".$option['manager_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('estimate_content', $option['estimate_content']);
        
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_estimate_detail');
        $result = $this->db->insert_id();
        return $result;
    }
    
    // 견적문의 마스터 가져오기
    public function getEstimateMaster($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_estimate_master A');
        $this->db->where('A.seq', $option['estimate_seq']);
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 견적문의 디테일 가져오기
    public function getEstimateDetail($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_estimate_detail A');
        $this->db->where('A.estimate_seq', $option['estimate_seq']);
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    public function insertFrontEstimateStep01($option)
    {
        $this->db->set('member_id', $option['member_id']);
        $this->db->set('company_name', $option['company_name']);
        $this->db->set('company_ceo', $option['company_ceo']);
        $this->db->set('company_no', $option['company_no']);
        $this->db->set('company_address', $option['company_address']);
        $this->db->set('company_site', $option['company_site']);
        $this->db->set('company_email', $option['company_email']);
        $this->db->set('company_brand', $option['company_brand']);
        $this->db->set('company_tel', $option['company_tel']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_estimate_master');
        $result = $this->db->insert_id();
        return $result;
    }
    
    public function updateFrontEstimateStep01($option)
    {
        $this->db->set('company_name', $option['company_name']);
        $this->db->set('company_ceo', $option['company_ceo']);
        $this->db->set('company_no', $option['company_no']);
        $this->db->set('company_address', $option['company_address']);
        $this->db->set('company_site', $option['company_site']);
        $this->db->set('company_email', $option['company_email']);
        $this->db->set('company_brand', $option['company_brand']);
        $this->db->set('company_tel', $option['company_tel']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_master');
        //var_dump($this->db->last_query()); exit;		
    }
    
    public function insertFrontEstimateStep02($option)
    {
        $this->db->set('estimate_seq', $option['estimate_seq']);
        $this->db->set('release_date', $option['release_date']);
        $this->db->set('release_week', $option['release_week']);
        $this->db->set('release_time', $option['release_time']);
        $this->db->set('release_method', $option['release_method']);
        $this->db->set('pickup_time', $option['pickup_time']);
        $this->db->set('pickup_type', $option['pickup_type']);
        $this->db->set('pickup_etc', $option['pickup_etc']);
        $this->db->set('pickup_address1', $option['pickup_address1']);
        $this->db->set('pickup_address2', $option['pickup_address2']);
        $this->db->set('release_content', $option['release_content']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_estimate_detail');
        $result = $this->db->insert_id();
        return $result;
    }
    
    public function updateFrontEstimateStep02($option)
    {   
        $this->db->set('release_date', $option['release_date']);
        $this->db->set('release_week', $option['release_week']);
        $this->db->set('release_time', $option['release_time']);
        $this->db->set('release_method', $option['release_method']);
        $this->db->set('pickup_time', $option['pickup_time']);
        $this->db->set('pickup_type', $option['pickup_type']);
        $this->db->set('pickup_etc', $option['pickup_etc']);
        $this->db->set('pickup_address1', $option['pickup_address1']);
        $this->db->set('pickup_address2', $option['pickup_address2']);
        $this->db->set('release_content', $option['release_content']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
        
    }
    
    public function insertFrontEstimateStep03($option)
    {
        $this->db->set('early_day1_cnt', $option['early_day1_cnt']);
        $this->db->set('early_day2_cnt', $option['early_day2_cnt']);
        $this->db->set('early_day3_cnt', $option['early_day3_cnt']);
        $this->db->set('early_day4_cnt', $option['early_day4_cnt']);
        $this->db->set('early_day5_cnt', $option['early_day5_cnt']);
        $this->db->set('early_day6_cnt', $option['early_day6_cnt']);
        $this->db->set('early_day7_cnt', $option['early_day7_cnt']);
        
        $this->db->set('early_month1', $option['early_month1']);
        $this->db->set('early_month1_cnt', $option['early_month1_cnt']);
        $this->db->set('early_month2', $option['early_month2']);
        $this->db->set('early_month2_cnt', $option['early_month2_cnt']);
        $this->db->set('early_month3', $option['early_month3']);
        $this->db->set('early_month3_cnt', $option['early_month3_cnt']);
        
        $this->db->set('delivery_month1', $option['delivery_month1']);
        $this->db->set('delivery_month1_cnt', $option['delivery_month1_cnt']);
        $this->db->set('delivery_month2', $option['delivery_month2']);
        $this->db->set('delivery_month2_cnt', $option['delivery_month2_cnt']);
        $this->db->set('delivery_month3', $option['delivery_month3']);
        $this->db->set('delivery_month3_cnt', $option['delivery_month3_cnt']);
        
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
        
    }
    
    public function updateFrontEstimateStep03($option)
    {   
        $this->db->set('early_day1_cnt', $option['early_day1_cnt']);
        $this->db->set('early_day2_cnt', $option['early_day2_cnt']);
        $this->db->set('early_day3_cnt', $option['early_day3_cnt']);
        $this->db->set('early_day4_cnt', $option['early_day4_cnt']);
        $this->db->set('early_day5_cnt', $option['early_day5_cnt']);
        $this->db->set('early_day6_cnt', $option['early_day6_cnt']);
        $this->db->set('early_day7_cnt', $option['early_day7_cnt']);
        
        $this->db->set('early_month1', $option['early_month1']);
        $this->db->set('early_month1_cnt', $option['early_month1_cnt']);
        $this->db->set('early_month2', $option['early_month2']);
        $this->db->set('early_month2_cnt', $option['early_month2_cnt']);
        $this->db->set('early_month3', $option['early_month3']);
        $this->db->set('early_month3_cnt', $option['early_month3_cnt']);
        
        $this->db->set('delivery_month1', $option['delivery_month1']);
        $this->db->set('delivery_month1_cnt', $option['delivery_month1_cnt']);
        $this->db->set('delivery_month2', $option['delivery_month2']);
        $this->db->set('delivery_month2_cnt', $option['delivery_month2_cnt']);
        $this->db->set('delivery_month3', $option['delivery_month3']);
        $this->db->set('delivery_month3_cnt', $option['delivery_month3_cnt']);
        
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
    }
    
    public function insertFrontEstimateStep04($option)
    {
        $this->db->set('goods_title', $option['goods_title']);
        $this->db->set('goods_type', $option['goods_type']);
        $this->db->set('goods_etc', $option['goods_etc']);
        $this->db->set('goods_length', $option['goods_length']);
        $this->db->set('goods_weight', $option['goods_weight']);
        
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
    }
    
    public function updateFrontEstimateStep04($option)
    {   
        $this->db->set('goods_title', $option['goods_title']);
        $this->db->set('goods_type', $option['goods_type']);
        $this->db->set('goods_etc', $option['goods_etc']);
        $this->db->set('goods_length', $option['goods_length']);
        $this->db->set('goods_weight', $option['goods_weight']);
        
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
    }
    
    public function insertFrontEstimateStep05($option)
    {
        $this->db->set('manager_name', $option['manager_name']);
        $this->db->set('manager_tel', $option['manager_tel']);
        $this->db->set('manager_email', $option['manager_email']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
    }
    
    public function updateFrontEstimateStep05($option)
    {   
        $this->db->set('manager_name', $option['manager_name']);
        $this->db->set('manager_tel', $option['manager_tel']);
        $this->db->set('manager_email', $option['manager_email']);
        
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
    }
    
    public function insertFrontEstimateStep06($option)
    {
        $this->db->set('estimate_content', $option['estimate_content']);
        
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
    }
    
    public function updateFrontEstimateStep06($option)
    {   
        $this->db->set('estimate_content', $option['estimate_content']);
        
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        
        $this->db->where('estimate_seq', $option['estimate_seq']);
        $this->db->update('tb_estimate_detail');
    }
}