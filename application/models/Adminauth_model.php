<?php
class Adminauth_model extends CI_Model {
 
	public function __construct()
	{        
		parent::__construct();
	}
    
    
    // 사용중인 관리자 메뉴 전체 권한 목록
	public function getAdminAuthList()
	{
        $query = "
            SELECT M.menu_code AS main_code, M.menu_icon AS main_icon, M.menu_name AS main_name, M.url AS main_url, M.auth AS main_auth
                , S.menu_code AS sub_code, S.menu_name AS sub_name, S.url AS sub_url, S.auth AS sub_auth
                , (
                    SELECT GROUP_CONCAT(CONCAT(AA.admin_id, '|', A.admin_name) SEPARATOR ',')
                    FROM tb_admin_auth AA
                        INNER JOIN tb_admin A
                            ON AA.admin_id = A.admin_id
                    WHERE AA.menu_code = S.menu_code
                ) AS admin_id_list
            FROM (
                SELECT menu_code, menu_icon, menu_name, url, auth, sequence, is_use
                FROM tb_admin_menu
                WHERE LENGTH(menu_code) = 2
                    AND is_use = 'Y'
            ) M LEFT OUTER JOIN (
                SELECT menu_code, menu_icon, menu_name, url, auth, sequence, is_use, substring(menu_code, 1, 2) AS parent
                FROM tb_admin_menu
                WHERE LENGTH(menu_code) = 4
                    AND is_use = 'Y'
            ) S ON M.menu_code = S.parent
            ORDER BY M.sequence ASC, S.sequence ASC
        ";
        $result = $this->db->query($query)->result();
		return $result;
	}
    
    
	// 권한 추가
	public function insertAdminAuth($option)
	{
		$this->db->set('admin_id', $option['admin_id']);
		$this->db->set('menu_code', $option['menu_code']);
		$this->db->set('regist_date', 'now()', false);
		$this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
		$this->db->insert('tb_admin_auth');
		$result = $this->db->insert_id();
		return $result;
	}
    
    
    // 권한 삭제
    public function deleteAdminAuth($option)
    {
		$this->db->where('admin_id', $option['admin_id']);
		$this->db->where('menu_code', $option['menu_code']);
		$this->db->delete('tb_admin_auth');
    }
    
    
    // 해당 부모메뉴에 해당하는 서브메뉴 갯수
	public function getAdminAuthSubCount($option)
	{
		$this->db->where('admin_id', $option['admin_id']);
        $this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
		$this->db->like('menu_code', $option['menu_code'], 'after');
		$this->db->from('tb_admin_auth');
		$result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
    // 해당 메뉴코드에 관리자의 권한이 있는지 체크
	public function getAdminMenuAuthCount($option)
	{
		$this->db->where('admin_id', $option['admin_id']);
		$this->db->where('menu_code', $option['menu_code']);
		$this->db->from('tb_admin_auth');
		$result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
	}


    // 팝업 메뉴에 해당하는 관리자 목록 가져오기
	public function getAdminList($option)
	{
        $this->db->select('A.*, L.code_name AS admin_level_name, (SELECT COUNT(*) FROM tb_admin_auth WHERE admin_id = A.admin_id AND menu_code = \''.$option['menu_code'].'\') AS check_auth', FALSE);
        $this->db->where('A.status', 'Y');
		$this->db->order_by("A.regist_date", "DESC");
		$this->db->from('tb_admin A');
		$this->db->join('tb_code L', 'A.admin_level = L.code AND L.scheme_code = \'AL1\'');
		$result = $this->db->get()->result();
		//var_dump($this->db->last_query());
		return $result;
	}
}