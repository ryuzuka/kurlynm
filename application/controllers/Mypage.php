<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypage extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->model('member_model');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_prefix."main";
        
        // 로그인 체크
        $this->_require_login($_SERVER['REQUEST_URI']);
	}
    
    
	public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['member'] = $this->member;
        
        $data['pageTitle'] = "회원정보 변경";
        $data['pageName'] = "front/mypage/info";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
    public function emailcheck() {
        $option = array(
            'member_id' => $this->session->userdata('MID'),
            'email' => $this->input->get("email")
        );
        
        $chk = $this->member_model->getMyEmailCheck($option);
        
        if ($chk > 0) {
            $result = "N";
        } else {
            $result = "Y";
        }
        
        echo $result;
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

                // 본인인증 성공시 휴대폰번호 변경
                if ($dupinfo == $this->member->di && $name == $this->member->member_name && $mobileno && $mobileco) {
                    $option['member_id'] = $this->session->userdata('MID');
                    $option['mobile'] = $mobileno;
                    $option['mobileco'] = $mobileco;

                    $this->member_model->updateMemberMobile($option);
                    echo "<script type='text/javascript'> alert('정상적으로 수정되었습니다.'); opener.location.reload(); window.close(); </script>";
                } else {
                    echo "<script type='text/javascript'> alert('본인정보와 일치하지 않습니다.'); window.close(); </script>";
                }
            }
        }

        if ($returnMsg) {
            echo "<script type='text/javascript'> alert('본인인증이 실패하였습니다.'); window.close(); </script>";
        }
        
        $this->_footer();
    }
    
    
	public function update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $option = $this->input->post();
        
        $option['member_id'] = $this->session->userdata('MID');
        
        if (isset($option['member_passwd']) && $option['member_passwd']) {
            if(!function_exists('password_hash')){
                $this->load->helper('password');
            }

            $option['hash'] = password_hash($option['member_passwd'], PASSWORD_BCRYPT);
        }

        //var_dump($option);
        $this->member_model->updateMember($option);
        
        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mypage/info');
        
        $this->_footer();
    }
    
    
	public function leave() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "회원탈퇴";
        $data['pageName'] = "front/mypage/leave";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
	public function secession() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $option['member_id'] = $this->session->userdata('MID');
        
        // 회원정보
        $member = $this->member_model->getMember($option);

        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        
        if($member && $member->member_id && $member->status == "Y"){
            if ($option['member_id'] == $member->member_id && password_verify($this->input->post('member_passwd'), $member->member_passwd)) {			// 비밀번호가 일치 할 경우
                // 탈퇴 처리
                $this->member_model->updateSecession($option);

                // 로그아웃 처리
                $this->session->sess_destroy();
                
                alert("정상적으로 탈퇴되었습니다.", "/");

            } else {
                // 비밀번호가 일치하지 않을 경우
                alert("비밀번호가 일치하지 않습니다.");
            }
        } else {
            // 일치하는 정보가 없을 경우
            alert("일치하는 정보가 없습니다.");
        }
        
        $this->_footer();
    }
    
}