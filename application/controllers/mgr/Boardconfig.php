<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Boardconfig extends KURLY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('code_model');
        $this->load->model('boardconfig_model');
        $this->load->helper('arraytostring');
        $this->load->helper('paging');

        $this->current_menu_code = "0301";
    }

    public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 15;
        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            'limit_start' => $limit_start,
            'limit_size' => $limit_size
        );
        $params = "";

        // 전체 데이터 수
        $total_count = $this->boardconfig_model->getBoardconfigListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $boardconfigList = $this->boardconfig_model->getBoardconfigList($option);

        // Pagination
        $url = '/mgr/boardconfig' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['boardconfigList'] = $boardconfigList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/boardconfig/list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    public function insert() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $this->load->library('form_validation');   //form_validation 로드
        $this->form_validation->set_rules('board_code', '게시판 코드', 'trim|required|min_length[2]|max_length[20]|is_unique[tb_board_config.board_code]'); // is_unique[TB_BOARD_CONFIG.board_code] - 내부적으로 DB 연동하여 unique 체크
        $this->form_validation->set_rules('board_name', '게시판 이름', 'trim|required|min_length[2]|max_length[20]|xss_clean');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
        
            // Code - 게시판종류 List
            $data['boardCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'B01'));
            
            $data['pageName'] = 'mgr/boardconfig/write';
            $this->load->view($this->global_layout_manager, $data);
        } else {
            //print_r($this->input->post());exit;

            $option = array(
                'board_code' => $this->input->post('board_code'),
                'board_name' => $this->input->post('board_name'),
                'board_skin' => $this->input->post('board_skin'),
                'board_speech' => $this->input->post('board_speech'),
                'is_use' => $this->input->post('is_use'),
                'is_comment' => $this->input->post('is_comment'),
                'is_secret' => $this->input->post('is_secret'),
                'is_image' => $this->input->post('is_image'),
                'is_file' => $this->input->post('is_file'),
                'auth_read' => arraytostring($this->input->post('auth_read')),
                'auth_write' => arraytostring($this->input->post('auth_write')),
                'auth_reply' => arraytostring($this->input->post('auth_reply')),
                'auth_comment' => arraytostring($this->input->post('auth_comment')),
                'auth_download' => arraytostring($this->input->post('auth_download'))
            );
            
            $this->boardconfig_model->insertBoardconfig($option);
            redirect('mgr/boardconfig');
        }
        $this->_admin_footer();
    }
    
    // 기수 SelectBox (insert View) - 현재 미사용
    public function getPartSelect() {
        $this->output->enable_profiler(false);
        $group_cd = $this->input->get('group_cd');
        
        echo '<div class="form-group">';
        echo '<label class="col-sm-2 control-label"><span style="color:#FF0000;">*</span> 기수</label>';
        echo '<div class="col-sm-2">';
        echo '<select id="group_cd" name="group_cd" class="form-control input-sm group_part">';
        echo '<option value="">== 기수선택 ==</option>';
        // Code - 기수 List
        $groupCodeList = $this->code_model->getUseCodeList(array('scheme_code' => 'G01'));
            foreach($groupCodeList as $i => $list){
                echo '<option value="'.$list->code.'"'. (($list->code == $group_cd) ? " selected" : "") .'>'. $list->code_name.'('.$list->value1.'년)</option>';
            }
        echo '</select>';
        echo '</div>';
        echo '</div>';
        
    }
    
    // Board_Code 중복체크
    public function checkBoardCode() {
        $this->output->enable_profiler(false);
        $board_code = $this->input->get('board_code');
        
        $cnt = $this->boardconfig_model->getBoardconfigCheck(array('board_code' => $board_code));

        echo $cnt;
    }
    
    public function update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $this->load->library('form_validation');   //form_validation 로드
        $this->form_validation->set_rules('board_code', '게시판 코드', 'trim|required|min_length[2]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('board_name', '게시판 이름', 'trim|required|min_length[2]|max_length[20]|xss_clean');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            if (!$this->input->get('board_code')) {
                alert('페이지를 찾을 수 없습니다.');
            }

            if ($this->input->get('page'))
                $page = $this->input->get('page');
            else
                $page = 1;
            
            // Code - 게시판종류 List
            $data['boardCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'B01'));
            
            // boardconfig 정보 가져오기
            $data['boardconfig'] = $this->boardconfig_model->getBoardconfig(array('board_code' => $this->input->get('board_code')));

            $data['page'] = $page;
            $data['pageName'] = 'mgr/boardconfig/info';
            $this->load->view($this->global_layout_manager, $data);
        } else {
            //var_dump($this->input->post()); exit;

            $option = array(
                'board_code' => $this->input->post('board_code'),
                'board_name' => $this->input->post('board_name'),
                'board_skin' => $this->input->post('board_skin'),
                'board_speech' => $this->input->post('board_speech'),
                'is_use' => $this->input->post('is_use'),
                'is_comment' => $this->input->post('is_comment'),
                'is_secret' => $this->input->post('is_secret'),
                'is_image' => $this->input->post('is_image'),
                'is_file' => $this->input->post('is_file'),
                'auth_read' => arraytostring($this->input->post('auth_read')),
                'auth_write' => arraytostring($this->input->post('auth_write')),
                'auth_reply' => arraytostring($this->input->post('auth_reply')),
                'auth_comment' => arraytostring($this->input->post('auth_comment')),
                'auth_download' => arraytostring($this->input->post('auth_download'))
            );

            $this->boardconfig_model->updateBoardconfig($option);

            $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
            redirect('mgr/boardconfig/update?board_code=' . $this->input->post('board_code') . "&page=" . $page);
        }

        $this->_admin_footer();
    }

    public function delete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('페이지를 찾을 수 없습니다.');
        }
        
        $this->boardconfig_model->deleteBoardconfig(array('board_code' => $this->input->get('board_code')));

        redirect('mgr/boardconfig');
        
        $this->_admin_footer();
    }

}
