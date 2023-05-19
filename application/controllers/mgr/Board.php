<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Board extends KURLY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('adminmenu_model');
        $this->load->model('boardconfig_model');
        $this->load->model('board_model');
        $this->load->model('code_model');
        $this->load->model('site_model');
        $this->load->helper('arraytostring');
        $this->load->helper('directory');
        $this->load->helper('paging');
        $this->load->helper('alert');

        $this->current_menu_code = $this->_getMenuCode($this->input->get('board_code'));

        $this->board_path = "/mgr/board/";
    }

    public function _getMenuCode($board_code) {
        $url = "/mgr/board?board_code=" . $board_code;
        $adminmenu = $this->adminmenu_model->getAdminMenuCode(array('url' => $url));
        return $adminmenu->menu_code;
    }

    public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다..');
        }
        
        $board_code = $this->input->get('board_code');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');

        // boardconfig 정보 가져오기
        $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code' => $board_code));
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 10;
        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            'board_code' => $board_code,
            's_field' => $s_field,
            's_string' => $s_string,
            'limit_start' => $limit_start,
            'limit_size' => $limit_size
        );
        $params = "board_code=" . $board_code . "&s_field=" . $s_field . "&s_string=" . $s_string;

        // 전체 데이터 수
        $total_count = $this->board_model->getBoardListCount($option);
        $total_page = ceil($total_count / $limit_size);
        
        // Pagination
        $url = base_url('mgr/board') . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);
        
        // 데이터 목록
        $boardList = $this->board_model->getBoardList($option);

        // 리스트 페이지 속도 때문에 배열로 뿌려주기
        $arrComment = array();
        $arrFile = array();
        $arrFileNo = array();
        
        foreach ($boardList as $i => $list) {
            // comment count
            $arrComment[$list->seq] = $this->board_model->getBoardCommentCount(array('seq' => $list->seq));
            
            // file list
            $fileList = $this->board_model->getBoardUploadList(array('seq' => $list->seq));
            if ($fileList) {
                $arrFile[$list->seq] = $fileList->full_path;
                $arrFileNo[$list->seq] = $fileList->file_no;
            } else {
                $arrFile[$list->seq] = null;
                $arrFileNo[$list->seq] = null;
            }
        }
        
        // 공지 목록
        $noticeList = $this->board_model->getBoardNoticeList($option);

        // 리스트 페이지 속도 때문에 배열로 뿌려주기
        $arrNoticeComment = array();
        $arrNoticeFile = array();
        $arrNoticeFileNo = array();
        
        foreach ($noticeList as $i => $list) {
            // comment count
            $arrNoticeComment[$list->seq] = $this->board_model->getBoardCommentCount(array('seq' => $list->seq));
            
            // file list
            $fileList = $this->board_model->getBoardUploadList(array('seq' => $list->seq));
            if ($fileList) {
                $arrNoticeFile[$list->seq] = $fileList->full_path;
                $arrNoticeFileNo[$list->seq] = $fileList->file_no;
            } else {
                $arrNoticeFile[$list->seq] = null;
                $arrNoticeFileNo[$list->seq] = null;
            }
        }
        
        $data['arrComment'] = $arrComment;
        $data['arrFile'] = $arrFile;
        $data['arrFileNo'] = $arrFileNo;
        $data['arrNoticeComment'] = $arrNoticeComment;
        $data['arrNoticeFile'] = $arrNoticeFile;        
        $data['arrNoticeFileNo'] = $arrNoticeFileNo;        
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

        $data['pageName'] = 'mgr/board/' . $boardconfig->board_skin . '/list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }
    
    public function excel() {
        $this->output->enable_profiler(false);		// 디버그용 결과

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다..');
        }
        $board_code = $this->input->get('board_code');
        $s_road_group = $this->input->get('s_road_group');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');

        $option = array(
            'board_code' => $board_code,
            's_road_group'	=> $s_road_group,
            's_field' => $s_field,
            's_string' => $s_string
        );
        // 데이터 목록
        $boardList = $this->board_model->getBoardList($option);

        // 파일명
        $filename = $board_code.date("Ymd");

        // Sheet명
        $sheet_name = "Sheet1";

        # 시트지정
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($sheet_name);

        // CELL 헤더 설정
        $this->excel->getActiveSheet()->setCellValue('A1', 'No');
        $this->excel->getActiveSheet()->setCellValue('B1', '기수');
        $this->excel->getActiveSheet()->setCellValue('C1', '조');
        $this->excel->getActiveSheet()->setCellValue('D1', '제목');
        $this->excel->getActiveSheet()->setCellValue('E1', '내용');
        $this->excel->getActiveSheet()->setCellValue('F1', '파일');
        $this->excel->getActiveSheet()->setCellValue('G1', '작성자');
        $this->excel->getActiveSheet()->setCellValue('H1', '작성일');
        $this->excel->getActiveSheet()->setCellValue('I1', '조회수');
        $this->excel->getActiveSheet()->setCellValue('J1', '공지사항');

        $this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setSize(11);
        $this->excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);

        # 헤더 컬럼 가운데 정렬
        $this->excel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1:J1')->applyFromArray(array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
        ));

        $cnt = 1;
        $file_url = "";
        foreach ($boardList as $i => $list) {
            $cnt++;
            //파일 없으면 빈값, 있으면 url 붙여주기
            if(!$list->full_path) {
                $file_on = "";
            } else {
                $arrFile = explode(",", $list->full_path);
                foreach($arrFile as $file) {
                    $file_on = "http://".config_item('global_domain').str_replace($this->global_root_path, "", $file);
                    $file_url .= $file_on."  ";
                }
            }
            
            $this->excel->getActiveSheet()->setCellValue('A'.$cnt, $i+1);
            $this->excel->getActiveSheet()->setCellValue('B'.$cnt, $list->group_cd);
            $this->excel->getActiveSheet()->setCellValue('C'.$cnt, ($list->road_part > 0) ? $list->road_part : '');
            $this->excel->getActiveSheet()->setCellValue('D'.$cnt, $list->title);
            $this->excel->getActiveSheet()->setCellValue('E'.$cnt, $list->content);
            $this->excel->getActiveSheet()->setCellValue('F'.$cnt, $file_url);
            $this->excel->getActiveSheet()->setCellValue('G'.$cnt, $list->name);
            $this->excel->getActiveSheet()->setCellValue('H'.$cnt, $list->regist_date);
            $this->excel->getActiveSheet()->setCellValue('I'.$cnt, number_format($list->view_count));
            $this->excel->getActiveSheet()->setCellValue('J'.$cnt, ($list->is_notice == 'Y') ? '공지': '');
        }

        $this->excel->getActiveSheet()->getStyle('A2:J'.$cnt)->getFont()->setSize(11);
        $this->excel->getActiveSheet()->getStyle('A2:J'.$cnt)->applyFromArray(array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
        ));

        set_time_limit(0);
        ini_set('memory_limit','512M');
        ini_set('max_execution_time',120);

        #파일로 내보낸다.
        if (!$filename) $filename = date('Ymd');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');

        # 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');

        # 이용자가 다운로드하여 컴퓨터 HDD에 저장하도록 강제한다.
        $objWriter->save('php://output');
        
