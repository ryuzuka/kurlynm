<?php
class Code_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
    
    // Code Scheme - 중복 Check
    public function getCodeSchemeCheck($option)
    {
		$this->db->where('scheme_code', $option['scheme_code']);
        $this->db->from('tb_code_scheme');
        $result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
    }
    
    
    // Code Scheme - Insert
    public function insertCodeScheme($option)
    {
		$this->db->set('scheme_code', $option['scheme_code']);
		$this->db->set('scheme_name', $option['scheme_name']);
		$this->db->set('desc', $option['desc']);
		$this->db->set('regist_date', 'NOW()', false);
		$this->db->set('regist_ip', $option['regist_ip']);
		$this->db->set('update_date', 'NOW()', false);
		$this->db->set('update_ip', $option['update_ip']);
		$this->db->insert('tb_code_scheme');
		//$result = $this->db->insert_id();
		//return $result;
    }
    
    
    // Code Scheme - List
	public function getCodeSchemeList()
	{
		$this->db->order_by('scheme_code', 'ASC');
		$result = $this->db->get('tb_code_scheme')->result();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
	// Code Scheme - 정보
	public function getCodeScheme($option)
	{
		$this->db->where('scheme_code', $option['scheme_code']);
		$this->db->from('tb_code_scheme');
		$result = $this->db->get()->row();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
    // Code Scheme - Update
    public function updateCodeScheme($option)
    {
		$this->db->set('scheme_name', $option['scheme_name']);
		$this->db->set('desc', $option['desc']);
		$this->db->set('update_date', 'NOW()', false);
		$this->db->set('update_ip', $option['update_ip']);
		$this->db->where('scheme_code', $option['scheme_code']);
		$this->db->update('tb_code_scheme');
    }
    
    
    // Code Scheme - Delete
    public function deleteCodeScheme($option)
    {
		$this->db->where('scheme_code', $option['scheme_code']);
		$this->db->delete('tb_code_scheme');
    }
    
    
    
    
    
    // Code
	public function getCode($option)
	{
		$this->db->where('scheme_code', $option['scheme_code']);
		$this->db->where('code', $option['code']);
		$result = $this->db->get('tb_code')->row();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
    // Code Scheme 안에 code 갯수 체크
    public function getCodeCount($option)
    {
		$this->db->where('scheme_code', $option['scheme_code']);
        $this->db->from('tb_code');
        $result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
    }
    
    
    // Code - List
	public function getCodeList($option)
	{
		$this->db->where('scheme_code', $option['scheme_code']);
		$this->db->order_by('sequence', 'ASC');
		$result = $this->db->get('tb_code')->result();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
    // Code - Use List
	public function getUseCodeList($option)
	{
		$this->db->where('scheme_code', $option['scheme_code']);
		$this->db->where('is_use', "Y");
		$this->db->order_by('sequence', 'ASC');
		$result = $this->db->get('tb_code')->result();
		//var_dump($this->db->last_query());
		return $result;
	}

    
    // Code - 중복 Check
    public function getCodeCheck($option)
    {
		$this->db->where('code', $option['code']);
		$this->db->where('scheme_code', $option['scheme_code']);
        $this->db->from('tb_code');
        $result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
    }
    
    
    // Code - Insert
    public function insertCode($option)
    {
		$this->db->set('scheme_code', $option['scheme_code']);
		$this->db->set('code', $option['code']);
		$this->db->set('code_name', $option['code_name']);
		$this->db->set('sequence', $option['sequence']);
		$this->db->set('value1', $option['value1']);
		$this->db->set('value2', $option['value2']);
		$this->db->set('value3', $option['value3']);
		$this->db->set('value4', $option['value4']);
		$this->db->set('is_use', $option['is_use']);
		$this->db->set('regist_date', 'NOW()', false);
		$this->db->set('regist_ip', $option['regist_ip']);
		$this->db->set('update_date', 'NOW()', false);
		$this->db->set('update_ip', $option['update_ip']);
		$this->db->insert('tb_code');
		$result = $this->db->insert_id();
		return $result;
    }
    
    
    // Code - Update
    public function updateCode($option)
    {
		$this->db->set('code_name', $option['code_name']);
		$this->db->set('sequence', $option['sequence']);
		$this->db->set('value1', $option['value1']);
		$this->db->set('value2', $option['value2']);
		$this->db->set('value3', $option['value3']);
		$this->db->set('value4', $option['value4']);
		$this->db->set('is_use', $option['is_use']);
		$this->db->set('update_date', 'NOW()', false);
		$this->db->set('update_ip', $option['update_ip']);
		$this->db->where('seq', $option['seq']);
		$this->db->update('tb_code');
    }
    
    
    // Code - Delete
    public function deleteCode($option)
    {
		$this->db->where('seq', $option['seq']);
		$this->db->delete('tb_code');
    }
}