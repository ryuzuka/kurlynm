<?php
class Site_model extends CI_Model {
 
    public function __construct()
    {        
        parent::__construct();
    }

    // 팝업 정보 가져오기
    public function getPopup($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_popup A');        
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 팝업 LIst 수
    function getPopupListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->from("tb_popup");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 팝업 LIst
    public function getPopupList($option)
    {
        $this->db->select("A.*", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_popup A');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 팝업 정보 저장
    public function insertPopup($option)
    {
        $this->db->set('title', $option['title']);
        $this->db->set('start_date', $option['start_date']);
        $this->db->set('end_date', $option['end_date']);
        $this->db->set('link_url', $option['link_url']);
        if (isset($option['file_path']) && $option['file_path']) $this->db->set('file_path', $option['file_path']);
        if (isset($option['file_name']) && $option['file_name']) $this->db->set('file_name', $option['file_name']);
        if (isset($option['mobile_file_name']) && $option['mobile_file_name']) $this->db->set('mobile_file_name', $option['mobile_file_name']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_popup');
        $result = $this->db->insert_id();
        return $result;
    }


    // 팝업 정보 수정
    public function updatePopup($option)
    {
        $this->db->set('title', $option['title']);
        $this->db->set('start_date', $option['start_date']);
        $this->db->set('end_date', $option['end_date']);
        $this->db->set('link_url', $option['link_url']);
        if (isset($option['file_path']) && $option['file_path']) $this->db->set('file_path', $option['file_path']);
        if (isset($option['file_name']) && $option['file_name']) $this->db->set('file_name', $option['file_name']);
        if (isset($option['mobile_file_name']) && $option['mobile_file_name']) $this->db->set('mobile_file_name', $option['mobile_file_name']);
        $this->db->set('status', $option['status']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);        
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_popup');
        //var_dump($this->db->last_query()); exit;		
    }

    // 설문정보
    public function getResearch($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_research_master A');        
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 설문 LIst 수
    function getResearchListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->from("tb_research_master");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 설문 LIst
    public function getResearchList($option)
    {
        $this->db->select("A.*, L.code_name AS research_name", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_research_master A');
        $this->db->join('tb_code L', 'A.research_cd = L.code AND L.scheme_code = \'R01\'');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 설문 정보 저장
    public function insertResearch($option)
    {
        $this->db->set('research_cd', $option['research_cd']);
        if (isset($option['group_cd']) && $option['group_cd']) $this->db->set('group_cd', $option['group_cd']);
        $this->db->set('title', $option['title']);
        $this->db->set('start_dt', $option['start_date']);
        $this->db->set('end_dt', $option['end_date']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_research_master');
        $result = $this->db->insert_id();
        return $result;
    }


    // 설문 정보 수정
    public function updateResearch($option)
    {
        $this->db->set('research_cd', $option['research_cd']);
        $this->db->set('group_cd', $option['group_cd']);
        $this->db->set('title', $option['title']);
        $this->db->set('start_dt', $option['start_date']);
        $this->db->set('end_dt', $option['end_date']);
        $this->db->set('status', $option['status']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);        
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_research_master');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    // FAQ 정보 가져오기
    public function getFaq($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_faq A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }


    // FAQ LIst 수
    function getFaqListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->from("tb_faq");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // FAQ LIst
    public function getFaqList($option)
    {
        $this->db->select("A.*, L.code_name AS question_name", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_faq A');
        $this->db->join('tb_code L', 'A.faq_cd = L.code AND L.scheme_code = \'F02\'');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // FAQ 정보 저장
    public function insertFaq($option)
    {
        $this->db->set('faq_cd', $option['faq_cd']);
        $this->db->set('question_title', $option['question_title']);
        $this->db->set('answer_content', $option['answer_content']);
        $this->db->set('status', "Y");
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_faq');
        $result = $this->db->insert_id();
        return $result;
    }


    // FAQ 정보 수정
    public function updateFaq($option)
    {
        $this->db->set('faq_cd', $option['faq_cd']);
        $this->db->set('question_title', $option['question_title']);
        $this->db->set('answer_content', $option['answer_content']);
        $this->db->set('status', $option['status']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_faq');
        //var_dump($this->db->last_query()); exit;		
    }


    // 대시보드 정보 가져오기
    public function getDashboard()
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_dashboard A');        
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 대시보드 저장
    public function insertDashboard($option)
    {
        $this->db->set('client_count', $option['client_count']);
        $this->db->set('release_count', $option['release_count']);
        $this->db->set('member_count', $option['member_count']);
        $this->db->set('center_count', $option['center_count']);
        $this->db->set('base_date', $option['base_date']);
        $this->db->set('regist_id', $this->session->userdata('AID'));
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_operation');
        $result = $this->db->insert_id();
        return $result;
    }


    // 대시보드 수정
    public function updateDashboard($option)
    {
        $this->db->set('client_count', $option['client_count']);
        $this->db->set('release_count', $option['release_count']);
        $this->db->set('member_count', $option['member_count']);
        $this->db->set('center_count', $option['center_count']);
        $this->db->set('base_date', $option['base_date']);
        $this->db->set('update_id', $this->session->userdata('AID'));
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->update('tb_dashboard');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    // 요금안내 가져오기
    public function getFee()
    {
        $this->db->select("A.*", FALSE);
        $this->db->order_by("start_count", "ASC");
        $this->db->from('tb_fee A');
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 요금안내 가져오기
    public function getFeeHistory()
    {
        $this->db->select("regist_id, update_id, max(regist_date) as regist_date, max(update_date) as update_date", FALSE);
        $this->db->from('tb_fee');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }    
    
    // 요금안내 저장
    public function insertFee($option)
    {
        $this->db->set('start_count', $option['start_count']);
        $this->db->set('end_count', $option['end_count']);
        $this->db->set('price', $option['price']);
        $this->db->set('regist_id', $this->session->userdata('AID'));
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_fee');
        $result = $this->db->insert_id();
        return $result;
    }


    // 요금안내 수정
    public function updateFee($option)
    {
        $this->db->set('start_count', $option['mod_start_count']);
        $this->db->set('end_count', $option['mod_end_count']);
        $this->db->set('price', $option['mod_price']);
        $this->db->set('update_id', $this->session->userdata('AID'));
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['mod_seq']);
        $this->db->update('tb_fee');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 요금안내 삭제
    public function deleteFee($option)
    {
        $this->db->where('seq', $option['del_seq']);
        $this->db->delete('tb_fee');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    // 운영 정보 가져오기
    public function getOperation()
    {
        $this->db->select("A.*", FALSE);
        $this->db->from('tb_operation A');        
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 운영 정보 저장
    public function insertOperation($option)
    {
        $this->db->set('contact_name', $option['contact_name']);
        $this->db->set('contact_email', $option['contact_email']);
        $this->db->set('zipcode', $option['zipcode']);
        $this->db->set('address', $option['address']);
        $this->db->set('copyright', $option['copyright']);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_operation');
        $result = $this->db->insert_id();
        return $result;
    }


    // 운영 정보 수정
    public function updateOperation($option)
    {
        $this->db->set('contact_name', $option['contact_name']);
        $this->db->set('contact_email', $option['contact_email']);
        $this->db->set('zipcode', $option['zipcode']);
        $this->db->set('address', $option['address']);
        $this->db->set('copyright', $option['copyright']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->update('tb_operation');
        //var_dump($this->db->last_query()); exit;		
    }


    // 공시정보 가져오기
    public function getFinance($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_finance A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // // 공시정보 LIst 수
    function getFinanceListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like('A.title', $option['s_string']);
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            $this->db->where('A.regist_date >=', $option['start_date']);
            $this->db->where('A.regist_date <=', $option['end_date']);
        }
        $this->db->from("tb_finance A");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 공시정보 LIst
    public function getFinanceList($option)
    {
        $this->db->select("A.*", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like('A.title', $option['s_string']);
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            $this->db->where('A.regist_date >=', $option['start_date']);
            $this->db->where('A.regist_date <=', $option['end_date']);
        }
        $this->db->order_by("status", "DESC");
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_finance A');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }    

    // 공시정보 저장
    public function insertFinance($option)
    {
        $this->db->set('title', $option['title']);
        if (isset($option['file_path']) && $option['file_path']) $this->db->set('file_path', $option['file_path']);
        if (isset($option['file_name']) && $option['file_name']) $this->db->set('file_name', $option['file_name']);
        $this->db->set('regist_id', $this->session->userdata('AID'));
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_finance');
        $result = $this->db->insert_id();
        return $result;
    }


    // 공시정보 수정
    public function updateFinance($option)
    {
        $this->db->set('title', $option['title']);
        $this->db->set('file_path', $option['file_path']);
        $this->db->set('file_name', $option['file_name']);
        $this->db->set('update_id', $this->session->userdata('AID'));
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_finance');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 공시정보 삭제
    public function deleteFinance($option)
    {
        $this->db->where('seq', $option['seq']);
        $this->db->delete('tb_finance');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    // 이벤트 정보 가져오기
    public function getEvent($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_event A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 이벤트 LIst 수
    function getEventListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "start_date") {
                $this->db->where('A.start_date >=', $option['start_date']);
                $this->db->where('A.start_date <=', $option['end_date']);
            } else if ($option['s_term'] == "end_date") {
                $this->db->where('A.end_date >=', $option['start_date']);
                $this->db->where('A.end_date <=', $option['end_date']);
            }
        }
        if (isset($option['s_status']) && $option['s_status']) {
            if ($option['s_status'] == "W") {
                $this->db->where('now() between A.start_date AND A.end_date=0');
                $this->db->where('A.start_date > now()');
            } else if ($option['s_status'] == "I") {
                $this->db->where('now() between A.start_date AND A.end_date=1');
            } else if ($option['s_status'] == "E") {
                $this->db->where('now() between A.start_date AND A.end_date=0');
            }
        }
        $this->db->from("tb_event A");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 이벤트 LIst
    public function getEventList($option)
    {
        $this->db->select("A.*, date_format(now(), '%Y-%m-%d') between A.start_date AND A.end_date AS ing", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "start_date") {
                $this->db->where('A.start_date >=', $option['start_date']);
                $this->db->where('A.start_date <=', $option['end_date']);
            } else if ($option['s_term'] == "end_date") {
                $this->db->where('A.end_date >=', $option['start_date']);
                $this->db->where('A.end_date <=', $option['end_date']);
            }
        }
        if (isset($option['s_status']) && $option['s_status']) {
            if ($option['s_status'] == "W") {
                $this->db->where('now() between A.start_date AND A.end_date=0');
                $this->db->where('A.start_date > now()');
            } else if ($option['s_status'] == "I") {
                $this->db->where('now() between A.start_date AND A.end_date=1');
            } else if ($option['s_status'] == "E") {
                $this->db->where('now() between A.start_date AND A.end_date=0');
            }
        }
        $this->db->order_by("ing", "DESC");
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_event A');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 이벤트 정보 저장
    public function insertEvent($option)
    {
        $this->db->set('title', $option['title']);
        $this->db->set('content', $option['content']);
        $this->db->set('thumb_type', $option['thumb_type']);
        if (isset($option['file_path_pc']) && $option['file_path_pc']) $this->db->set('file_path_pc', $option['file_path_pc']);
        if (isset($option['file_name_pc']) && $option['file_name_pc']) $this->db->set('file_name_pc', $option['file_name_pc']);
        if (isset($option['file_path_mo']) && $option['file_path_mo']) $this->db->set('file_path_mo', $option['file_path_mo']);
        if (isset($option['file_name_mo']) && $option['file_name_mo']) $this->db->set('file_name_mo', $option['file_name_mo']);
        if (isset($option['start_date']) && $option['start_date']) $this->db->set('start_date', $option['start_date']);
        if (isset($option['end_date']) && $option['end_date']) $this->db->set('end_date', $option['end_date']);
        $this->db->set('thumb_pc1', $option['thumb_pc1']);
        $this->db->set('thumb_pc2', $option['thumb_pc2']);
        $this->db->set('thumb_mo1', $option['thumb_mo1']);
        $this->db->set('thumb_mo2', $option['thumb_mo2']);
        $this->db->set('banner_title', $option['banner_title']);
        $this->db->set('regist_id', $this->session->userdata('AID'));
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_event');
        $result = $this->db->insert_id();
        return $result;
    }


    // 이벤트 정보 수정
    public function updateEvent($option)
    {
        $this->db->set('title', $option['title']);
        $this->db->set('content', $option['content']);
        $this->db->set('thumb_type', $option['thumb_type']);
        $this->db->set('file_path_pc', $option['file_path_pc']);
        $this->db->set('file_name_pc', $option['file_name_pc']);
        $this->db->set('file_path_mo', $option['file_path_mo']);
        $this->db->set('file_name_mo', $option['file_name_mo']);
        if (isset($option['start_date']) && $option['start_date']) $this->db->set('start_date', $option['start_date']);
        if (isset($option['end_date']) && $option['end_date']) $this->db->set('end_date', $option['end_date']);
        $this->db->set('thumb_pc1', $option['thumb_pc1']);
        $this->db->set('thumb_pc2', $option['thumb_pc2']);
        $this->db->set('thumb_mo1', $option['thumb_mo1']);
        $this->db->set('thumb_mo2', $option['thumb_mo2']);
        $this->db->set('banner_title', $option['banner_title']);
        $this->db->set('status', $option['status']);
        $this->db->set('update_id', $this->session->userdata('AID'));
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_event');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 이벤트 삭제
    public function deleteEvent($option)
    {
        $this->db->where('seq', $option['seq']);
        $this->db->delete('tb_event');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    
    // 공지사항 정보 가져오기
    public function getNotice($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_notice A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 공지사항 LIst 수
    function getNoticeListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('regist_date >=', $option['start_date']);
                $this->db->where('regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "start_date") {
                $this->db->where('start_date >=', $option['start_date']);
                $this->db->where('start_date <=', $option['end_date']);
            } else if ($option['s_term'] == "end_date") {
                $this->db->where('end_date >=', $option['start_date']);
                $this->db->where('end_date <=', $option['end_date']);
            }
        }
        $this->db->from("tb_notice");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 공지사항 LIst
    public function getNoticeList($option)
    {
        $this->db->select("A.*", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "start_date") {
                $this->db->where('A.start_date >=', $option['start_date']);
                $this->db->where('A.start_date <=', $option['end_date']);
            } else if ($option['s_term'] == "end_date") {
                $this->db->where('A.end_date >=', $option['start_date']);
                $this->db->where('A.end_date <=', $option['end_date']);
            }
        }
        $this->db->order_by("status", "DESC");
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_notice A');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 공지사항 정보 저장
    public function insertNotice($option)
    {
        $this->db->set('title', $option['title']);
        $this->db->set('content', $option['content']);
        if (isset($option['file_path']) && $option['file_path']) $this->db->set('file_path', $option['file_path']);
        if (isset($option['file_name']) && $option['file_name']) $this->db->set('file_name', $option['file_name']);        
        if (isset($option['start_date']) && $option['start_date']) $this->db->set('start_date', $option['start_date']);
        if (isset($option['end_date']) && $option['end_date']) $this->db->set('end_date', $option['end_date']);
        $this->db->set('status', $option['status']);
        $this->db->set('regist_id', $this->session->userdata('AID'));
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_notice');
        $result = $this->db->insert_id();
        return $result;
    }


    // 공지사항 정보 수정
    public function updateNotice($option)
    {
        $this->db->set('title', $option['title']);
        $this->db->set('content', $option['content']);
        $this->db->set('file_path', $option['file_path']);
        $this->db->set('file_name', $option['file_name']);
        if (isset($option['start_date']) && $option['start_date']) $this->db->set('start_date', $option['start_date']);
        if (isset($option['end_date']) && $option['end_date']) $this->db->set('end_date', $option['end_date']);
        $this->db->set('status', $option['status']);
        $this->db->set('update_id', $this->session->userdata('AID'));
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_notice');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 공지사항 중요 수
    function getNoticeImportantCount()
    {
        $this->db->from("tb_notice");
        $this->db->where('status', 'Y');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 요금안내 삭제
    public function deleteNotice($option)
    {
        $this->db->where('seq', $option['seq']);
        $this->db->delete('tb_notice');
        //var_dump($this->db->last_query()); exit;		
    }
    
    // 이전 공지 글
    public function getNoticePrev($option) {
        $this->db->select('*');        
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        $this->db->where('seq <', $option['seq']);
        $this->db->where('status', 'Y');
        $this->db->order_by("seq", "DESC");
        $this->db->limit(1);
        $result = $this->db->get('tb_notice')->row();
        return $result;
    }
    
    // 다음 공지 글
    public function getNoticeNext($option) {
        $this->db->select('*');        
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        $this->db->where('seq >', $option['seq']);
        $this->db->where('status', 'Y');
        $this->db->order_by("seq", "DESC");
        $this->db->limit(1);
        $result = $this->db->get('tb_notice')->row();
        return $result;
    }
    
    // 문의 정보 
    public function getInquiry($option)
    {
        $this->db->select("A.*, L.code_name AS question_name", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->from('tb_question A');
        $this->db->join('tb_code L', 'A.question_cd = L.code AND L.scheme_code = \'Q01\'');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 이전 문의 글
    public function getInquiryPrev($option) {
        $this->db->select('*');                
        $this->db->where('seq <', $option['seq']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->order_by("seq", "DESC");
        $this->db->limit(1);
        $result = $this->db->get('tb_question')->row();
        return $result;
    }
    
    // 다음 문의 글
    public function getInquiryNext($option) {
        $this->db->select('*');
        $this->db->where('seq >', $option['seq']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->order_by("seq", "DESC");
        $this->db->limit(1);
        $result = $this->db->get('tb_question')->row();
        return $result;
    }
    
    // 문의 LIst 수
    function getInquiryListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->from("tb_question");
        $this->db->where('member_id', $option['member_id']);
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 LIst
    public function getInquiryList($option)
    {
        $this->db->select("A.*, L.code_name AS question_name", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->order_by("seq", "DESC");
        $this->db->where('member_id', $option['member_id']);
        $this->db->from('tb_question A');
        $this->db->join('tb_code L', 'A.question_cd = L.code AND L.scheme_code = \'Q01\'');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query()); exit;
        return $result;
    }


    // 문의 정보 저장
    public function insertInquiry($option)
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
    public function updateInquiry($option)
    {
        $this->db->set('question_cd', $option['question_cd']);        
        $this->db->set('question_title', $option['question_title']);
        $this->db->set('question_content', $option['question_content']);
        if (isset($option['file_path']) && $option['file_path']) $this->db->set('file_path', $option['file_path']);
        if (isset($option['file_name']) && $option['file_name']) $this->db->set('file_name', $option['file_name']);
        $this->db->set('status', $option['status']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_question');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    // 문의 정보 삭제
    public function deleteInquiry($option)
    {
        $this->db->where('seq', $option['seq']);
        $this->db->delete('tb_question');
        //var_dump($this->db->last_query()); exit;		
    }
    
    
    // FAQ All LIst - Front
    public function getFaqAllList($option)
    {
        $this->db->select("A.*", FALSE);
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_faq A');
        $this->db->where('faq_cd', $option['faq_cd']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    
    /* 설문 */
    // LIst
    public function getReaesrchQuestionList($option)
    {
        $this->db->select("A.*", FALSE);
        if ($option['s_field'] != "" && $option['s_string'] != "") $this->db->like($option['s_field'], $option['s_string'], 'both');
        $this->db->where('research_cd', $option['r_type']);
        $this->db->order_by("A.seq", "DESC");
        $this->db->from('tb_reaesrch_question A');

        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    
    
    
    
    /*################################ FRONT #########################################*/
    // 공시정보 가져오기
    public function getFrontFinance($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_finance A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 문의 LIst 수
    function getFrontFinanceListCount($option)
    {
        $this->db->from("tb_finance");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 LIst
    public function getFrontFinanceList($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_finance A');
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query()); exit;
        return $result;
    }
    
    
}