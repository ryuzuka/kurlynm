<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        //$this->output->enable_profiler(true);
        
        $this->load->model('member_model');
        $this->load->model('code_model');
        $this->load->helper('directory');
        $this->load->helper('string');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "0204";
        
        $this->excel_limit = 20000;
        
        $this->member_path = "/mgr/member/";
    }


    public function total_list() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_month = $this->input->get('s_month');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
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
            's_term'		=> $s_term,
            'start_date'	=> $start_date,
            'end_date'		=> $end_date . " 23:59",
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size,
            'status'    	=> 'Y',
        );

        $data['s_term'] = $s_term;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['s_month'] = $s_month;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $params = "limit_size=".$limit_size."&page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_month=".$s_month;

        // 전체 데이터 수
        $total_count = $this->member_model->getMemberListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $memberList = $this->member_model->getMemberList($option);

        // Pagination
        $url = '/mgr/member/total_list' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['memberList'] = $memberList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['limit_size'] = $limit_size;
        $data['pagination'] = $pagination;
        $data['down_count'] = ceil($total_count / $this->excel_limit);

        $data['pageName'] = 'mgr/member/total_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }
    
    public function secession_list() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_month = $this->input->get('s_month');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
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
            $limit_size = 15;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_term'		=> $s_term,
            'start_date'	=> $start_date,
            'end_date'		=> $end_date . " 23:59",
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size,
            'status'        => 'N'
        );

        $data['s_term'] = $s_term;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['s_month'] = $s_month;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $params = "limit_size=".$limit_size."&page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_month=".$s_month;

        // 전체 데이터 수
        $total_count = $this->member_model->getSecessionMemberListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $memberList = $this->member_model->getSecessionMemberList($option);

        // Pagination
        $url = '/mgr/member/secession_list' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['memberList'] = $memberList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['limit_size'] = $limit_size;
        $data['pagination'] = $pagination;
        $data['down_count'] = ceil($total_count / $this->excel_limit);

        $data['pageName'] = 'mgr/member/secession_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }
    
    // 전체 회원 엑셀
    public function total_excel() {
        $this->output->enable_profiler(false);		// 디버그용 결과

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $down_cnt = $this->input->get('down_cnt');
        
        $limit_start = $this->excel_limit * ($down_cnt - 1);
        $limit_size = $this->excel_limit;

        $option = array(
            's_field' => $s_field,
            's_string' => $s_string,
            'limit_start' => $limit_start,
            'limit_size' => $limit_size
        );
        // 데이터 목록
        $memberList = $this->member_model->getMemberListExcel($option);
        
        Header("Content-type: application/vnd.ms-excel; charset=UTF-8; ");
	Header("Content-Disposition: attachment; filename=전체회원목록_".date("Ymd",time()).".csv");
	Header("Content-type: application/octet-stream"); 
        Header("Content-Transfer-Encoding: binary"); 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Content-type: application/octet-stream\r\n" );
        header("Cache-control: private"); 
        Header("Expires: 0");  
        
        echo "\xEF\xBB\xBF"; // 한글 깨짐 방지
        
	if($memberList){
            echo "번호,아이디,이름,휴대폰,이메일,프론티어,생년월일,성별,국적,접속횟수,최근로그인,가입일,상태 \r\n";
            
            foreach ($memberList as $i => $list) {
                $no = $i + 1 + $limit_start;
                if ($list->gender == '0') {
                    $gender = '여';
                } else if($list->gender == '1') {
                    $gender = '남';
                } else {
                    $gender = '';
                }
                if ($list->forigner == '0') {
                    $forigner = '내국인';
                } else if($list->forigner == '1') {
                    $forigner = '외국인';
                } else {
                    $forigner = '';
                }
                
                $mobile = str_replace("-", "", $list->dec_mobile);
                $len = strlen($mobile);
                if ($len == 10)
                    $dec_mobile = substr($mobile, 0, 3)."-".substr($mobile, 3, 3)."-".substr($mobile, 6, 4);
                else if ($len == 11)
                    $dec_mobile = substr($mobile, 0, 3)."-".substr($mobile, 3, 4)."-".substr($mobile, 7, 4);
                else if ($len == 12)
                    $dec_mobile = substr($mobile, 0, 4)."-".substr($mobile, 4, 4)."-".substr($mobile, 8, 4);
                else
                    $dec_mobile = $mobile;
                
                $access_cnt = number_format($list->count);
                $member_st = ($list->status == 'Y') ? '회원': '탈퇴';
                $dec_birthday = ($list->dec_birthday) ? date('Y-m-d', strtotime($list->dec_birthday)) : "";
                echo "$no,$list->member_id,$list->member_name,$dec_mobile,$list->dec_email,$list->frontier,$dec_birthday,$gender,$forigner,$access_cnt,$list->login_date,$list->regist_date,$member_st \r\n";
            }
            
        } else {
            echo "일치하는 정보가 없습니다";
        }
    }
    
    public function insert() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $limit_size = $this->input->get('limit_size');

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('member_id', '아이디', 'trim|required|min_length[4]|max_length[20]|is_unique[tb_member.member_id]');// is_unique[tb_admin.admin_id] - 내부적으로 DB 연동하여 unique 체크
        $this->form_validation->set_rules('member_passwd', '비밀번호', 'trim|required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('member_passwd2', '비밀번호 확인', 'trim|required|matches[member_passwd]');
        $this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email|is_unique[tb_member.email]');        

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            $params = "limit_size=".$limit_size."&page=".$page."&s_field=".$s_field."&s_string=".$s_string;

            $data['params'] = $params;
            $data['pageName'] = 'mgr/member/write';

            $this->load->view($this->global_layout_manager, $data);
        } else {
            if(!function_exists('password_hash')){
                $this->load->helper('password');
            }

            $hash = password_hash($this->input->post('member_passwd'), PASSWORD_BCRYPT);

            $option = array(
                'member_id' => $this->input->post('member_id'),
                'member_passwd' => $hash,
                'hash' => $hash,
                'email' => $this->input->post('email'),
                'acceptance' => 'N'
            );

            $this->member_model->insertMember($option);

            $this->session->set_flashdata('message', '정상 등록되었습니다.');
            redirect('mgr/member/total_list');
        }

        $this->_admin_footer();
    }


    public function update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $limit_size = $this->input->get('limit_size');

        $params = "limit_size=".$limit_size."&page=".$page."&s_field=".$s_field."&s_string=".$s_string;

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('member_id', '아이디', 'required');
        $this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email');
        $this->form_validation->set_rules('status', '상태', 'required');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            // 정보 가져오기
            $data['member'] = $this->member_model->getMember(array('member_id' => $this->input->get('member_id')));
