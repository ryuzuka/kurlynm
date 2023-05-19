<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resume extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Resume_model');
        $this->load->model('Code_model');
        $this->load->model('Region_model');
        $this->load->helper('paging');
        $this->load->helper('directory');
        $this->load->helper("alert");
        
        $this->current_menu_code = "0";
	}

    
	public function index() {
        // 로그인 체크
        $this->_require_login($_SERVER['REQUEST_URI']);
        
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['divisions'] = $this->Code_model->getUseCodeList(array('scheme_code'=>"DIV"));
        $data['positions'] = $this->Code_model->getUseCodeList(array('scheme_code'=>"POS"));
        $data['regions'] = $this->Region_model->getRegion();
        
        $data['resume'] = $this->Resume_model->getResume(array('email'=>$this->session->userdata('UID')));
        
        $data['pageTitle'] = "Resume";
        $data['pageName'] = $this->global_device_view.'/resume/standby';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }
    
    public function standby_process() {
        $option = $this->input->post();
        $option['email'] = $this->session->userdata('UID');
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];
        
        // 이력서 업데이트
        $this->Resume_model->updateResume($option);
        
        redirect('resume/step01');
    }

    
	public function step01() {
        // 로그인 체크
        $this->_require_login($_SERVER['REQUEST_URI']);
        
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['status'] = $this->Code_model->getUseCodeList(array('scheme_code'=>"MAR"));
        $data['housings'] = $this->Code_model->getUseCodeList(array('scheme_code'=>"HOU"));
        $data['edus'] = $this->Code_model->getUseCodeList(array('scheme_code'=>"EDU"));
        
        $data['resume'] = $this->Resume_model->getResume(array('email'=>$this->session->userdata('UID')));
        
        $data['pageTitle'] = "Resume";
        $data['pageName'] = $this->global_device_view.'/resume/step01';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }

    public function step01_process() {
        $option = $this->input->post();
        
        // Upload 디렉토리 설정
        $path = "/user/".date('Y')."/".date('m');
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

        // 첨부 이미지가 있는 경우..
        if(is_uploaded_file($_FILES["photo_file"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_image_allowed;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload("photo_file")) {
                echo $this->upload->display_errors();
            } else {
                $img = $this->upload->data();
            }
        }
        
        $this->load->library('encrypt');
        $option['email'] = $this->encrypt->decode($option['email']);
        
        $resume = $this->Resume_model->getResume(array('email'=>$option['email']));
        
        if ($img['file_name']) {
            $option['photo_filepath'] = $upload_uri;
            $option['photo_filename'] = $img['file_name'];
        } else {
            $option['photo_filepath'] = null;
            $option['photo_filename'] = null;
        }
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];
        
        // 이력서 업데이트
        $this->Resume_model->updateResume($option);
        
        // 새로운 파일이 업로드 된후.. 기존 파일이 있으면 삭제..
        if ($img['file_name'] && $resume->photo_filename) {
            $oldFile = $this->global_root_path.$resume->photo_filepath."/".$resume->photo_filename;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        
        redirect('resume/step02');
    }
    
    
	public function step02() {
        // 로그인 체크
        $this->_require_login($_SERVER['REQUEST_URI']);
        
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['level'] = $this->Code_model->getUseCodeList(array('scheme_code'=>"LEV"));
        
        $data['resume'] = $this->Resume_model->getResume(array('email'=>$this->session->userdata('UID')));
        
        $data['pageTitle'] = "Resume";
        $data['pageName'] = $this->global_device_view.'/resume/step02';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }
    
    public function step02_process() {
        $option = $this->input->post();
        
        $this->load->library('encrypt');
        $option['email'] = $this->encrypt->decode($option['email']);
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];
        
        // 이력서 업데이트
        $this->Resume_model->updateResume($option);
        
        redirect('resume/step03');
    }
    
    
	public function step03() {
        // 로그인 체크
        $this->_require_login($_SERVER['REQUEST_URI']);
        
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['sector'] = $this->Code_model->getUseCodeList(array('scheme_code'=>"SEC"));
        
        $data['resume'] = $this->Resume_model->getResume(array('email'=>$this->session->userdata('UID')));
        
        $data['pageTitle'] = "Resume";
        $data['pageName'] = $this->global_device_view.'/resume/step03';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }
    
    public function step03_process() {
        $option = $this->input->post();
        
        $this->load->library('encrypt');
        $option['email'] = $this->encrypt->decode($option['email']);
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];
        
        $option['career_start_date1'] = ($option['career_start_date1']) ? date('Y-m-d', strtotime($option['career_start_date1'])) : "";
        $option['career_end_date1'] = ($option['career_end_date1']) ? date('Y-m-d', strtotime($option['career_end_date1'])) : "";
        $option['career_start_date2'] = ($option['career_start_date2']) ? date('Y-m-d', strtotime($option['career_start_date2'])) : "";
        $option['career_end_date2'] = ($option['career_end_date2']) ? date('Y-m-d', strtotime($option['career_end_date2'])) : "";
        $option['career_start_date3'] = ($option['career_start_date3']) ? date('Y-m-d', strtotime($option['career_start_date3'])) : "";
        $option['career_end_date3'] = ($option['career_end_date3']) ? date('Y-m-d', strtotime($option['career_end_date3'])) : "";
        $option['career_start_date4'] = ($option['career_start_date4']) ? date('Y-m-d', strtotime($option['career_start_date4'])) : "";
        $option['career_end_date4'] = ($option['career_end_date4']) ? date('Y-m-d', strtotime($option['career_end_date4'])) : "";
        
        // 이력서 업데이트
        $this->Resume_model->updateResume($option);
        
        redirect('resume/step04');
    }
    
    
	public function step04() {
        // 로그인 체크
        $this->_require_login($_SERVER['REQUEST_URI']);
        
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['resume'] = $this->Resume_model->getResume(array('email'=>$this->session->userdata('UID')));
        
        $data['pageTitle'] = "Resume";
        $data['pageName'] = $this->global_device_view.'/resume/step04';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }
    
    public function step04_process() {
        $option = $this->input->post();
        
        // Upload 디렉토리 설정
        $path = "/resume/".date('Y')."/".date('m');
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
            $config['allowed_types'] = $this->global_upload_file_allowed."|".$this->global_upload_image_allowed;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload("file1")) {
                echo $this->upload->display_errors();
            } else {
                $file1 = $this->upload->data();
            }
        }
        if(is_uploaded_file($_FILES["file2"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed."|".$this->global_upload_image_allowed;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload("file2")) {
                echo $this->upload->display_errors();
            } else {
                $file2 = $this->upload->data();
            }
        }
        if(is_uploaded_file($_FILES["file3"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed."|".$this->global_upload_image_allowed;
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload("file3")) {
                echo $this->upload->display_errors();
            } else {
                $file3 = $this->upload->data();
            }
        }
        
        $this->load->library('encrypt');
        $option['email'] = $this->encrypt->decode($option['email']);
        
        $resume = $this->Resume_model->getResume(array('email'=>$option['email']));
        
        if (isset($file1) && $file1['file_name']) {
            $option['filepath1'] = $upload_uri;
            $option['filename1'] = $file1['file_name'];
        } else {
            $option['filepath1'] = null;
            $option['filename1'] = null;
        }
        if (isset($file2) && $file2['file_name']) {
            $option['filepath2'] = $upload_uri;
            $option['filename2'] = $file2['file_name'];
        } else {
            $option['filepath2'] = null;
            $option['filename2'] = null;
        }
        if (isset($file3) && $file3['file_name']) {
            $option['filepath3'] = $upload_uri;
            $option['filename3'] = $file3['file_name'];
        } else {
            $option['filepath3'] = null;
            $option['filename3'] = null;
        }
        
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];
        $option['submit_ip'] = $_SERVER["REMOTE_ADDR"];
        
        // 이력서 업데이트
        $this->Resume_model->updateResume($option);
        
        // 새로운 파일이 업로드 된후.. 기존 파일이 있으면 삭제..
        if ($file1['file_name'] && $resume->filename1) {
            $oldFile = $this->global_root_path.$resume->filepath1."/".$resume->filename1;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        if ($file2['file_name'] && $resume->filename2) {
            $oldFile = $this->global_root_path.$resume->filepath2."/".$resume->filename2;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        if ($file3['file_name'] && $resume->filename3) {
            $oldFile = $this->global_root_path.$resume->filepath3."/".$resume->filename3;
            if (file_exists($oldFile)) unlink($oldFile);
        }
        
        redirect('resume/step05');
    }
    
    
	public function step05() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "Resume";
        $data['pageName'] = $this->global_device_view.'/resume/step05';
		$this->load->view($this->global_layout_front, $data);
        
		$this->_footer();
    }
    
    
    
    
    
    
    public function getState() {
        $regionId = $this->input->get('regionId');
        $stateId = $this->input->get('stateId');
        
        $states = $this->Region_model->getState(array('regionId'=>$regionId));
        
        $html = '<select name="stateId" id="stateId" class="w360">';
        $html .= '<option value="">-- State --</option>';
        foreach ($states as $i => $list) {
            $html .= '<option value="'.$list->stateId.'"'.(($stateId == $list->stateId) ? " selected" : "").'>'.$list->stateName.'</option>';
        }
        $html .= '<option value="0"'.(($stateId == "0") ? " selected" : "").'>Other</option>';
        $html .= '</select>';
        
        echo $html;
    }

    
    public function getCity() {
        $stateId = $this->input->get('stateId');
        $cityId = $this->input->get('cityId');
        
        $citys = $this->Region_model->getCity(array('stateId'=>$stateId));
        
        $html = '<select name="cityId" id="cityId" class="w360">';
        $html .= '<option value="">-- City --</option>';
        foreach ($citys as $i => $list) {
            $html .= '<option value="'.$list->cityId.'"'.(($cityId == $list->cityId) ? " selected" : "").'>'.$list->cityName.'</option>';
        }
        $html .= '<option value="0"'.(($cityId == "0") ? " selected" : "").'>Other</option>';
        $html .= '</select>';
        
        echo $html;
    }

    
	public function preview() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $this->_require_login("");
        
        $edus = $this->Code_model->getUseCodeList(array('scheme_code'=>"EDU"));
        foreach ($edus as $i => $list) {
            $education[$list->code] = $list->code_name;
        }
        
        $levels = $this->Code_model->getUseCodeList(array('scheme_code'=>"LEV"));
        foreach ($levels as $i => $list) {
            $level[$list->code] = $list->code_name;
        }
        
        $data['education'] = $education;
        $data['level'] = $level;
        $data['user'] = $this->User_model->getUser(array('email'=>$this->session->userdata('UID')));
        $data['resume'] = $this->Resume_model->getResume(array('email'=>$this->session->userdata('UID')));
        
        $data['pageTitle'] = "Resume";
		$this->load->view("front/resume/preview", $data);
        
		$this->_footer();
    }
    
}
