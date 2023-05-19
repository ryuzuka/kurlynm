<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('expedition_model');
        $this->load->model('site_model');
        $this->load->model('code_model');
        $this->load->helper('directory');
        $this->load->helper('string');        
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_prefix."support";
        
    }

    // 공지사항 목록
    public function notice() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $limit_size = $this->input->get('limit_size');

        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;

        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 15;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string;

        // 전체 데이터 수
        $total_count = $this->site_model->getNoticeListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $noticeList = $this->site_model->getNoticeList($option);

        // Pagination
        $url = '/front/support/notice' . "?" . $params . "&page=";
        $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['noticeList'] = $noticeList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;
        $data['pageTitle'] = '공지사항';
        $data['pageName'] = 'front/support/notice_list';
        $this->load->view($this->global_layout, $data);

        $this->_footer();
    }
    
    // 공지사항 정보 보기
    public function notice_view() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $seq = $this->input->get('seq');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');

        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string;

        $option = array(
            'seq'		=> $seq,
            's_field'		=> $s_field,
            's_string'		=> $s_string
        );
        
        // 정보 가져오기
        $data['notice'] = $this->site_model->getNotice($option);

        $data['noticePrev'] = $this->site_model->getNoticePrev($option);
        $data['noticeNext'] = $this->site_model->getNoticeNext($option);
        
        $data['params'] = $params;
        $data['pageTitle'] = '공지사항';
        $data['pageName'] = 'front/support/notice_view';
        $this->load->view($this->global_layout, $data);

        $this->_footer();
    }
    
    
    // 1:1문의 목록
    public function inquiry() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $this->_require_login($_SERVER['REQUEST_URI']);
        
        //$this->session->set_userdata('MID', 'tester01');
        //$this->session->set_userdata('MNAME', '박재훈');
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;
        
        $block_size = 10;
        $limit_size = 10;
        
        $limit_start = ($page - 1) * $limit_size;
        
        $option = array(
            'member_id'	=> $this->session->userdata('MID'),
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page;

        // 전체 데이터 수
        $total_count = $this->site_model->getInquiryListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $inquiryList = $this->site_model->getInquiryList($option);

        // Pagination
        $url = '/front/support/inquiry' . "?" . $params . "&page=";
        $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['inquiryList'] = $inquiryList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;
        $data['pageTitle'] = '1:1문의';
        $data['pageName'] = 'front/support/inquiry_list';
        $this->load->view($this->global_layout, $data);

        $this->_footer();
    }
    
    
    // 1:1 문의 등록
    public function inquiry_write() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $this->_require_login($_SERVER['REQUEST_URI']);
        
        $page = $this->input->get('page');

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('question_title', '제목', 'trim|required|min_length[1]');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            $params = "page=".$page;

            // 문의종류 코드
            $data['inquiryCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'Q01'));
            
            $data['params'] = $params;
            $data['pageTitle'] = '1:1문의';
            $data['pageName'] = 'front/support/inquiry_write';

            $this->load->view($this->global_layout, $data);
        } else {			
            $option = $this->input->post();

            //$this->session->set_userdata('MID', 'tester01');
            //$this->session->set_userdata('MNAME', '박재훈');
        
            // Upload 디렉토리 설정
            $path = "/inquiry/".date('Y')."/".date('m');
            $upload_path = $this->global_upload_path.$path;
            $upload_uri = $this->global_upload_uri.$path;

            // Upload 디렉토리 없으면 생성
            make_directory($upload_uri);

            // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
            $config['upload_path'] = $upload_path;
            // 허용되는 파일의 최대 사이즈
            $config['max_size'] = $this->global_upload_max_size;
            // 이미지인 경우 허용되는 최대 폭
            $config['max_width']  = '0';
            // 이미지인 경우 허용되는 최대 높이
            $config['max_height']  = '0';

            // 첨부 있는 경우..
            if(is_uploaded_file($_FILES["question_file"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_media_allowed;
                $config['file_name'] = time().random_string('alnum', 4);
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("question_file")) {
                    echo $this->upload->display_errors();
                } else {
                    $question_file = $this->upload->data();
                }
            }            

            if (isset($question_file) && $question_file['file_name']) {
                $option['file_path'] = $upload_uri;
                $option['file_name'] = $question_file['file_name'];
            } else {
                $option['file_path'] = null;
                $option['file_name'] = null;
            }

            $option['member_id'] = $this->member->member_id;
            $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

    //            print_r($option); exit;

            $this->site_model->insertInquiry($option);

            $this->session->set_flashdata('message', '1:1 문의가 정상 등록되었습니다.');
            redirect('support/inquiry');
        }

        $this->_footer();
    }
    
    
    // 1:1 문의 정보 보기
    public function inquiry_view() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $this->_require_login($_SERVER['REQUEST_URI']);
        
        $seq = $this->input->get('seq');
        $page = $this->input->get('page');

        $params = "page=".$page;

        $option = array(
            'seq'   => $seq,
            'member_id' => $this->session->userdata('MID')
        );
        
        // 정보 가져오기
        $data['inquiry'] = $this->site_model->getInquiry($option);

        $data['inquiryPrev'] = $this->site_model->getInquiryPrev($option);
        $data['inquiryNext'] = $this->site_model->getInquiryNext($option);
        
        $data['params'] = $params;
        $data['pageTitle'] = '1:1문의';
        $data['pageName'] = 'front/support/inquiry_view';
        $this->load->view($this->global_layout, $data);

        $this->_footer();
    }
    
    
    // 1:1 문의 정보 보기
    public function inquiry_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $this->_require_login($_SERVER['REQUEST_URI']);
        
        $page = $this->input->get('page');

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('question_title', '제목', 'trim|required|min_length[1]');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            $option = array(
                'seq'   => $this->input->get('seq'),
                'member_id' => $this->member->member_id
            );
            
            $params = "page=".$page;

            // 문의종류 코드
            $data['inquiryCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'Q01'));

            // 정보 가져오기
            $data['inquiry'] = $this->site_model->getInquiry($option);

            $data['params'] = $params;
            $data['pageTitle'] = '1:1문의';
            $data['pageName'] = 'front/support/inquiry_info';

            $this->load->view($this->global_layout, $data);
        } else {			
            $option = $this->input->post();

            //$this->session->set_userdata('MID', 'tester01');
            //$this->session->set_userdata('MNAME', '박재훈');
        
            // Upload 디렉토리 설정
            $path = "/inquiry/".date('Y')."/".date('m');
            $upload_path = $this->global_upload_path.$path;
            $upload_uri = $this->global_upload_uri.$path;

            // Upload 디렉토리 없으면 생성
            make_directory($upload_uri);

            // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
            $config['upload_path'] = $upload_path;
            // 허용되는 파일의 최대 사이즈
            $config['max_size'] = $this->global_upload_max_size;
            // 이미지인 경우 허용되는 최대 폭
            $config['max_width']  = '0';
            // 이미지인 경우 허용되는 최대 높이
            $config['max_height']  = '0';

            // 첨부 있는 경우..
            if(is_uploaded_file($_FILES["question_file"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_media_allowed;
                $config['file_name'] = time().random_string('alnum', 4);
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("question_file")) {
                    echo $this->upload->display_errors();
                } else {
                    $question_file = $this->upload->data();
                }
            }            

            if (isset($question_file) && $question_file['file_name']) {
                $option['file_path'] = $upload_uri;
                $option['file_name'] = $question_file['file_name'];
            } else {
                $option['file_path'] = null;
                $option['file_name'] = null;
            }

            $question = $this->site_model->getQuestion(array('seq' => $this->input->post('seq')));
            
            $option['member_id'] = $this->member->member_id;
            $option['member_name'] = $this->member->member_name;
            $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

    //            print_r($option); exit;

            $this->site_model->updateInquiry($option);

            if (isset($question_file) && $question->file_name) {            
            $oldFile = $this->global_root_path.$question->file_path."/".$question->file_name;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        
            $this->session->set_flashdata('message', '1:1 문의가 정상 수정되었습니다.');
            redirect('support/inquiry_info?seq='.$this->input->post('seq'));
        }

        $this->_footer();
    }
    
    // 1:1 문의 정보 삭제
    public function inquiry_delete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $this->_require_login($_SERVER['REQUEST_URI']);
        
        $seq = $this->input->get('seq');
        $page = $this->input->get('page');

        $params = "page=".$page;

        $option = array(
            'seq'   => $seq,
            'member_id' => $this->session->userdata('MID')
        );
        
        // 삭제
        $this->site_model->deleteInquiry($option);

        $data['params'] = $params;        
        redirect('support/inquiry');

        $this->_footer();
    }
    
    // faq 목록
    public function faq() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        
        if ($this->input->get('faq_cd'))
            $faq_cd = $this->input->get('faq_cd');
        else
            $faq_cd = "01";
        
        $option = array(
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            'faq_cd'	=> $faq_cd
        );

        $params = "faq_cd=".$faq_cd."&s_field=".$s_field."&s_string=".$s_string;
        
        // 문의종류 코드
        $data['faqCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'F02'));
            
        // 데이터 목록
        $faqList = $this->site_model->getFaqAllList($option);

        $data['faqList'] = $faqList;
        $data['faq_cd'] = $faq_cd;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['pageTitle'] = 'FAQ';
        $data['pageName'] = 'front/support/faq';
        $this->load->view($this->global_layout, $data);

        $this->_footer();
    }    
}