//        $this->excel->getSecurity()->setLockWindows(true);
//        $this->excel->getSecurity()->setLockStructure(true);
//        $this->excel->getSecurity()->setWorkbookPassword('secret'); 
    }

    public function insert() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        
        $board_code = $this->input->get('board_code');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;
        
        $params = "board_code=" . $board_code . "&s_field=" . $s_field . "&s_string=" . $s_string;

        $this->load->library('form_validation');   //form_validation 로드
        $this->form_validation->set_rules('name', '이름', 'trim|required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('title', '제목', 'trim|required|min_length[2]|max_length[100]');
        //$this->form_validation->set_rules('content', '내용', 'required');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            // boardconfig 정보 가져오기
            $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code' => $board_code));
            
            // 답변할 글정보 가져오기
            $seq = $this->input->get('seq');
            
            if ($seq) {
                $board = $this->board_model->getBoard(array('seq' => $seq));
            } else {
                $board = null;
            }

            $data['boardconfig'] = $boardconfig;
            $data['board'] = $board;
            $data['s_field'] = $s_field;
            $data['s_string'] = $s_string;
            $data['page'] = $page;
            $data['params'] = $params;
            $data['pageName'] = 'mgr/board/' . $boardconfig->board_skin . '/write';
            $this->load->view($this->global_layout_manager, $data);
        } else {
            // Upload 디렉토리 설정
            $path = "/board/" . date('Y') . "/" . date('m');
            $upload_path = $this->global_upload_path . $path;
            $upload_uri = $this->global_upload_uri . $path;

            // Upload 디렉토리 없으면 생성
            make_directory($upload_uri);

            // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
            $config['upload_path'] = $upload_path;
            // 허용되는 파일의 최대 사이즈
            $config['max_size'] = $this->global_upload_max_size;
            // 이미지인 경우 허용되는 최대 폭
            $config['max_width'] = '0';
            // 이미지인 경우 허용되는 최대 높이
            $config['max_height'] = '0';

            // 첨부 이미지가 있는 경우..
            if (is_uploaded_file($_FILES["image_file"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_file_allowed."|".$this->global_upload_image_allowed;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("image_file")) {
                    echo $this->upload->display_errors();
                } else {
                    $image_file = $this->upload->data();
                }
            }
            
            // 첨부파일이 있는 경우..
            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
                $file_ext = strtolower(substr(strrchr($_FILES['file']['name'], "."), 1));
                // 아래 파일만 업로드를 허용한다.
                if ($file_ext == "hwp") {
                    $config['allowed_types'] = "*";
                } else {
                    $config['allowed_types'] = $this->global_upload_file_allowed;
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("file")) {
                    echo $this->upload->display_errors();
                } else {
                    $file = $this->upload->data();
                }
            }
            
            //print_r($file);exit;
            
            // 게시판 데이터 설정
            if (!$this->input->post('re_group')) {   // 처음 등록하는 글일 경우
                $re_group = 0;
                $re_step = 0;
                $re_level = 0;
            } else {   // 답변 글을 등록하는 경우
                $re_group = (int) $this->input->post('re_group');
                $re_step = (int) $this->input->post('re_step');
                $re_level = (int) $this->input->post('re_level');

                $this->board_model->updateReplyStep(array('re_group' => $re_group, 're_step' => $re_step));

                $re_step++;
                $re_level++;
            }
            
            $is_notice = "N";
            $is_secret = "N";
            $view_count = 0;
            $is_use = "Y";

            $option = array(
                'board_code' => $board_code,
                're_group' => $re_group,
                're_step' => $re_step,
                're_level' => $re_level,
                'user_id' => $this->session->userdata('AID'),
                'name' => $this->input->post('name'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'is_notice' => $is_notice,
                'is_secret' => $is_secret,
                'view_count' => $view_count,
                'regist_ip' => $_SERVER['REMOTE_ADDR'],
                'update_ip' => $_SERVER['REMOTE_ADDR'],
                'is_use' => $is_use
            );

            // BOARD Insert
            $seq = $this->board_model->insertBoard($option);

            // re_group Update
            if ($re_group == 0)
                $this->board_model->updateReplyGroup(array('seq' => $seq));

            // UPLOAD Image Insert
            if (isset($image_file) && $image_file['file_name']) {
                $image_file['seq'] = $seq;
                $image_file['upload_type'] = "image";
                $this->board_model->insertUpload($image_file);
            }
            
            // UPLOAD file Insert
            if (isset($file) && $file['file_name']) {
                $file['seq'] = $seq;
                $file['upload_type'] = "file";
                $this->board_model->insertUpload($file);
            }

            redirect('mgr/board/view?board_code=' . $board_code . "&seq=" . $seq);
        }

        $this->_admin_footer();
    }

    public function view() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code') || !$this->input->get('seq')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $board_code = $this->input->get('board_code');
        $s_road_group = $this->input->get('s_road_group');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $seq = $this->input->get('seq');
        $page = $this->input->get('page');
        $params = "board_code=" . $board_code . "&s_road_group=" . $s_road_group . "&s_field=" . $s_field . "&s_string=" . $s_string;

        // boardconfig 정보 가져오기
        $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code' => $board_code));

        // 글정보 가져오기
        $board = $this->board_model->getBoard(array('seq' => $seq));
        if (!$board) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }

        // Upload 정보 가져오기
        $imageList = $this->board_model->getUploadList(array('seq' => $seq, 'upload_type' => 'image'));
        $fileList = $this->board_model->getUploadList(array('seq' => $seq, 'upload_type' => 'file'));
        
        //작성자가 관리자가 아니면 조회수 update
