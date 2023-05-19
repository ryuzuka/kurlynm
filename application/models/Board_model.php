<?php

class Board_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // 글 정보 가져오기
    public function getBoard($option) {
        $array = array(
            'seq' => $option['seq'],
            'is_use' => 'Y'
        );
        $result = $this->db->get_where('tb_board', $array)->row();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 다음 글번호 (Orientation)
    public function getBoardNext($option) {
        $this->db->select('seq');
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('seq >', $option['seq']);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("regist_date", "ASC");
        $this->db->limit(1);
        $result = $this->db->get('tb_board')->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 이전 글번호 (Orientation)
    public function getBoardPrev($option) {
        $this->db->select('seq');
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('seq <', $option['seq']);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("regist_date", "DESC");
        $this->db->limit(1);
        $result = $this->db->get('tb_board')->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }
    
    // 다음 글번호 (Frontier)
    public function getFrontierBoardNext($option) {
        $this->db->select('seq');
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('regist_date <', $option['regist_date']);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("regist_date", "DESC");
        $this->db->limit(1);
        $result = $this->db->get('tb_board')->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 이전 글번호 (Frontier)
    public function getFrontierBoardPrev($option) {
        $this->db->select('seq');
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('regist_date >', $option['regist_date']);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("regist_date", "ASC");
        $this->db->limit(1);
        $result = $this->db->get('tb_board')->row();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 글 목록 전체 수
    function getBoardListCount($option) {
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('is_use', 'Y');
        $this->db->where('is_notice', 'N');
        $this->db->from('tb_board');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 글 목록 가져오기 (Mgr)
    public function getBoardList($option) {
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('is_use', 'Y');
        $this->db->where('is_notice', 'N');
        $this->db->order_by("regist_date", "DESC");
        if (isset($option['limit_size']) && isset($option['limit_start'])) $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get('tb_board')->result();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 공지 글 목록 가져오기 (Mgr)
    public function getBoardNoticeList($option) {
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $array_where = array(
            'board_code' => $option['board_code'],
            'is_notice' => 'Y'
        );
        $this->db->where($array_where);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("regist_date", "DESC");
        $result = $this->db->get('tb_board')->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 공지 글 목록 가져오기(Front Notice)
    public function getFrontBoardNoticeList($option) {
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $array_where = array(
            'board_code' => $option['board_code'],
            'is_notice' => 'Y'
        );
        $this->db->where($array_where);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("regist_date", "DESC");
        $result = $this->db->get('tb_board')->result();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 글 목록 가져오기(Front)
    public function getFrontBoardList($option) {
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        if (isset($option['s_road_group']) && $option['s_road_group']) $this->db->where("group_cd", $option['s_road_group']);
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('is_use', 'Y');
        $this->db->where('is_notice', 'N');
        $this->db->order_by("regist_date", "DESC");
        if (isset($option['limit_size']) && isset($option['limit_start'])) $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get('tb_board')->result();
        //var_dump($this->db->last_query());exit;
        return $result;
    }
    
    
    // 글 목록 가져오기(Front)
    public function getFrontStoryList($option) {
        if (isset($option['s_field']) && isset($option['s_string']) && $option['s_field'] && $option['s_string']) {
            $this->db->like($option['s_field'], $option['s_string']);
        }
        $this->db->where('board_code', $option['board_code']);
        $this->db->where('is_use', 'Y');
        $this->db->where('is_notice', 'N');
        $this->db->order_by("regist_date", "DESC");
        if (isset($option['limit_size']) && isset($option['limit_start'])) $this->db->limit($option['limit_size'], $option['limit_start']);
        $result = $this->db->get('tb_board')->result();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 메인 글 목록 5개 가져오기
    public function getBoardMainList($option) {
        $array_where = array(
            'board_code' => $option['board_code']
        );
        $this->db->where($array_where);
        $this->db->where('is_use', 'Y');
        $this->db->order_by("is_notice", "DESC");
        $this->db->order_by("regist_date", "DESC");
        $this->db->limit(5, 0);
        $result = $this->db->get('tb_board')->result();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 게시판 추가
    public function insertBoard($option) {
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('update_date', 'now()', false);
        $this->db->insert('tb_board', $option);
        $result = $this->db->insert_id();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 답변글 re_step 값 UPDATE
    public function updateReplyStep($option) {
        $this->db->set('re_step', 're_step + 1', false);
        $this->db->where(array('re_group' => $option['re_group'], 're_step >' => $option['re_step']));
        $this->db->update('tb_board');
    }

    // re_group 값 UPDATE
    public function updateReplyGroup($option) {
        $this->db->set('re_group', $option['seq']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_board');
    }

    // 게시판 글 수정
    function updateBoard($option) {
        $array = array(
            'group_cd' => $option['group_cd'],
            'road_part' => $option['road_part'],
            'name' => $option['name'],
            'title' => $option['title'],
            'content' => $option['content'],
            'is_secret' => $option['is_secret'],
            'update_ip' => $option['update_ip']
        );
        $this->db->set('update_date', 'now()', false);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_board', $array);
        //var_dump($this->db->last_query());exit;
    }

    // 게시판 글 삭제
    public function deleteBoard($option) {
        $this->db->set('is_use', 'N');
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_board');
        /*
          $this->db->where('seq', $option['seq']);
          $this->db->delete('tb_board');
         */
    }

    // 공지 업데이트
    public function updateNotice($option) {
        $this->db->set('is_notice', $option['is_notice']);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_board');
    }

    // 조회수 업데이트
    public function updateHit($option) {
        $this->db->set('view_count', "view_count+1", false);
        $this->db->where('seq', $option['seq']);
        $this->db->update('tb_board');
        //var_dump($this->db->last_query());
    }

    // 업로드 정보 가져오기
    public function getUpload($option) {
        $result = $this->db->get_where('tb_board_upload', array('file_no' => $option['file_no']))->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 업로드 목록 가져오기
    public function getUploadList($option) {
        $this->db->where('seq', $option['seq']);
        $this->db->where('upload_type', $option['upload_type']);
        $this->db->order_by("file_no", "ASC");
        $result = $this->db->get('tb_board_upload')->result();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 업로드 추가
    public function insertUpload($option) {
        $this->db->set('regist_date', 'now()', false);
        $this->db->insert('tb_board_upload', $option);
        $result = $this->db->insert_id();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 업로드 수정
    public function updateUpload($option) {
        $array = array(
            'file_name' => $option['file_name'],
            'file_type' => $option['file_type'],
            'file_path' => $option['file_path'],
            'full_path' => $option['full_path'],
            'raw_name' => $option['raw_name'],
            'orig_name' => $option['orig_name'],
            'client_name' => $option['client_name'],
            'file_ext' => $option['file_ext'],
            'file_size' => $option['file_size'],
            'is_image' => $option['is_image'],
            'image_width' => $option['image_width'],
            'image_height' => $option['image_height'],
            'image_type' => $option['image_type'],
            'image_size_str' => $option['image_size_str']
        );
        $this->db->set('regist_date', 'now()', false);
        $this->db->where('file_no', $option['file_no']);
        $this->db->update('tb_board_upload', $array);
    }

    // 업로드 삭제
    public function deleteUpload($option) {
        $this->db->where('file_no', $option['file_no']);
        $this->db->delete('tb_board_upload');
    }

    // 업로드 삭제
    public function deleteBoardUpload($option) {
        $this->db->where('seq', $option['seq']);
        $this->db->delete('tb_board_upload');
    }

    // 댓글 갯수
    function getCommentListCount($option) {
        $array_where = array(
            'seq' => $option['seq'],
            'is_use' => "Y"
        );
        $this->db->where($array_where);
        $this->db->from('tb_board_comment');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 댓글 목록
    public function getCommentList($option) {
        $array_where = array(
            'seq' => $option['seq'],
            'is_use' => "Y"
        );
        $this->db->where($array_where);
        $this->db->order_by("c_group", "DESC");
        $this->db->order_by("c_step", "ASC");
        $result = $this->db->get('tb_board_comment')->result();
        //var_dump($this->db->last_query());
        return $result;
    }

    public function getComment($option) {
        $array = array(
            'c_no' => $option['c_no'],
            'is_use' => 'Y'
        );
        $result = $this->db->get_where('tb_board_comment', $array)->row();
        //var_dump($this->db->last_query());
        return $result;
    }

    // 댓글 추가
    public function insertComment($option) {
        $this->db->set('regist_date', 'now()', false);
        $this->db->set('update_date', 'now()', false);
        $this->db->insert('tb_board_comment', $option);
        $result = $this->db->insert_id();
        //var_dump($this->db->last_query());exit;
        return $result;
    }

    // 답변글 c_step 값 UPDATE
    public function updateCommentReplyStep($option) {
        $this->db->set('c_step', 'c_step + 1', false);
        $this->db->where(array('c_group' => $option['c_group'], 'c_step >' => $option['c_step']));
        $this->db->update('tb_board_comment');
        //var_dump($this->db->last_query());exit;
    }

    // c_group 값 UPDATE
    public function updateCommentReplyGroup($option) {
        $this->db->set('c_group', $option['c_no']);
        $this->db->where('c_no', $option['c_no']);
        $this->db->update('tb_board_comment');
    }

    function updateComment($option) {
        $array = array(
            //'name'   => $option['name'],
            'comment' => $option['comment'],
            'update_ip' => $option['update_ip']
        );
        $this->db->set('update_date', 'now()', false);
        $this->db->where('c_no', $option['c_no']);
        $this->db->update('tb_board_comment', $array);
    }

    public function deleteComment($option) {
        $this->db->set('is_use', 'N');
        $this->db->where('c_no', $option['c_no']);
        $this->db->update('tb_board_comment');
        /*
          $this->db->where('c_no', $option['c_no']);
          $this->db->delete('tb_board_comment');
         */
    }
    
    // 글 목록 댓글 수 (Front)
    public function getBoardCommentCount($option) {
        $this->db->where('seq', $option['seq']);
        $this->db->where('is_use', 'Y');
        $this->db->from('tb_board_comment');
        $result = $this->db->count_all_results();
        //var_dump($this->db->last_query());
        return $result;
    }
    
    // 업로드 목록 가져오기 (Front)
    public function getBoardUploadList($option) {
        $this->db->where('seq', $option['seq']);
        $this->db->from('tb_board_upload');
        $this->db->limit('1');
        $result = $this->db->get()->row();
        //var_dump($this->db->last_query());
        return $result;
    }
}