//echo password_hash('qkrwogns0508', PASSWORD_BCRYPT); exit;
            $data['params'] = $params;
            $data['pageName'] = 'mgr/member/info';
            $this->load->view($this->global_layout_manager, $data);
        } else {

            $option = $this->input->post();

            $this->member_model->updateMember($option);

            $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
            redirect('mgr/member/update?member_id='.$this->input->post('member_id').'&'.$params);
        }

        $this->_admin_footer();
    }


    // 프론티어 리스트
    public function frontier_list() {
        $data['current_menu_code'] = "0202";
        $this->_admin_header($data);

        $s_road_group = $this->input->get('s_road_group');
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
            's_road_group'		=> $s_road_group,
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size,
            'level'         => '9'
        );

        $data['s_road_group'] = $s_road_group;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $params = "s_road_group=".$s_road_group."&page=".$page."&s_field=".$s_field."&s_string=".$s_string;

        // 전체 데이터 수
        $total_count = $this->member_model->getFrontierListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $memberList = $this->member_model->getFrontierList($option);

        // 기수 코드
        $data['groupCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'G01'));
        
        // Pagination
        $url = '/mgr/member/frontier_list' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['memberList'] = $memberList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/member/frontier_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }
    
    // 프론티어 회원 엑셀
    public function frontier_excel() {
        $this->output->enable_profiler(false);		// 디버그용 결과

        $s_road_group = $this->input->get('s_road_group');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');

        $option = array(
            's_road_group' => $s_road_group,
            's_field' => $s_field,
            's_string' => $s_string
        );
        // 데이터 목록
        $memberList = $this->member_model->getFrontierList($option);
        
        Header("Content-type: application/vnd.ms-excel; charset=UTF-8; ");
	Header("Content-Disposition: attachment; filename=프론티어회원목록_".date("Ymd",time()).".csv");
	Header("Content-type: application/octet-stream"); 
        Header("Content-Transfer-Encoding: binary"); 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Content-type: application/octet-stream\r\n" );
        header("Cache-control: private"); 
        Header("Expires: 0");  
        
        echo "\xEF\xBB\xBF"; // 한글 깨짐 방지
        
	if($memberList){
            echo "번호,기수,조,이름,영문이름,나이,성별,대학교,학부,전공,가입일,상태 \r\n";
            
            foreach ($memberList as $i => $list) {
                $no = $i+1;
                if ($list->status == 'A') {
                    $member_st = '1차 지원';
                } else if($list->status == 'B') {
                    $member_st = '1차 합격';
                } else if($list->status == 'C') {
                    $member_st = '2차 합격';
                } else if($list->status == 'F') {
                    $member_st = '최종선발';
                } else {
                    $member_st = '';
                }
                
                if ($list->regist_date != '') {
                    $regist_date = date('Y-m-d', strtotime($list->regist_date));
                } else {
                    $regist_date = "";
                }
                
                echo "$no,$list->group_cd,$list->road_part,$list->member_name,$list->eng_name,$list->age,$list->gender,$list->univ_name,$list->dept,$list->major,$regist_date,$member_st \r\n";
            }
            
        } else {
            echo "일치하는 정보가 없습니다";
        }
    }


    // 프론티어 정보
    public function frontier_info() {
        $data['current_menu_code'] = "0202";
        $this->_admin_header($data);

        $s_road_group = $this->input->get('s_road_group');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');

        $params = "s_road_group=".$s_road_group."&page=".$page."&s_field=".$s_field."&s_string=".$s_string;

        // 기수 코드
        $data['groupCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'G01'));
        
        // 정보 가져오기
        $data['member'] = $this->member_model->getFrontier(array('seq' => $this->input->get('seq')));

        $data['params'] = $params;
        $data['pageName'] = 'mgr/member/frontier_info';
        $this->load->view($this->global_layout_manager, $data);


        $this->_admin_footer();
    }


    
    // 프론티어 정보 수정
    public function frontier_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        $option = $this->input->post();
        
        // Upload 디렉토리 설정
        $path = "/frontier/".date('Y')."/".date('m');
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
        if(is_uploaded_file($_FILES["photo_file"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_image_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("photo_file")) {
                echo $this->upload->display_errors();
            } else {
                $photo_file = $this->upload->data();
            }
        } 
        
        if (isset($photo_file) && $photo_file['file_name']) {
            $option['photo_file_path'] = $upload_uri;
            $option['photo_file_name'] = $photo_file['file_name'];
        } else {
            $option['photo_file_path'] = null;
            $option['photo_file_name'] = null;
        }
        
        $member = $this->member_model->getFrontier(array('seq' => $this->input->post('seq')));

        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->member_model->updateFrontier($option);

        if (isset($photo_file) && $album->photo_file_name) {            
            $oldFile = $this->global_root_path.$member->photo_file_path."/".$member->photo_file_name;
            //echo $oldFile; exit;
            if (file_exists($oldFile)) unlink($oldFile);
        }

        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/member/frontier_info?seq='.$option['seq'].'&'.$option['params']);

        $this->_admin_footer();
    }
    
    
    // 검색용 팝업
    public function search()
    {
        $data['current_menu_cd'] = "9906";
        $this->_header($data);

        // 리턴받을 함수명
        $func = $this->input->get('func');
        if (!$func) {
            alert_close("Page not found.");
        }

        // Parameter
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $limit_size = $this->input->get('limit_size');

        if ($this->input->get('page')) 
            $page = $this->input->get('page');
        else
            $page = 1;

        // List 설정 값
        $block_size = 5;
        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 15;
        }
        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'	=> $s_field,
            's_string'	=> $s_string,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );
        $params = "func=".$func."&limit_size=".$limit_size."&s_field=".$s_field."&s_string=".$s_string;

        // 전체 데이터 수
        $total_count = $this->member_model->getMemberListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $memberList = $this->member_model->getMemberList($option);

        // Pagination
        $url = base_url('mgr/member/search') . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['func'] = $func;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['limit_size'] = $limit_size;
        $data['memberList'] = $memberList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;
        $data['params'] = $params;

        $data['pageName'] = 'mgr/member/popup_member_search';
        $this->load->view($this->global_layout_manager_popup, $data);

        $this->_footer();
    }


    // 자랑스러운 얼굴 검색용 팝업
    public function search_proud()
    {
        $data['current_menu_cd'] = "9906";
        $this->_header($data);

        // 리턴받을 함수명
        $func = $this->input->get('func');
        
        if (!$func) {
            alert_close("Page not found.");
        }

        // Parameter
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $limit_size = $this->input->get('limit_size');

        if ($this->input->get('page')) 
            $page = $this->input->get('page');
        else
            $page = 1;

        // List 설정 값
        $block_size = 5;
        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 15;
        }
        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'	=> $s_field,
            's_string'	=> $s_string,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );
        $params = "func=".$func."&limit_size=".$limit_size."&s_field=".$s_field."&s_string=".$s_string;

        // 전체 데이터 수
        $total_count = $this->member_model->getProudMemberListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $memberList = $this->member_model->getProudMemberList($option);

        // Pagination
        $url = base_url('mgr/member/search') . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['func'] = $func;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['limit_size'] = $limit_size;
        $data['memberList'] = $memberList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;
        $data['params'] = $params;

        $data['pageName'] = 'mgr/member/popup_proud_search';
        $this->load->view($this->global_layout_manager_popup, $data);

        $this->_footer();
    }
}