//        if ($board->user_id != $this->session->userdata('AID')) {
//            $this->board_model->updateHit(array('seq' => $seq));
//        }
        $this->board_model->updateHit(array('seq' => $seq));
        
        if (!$s_road_group) { //클럽 , 앨범
            $option = array(
                'seq' => $this->input->get('seq'),
                'board_code' => $board_code,
                'regist_date' => date("Y-m-d H:i:s", strtotime($board->regist_date)),
                's_field' => $s_field,
                's_string' => $s_string
            );

            /*이전글 다음글 정보*/
            //다음글 seq
            $next_seq = $this->board_model->getFrontierBoardNext($option);
            //이전글 seq
            $prev_seq = $this->board_model->getFrontierBoardPrev($option);
            
        } else { //오리엔테이션
            $option = array(
                'seq' => $this->input->get('seq'),
                'board_code' => $board_code,
                's_road_group' => $s_road_group,
                's_field' => $s_field,
                's_string' => $s_string
            );

            /*이전글 다음글 정보*/
            //다음글 seq
            $next_seq = $this->board_model->getBoardNext($option);
            //이전글 seq
            $prev_seq = $this->board_model->getBoardPrev($option);
        }
        
        
        // 다음글 글정보 가져오기
        if (isset($next_seq) && $next_seq) {
            $next_board = $this->board_model->getBoard(array('seq' => $next_seq->seq));
            $data['next_board'] = $next_board;
        }
        // 이전글 글정보 가져오기
        if (isset($prev_seq) && $prev_seq) {
            $prev_board = $this->board_model->getBoard(array('seq' => $prev_seq->seq));
            $data['prev_board'] = $prev_board;
        }

        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['page'] = $page;
        $data['boardconfig'] = $boardconfig;
        $data['board'] = $board;
        $data['imageList'] = $imageList;
        $data['fileList'] = $fileList;
        $data['params'] = $params;

        $data['pageName'] = 'mgr/board/' . $boardconfig->board_skin . '/view';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    public function update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $board_code = $this->input->get('board_code');
        $s_road_group = $this->input->get('s_road_group');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $seq = $this->input->get('seq');
        $params = "board_code=" . $board_code . "&s_road_group=" . $s_road_group . "&s_field=" . $s_field . "&s_string=" . $s_string;

        $this->load->library('form_validation');   //form_validation 로드
        $this->form_validation->set_rules('name', '이름', 'trim|required|min_length[2]|max_length[20]');
        $this->form_validation->set_rules('title', '제목', 'trim|required|min_length[2]|max_length[100]');
        //$this->form_validation->set_rules('content', '내용', 'required');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            // boardconfig 정보 가져오기
            $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code' => $board_code));
            
            // 기수 코드
            //$data['groupCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'G01'));
            
            // 활성화된 기수정보 가져오기
            $group = $this->site_model->getGroup();

            // 글정보 가져오기
            $board = $this->board_model->getBoard(array('seq' => $seq));

            // Upload 정보 가져오기
            $imageList = $this->board_model->getUploadList(array('seq' => $seq, 'upload_type' => 'image'));
            $fileList = $this->board_model->getUploadList(array('seq' => $seq, 'upload_type' => 'file'));

            $data['s_field'] = $s_field;
            $data['s_string'] = $s_string;
            $data['page'] = $page;
            $data['boardconfig'] = $boardconfig;
            $data['board'] = $board;
            $data['group'] = $group;
            $data['imageList'] = $imageList;
            $data['fileList'] = $fileList;
            $data['params'] = $params;

            $data['pageName'] = 'mgr/board/' . $boardconfig->board_skin . '/update';
            $this->load->view($this->global_layout_manager, $data);
        } else {
            $option = array(
                'group_cd' => $this->input->post('group_cd'),
                'road_part' => $this->input->post('road_part'),
                'name' => $this->input->post('name'),
                'title' => $this->input->post('title'),
                'is_secret' => 'N',
                'content' => $this->input->post('content'),
                'update_ip' => $_SERVER['REMOTE_ADDR'],
                'seq' => $seq
            );

            // BOARD Update
            $this->board_model->updateBoard($option);

            // Upload 디렉토리 설정
            $path = "/board/" . date('Y') . "/" . date('m');
            $upload_path = $this->global_upload_path . $path;
            $upload_uri = $this->global_upload_uri . $path;

            // Upload 디렉토리 없으면 생성
            make_directory($upload_uri);

            // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
            $config['upload_path'] = $upload_path;
            // 허용되는 파일의 최대 사이즈
            $config['max_size'] = $this->global_upload_max_size;
            // 이미지인 경우 허용되는 최대 폭
            $config['max_width'] = '0';
            // 이미지인 경우 허용되는 최대 높이
            $config['max_height'] = '0';

            $file_no = $this->input->post('image_file_no');
            if (is_uploaded_file($_FILES["image_file"]["tmp_name"])) {        // 첨부 이미지가 있는 경우..
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_image_allowed;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("image_file")) {
                    echo $this->upload->display_errors();
                } else {
                    // 새로운 Upload 파일 정보
                    $imagedata = $this->upload->data();
                    if ($file_no) {
                        // 기존 이미지 파일 정보
                        $image = $this->board_model->getUpload(array('file_no' => $file_no));
                        // TB_BOARD_UPLOAD Update
                        $imagedata['file_no'] = $file_no;
                        $this->board_model->updateUpload($imagedata);
                        // 기존 이미지 파일 삭제
                        if (file_exists($image->full_path))
                            unlink($image->full_path);
                    } else {
                        $imagedata['seq'] = $seq;
                        $imagedata['upload_type'] = "image";
                        $this->board_model->insertUpload($imagedata);
                    }
                }
            } else if ($this->input->post('image_file_delete') == "Y") {        // 기존 이미지 삭제..
                // 기존 이미지 파일 정보
                $image = $this->board_model->getUpload(array('file_no' => $file_no));
                // 파일 삭제
                if (file_exists($image->full_path))
                    unlink($image->full_path);
                // TB_BOARD_UPLOAD Delete
                $this->board_model->deleteUpload(array('file_no' => $file_no));
            }

            $file_no = $this->input->post('file_no');
            if (is_uploaded_file($_FILES["file"]["tmp_name"])) {     // 첨부파일이 있는 경우..
                $file_ext = strtolower(substr(strrchr($_FILES['file']['name'], "."), 1));
                // 아래 파일만 업로드를 허용한다.
                if ($file_ext == "hwp") {
                    $config['allowed_types'] = "*";
                } else {
                    $config['allowed_types'] = $this->global_upload_file_allowed;
                }
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("file")) {
                    echo $this->upload->display_errors();
                } else {
                    // 새로운 Upload 파일 정보
                    $filedata = $this->upload->data();
                    if ($file_no) {
                        // 기존 첨부 파일 정보
                        $file = $this->board_model->getUpload(array('file_no' => $file_no));
                        // TB_BOARD_UPLOAD Update
                        $filedata['file_no'] = $file_no;
                        $this->board_model->updateUpload($filedata);
                        // 기존 첨부 파일 삭제
                        if (file_exists($file->full_path))
                            unlink($file->full_path);
                    } else {
                        $filedata['seq'] = $seq;
                        $filedata['upload_type'] = "file";
                        $this->board_model->insertUpload($filedata);
                    }
                }
            } else if ($this->input->post('file_delete') == "Y") {        // 첨부파일 삭제..
                // 기존 이미지 파일 정보
                $file = $this->board_model->getUpload(array('file_no' => $file_no));
                // 파일 삭제
                if (file_exists($file->full_path))
                    unlink($file->full_path);
                // TB_BOARD_UPLOAD Delete
                $this->board_model->deleteUpload(array('file_no' => $file_no));
            }

            redirect('mgr/board/view?' . $params . '&seq=' . $seq . '&page=' . $page);
        }

        $this->_admin_footer();
    }

    public function chkdelete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $arrNo = $this->input->post('checkno');
        $board_code = $this->input->post('board_code');
        $s_field = $this->input->post('s_field');
        $s_string = $this->input->post('s_string');
        $page = $this->input->post('page');
        
        foreach ($arrNo as $i => $no) {
            $this->board_model->deleteBoard(array('seq' => $no)); 
        }
        
        echo "<script type='text/javascript'> parent.location.reload(); </script>";
        
        $this->_admin_footer();
    }
    
    public function delete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $board_code = $this->input->get('board_code');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $seq = $this->input->get('seq');
        $params = "board_code=" . $board_code . "&s_field=" . $s_field . "&s_string=" . $s_string;

        // TB_BOARD Delete
        $this->board_model->deleteBoard(array('seq' => $seq));

        redirect('mgr/board?' . $params . '&page=' . $page);

        $this->_admin_footer();
    }

    public function selectdelete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $board_code = $this->input->get('board_code');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $params = "board_code=" . $board_code . "&s_field=" . $s_field . "&s_string=" . $s_string;

        $arraySeq = $this->input->post('seq');
        $cnt = count($arraySeq);

        for ($i = 0; $i < $cnt; $i++) {
            $seq = $arraySeq[$i];

            // TB_BOARD Delete
            $this->board_model->deleteBoard(array('seq' => $seq));
        }

        redirect('mgr/board?' . $params . '&page=' . $page);

        $this->_admin_footer();
    }

    public function download() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $this->load->helper('download');

        $file_no = $this->input->get('file_no');

        // Upload File 정보 가져오기
        $upload = $this->board_model->getUpload(array('file_no' => $file_no));

        $filedata = file_get_contents($upload->full_path);
        $filename = urlencode($upload->file_name);

        force_download($filename, $filedata);

        $this->_admin_footer();
    }

    public function updateNotice() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $board_code = $this->input->get('board_code');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $seq = $this->input->get('seq');
        $params = "board_code=" . $board_code . "&s_field=" . $s_field . "&s_string=" . $s_string;

        // Notice Update
        $this->board_model->updateNotice(array('seq' => $seq, 'is_notice' => 'Y'));

        redirect('mgr/board?' . $params . '&page=' . $page);

        $this->_admin_footer();
    }

    public function deleteNotice() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $board_code = $this->input->get('board_code');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $seq = $this->input->get('seq');
        $params = "board_code=" . $board_code. "&s_field=" . $s_field . "&s_string=" . $s_string;

        // Notice Update
        $this->board_model->updateNotice(array('seq' => $seq, 'is_notice' => 'N'));

        redirect('mgr/board?' . $params . '&page=' . $page);

        $this->_admin_footer();
    }

    public function insertComment() {
        $this->output->enable_profiler(false);
        
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('seq')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }

        $seq = $this->input->get('seq');

        if (!$this->input->post('c_group')) {   // 처음 등록하는 글일 경우
            $c_group = 0;
            $c_step = 0;
            $c_level = 0;
        } else {   // 답변 글을 등록하는 경우
            $c_group = (int) $this->input->post('c_group');
            $c_step = (int) $this->input->post('c_step');
            $c_level = (int) $this->input->post('c_level');

            $this->board_model->updateCommentReplyStep(array('c_group' => $c_group, 'c_step' => $c_step));

            $c_step++;
            $c_level++;
        }
        $is_use = "Y";

        $option = array(
            'seq' => $seq,
            'c_group' => $c_group,
            'c_step' => $c_step,
            'c_level' => $c_level,
            'user_id' => $this->session->userdata('AID'),
            //'name' => $this->session->userdata('AName'),
            'name' => "관리자",
            'comment' => $this->input->post('comment'),
            'regist_ip' => $_SERVER['REMOTE_ADDR'],
            'update_ip' => $_SERVER['REMOTE_ADDR'],
            'is_use' => $is_use
        );
        
        /** 트랜잭션 수행 * */
        $this->db->trans_start();
        
        // Comment Insert
        $c_no = $this->board_model->insertComment($option);
        
        // c_group Update
        if ($c_group == 0)
            $this->board_model->updateCommentReplyGroup(array('c_no' => $c_no));

        /** 트랜잭션 완료 * */
        $this->db->trans_complete();

        /** 트랜잭션 에러 * */
        if ($this->db->trans_status() === FALSE) {
            alert("DB Error!!");
        }
            
        $this->_admin_footer();
    }

    public function updateComment() {
        $this->output->enable_profiler(false);
        
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('c_no')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }

        $c_no = $this->input->get('c_no');

        $option = array(
            'c_no' => $c_no,
            'comment' => $this->input->post('comment'),
            'update_ip' => $_SERVER['REMOTE_ADDR'],
        );

        // Comment Update
        $this->board_model->updateComment($option);

        $this->_admin_footer();
    }

    public function comment() {
        $this->output->enable_profiler(false);

        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code') || !$this->input->get('seq')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }

        $board_code = $this->input->get('board_code');
        $seq = $this->input->get('seq');

        // boardconfig 정보 가져오기
        $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code' => $board_code));

        // 댓글 갯수
        $comment_count = $this->board_model->getCommentListCount(array('seq' => $seq));
        // 댓글 목록
        $commentList = $this->board_model->getCommentList(array('seq' => $seq));

        $data['seq'] = $seq;
        $data['boardconfig'] = $boardconfig;
        $data['comment_count'] = $comment_count;
        $data['commentList'] = $commentList;

        $this->load->view('mgr/board/' . $boardconfig->board_skin . '/comment', $data);
        $this->_admin_footer();
    }

    public function commentReplyForm() {
        $this->output->enable_profiler(false);

        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code') || !$this->input->get('seq') || !$this->input->get('c_no')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }

        $board_code = $this->input->get('board_code');
        $seq = $this->input->get('seq');
        $c_no = $this->input->get('c_no');

        // boardconfig 정보 가져오기
        $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code' => $board_code));

        // comment 정보 가져오기
        $comment = $this->board_model->getComment(array('c_no' => $c_no));

        $data['seq'] = $seq;
        $data['boardconfig'] = $boardconfig;
        $data['comment'] = $comment;

        $this->load->view('mgr/board/' . $boardconfig->board_skin . '/comment_reply', $data);

        $this->_admin_footer();
    }

    //댓글 수정폼
    public function commentUpdateForm() {
        $this->output->enable_profiler(false);

        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('board_code') || !$this->input->get('c_no')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }

        $board_code = $this->input->get('board_code');
        $c_no = $this->input->get('c_no');

        // boardconfig 정보 가져오기
        $boardconfig = $this->boardconfig_model->getBoardconfig(array('board_code' => $board_code));

        // comment 정보 가져오기
        $comment = $this->board_model->getComment(array('c_no' => $c_no));

        $data['boardconfig'] = $boardconfig;
        $data['comment'] = $comment;

        $this->load->view('mgr/board/' . $boardconfig->board_skin . '/comment_update', $data);

        $this->_admin_footer();
    }

    public function deleteComment() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->get('c_no')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }

        $c_no = $this->input->get('c_no');

        // Comment Delete
        $this->board_model->deleteComment(array('c_no' => $c_no));

        $this->_admin_footer();
    }

}
