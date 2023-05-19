<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('boardconfig_model');
        $this->load->model('board_model');
		$this->load->helper('arraytostring');
		$this->load->helper('paging');
		$this->load->helper('alert');
        
        $this->current_menu_code = "0";
	}

    
	public function index() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다..');
        }
        $board_code = $this->input->get('board_code');
        $s_category = $this->input->get('s_category');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');

        // boardconfig 정보 가져오기
        $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code'=>$board_code));
        $boardconfig->board_category = stringtoarray($boardconfig->board_category);

		if ($this->input->get('page')) 
			$page = $this->input->get('page');
		else
			$page = 1;

		$block_size = 10;
		$limit_size = 10;
		$limit_start = ($page - 1) * $limit_size;
        
		$option = array(
			'board_code'	=> $board_code,
			's_category'	=> $s_category,
			's_field'	=> $s_field,
			's_string'	=> $s_string,
			'limit_start'	=> $limit_start,
			'limit_size'	=> $limit_size
		);
		$params = "board_code=".$board_code."&s_category=".$s_category."&s_field=".$s_field."&s_string=".$s_string;

        // 전체 데이터 수
		$total_count = $this->board_model->getBoardListCount($option);
		$total_page = ceil($total_count / $limit_size);
        
        // 데이터 목록
        $boardList = $this->board_model->getBoardList($option);
        
        // 공지 목록
        $noticeList = $this->board_model->getBoardNoticeList($option);
        
        // Pagination
        $url = base_url('notice') . "?" . $params . "&page=";
		$pagination = getPagingBasic($block_size, $page, $total_page, $url);
        
        $data['s_category'] = $s_category;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['boardconfig'] = $boardconfig;
        $data['noticeList'] = $noticeList;
        $data['boardList'] = $boardList;
		$data['total_count'] = $total_count;
		$data['total_page'] = $total_page;
		$data['page'] = $page;
		$data['page_rows'] = $limit_size;
		$data['pagination'] = $pagination;
		$data['params'] = $params;
        
        $data['pageTitle'] = "Notice";
        $data['pageName'] = $this->global_device_view.'/notice/list';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }

    
	public function view() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        if (!$this->input->get('board_code') || !$this->input->get('seq')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $board_code = $this->input->get('board_code');
        $s_category = $this->input->get('s_category');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $seq = $this->input->get('seq');
        $page = $this->input->get('page');
        $params = "board_code=".$board_code."&s_category=".$s_category."&s_field=".$s_field."&s_string=".$s_string;
        
        // boardconfig 정보 가져오기
        $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code'=>$board_code));
        $boardconfig->board_category = stringtoarray($boardconfig->board_category);
        
        // 글정보 가져오기
        $board = $this->board_model->getBoard(array('seq'=>$seq));
        if (!$board) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        
        // Upload 정보 가져오기
        $imageList = $this->board_model->getUploadList(array('seq'=>$seq, 'upload_type'=>'image'));
        $fileList = $this->board_model->getUploadList(array('seq'=>$seq, 'upload_type'=>'file'));
        
        $data['s_category'] = $s_category;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['page'] = $page;
        $data['boardconfig'] = $boardconfig;
        $data['board'] = $board;
        $data['imageList'] = $imageList;
        $data['fileList'] = $fileList;
		$data['params'] = $params;
        
        $data['pageTitle'] = "Notice";
        $data['pageName'] = $this->global_device_view.'/notice/view';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }
    
}