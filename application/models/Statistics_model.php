<?php
class Statistics_model extends CI_Model {
 
	public function __construct()
	{        
		parent::__construct();
	}
    
    
    /****************************************
     * 로그 관련
     ****************************************/
	function getLogCheck($option)
	{
        $this->db->where("device", $option['device']);
        $this->db->where("ip", $option['ip']);
        $this->db->like("regist_date", $option['date'], "after");
        $this->db->from("tb_statistics_log");
		$result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
	}
    
    
    public function insertLog($option)
    {
        $this->db->set('page', $option['page']);        
        $this->db->set('device', $option['device']);        
        $this->db->set('ip', $option['ip']);        
        $this->db->set('agent', $option['agent']);        
        $this->db->set('referer', $option['referer']);        
        $this->db->set('regist_date', 'now()', false);
		$this->db->insert('tb_statistics_log');
		$result = $this->db->insert_id();
		return $result;
    }

    

    /****************************************
     * 통계 관련
     ****************************************/
	function getStatisticsCheck($option)
	{
        $this->db->where("cdate", $option['date']);
        $this->db->from("tb_statistics");
		$result = $this->db->count_all_results();
		//var_dump($this->db->last_query());
		return $result;
	}
    

    public function insertStatistics($option)
    {
		$this->db->set("cdate", $option['date']);
        if ($option['device'] == "pc") {
            $this->db->set("pv_pc", 1);
            $this->db->set("uv_pc", 1);
            $this->db->set("pv_mobile", 0);
            $this->db->set("uv_mobile", 0);
        } else {
            $this->db->set("pv_pc", 0);
            $this->db->set("uv_pc", 0);
            $this->db->set("pv_mobile", 1);
            $this->db->set("uv_mobile", 1);
        }
		$this->db->insert("tb_statistics");
    }
    

    public function updateStatistics($option)
    {
        if ($option['device'] == "pc") {
            $this->db->set("pv_pc", "pv_pc + 1", false);
            if ($option['logCheck'] < 1) $this->db->set("uv_pc", "uv_pc + 1", false);
        } else {
            $this->db->set("pv_mobile", "pv_mobile + 1", false);
            if ($option['logCheck'] < 1) $this->db->set("uv_mobile", "uv_mobile + 1", false);
        }
		$this->db->where("cdate", $option['date']);
		$this->db->update("tb_statistics");
    }

    
    
    

    public function getStatisticsListPC($option)
    {
        $this->db->select("D.date, IFNULL(S.pv_pc, 0) AS pv, IFNULL(S.uv_pc, 0) AS uv", FALSE);
        $this->db->from("VW_DATE D");
        $this->db->join("tb_statistics S", "D.date = S.cdate", "left");
        $this->db->like("D.date", $option['target_month'], "after");
        $this->db->order_by("D.date", "ASC");
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());exit;
        return $result;
    }


    public function getStatisticsListMobile($option)
    {
        $this->db->select("D.date, IFNULL(S.pv_mobile, 0) AS pv, IFNULL(S.uv_mobile, 0) AS uv", FALSE);
        $this->db->from("VW_DATE D");
        $this->db->join("tb_statistics S", "D.date = S.cdate", "left");
        $this->db->like("D.date", $option['target_month'], "after");
        $this->db->order_by("D.date", "ASC");
        $result = $this->db->get()->result();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    
    public function getStatisticsPC($option)
    {
        $this->db->select("SUM(pv_pc) AS pv, SUM(uv_pc) AS uv", FALSE);
        $this->db->from("tb_statistics");
        $this->db->like("cdate", $option['target'], "after");
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    
    public function getStatisticsMobile($option)
    {
        $this->db->select("SUM(pv_mobile) AS pv, SUM(uv_mobile) AS uv", FALSE);
        $this->db->from("tb_statistics");
        $this->db->like("cdate", $option['target'], "after");
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    
}