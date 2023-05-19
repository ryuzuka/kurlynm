<?php
class Adminmenu_model extends CI_Model {
 
	public function __construct()
	{        
		parent::__construct();
	}
    
    
	// 메뉴코드 정보 가져오기
	public function getAdminMenu($option)
	{
		$result = $this->db->get_where('tb_admin_menu', array('menu_code'=>$option['menu_code']))->row();
		//var_dump($this->db->last_query());
		return $result;
	}
    

    // 자식 메뉴코드 갯수 가져오기
	public function getAdminMenuListCount($option)
	{
		$this->db->where('menu_code <>', $option['menu_code']);
        $this->db->like('menu_code', $option['menu_code'], 'after');
		$this->db->from('tb_admin_menu');
		$result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
	// parent 와 매칭되는 sub 메뉴코드 목록
	public function getAdminMenuList($option)
	{
		$this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
        if ($option['parent']) $this->db->like('menu_code', $option['parent'], 'after');
		$this->db->order_by("sequence", "ASC");
		$result = $this->db->get('tb_admin_menu')->result();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
    // 부모 메뉴코드에 하위에 있는 자식 메뉴코드의 마지막 메뉴코드 값 가져오기
    public function getTopMenuCode($option) {
		$this->db->select_max('menu_code');
		$this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
        if ($option['parent']) $this->db->like('menu_code', $option['parent'], 'after');
		$result = $this->db->get('tb_admin_menu')->row();
		//var_dump($this->db->last_query());
		return $result;
    }
    
    
    // 부모 메뉴코드에 하위에 있는 sequence 의 Max 값 가져오기
    public function getMaxSequence($option) {
		$this->db->select_max('sequence');
		$this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
        if ($option['parent']) $this->db->like('menu_code', $option['parent'], 'after');
		$result = $this->db->get('tb_admin_menu')->row();
		//var_dump($this->db->last_query());
		return $result;
    }
    
    
	// 메뉴코드 추가
	public function insertAdminMenu($option)
	{
		$this->db->set('menu_code', $option['menu_code']);
		if ($option['menu_icon']) $this->db->set('menu_icon', $option['menu_icon']);
		$this->db->set('menu_name', $option['menu_name']);
		$this->db->set('url', $option['url']);
		if ($option['auth']) $this->db->set('auth', $option['auth']);
		$this->db->set('is_use', $option['is_use']);
		$this->db->set('sequence', $option['sequence']);
		$this->db->set('regist_date', 'now()', false);
		$this->db->set('regist_ip', $_SERVER['REMOTE_ADDR']);
		$this->db->set('update_date', 'now()', false);
		$this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
		$this->db->insert('tb_admin_menu');
		$result = $this->db->insert_id();
		return $result;
	}
    
    
	// 메뉴코드 수정
	public function updateAdminMenu($option) {
        if ($option['menu_icon']) $this->db->set('menu_icon', $option['menu_icon']);
		$this->db->set('menu_name', $option['menu_name']);
		$this->db->set('url', $option['url']);
		if ($option['auth']) $this->db->set('auth', $option['auth']);
		$this->db->set('is_use', $option['is_use']);
		$this->db->set('sequence', $option['sequence']);
		$this->db->set('update_date', 'now()', false);
		$this->db->set('update_ip', $_SERVER['REMOTE_ADDR']);
		$this->db->where('menu_code', $option['menu_code']);
		$this->db->update('tb_admin_menu', $array);
	}
    
    
	// 메뉴코드 삭제
	public function deleteAdminMenu($option) {
		$this->db->where('menu_code', $option['menu_code']);
		$this->db->delete('tb_admin_menu');
	}
    
    
	// sequence 재설정 (insert 시)
	public function updateSortInsert($option)
	{
		$this->db->set('sequence', 'sequence + 1', false);
        $this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
        if ($option['parent']) $this->db->where('SUBSTRING(menu_code, 1, '.strlen($option['parent']).') = \''.$option['parent'].'\'');
        $this->db->where('menu_code <>', $option['menu_code']);
        $this->db->where('sequence >=', $option['sequence']);
		$this->db->update('tb_admin_menu'); 
	}

	// sequence 재설정 (update 시)
	public function updateSortUpdate($option)
	{
		// 이동전 sequence 보다 현재 sequence 가 작은 경우
		if ($option['sequence'] < $option['prev_sequence']) {
			$this->db->set('sequence', 'sequence + 1', false);
            $this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
            if ($option['parent']) $this->db->where('SUBSTRING(menu_code, 1, '.strlen($option['parent']).') = \''.$option['parent'].'\'');
            $this->db->where('menu_code <>', $option['menu_code']);
            $this->db->where('sequence >=', $option['sequence']);
            $this->db->where('sequence <', $option['prev_sequence']);
			$this->db->update('tb_admin_menu');

		// 이동전 sequence 보다 현재 sequence 가 큰 경우
		} else if ($option['sequence'] > $option['prev_sequence']) {
			$this->db->set('sequence', 'sequence - 1', false);
            $this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
            if ($option['parent']) $this->db->where('SUBSTRING(menu_code, 1, '.strlen($option['parent']).') = \''.$option['parent'].'\'');
            $this->db->where('menu_code <>', $option['menu_code']);
            $this->db->where('sequence <=', $option['sequence']);
            $this->db->where('sequence >', $option['prev_sequence']);
			$this->db->update('tb_admin_menu'); 

		}
		var_dump($this->db->last_query());
	}
    
	// sequence 재설정 (delete 시)
	public function updateSortDelete($option)
	{
		$this->db->set('sequence', 'sequence - 1', false);
        $this->db->where('LENGTH(menu_code)', $option['menu_code_length'], FALSE);
        if ($option['parent']) $this->db->where('SUBSTRING(menu_code, 1, '.strlen($option['parent']).') = \''.$option['parent'].'\'');
        $this->db->where('sequence >', $option['sequence']);
		$this->db->update('tb_admin_menu'); 
		//var_dump($this->db->last_query());
	}
    
    
    
    // 관리자페이지에 admin_level 별 메뉴 노출 쿼리
	public function getAdminMenuDisplay($option)
	{
        $query = "
            SELECT M.menu_code AS main_code, M.menu_icon AS main_icon, M.menu_name AS main_name, M.url AS main_url
                , S.menu_code AS sub_code, S.menu_name AS sub_name, S.url AS sub_url
            FROM (
                SELECT menu_code, menu_icon, menu_name, url, auth, sequence
                FROM tb_admin_menu T
                WHERE LENGTH(menu_code) = 2
                    AND is_use = 'Y'
                    AND (
                        auth LIKE '%".$option['admin_level']."%'
                        OR
                        (SELECT COUNT(*) FROM tb_admin_auth WHERE admin_id = '".$option['admin_id']."' AND menu_code = T.menu_code) > 0
                    )
            ) M LEFT OUTER JOIN (
                SELECT menu_code, menu_icon, menu_name, url, auth, sequence, substring(menu_code, 1, 2) AS parent
                FROM tb_admin_menu T
                WHERE LENGTH(menu_code) = 4
                    AND is_use = 'Y'
                    AND (
                        auth LIKE '%".$option['admin_level']."%'
                        OR
                        (SELECT COUNT(*) FROM tb_admin_auth WHERE admin_id = '".$option['admin_id']."' AND menu_code = T.menu_code) > 0
                    )
            ) S ON M.menu_code = S.parent
            ORDER BY M.sequence ASC, S.sequence ASC
        ";
        $result = $this->db->query($query)->result();
		return $result;
	}
    
    
	// 메뉴코드 가져오기
	public function getAdminMenuCode($option)
	{
		$this->db->select('menu_code');
		$this->db->where('url', $option['url']);
        $this->db->where('LENGTH(menu_code)', 4, FALSE);
		$result = $this->db->get('tb_admin_menu')->row();
		//var_dump($this->db->last_query());
		return $result;
	}
    
}