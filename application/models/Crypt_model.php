<?php
class Crypt_model extends CI_Model {
 
	public function __construct()
	{        
		parent::__construct();
	}
    
    
    // 목록 가져오기
	public function getList($option)
	{
		$query = "
            SELECT @rownum:=@rownum+1 as no, M.*
            FROM tb_member M
                , (SELECT @rownum:=0) TMP
            ORDER BY M.member_id ASC
            LIMIT ".$option['start'].", ".$option['end']."
        ";
        $result = $this->db->query($query)->result();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
    // 비번 수정
    public function updatePassword($option)
    {
        $this->db->set("member_passwd", $option['member_passwd']);
        $this->db->set("update_date", "NOW()", false);
		$this->db->where("member_id", $option['member_id']);
		$this->db->update("tb_member");
    }
    
    
}
    