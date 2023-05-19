<?php

class Boardconfig_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // 게시판설정 정보 가져오기
    public function getBoardconfig($option) {
        $result = $this->db->get_where('tb_board_config', array('board_code' => $option['board_code']))->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 게시판설정 목록 전체 수
    function getBoardconfigListCount($option) {

        $this->db->from('tb_board_config');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 게시판설정 목록 가져오기
    public function getBoardconfigList($option) {
        $this->db->from('tb_board_config');
        $this->db->order_by("board_code", "DESC");
        $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get()->result();
        //$result = $this->db->get('tb_board_config')->result();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 게시판설정 추가
    public function insertBoardconfig($option) {
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('update_date', 'now()', false);
        $this->db->insert('tb_board_config', $option);
        $result = $this->db->insert_id();
        return $result;
    }

    // Board Code 중복 체크
    public function getBoardconfigCheck($option) {
        $this->db->where('board_code', $option['board_code']);
        $this->db->from('tb_board_config');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 게시판설정 수정
    public function updateBoardconfig($option) {
        $this->db->set('update_date', 'now()', false);
        $this->db->where('board_code', $option['board_code']);
        $this->db->update('tb_board_config', $option);
    }

    // 게시판설정 삭제
    public function deleteBoardconfig($option) {
        $this->db->where('board_code', $option['board_code']);
        $this->db->delete('tb_board_config');
    }

}
