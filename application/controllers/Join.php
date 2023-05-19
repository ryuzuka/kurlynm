<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_prefix."join";
    }
    
    public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        if ($this->session->userdata('MID')) {
            alert("로그인 되어 있습니다.");
        } else {
            redirect("join/agree");
        }
        
        $this->_footer();
    }
    
    
    public function agree() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
            
        $data['pageTitle'] = "회원가입";
        $data['pageName'] = "front/join/agree";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
    public function checkplus_success() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        
        //**************************************************************************************************************
        //NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
        //서비스명 :  체크플러스 - 안심본인인증 서비스
        //페이지명 :  체크플러스 - 결과 페이지
        //보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다.
        //인증 후 결과값이 null로 나오는 부분은 관리담당자에게 문의 바랍니다.	
        //**************************************************************************************************************
        $sitecode = config_item('sitecode');				// NICE로부터 부여받은 사이트 코드
        $sitepasswd = config_item('sitepasswd');			// NICE로부터 부여받은 사이트 패스워드
        $cb_encode_path = config_item('cb_encode_path');

        $enc_data = $_POST["EncodeData"];		// 암호화된 결과 데이타

        //////////////////////////////////////////////// 문자열 점검///////////////////////////////////////////////
        if(preg_match('~[^0-9a-zA-Z+/=]~', $enc_data, $match)) {echo "입력 값 확인이 필요합니다 : ".$match[0]; exit;} // 문자열 점검 추가. 
        if(base64_encode(base64_decode($enc_data))!=$enc_data) {echo "입력 값 확인이 필요합니다"; exit;}
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($enc_data != "") {

            $plaindata = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data`;		// 암호화된 결과 데이터의 복호화
            //echo "[plaindata]  " . $plaindata . "<br>";

            if ($plaindata == -1){
                $returnMsg  = "암/복호화 시스템 오류";
            }else if ($plaindata == -4){
                $returnMsg  = "복호화 처리 오류";
            }else if ($plaindata == -5){
                $returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
            }else if ($plaindata == -6){
                $returnMsg  = "복호화 데이터 오류";
            }else if ($plaindata == -9){
                $returnMsg  = "입력값 오류";
            }else if ($plaindata == -12){
                $returnMsg  = "사이트 비밀번호 오류";
            }else{
                // 복호화가 정상적일 경우 데이터를 파싱합니다.
                $ciphertime = `$cb_encode_path CTS $sitecode $sitepasswd $enc_data`;	// 암호화된 결과 데이터 검증 (복호화한 시간획득)

                $requestnumber = $this->GetValue($plaindata , "REQ_SEQ");
                $responsenumber = $this->GetValue($plaindata , "RES_SEQ");
                $authtype = $this->GetValue($plaindata , "AUTH_TYPE");
                $name = $this->GetValue($plaindata , "NAME");
                $name = urldecode($this->GetValue($plaindata , "UTF8_NAME")); //charset utf8 사용시 주석 해제 후 사용
                $birthdate = $this->GetValue($plaindata , "BIRTHDATE");
                $gender = $this->GetValue($plaindata , "GENDER");
                $nationalinfo = $this->GetValue($plaindata , "NATIONALINFO");	//내/외국인정보(사용자 매뉴얼 참조)
                $dupinfo = $this->GetValue($plaindata , "DI");
                $conninfo = $this->GetValue($plaindata , "CI");
                $mobileno = $this->GetValue($plaindata , "MOBILE_NO");
                $mobileco = $this->GetValue($plaindata , "MOBILE_CO");

                if(strcmp($_SESSION["REQ_SEQ"], $requestnumber) != 0)
                {
                    echo "세션값이 다릅니다. 올바른 경로로 접근하시기 바랍니다.<br>";
                    $requestnumber = "";
                    $responsenumber = "";
                    $authtype = "";
                    $name = "";
                    $birthdate = "";
                    $gender = "";
                    $nationalinfo = "";
                    $dupinfo = "";
                    $conninfo = "";
                    $mobileno = "";
                    $mobileco = "";
                }
                
                // 본인인증 거쳐 가입한 정보가 있는지 체크
                $checkplus = $this->member_model->getDICheck(array('di'=>$dupinfo));
                if ($checkplus > 0) {
                    echo "<script type='text/javascript'> alert('이미 가입된 회원입니다.'); window.close(); </script>";
                    exit;
                }
            }
        }

        $data['requestnumber'] = $requestnumber;
        $data['responsenumber'] = $responsenumber;
        $data['authtype'] = $authtype;
        $data['name'] = $name;
        $data['birthdate'] = $birthdate;
        $data['gender'] = $gender;
        $data['nationalinfo'] = $nationalinfo;
        $data['dupinfo'] = $dupinfo;
        $data['conninfo'] = $conninfo;
        $data['mobileno'] = $mobileno;
        $data['mobileco'] = $mobileco;

        $this->load->view("front/join/success", $data);
        
        $this->_footer();
    }
    
    
    public function checkplus_fail() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        
        //**************************************************************************************************************
        //NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
        //서비스명 :  체크플러스 - 안심본인인증 서비스
        //페이지명 :  체크플러스 - 결과 페이지
        //보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다. 
        //**************************************************************************************************************
        $sitecode = config_item('sitecode');				// NICE로부터 부여받은 사이트 코드
        $sitepasswd = config_item('sitepasswd');			// NICE로부터 부여받은 사이트 패스워드
        $cb_encode_path = config_item('cb_encode_path');

        $enc_data = $_POST["EncodeData"];		// 암호화된 결과 데이타

        //////////////////////////////////////////////// 문자열 점검///////////////////////////////////////////////
        if(preg_match('~[^0-9a-zA-Z+/=]~', $enc_data, $match)) {echo "입력 값 확인이 필요합니다 : ".$match[0]; exit;} // 문자열 점검 추가. 
        if(base64_encode(base64_decode($enc_data))!=$enc_data) {echo "입력 값 확인이 필요합니다"; exit;}
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////

        $returnMsg = "";
        $errcode = "";
        
        if ($enc_data != "") {
            $plaindata = `$cb_encode_path DEC $sitecode $sitepasswd $enc_data`;		// 암호화된 결과 데이터의 복호화
            echo "[plaindata] " . $plaindata . "<br>";

            if ($plaindata == -1){
                $returnMsg  = "암/복호화 시스템 오류";
            }else if ($plaindata == -4){
                $returnMsg  = "복호화 처리 오류";
            }else if ($plaindata == -5){
                $returnMsg  = "HASH값 불일치 - 복호화 데이터는 리턴됨";
            }else if ($plaindata == -6){
                $returnMsg  = "복호화 데이터 오류";
            }else if ($plaindata == -9){
                $returnMsg  = "입력값 오류";
            }else if ($plaindata == -12){
                $returnMsg  = "사이트 비밀번호 오류";
            }else{
                // 복호화가 정상적일 경우 데이터를 파싱합니다.
                $ciphertime = `$cb_encode_path CTS $sitecode $sitepasswd $enc_data`;	// 암호화된 결과 데이터 검증 (복호화한 시간획득)

                $requestnumber = $this->GetValue($plaindata , "REQ_SEQ");
                $errcode = $this->GetValue($plaindata , "ERR_CODE");
                $authtype = $this->GetValue($plaindata , "AUTH_TYPE");
            }
        }

        $data['returnMsg'] = $returnMsg;
        $data['requestnumber'] = $requestnumber;
        $data['errcode'] = $errcode;
        $data['authtype'] = $authtype;
        
        $data['pageName'] = "front/join/fail";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
    public function form() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $agree1 = $this->input->post('agree1');
        $agree2 = $this->input->post('agree2');
        
        if ($agree1 != "Y" || $agree2 != "Y") {
            alert("약관에 동의해주십시오.");
        }
        
        $data['pageTitle'] = "회원가입";
        $data['pageName'] = "front/join/form";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
    public function idcheck() {
        $member_id = $this->input->get("member_id");
        
        $chk = $this->member_model->getIDCheck(array('member_id'=>$member_id));
        
        if ($chk > 0) {
            $result = "N";
        } else {
            $result = "Y";
        }
        
        echo $result;
    }
    
    
    public function emailcheck() {
        $email = $this->input->get("email");
        
        $chk = $this->member_model->getEmailCheck(array('email'=>$email));
        
        if ($chk > 0) {
            $result = "N";
        } else {
            $result = "Y";
        }
        
        echo $result;
    }


	public function process() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $option = $this->input->post();
        
        $option['member_id'] = strtolower($option['member_id']);
        
        // 아이디 중복체크
        $chk = $this->member_model->getIDCheck($option);
        if ($chk > 0) {
            alert("[".$option['member_id']."]은 이미 등록된 아이디입니다.");
        }
        
        // 이메일 중복체크
        $chk = $this->member_model->getEmailCheck($option);
        if ($chk > 0) {
            alert("[".$option['email']."]은 이미 등록된 이메일입니다.");
        }
        
        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        
        $option['hash'] = password_hash($option['member_passwd'], PASSWORD_BCRYPT);
        
        //var_dump($option);
        $this->member_model->insertMember($option);
        
        redirect("join/complete");
        
        $this->_footer();
    }
    
    
	public function complete() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "회원가입";
        $data['pageName'] = "front/join/complete";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
}