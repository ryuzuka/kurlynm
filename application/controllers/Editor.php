<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Editor extends KURLY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper("alert");
        $this->load->helper("directory");

        $this->current_menu_code = "00";
    }

    public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        redirect('editor/upload');

        $this->_admin_footer();
    }

    public function ckupload() {
        $data['current_menu_code'] = $this->current_menu_code;
        //$this->_admin_header($data);

        // Upload 디렉토리 설정
        $path = "/editor/" . date('Y') . "/" . date('m');
        $upload_path = $this->global_upload_path . $path;
        $upload_uri = $this->global_upload_uri . $path;

        // Upload 디렉토리 없으면 생성
        make_directory($upload_uri);

        // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
        $config['upload_path'] = $upload_path;
        // git,jpg,png 파일만 업로드를 허용한다.
        //$config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['allowed_types'] = $this->global_upload_image_allowed;
        // 허용되는 파일의 최대 사이즈
        $config['max_size'] = 10 * 1024;
        // 이미지인 경우 허용되는 최대 폭
        $config['max_width'] = '0';
        // 이미지인 경우 허용되는 최대 높이
        $config['max_height'] = '0';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("upload")) {
            //echo "<script> alert('업로드에 실패하였습니다. ".$this->upload->display_errors('', '')."'); </script>";
            alert_close("업로드에 실패하였습니다. " . $this->upload->display_errors('', ''));
        } else {
            //$CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

            $data = $this->upload->data();
            
            $filename = $data['file_name'];
            $url = $upload_uri . '/' . $filename;

            // ckeditor 4 이상 버전부터 json 방식으로 리턴값 변경
            echo '{"filename" : "'.$filename.'", "uploaded" : 1, "url":"'.$url.'"}';
            
//            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('" . $CKEditorFuncNum . "', '" . $url . "', '전송에 성공하였습니다.')</script>";
        }

        //$this->_admin_footer();
    }

}
