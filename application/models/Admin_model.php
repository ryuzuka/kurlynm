<?php
class Admin_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	// 관리자 정보 가져오기
	public function getAdmin($option)
	{
        $this->db->select('A.*', FALSE);
		$this->db->where('A.admin_id', $option['admin_id']);
		$this->db->from('tb_admin A');
        $result = $this->db->get()->row();

		return $result;
	}

	// 관리자 목록 전체 수
	function getAdminListCount($option)
	{

    	$this->db->from('tb_admin');
		if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
			$this->db->like($option['s_field'], $option['s_string']);
		}
        $result = $this->db->count_all_results();

		return $result;
	}

    // 관리자 목록 가져오기
	public function getAdminList($option)
	{
        $this->db->select('A.*, L.code_name AS admin_level_name', FALSE);
        if ($option['s_field'] != "" && $option['s_string'] != "") $this->db->like($option['s_field'], $option['s_string'], 'both');
		$this->db->order_by("A.regist_date", "DESC");
		$this->db->from('tb_admin A');
		$this->db->join('tb_code L', 'A.admin_level = L.code AND L.scheme_code = \'AL1\'');
		$this->db->limit($option['limit_size'], $option['limit_start']);

		$result = $this->db->get()->result();
		//var_dump($this->db->last_query());
		return $result;
	}


	// 관리자 추가
	public function insertAdmin($option)
	{
		$this->db->set('admin_id', $option['admin_id']);
		$this->db->set('admin_passwd', $option['admin_passwd']);
		$this->db->set('admin_name', $option['admin_name']);
		$this->db->set('admin_level', $option['admin_level']);
		$this->db->set('email', $option['email']);
		$this->db->set('phone', $option['phone']);
		$this->db->set('status', $option['status']);
		$this->db->set('regist_date', 'now()', false);
		$this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
		$this->db->set('update_date', 'now()', false);
		$this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
		$this->db->insert('tb_admin');
		$result = $this->db->insert_id();
		return $result;
	}


	// 관리자 수정
	public function updateAdmin($option)
    {
		if ($option['admin_passwd']) $this->db->set('admin_passwd', $option['admin_passwd']);
		$this->db->set('admin_name', $option['admin_name']);
		$this->db->set('admin_level', $option['admin_level']);
		$this->db->set('email', $option['email']);
		$this->db->set('phone', $option['phone']);
		$this->db->set('status', $option['status']);
		$this->db->set('update_date', 'now()', false);
		$this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
		$this->db->where('admin_id', $option['admin_id']);
		$this->db->update('tb_admin');
	}


	// 관리자 삭제
	public function deleteAdmin($option)
    {
		$this->db->where('admin_id', $option['admin_id']);
		$this->db->delete('tb_admin');
	}


    // 로그인 Update
    public function updateAdminLogin($option)
    {
		$this->db->set('last_login_date', 'now()', false);
		$this->db->set('login_count', 'login_count + 1', false);
		$this->db->where('admin_id', $option['admin_id']);
		$this->db->update('tb_admin');
    }
}