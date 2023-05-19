<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('site_model');
        $this->load->model('code_model');
        $this->load->helper('directory');
        $this->load->helper('string');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "0601";
    }

    
    // 사이트관리 - 공지사항
    public function notice() {
        $data['current_menu_code'] = "0201";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_month = $this->input->get('s_month');
        $limit_size = $this->input->get('limit_size');
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;
        
        if ($this->input->get('s_month'))
            $s_month = $this->input->get('s_month');
        else
            $s_month = "30";
        
        if ($this->input->get('s_term'))
            $s_term = $this->input->get('s_term');
        else
            $s_term = "question_date";

        if ($this->input->get('start_date') && $this->input->get('end_date')) {
            
        } else {
            $start_date = date("Y-m-d", strtotime("-1 months"));
            $end_date = date('Y-m-d');
        }
        
        $block_size = 10;

        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 10;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            's_term'		=> $s_term,
            'start_date'	=> $start_date,
            'end_date'		=> $end_date . " 23:59",
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );
//print_r($option);
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['s_term'] = $s_term;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['s_month'] = $s_month;
        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_month=".$s_month;

        // 전체 데이터 수
        $total_count = $this->site_model->getNoticeListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $noticeList = $this->site_model->getNoticeList($option);

        // Pagination
        $url = '/mgr/site/notice' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['noticeList'] = $noticeList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/site/notice_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // SNS 등록
    public function notice_insert() {
        $data['current_menu_code'] = "0201";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('title', '제목', 'trim|required|min_length[1]');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date;
            $data['count'] = $this->site_model->getNoticeImportantCount();
            
            $data['params'] = $params;
            $data['pageName'] = 'mgr/site/notice_write';

            $this->load->view($this->global_layout_manager, $data);
        } else {			
            $option = $this->input->post();
//print_r($option); exit;
            
            // Upload 디렉토리 설정
            $path = "/notice/".date('Y')."/".date('m');
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
            if(is_uploaded_file($_FILES["file"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_file_allowed;
                $config['file_name'] = time().random_string('alnum', 4);
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("file")) {
                    echo $this->upload->display_errors();
                } else {
                    $file = $this->upload->data();
                }
            }            

            if (isset($file) && $file['file_name']) {
                $option['file_path'] = $upload_uri;
                $option['file_name'] = $file['file_name'];
            } else {
                $option['file_path'] = null;
                $option['file_name'] = null;
            }

            $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

    //            print_r($option); exit;

            $this->site_model->insertNotice($option);

            $this->session->set_flashdata('message', '정상 등록되었습니다.');
            redirect('mgr/site/notice');
        }

        $this->_admin_footer();
    }


    // 공지사항 정보 보기
    public function notice_info() {
        $data['current_menu_code'] = "0201";
        $this->_admin_header($data);

        $seq = $this->input->get('seq');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $page = $this->input->get('page');

        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date;

        // 정보 가져오기
        $data['notice'] = $this->site_model->getNotice(array('seq' => $seq));

        $data['count'] = $this->site_model->getNoticeImportantCount();
        
        $data['params'] = $params;
        $data['pageName'] = 'mgr/site/notice_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 공지사항 정보 수정
    public function notice_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $option = $this->input->post();

        // Upload 디렉토리 설정
        $path = "/notice/".date('Y')."/".date('m');
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

        $notice = $this->site_model->getNotice(array('seq' => $this->input->post('seq')));
        
        // 첨부 있는 경우..
        if(is_uploaded_file($_FILES["file"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file")) {
                echo $this->upload->display_errors();
            } else {
                $file = $this->upload->data();
            }
        } 

        if (isset($file) && $file['file_name']) {
            $option['file_path'] = $upload_uri;
            $option['file_name'] = $file['file_name'];
        } else {
            if ($option['img_del'] == "D") {
                $option['file_path'] = null;
                $option['file_name'] = null;

                $oldFile = $this->global_root_path.$notice->file_path."/".$notice->file_name;
                //echo $oldFile; exit;
                if (file_exists($oldFile)) unlink($oldFile);
            } else {
                $option['file_path'] = $notice->file_path;
                $option['file_name'] = $notice->file_name;
            }
        }

        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->site_model->updateNotice($option);

        if (isset($file) && $notice->file_name) {            
            $oldFile = $this->global_root_path.$notice->file_path."/".$notice->file_name;
            //echo $oldFile; exit;
            if (file_exists($oldFile)) unlink($oldFile);
        }

        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/site/notice?'.$option['params']);

        $this->_admin_footer();
    }
    
    // 공지사항 삭제
    public function notice_delete() {
        $option = $this->input->post();
        //print_r($option); exit;
        
        $this->site_model->deleteNotice($option);

        $this->session->set_flashdata('message', '공지사항이 삭제되었습니다.');
        redirect('mgr/site/notice');
    }
    
    // 공지사항 중요 수
    public function notice_check() {
        $count = $this->site_model->getNoticeImportantCount();
        
        echo $count;
    }
    
    
    // 대시보드 조회
    public function dashboard() {
        $data['current_menu_code'] = "0205";
        $this->_admin_header($data);

        $mode = "";

        // 정보 가져오기
        $data['dashboard'] = $this->site_model->getDashboard();

        $data['mode'] = "update";
        $data['pageName'] = 'mgr/site/dashboard_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 대시보드 insert/update
    public function dashboard_action() {
        $data['current_menu_code'] = "0205";
        $this->_admin_header($data);

        $option = $this->input->post();

        
        $this->site_model->updateDashboard($option);

        // 정보 가져오기
        $data['dashboard'] = $this->site_model->getDashboard();

        $data['mode'] = "update";
        $data['pageName'] = 'mgr/site/dashboard_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }
    
    
    // 요금안내 조회
    public function fee() {
        $data['current_menu_code'] = "0206";
        $this->_admin_header($data);

        $mode = "";

        // 정보 가져오기
        $data['feeList'] = $this->site_model->getFee();
        
        // 정보 가져오기
        $data['feeHistory'] = $this->site_model->getFeeHistory();

        $data['mode'] = "update";
        $data['pageName'] = 'mgr/site/fee_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 요금안내 insert/update
    public function fee_insert() {
        $option = $this->input->post();

        $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->site_model->insertFee($option);

        $this->session->set_flashdata('message', '정상 등록되었습니다.');
        redirect('mgr/site/fee');
    }
    
    // 요금안내 insert/update
    public function fee_update() {
        $option = $this->input->post();
        //print_r($option); exit;
        
        $this->site_model->updateFee($option);

        $this->session->set_flashdata('message', '정상 수정되었습니다.');
        redirect('mgr/site/fee');
    }
    
    // 요금안내 insert/update
    public function fee_delete() {
        $option = $this->input->post();
        //print_r($option); exit;
        
        $this->site_model->deleteFee($option);

        $this->session->set_flashdata('message', '정상 삭제되었습니다.');
        redirect('mgr/site/fee');
    }
    
    // 요금안내 선택삭제
    public function fee_chkdelete() {
        $arrNo = $this->input->post('checkno');
        //print_r($arrNo); exit;
        
        foreach ($arrNo as $i => $no) {
            $this->site_model->deleteFee(array('del_seq' => $no)); 
        }
        
        $this->session->set_flashdata('message', '정상 삭제되었습니다.');
        redirect('mgr/site/fee');
    }
    
    
    // 사이트관리 - 공시정보
    public function finance() {
        $data['current_menu_code'] = "0207";
        $this->_admin_header($data);

        $s_string = $this->input->get('s_string');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_month = $this->input->get('s_month');
        $limit_size = $this->input->get('limit_size');
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;
        
        if ($this->input->get('s_month'))
            $s_month = $this->input->get('s_month');
        else
            $s_month = "30";
        
        if ($this->input->get('start_date') && $this->input->get('end_date')) {
            
        } else {
            $start_date = date("Y-m-d", strtotime("-1 months"));
            $end_date = date('Y-m-d');
        }
        
        $block_size = 10;

        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 10;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_string'		=> $s_string,
            'start_date'	=> $start_date,
            'end_date'		=> $end_date . " 23:59",
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );
//print_r($option);
        $data['s_string'] = $s_string;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['s_month'] = $s_month;
        $params = "page=".$page."&s_string=".$s_string."&start_date=".$start_date."&end_date=".$end_date."&s_month=".$s_month;

        // 전체 데이터 수
        $total_count = $this->site_model->getFinanceListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $financeList = $this->site_model->getFinanceList($option);

        // Pagination
        $url = '/mgr/site/finance' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['financeList'] = $financeList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/site/finance_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // SNS 등록
    public function finance_insert() {
        $data['current_menu_code'] = "0207";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $limit_size = $this->input->get('limit_size');

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('title', '제목', 'trim|required|min_length[1]');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            $data['pageName'] = 'mgr/site/finance_write';

            $this->load->view($this->global_layout_manager, $data);
        } else {			
            $option = $this->input->post();

            // Upload 디렉토리 설정
            $path = "/finance/".date('Y')."/".date('m');
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
            if(is_uploaded_file($_FILES["file"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_file_allowed;
                $config['file_name'] = time().random_string('alnum', 4);
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("file")) {
                    echo $this->upload->display_errors();
                } else {
                    $file = $this->upload->data();
                }
            }            

            if (isset($file) && $file['file_name']) {
                $option['file_path'] = $upload_uri;
                $option['file_name'] = $file['file_name'];
            } else {
                $option['file_path'] = null;
                $option['file_name'] = null;
            }

            $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

            $this->site_model->insertFinance($option);

            $this->session->set_flashdata('message', '정상 등록되었습니다.');
            redirect('mgr/site/finance');
        }

        $this->_admin_footer();
    }


    // 공지사항 정보 보기
    public function finance_info() {
        $data['current_menu_code'] = "0207";
        $this->_admin_header($data);

        $seq = $this->input->get('seq');
        $s_string = $this->input->get('s_string');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $page = $this->input->get('page');

        $params = "page=".$page."&s_string=".$s_string."&start_date=".$start_date."&end_date=".$end_date;
        
        // 정보 가져오기
        $data['finance'] = $this->site_model->getFinance(array('seq' => $seq));

        $data['params'] = $params;
        $data['pageName'] = 'mgr/site/finance_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 공지사항 정보 수정
    public function finance_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $option = $this->input->post();

        // Upload 디렉토리 설정
        $path = "/finance/".date('Y')."/".date('m');
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
        if(is_uploaded_file($_FILES["file"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file")) {
                echo $this->upload->display_errors();
            } else {
                $file = $this->upload->data();
            }
        } 

        $finance = $this->site_model->getFinance(array('seq' => $this->input->post('seq')));
        
        if (isset($file) && $file['file_name']) {
            $option['file_path'] = $upload_uri;
            $option['file_name'] = $file['file_name'];
        } else {
            if ($option['img_del'] == "D") {
                $option['file_path'] = null;
                $option['file_name'] = null;

                $oldFile = $this->global_root_path.$finance->file_path."/".$finance->file_name;
                //echo $oldFile; exit;
                if (file_exists($oldFile)) unlink($oldFile);
            } else {
                $option['file_path'] = $finance->file_path;
                $option['file_name'] = $finance->file_name;
            }
        }

        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->site_model->updateFinance($option);

        if (isset($file) && $finance->file_name) {            
            $oldFile = $this->global_root_path.$finance->file_path."/".$finance->file_name;
            //echo $oldFile; exit;
            if (file_exists($oldFile)) unlink($oldFile);
        }

        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/site/finance');

        $this->_admin_footer();
    }
    
    public function finance_delete() {
        $option = $this->input->post();
        //print_r($option); exit;
        
        $this->site_model->deleteFinance($option);

        $this->session->set_flashdata('message', '공시정보가 삭제되었습니다.');
        redirect('mgr/site/finance');
    }
    
    
    // 사이트관리 - 이벤트
    public function event() {
        $data['current_menu_code'] = "0208";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_month = $this->input->get('s_month');
        $s_status = $this->input->get('s_status');
        $limit_size = $this->input->get('limit_size');
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        if ($this->input->get('s_month'))
            $s_month = $this->input->get('s_month');
        else
            $s_month = "30";
        
        if ($this->input->get('s_term'))
            $s_term = $this->input->get('s_term');
        else
            $s_term = "regist_date";
        
        if ($this->input->get('start_date') && $this->input->get('end_date')) {
            
        } else {
            $start_date = date("Y-m-d", strtotime("-1 months"));
            $end_date = date('Y-m-d');
        }
        
        $block_size = 10;

        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 10;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            's_term'		=> $s_term,
            'start_date'	=> $start_date,
            'end_date'		=> $end_date . " 23:59",
            's_status'		=> $s_status,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['s_term'] = $s_term;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['s_month'] = $s_month;
        $data['s_status'] = $s_status;
        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_month=".$s_month."&s_status=".$s_status;

        // 전체 데이터 수
        $total_count = $this->site_model->getEventListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $eventList = $this->site_model->getEventList($option);

        // Pagination
        $url = '/mgr/site/event' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['eventList'] = $eventList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/site/event_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // SNS 등록
    public function event_insert() {
        $data['current_menu_code'] = "0208";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_status = $this->input->get('s_status');
        $page = $this->input->get('page');

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('title', '제목', 'trim|required|min_length[1]');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_status=".$s_status;

            $data['params'] = $params;
            $data['pageName'] = 'mgr/site/event_write';

            $this->load->view($this->global_layout_manager, $data);
        } else {			
            $option = $this->input->post();

            // Upload 디렉토리 설정
            $path = "/event/".date('Y')."/".date('m');
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
            if(is_uploaded_file($_FILES["file_pc"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_file_allowed;
                $config['file_name'] = time().random_string('alnum', 4);
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("file_pc")) {
                    echo $this->upload->display_errors();
                } else {
                    $file = $this->upload->data();
                }
            }

            if (isset($file) && $file['file_name']) {
                $option['file_path_pc'] = $upload_uri;
                $option['file_name_pc'] = $file['file_name'];
            } else {
                $option['file_path_pc'] = null;
                $option['file_name_pc'] = null;
            }

            // 첨부 있는 경우..
            if(is_uploaded_file($_FILES["file_mo"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_file_allowed;
                $config['file_name'] = time().random_string('alnum', 4);
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("file_mo")) {
                    echo $this->upload->display_errors();
                } else {
                    $file2 = $this->upload->data();
                }
            }

            if (isset($file2) && $file2['file_name']) {
                $option['file_path_mo'] = $upload_uri;
                $option['file_name_mo'] = $file2['file_name'];
            } else {
                $option['file_path_mo'] = null;
                $option['file_name_mo'] = null;
            }
            
            
            $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

            $this->site_model->insertEvent($option);

            $this->session->set_flashdata('message', '정상 등록되었습니다.');
            redirect('mgr/site/event');
        }

        $this->_admin_footer();
    }


    // 공지사항 정보 보기
    public function event_info() {
        $data['current_menu_code'] = "0208";
        $this->_admin_header($data);

        $seq = $this->input->get('seq');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $page = $this->input->get('page');

        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date;

        // 정보 가져오기
        $data['event'] = $this->site_model->getEvent(array('seq' => $seq));

        $data['params'] = $params;
        $data['pageName'] = 'mgr/site/event_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 공지사항 정보 수정
    public function event_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $option = $this->input->post();

        // Upload 디렉토리 설정
        $path = "/event/".date('Y')."/".date('m');
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

        $event = $this->site_model->getEvent(array('seq' => $this->input->post('seq')));
        
        // 첨부 있는 경우..
        if(is_uploaded_file($_FILES["file_pc"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file_pc")) {
                echo $this->upload->display_errors();
            } else {
                $file = $this->upload->data();
            }
        } 

        if (isset($file) && $file['file_name']) {
            $option['file_path_pc'] = $upload_uri;
            $option['file_name_pc'] = $file['file_name'];
        } else {
            if ($option['img_del_pc'] == "D") {
                $option['file_path_pc'] = null;
                $option['file_name_pc'] = null;

                $oldFile = $this->global_root_path.$event->file_path_pc."/".$event->file_name_pc;
                //echo $oldFile; exit;
                if (file_exists($oldFile)) unlink($oldFile);
            } else {
                $option['file_path_pc'] = $event->file_path_pc;
                $option['file_name_pc'] = $event->file_name_pc;
            }
        }
        
        // 첨부 있는 경우..
        if(is_uploaded_file($_FILES["file_mo"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file_mo")) {
                echo $this->upload->display_errors();
            } else {
                $file2 = $this->upload->data();
            }
        } 

        if (isset($file2) && $file2['file_name']) {
            $option['file_path_mo'] = $upload_uri;
            $option['file_name_mo'] = $file2['file_name'];
        } else {
            if ($option['img_del_mo'] == "D") {
                $option['file_path_mo'] = null;
                $option['file_name_mo'] = null;

                $oldFile = $this->global_root_path.$event->file_path_mo."/".$event->file_name_mo;
                //echo $oldFile; exit;
                if (file_exists($oldFile)) unlink($oldFile);
            } else {
                $option['file_path_mo'] = $event->file_path_mo;
                $option['file_name_mo'] = $event->file_name_mo;
            }
        }

        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->site_model->updateEvent($option);

        if (isset($file) && $event->file_name_pc) {            
            $oldFile = $this->global_root_path.$event->file_path_pc."/".$event->file_name_pc;
            //echo $oldFile; exit;
            if (file_exists($oldFile)) unlink($oldFile);
        }

        if (isset($file2) && $event->file_name_mo) {            
            $oldFile = $this->global_root_path.$event->file_path_mo."/".$event->file_name_mo;
            //echo $oldFile; exit;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        
        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/site/event');

        $this->_admin_footer();
    }
    
    public function event_delete() {
        $option = $this->input->post();
        //print_r($option); exit;
        
        $this->site_model->deleteEvent($option);

        $this->session->set_flashdata('message', '이벤트가 삭제되었습니다.');
        redirect('mgr/site/event');
    }
    
    
    // 운영정보 조회
    public function operation() {
        $data['current_menu_code'] = "0202";
        $this->_admin_header($data);

        $mode = "";

        // 정보 가져오기
        $data['operation'] = $this->site_model->getOperation();

        if(!$data['operation']) {
            $mode = "insert";
        } else {
            $mode = "update";
        }

        $data['mode'] = $mode;
        $data['pageName'] = 'mgr/site/operation_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 운영정보 insert/update
    public function operation_action() {
        $data['current_menu_code'] = "0202";
        $this->_admin_header($data);

        $option = $this->input->post();

        if($option['mode'] == "insert") {
            $this->site_model->insertOperation($option);
        } else if($option['mode'] == "update") {
            $this->site_model->updateOperation($option);
        }

        // 정보 가져오기
        $data['operation'] = $this->site_model->getOperation();

        if(!$data['operation']) {
            $mode = "insert";
        } else {
            $mode = "update";
        }

        $data['mode'] = $mode;
        $data['pageName'] = 'mgr/site/operation_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

}