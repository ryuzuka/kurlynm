<?php
class Member_model extends CI_Model {
 
    public function __construct()
    {        
        parent::__construct();
    }


    // 정보 가져오기
    public function getMember($option)
    {
        $this->db->select("A.*, AES_DECRYPT(UNHEX(member_email), '".config_item('encryption_key')."') AS dec_email, AES_DECRYPT(UNHEX(member_tel), '".config_item('encryption_key')."') AS dec_tel", FALSE);
        $this->db->where('member_id', $option['member_id']);
        $this->db->from('tb_member A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 정보 가져오기
    public function findMember($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('member_id', $option['member_id']);
        $this->db->where('email', "HEX(AES_ENCRYPT('".$option['email']."', '".config_item('encryption_key')."'))", false);
        $this->db->from('tb_member A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 정보 가져오기
    public function getFindMember($option)
    {
        $this->db->select("A.*, AES_DECRYPT(UNHEX(email), '".config_item('encryption_key')."') AS dec_email", FALSE);
        $this->db->where('email', "HEX(AES_ENCRYPT('".$option['email']."', '".config_item('encryption_key')."'))", false);
        $this->db->from('tb_member A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 재가입 기간 체크
    function getReJoinCount($option)
    {
        $this->db->select("*", FALSE);
        $this->db->where('status', 'N');
        $this->db->where('member_id', $option['member_id']);
        $this->db->where('DATEDIFF(DATE_FORMAT(now(), "%Y-%m-%d"), update_date) > '.$option['join_day']);
        $this->db->from("tb_member");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // LIst 전체 수
    function getMemberListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) {
            if ($option['s_field'] == "member_name") {
                $this->db->like($option['s_field'], $option['s_string'], FALSE);
            } else {
                $this->db->where($option['s_field'], "HEX(AES_ENCRYPT('".$option['s_string']."', '".config_item('encryption_key')."'))", FALSE);
            }
        }
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "login_date") {
                $this->db->where('A.login_date >=', $option['start_date']);
                $this->db->where('A.login_date <=', $option['end_date']);
            }
        }
        $this->db->where("status", $option["status"]);
        $this->db->from("tb_member A");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // LIst
    public function getMemberList($option)
    {
        $this->db->select("A.*, AES_DECRYPT(UNHEX(member_email), '".config_item('encryption_key')."') AS dec_email, AES_DECRYPT(UNHEX(member_tel), '".config_item('encryption_key')."') AS dec_tel", FALSE);
        if (isset($option['s_string']) && $option['s_string']) {
            if ($option['s_field'] == "member_name") {
                $this->db->like($option['s_field'], $option['s_string'], FALSE);
            } else {
                $this->db->where($option['s_field'], "HEX(AES_ENCRYPT('".$option['s_string']."', '".config_item('encryption_key')."'))", FALSE);
            }
        }
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "login_date") {
                $this->db->where('A.login_date >=', $option['start_date']);
                $this->db->where('A.login_date <=', $option['end_date']);
            }
        }
        $this->db->where("status", $option["status"]);
        $this->db->order_by("A.regist_date", "DESC");
        $this->db->from('tb_member A');
        if (isset($option['limit_size']) && isset($option['limit_start'])) $this->db->limit($option['limit_size'], $option['limit_start']);

        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }


    // LIst 전체 수
    function getSecessionMemberListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) {
            if ($option['s_field'] == "member_name") {
                $this->db->like($option['s_field'], $option['s_string'], FALSE);
            } else {
                $this->db->where($option['s_field'], "HEX(AES_ENCRYPT('".$option['s_string']."', '".config_item('encryption_key')."'))", FALSE);
            }
        }
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "login_date") {
                $this->db->where('A.login_date >=', $option['start_date']);
                $this->db->where('A.login_date <=', $option['end_date']);
            }
        }
        $this->db->where("status", $option["status"]);
        $this->db->from("tb_member A");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // LIst
    public function getSecessionMemberList($option)
    {
        $this->db->select("A.*, AES_DECRYPT(UNHEX(member_email), '".config_item('encryption_key')."') AS dec_email, AES_DECRYPT(UNHEX(member_tel), '".config_item('encryption_key')."') AS dec_tel", FALSE);
        if (isset($option['s_string']) && $option['s_string']) {
            if ($option['s_field'] == "member_name") {
                $this->db->like($option['s_field'], $option['s_string'], FALSE);
            } else {
                $this->db->where($option['s_field'], "HEX(AES_ENCRYPT('".$option['s_string']."', '".config_item('encryption_key')."'))", FALSE);
            }
        }
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            if ($option['s_term'] == "regist_date") {
                $this->db->where('A.regist_date >=', $option['start_date']);
                $this->db->where('A.regist_date <=', $option['end_date']);
            } else if ($option['s_term'] == "login_date") {
                $this->db->where('A.login_date >=', $option['start_date']);
                $this->db->where('A.login_date <=', $option['end_date']);
            }
        }
        $this->db->where("status", $option["status"]);
        $this->db->order_by("A.update_date", "DESC");
        $this->db->from('tb_member A');
        if (isset($option['limit_size']) && isset($option['limit_start'])) $this->db->limit($option['limit_size'], $option['limit_start']);

        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // LIst
    public function getMemberListExcel($option)
    {
        $this->db->select("A.*, AES_DECRYPT(UNHEX(email), '".config_item('encryption_key')."') AS dec_email", FALSE);
        if ($option['s_field'] != "" && $option['s_string'] != "") $this->db->like($option['s_field'], $option['s_string'], 'both');
        $this->db->order_by("A.regist_date", "DESC");
        $this->db->from('tb_member A');
        $this->db->limit($option['limit_size'], $option['limit_start']);

        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());exit;
        return $result;
    }


    // Insert
    public function insertMember($option)
    {
        $this->db->set('member_id', $option['member_id']);
        $this->db->set('member_passwd', $option['hash']);
        $this->db->set('email', "HEX(AES_ENCRYPT('".$option['email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set("count", "0");
        $this->db->set("acceptance", $option["acceptance"]);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_member');
        $result = $this->db->insert_id();
        return $result;
    }


    // Update
    public function updateMember($option)
    {	
        if (isset($option['hash']) && $option['hash']) {
            $this->db->set('member_passwd', $option['hash']);
        }
        $this->db->set("email", "HEX(AES_ENCRYPT('".$option['email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set("acceptance", $option["acceptance"]);
        if (isset($option['status']) && $option['status']) $this->db->set("status", $option["status"]);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->update('tb_member');
    }
    

    // Update - Login Count
    public function updateLogin($option)
    {	
        $this->db->set('count', "count+1", false);		
        $this->db->set("login_date", "NOW()", false);
        $this->db->where('member_id', $option['member_id']);
        $this->db->update('tb_member');
    }
    
    
    // Update - 탈퇴 처리
    public function updateSecession($option) {
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->set("status", "N");
        $this->db->where('member_id', $option['member_id']);
        $this->db->update('tb_member');
    }
    
    
    // 본인확인 DI 중복 체크
    public function getDICheck($option)
    {
        $this->db->where("status", "Y");
        $this->db->where("di", $option['di']);
        if (isset($option['member_id']) && $option['member_id']) $this->db->where("member_id <>", $option['member_id']);
        $this->db->from("tb_member");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    
    // 아이디 중복 체크
    public function getIDCheck($option)
    {
        $this->db->select("((SELECT COUNT(*) FROM tb_admin WHERE admin_id = '".$option['member_id']."') + (SELECT COUNT(*) FROM tb_member WHERE member_id = '".$option['member_id']."')) AS cnt", FALSE);
        $result = $this->db->get()->row()->cnt;
        //var_dump($this->db->last_query());
        return $result;
    }
    
    
    // 이메일 중복 체크
    public function getEmailCheck($option)
    {        
        $query = "
            SELECT COUNT(*) AS cnt
            FROM (
                SELECT AES_DECRYPT(UNHEX(email), '".config_item('encryption_key')."') AS email
                FROM tb_member
            ) T
            WHERE T.email = '".$option['email']."'
        ";
        $result = $this->db->query($query)->row()->cnt;
        //var_dump($this->db->last_query());
        return $result;
    }
    
    
    // 이메일 중복 체크
    public function getMyEmailCheck($option)
    {
        $query = "
            SELECT COUNT(*) AS cnt
            FROM (
                SELECT AES_DECRYPT(UNHEX(email), '".config_item('encryption_key')."') AS email
                FROM tb_member
                WHERE member_id <> '".$option['member_id']."'
            ) T
            WHERE T.email = '".$option['email']."'
        ";
        $result = $this->db->query($query)->row()->cnt;
        //var_dump($this->db->last_query());
        return $result;
    }
    
        
    /**************************************************
     * Login History 관련
     **************************************************/
    // Insert - Login History
    public function insertLoginHistory($option)
    {
        $this->db->set('member_id', $option['member_id']);
        $this->db->set('login_device', $option['login_device']);
        $this->db->set('login_ip', $option['login_ip']);
        $this->db->set('login_agent', $option['login_agent']);
        $this->db->set('login_date', 'now()', false);
        $this->db->insert('tb_history_login');
        $result = $this->db->insert_id();
        return $result;
    }
    
    
    // LIst 전체 수
    public function getLoginHistoryListCount($option)
    {
        if (isset($option['s_string']) && $option['s_string']) $this->db->like($option['s_field'], $option['s_string']);
        $this->db->from("tb_history_login");
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // LIst
    public function getLoginHistoryList($option)
    {
        if ($option['s_field'] != "" && $option['s_string'] != "") $this->db->like($option['s_field'], $option['s_string'], 'both');
        $this->db->from('tb_history_login');
        $this->db->order_by("seq", "DESC");
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }

    
    /**************************************************
     * FRONT Member 관련
     **************************************************/    
    // 회원가입 여부 체크
    public function getJoinMember($option)
    {
        $this->db->select("A.*", FALSE);
        $this->db->where('member_type', $option['member_type']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->from('tb_member A');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 회원가입
    public function insertJoinMember($option)
    {
        $this->db->set('member_type', $option['member_type']);
        $this->db->set('member_id', $option['member_id']);
        $this->db->set('member_email', "HEX(AES_ENCRYPT('".$option['member_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->insert('tb_member');
        $result = $this->db->insert_id();
        return $result;
    }
    
    // Update
    public function updateJoinMember($option)
    {	
        $this->db->set('member_name', $option['member_name']);
        $this->db->set('member_tel', "HEX(AES_ENCRYPT('".$option['member_tel']."', '".config_item('encryption_key')."'))", false);
        $this->db->set("member_email", "HEX(AES_ENCRYPT('".$option['member_email']."', '".config_item('encryption_key')."'))", false);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->where('member_type', $option['member_type']);
        $this->db->update('tb_member');
    }

    // Secession
    public function deleteJoinMember($option)
    {	
        $this->db->set("status", $option["status"]);
        $this->db->set('secession_content', $option['secession_content']);
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->update('tb_member');
    }
    
    // Update
    public function updateReJoinMember($option)
    {	
        $this->db->set("status", "Y");
        $this->db->set('update_date', 'now()', false);
        $this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
        $this->db->where('member_id', $option['member_id']);
        $this->db->update('tb_member');
    }
    
    // Update - Login Count
    public function updateJoinLogin($option)
    {	
        $this->db->set('count', "count+1", false);		
        $this->db->set("login_date", "NOW()", false);
        $this->db->where('member_id', $option['member_id']);
        $this->db->update('tb_member');
    }
    
    // 문의 LIst 수
    function getMemberEstimateListCount($option)
    {
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            $this->db->where('regist_date >=', $option['start_date']);
            $this->db->where('regist_date <=', $option['end_date']);
        }
        $this->db->from("tb_estimate_master");
        $this->db->where('member_id', $option['member_id']);
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }


    // 문의 LIst
    public function getMemberEstimateList($option)
    {
        $this->db->select("A.*, B.manager_name, AES_DECRYPT(UNHEX(B.manager_tel), '".config_item('encryption_key')."') AS dec_tel, AES_DECRYPT(UNHEX(B.manager_email), '".config_item('encryption_key')."') AS dec_email", FALSE);
        if ((isset($option['start_date']) && $option['start_date']) && (isset($option['end_date']) && $option['end_date'])) {
            $this->db->where('A.regist_date >=', $option['start_date']);
            $this->db->where('A.regist_date <=', $option['end_date']);
        }
        $this->db->order_by("seq", "DESC");
        $this->db->from('tb_estimate_master A');
        $this->db->join('tb_estimate_detail B', 'A.seq = B.estimate_seq', 'left');
        $this->db->where('A.member_id', $option['member_id']);
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 문의 정보 가져오기
    public function getMemberEstimate($option)
    {
        $this->db->select("A.*, B.*, AES_DECRYPT(UNHEX(A.company_tel), '".config_item('encryption_key')."') AS dec_company_tel, AES_DECRYPT(UNHEX(A.company_email), '".config_item('encryption_key')."') AS dec_company_email, B.*, AES_DECRYPT(UNHEX(B.manager_tel), '".config_item('encryption_key')."') AS dec_manager_tel, AES_DECRYPT(UNHEX(B.manager_email), '".config_item('encryption_key')."') AS dec_manager_email, AES_DECRYPT(UNHEX(A.answer_email), '".config_item('encryption_key')."') AS dec_answer_email", FALSE);
        $this->db->where('A.seq', $option['seq']);
        $this->db->from('tb_estimate_master A');
        $this->db->join('tb_estimate_detail B', 'A.seq = B.estimate_seq', 'left');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }    
}