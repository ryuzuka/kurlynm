<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('main_model');
        $this->load->helper('paging');
        $this->load->helper("alert");
        $this->load->helper('directory');
        $this->load->helper('string');

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_pc_prefix."main";
    }


    public function guide() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = "";
        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/guide";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."customer", $data);
        } else {
            $pagename = "mobile/customer/guide";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."customer", $data);
        }
        
        $this->_footer();
    }
    
    public function notice() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 10;
        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page;

        // 전체 데이터 수
        $total_count = $this->customer_model->getFrontNoticeListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $noticeList = $this->customer_model->getFrontNoticeList($option);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['noticeList'] = $noticeList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            // Pagination
            $url = '/customer/notice' . "?" . $params . "&page=";
            $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);
        
            $pagename = "front/customer/notice";
            $data['pageName'] = $pagename;
            $data['pagination'] = $pagination;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            // Pagination
            $url = '/customer/notice' . "?" . $params . "&page=";
            $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);
            
            $pagename = "mobile/customer/notice";
            $data['pageName'] = $pagename;
            $data['pagination'] = $pagination;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }

        $this->_footer();
    }
    
    public function notice_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);        
        
        $seq = $this->input->get('seq');
        $page = $this->input->get('page');

        $params = "page=".$page;

        // 조회수
        $this->customer_model->updateNoticeView(array('seq' => $seq));
        
        // 정보 가져오기
        $data['notice'] = $this->customer_model->getFrontNotice(array('seq' => $seq));
        
        $data['params'] = $params;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/notice_info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."customer", $data);
        } else {
            $pagename = "mobile/customer/notice_info";
            $data['sub'] = "sub";
            $data['subTitle'] = "공지사항";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."customer_sub", $data);
        }
        
        $this->_footer();
    }
    
    public function inquiry_write() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = "";
        
        $type = $this->input->get('type');
        
        $data['pageTitle'] = "컬리넥스트마일";
        $data['type'] = $type;
        
        $data['privacy'] = $this->main_model->getMainPrivacy();
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/inquiry_write";            
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."customer", $data);
        } else {
            $pagename = "mobile/customer/inquiry_write";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."customer", $data);
        }
        
        $this->_footer();
    }
    
    public function inquiry_insert() {
        $option = $this->input->post();

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
        if(is_uploaded_file($_FILES["file1"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_image_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file1")) {
                echo $this->upload->display_errors();
            } else {
                $file1 = $this->upload->data();
            }
        }

        if(is_uploaded_file($_FILES["file3"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_image_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file3")) {
                echo $this->upload->display_errors();
            } else {
                $file3 = $this->upload->data();
            }
        }

        if(is_uploaded_file($_FILES["file2"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_image_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file2")) {
                echo $this->upload->display_errors();
            } else {
                $file2 = $this->upload->data();
            }
        }

        if (isset($file1) && $file1['file_name']) {
            $option['file_path_1'] = $upload_uri;
            $option['file_name_1'] = $file1['file_name'];
        } else {
            $option['file_path_1'] = null;
            $option['file_name_1'] = null;
        }

        if (isset($file2) && $file2['file_name']) {
            $option['file_path_2'] = $upload_uri;
            $option['file_name_2'] = $file2['file_name'];
        } else {
            $option['file_path_2'] = null;
            $option['file_name_2'] = null;
        }

        if (isset($file3) && $file3['file_name']) {
            $option['file_path_3'] = $upload_uri;
            $option['file_name_3'] = $file3['file_name'];
        } else {
            $option['file_path_3'] = null;
            $option['file_name_3'] = null;
        }

        $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->customer_model->insertInquiry($option);

        redirect('customer/inquiry_complete');
    }
    
    public function inquiry_complete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = "";
        
        $type = $this->input->get('type');
        
        $data['pageTitle'] = "컬리넥스트마일";
        $data['type'] = $type;
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/inquiry_complete";            
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."customer", $data);
        } else {
            $pagename = "mobile/customer/inquiry_complete";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."customer", $data);
        }
        
        $this->_footer();
    }
    
    public function inquiry_list() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 10;
        $limit_start = ($page - 1) * $limit_size;

        $crypt_pass = "abcdefghij123456"; // 16자리
        $crypt_iv = "abcdefghij123456"; // 16자리
            
        $param1 = base64_decode($this->input->get('param1'));
        $param1 = @openssl_decrypt($param1, "aes-128-cbc", $crypt_pass, true, $crypt_iv);
        
        $param2 = base64_decode($this->input->get('param2'));
        $param2 = @openssl_decrypt($param2, "aes-128-cbc", $crypt_pass, true, $crypt_iv);
        
        $option = array(
            'question_email'	=> $param1,
            'question_passwd'	=> $param2,
            'limit_start'       => $limit_start,
            'limit_size'        => $limit_size
        );

        $params = "page=".$page."&param1=".urlencode($this->input->get('param1'))."&param2=".urlencode($this->input->get('param2'));

        // 전체 데이터 수
        $total_count = $this->customer_model->getFrontInquiryListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $inquiryList = $this->customer_model->getFrontInquiryList($option);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['inquiryList'] = $inquiryList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            // Pagination
            $url = '/customer/inquiry_list' . "?" . $params . "&page=";
            $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);
        
            $pagename = "front/customer/inquiry_list";
            $data['pageName'] = $pagename;
            $data['pagination'] = $pagination;
            $this->load->view($this->global_layout_pc_prefix."company", $data);
        } else {
            // Pagination
            $url = '/customer/inquiry_list' . "?" . $params . "&page=";
            $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);
            
            $pagename = "mobile/customer/inquiry_list";
            $data['pageName'] = $pagename;
            $data['pagination'] = $pagination;
            $this->load->view($this->global_layout_mo_prefix."company", $data);
        }

        $this->_footer();
    }
    
    public function inquiry_auth() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        if($this->input->post('question_email')) {
            $option = $this->input->post();
            
            $data1 = $this->input->post("question_email");
            $data2 = $this->input->post("question_passwd");
            $crypt_pass = "abcdefghij123456"; // 16자리
            $crypt_iv = "abcdefghij123456"; // 16자리

            // 암호화
            $endata1 = @openssl_encrypt($data1 , "aes-128-cbc", $crypt_pass, true, $crypt_iv);
            $param1 = base64_encode($endata1);
            
            $endata2 = @openssl_encrypt($data2 , "aes-128-cbc", $crypt_pass, true, $crypt_iv);
            $param2 = base64_encode($endata2);
            //echo "ENCODE DATA : " . $endata . "<br>";
            
            $params = "param1=".urlencode($param1)."&param2=".urlencode($param2);
            if($this->global_device == "pc") {
                redirect("customer/inquiry_list?".$params);
            } else {
                redirect("customer/inquiry_list?".$params);
            }
        } else {
            $data['pageTitle'] = "컬리넥스트마일";

            $pagename = "";
            if($this->global_device == "pc") {
                $pagename = "front/customer/inquiry_auth";
                $data['pageName'] = $pagename;
                $this->load->view($this->global_layout_pc_prefix."customer", $data);
            } else {
                $pagename = "mobile/customer/inquiry_auth";
                $data['pageName'] = $pagename;
                $this->load->view($this->global_layout_mo_prefix."customer", $data);
            }
        }
        
        $this->_footer();
    }
    
    public function inquiry_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);        
        
        $seq = $this->input->get('seq');
        $page = $this->input->get('page');
        $param1 = $this->input->get('param1');
        $param2 = $this->input->get('param2');

        $params = "page=".$page."&param1=".urlencode($param1)."&param2=".urlencode($param2);
        
        // 정보 가져오기
        $data['inquiry'] = $this->customer_model->getFrontInquiry(array('seq' => $seq));
        
        $data['params'] = $params;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/inquiry_info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."customer", $data);
        } else {
            $pagename = "mobile/customer/inquiry_info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."customer", $data);
        }
        
        $this->_footer();
    }    
    
    public function inquiry_search() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = $this->input->post();
        
        $inquiryList = $this->customer_model->getFrontInquiryAuth($option);
        
        if ($inquiryList) {
            $data['pageTitle'] = "컬리넥스트마일";
            $data['inquiryList'] = $inquiryList;

            $pagename = "";
            if($this->global_device == "pc") {
                $pagename = "front/customer/inquiry_list";
                $data['pageName'] = $pagename;
                $this->load->view($this->global_layout_pc_prefix."customer", $data);
            } else {
                $pagename = "mobile/customer/inquiry_list";
                $data['pageName'] = $pagename;
                $this->load->view($this->global_layout_mo_prefix."customer", $data);
            }
        } else {
            //print_r("aa"); exit;
            // 비밀번호가 일치하지 않을 경우
            $this->session->set_flashdata('message', '일치하는 정보가 없습니다.');
            redirect('/customer/inquiry_auth');
        }
        
        $this->_footer();
    }
    
    public function event() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        
        if($this->global_device == "pc") {
            $limit_size = 20;
        } else {
            $limit_size = 5;
        }
        $limit_start = ($page - 1) * $limit_size;

        $option = array(            
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page;

        // 전체 데이터 수
        $total_count = $this->customer_model->getFrontEventListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $eventList = $this->customer_model->getFrontEventList($option);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['eventList'] = $eventList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/event";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."customer", $data);
        } else {
            $pagename = "mobile/customer/event";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."customer", $data);
        }
        
        $this->_footer();
    }
    
    public function event_more() {
        $page = $this->input->get('page');
        $limit_size = $this->input->post('end');
        $limit_start = $this->input->post('start');
        
        $option = array(            
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page;

        // 전체 데이터 수
        $total_count = $this->customer_model->getFrontEventListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $eventList = $this->customer_model->getFrontEventList($option);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['eventList'] = $eventList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/event";
            $data['pageName'] = $pagename;
            $this->load->view($data['pageName'], $data);
        } else {
            $pagename = "mobile/customer/event_more";
            $data['pageName'] = $pagename;
            $this->load->view($data['pageName'], $data);
        }
        
        $this->_footer();
    }
    
    public function event_info() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);        
        
        $seq = $this->input->get('seq');
        $page = $this->input->get('page');

        $params = "page=".$page;
        
        // 정보 가져오기
        $data['event'] = $this->customer_model->getFrontEvent(array('seq' => $seq));
        
        $data['params'] = $params;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/customer/event_info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."customer", $data);
        } else {
            $pagename = "mobile/customer/event_info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."customer", $data);
        }
        
        $this->_footer();
    }    
}
