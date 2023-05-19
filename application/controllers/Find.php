<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find extends KURLY_Controller {

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
            redirect("find/id");
        }
        
        $this->_footer();
    }
    
    
	public function id() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = $this->input->post();
        
        if (isset($option['email'])) {
            //var_dump($option);
            $data['member'] = $this->member_model->getFindMember($option);
            $data['email'] = $option['email'];
        } else {
            $data['member'] = null;
            $data['email'] = null;
        }
        
        $data['pageTitle'] = "아이디 찾기";
        $data['pageName'] = "front/find/id";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
	public function passwd() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "비밀번호 찾기";
        $data['pageName'] = "front/find/passwd";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
    public function member() {
        $member_id = $this->input->post("member_id");
        $email = $this->input->post("email");
        
        $user = $this->member_model->findMember(array('member_id'=>$member_id, 'email'=>$email));
        
        if ($user) {
            $json = '{"member_id":"'.$user->member_id.'"}';
            
            // 임시비밀번호로 업데이트 하고 비밀번호 메일 발송
            
        } else {
            $json = '';
        }
        
        echo $json;
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

        $returnMsg = "";
        
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

                // 본인인증 성공시 정보전달
                if ($requestnumber && $name && $mobileno && $dupinfo) {
                    echo "<script src='/js/jquery.min.js'></script>";
                    echo "<script type='text/javascript'>"
                    . " $('#member_name', opener.document).val('".$name."');"
                    . " $('#mobile', opener.document).val('".$mobileno."');"
                    . " $('#mobileco', opener.document).val('".$mobileco."');"
                    . " $('#birthday', opener.document).val('".$birthdate."');"
                    . " $('#gender', opener.document).val('".$gender."');"
                    . " $('#forigner', opener.document).val('".$nationalinfo."');"
                    . " $('#di', opener.document).val('".$dupinfo."');"
                    . " opener.sendChagePasswd();"
                    . " window.close();"
                    . " </script>";
                } else {
                    echo "<script type='text/javascript'> alert('세션값이 다릅니다. 올바른 경로로 접근하시기 바랍니다.'); window.close(); </script>";
                }
            }
        }

        if ($returnMsg) {
            echo "<script type='text/javascript'> alert('".$returnMsg."'); window.close(); </script>";
        }
        
        $this->_footer();
    }
    
    
	public function changepasswd() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['member'] = $this->member_model->findMember(array('member_id' => $this->input->post('member_id'), 'email' => $this->input->post('email')));
        if ($data['member']->member_id != $this->input->post("member_id")) {
            alert("입력한 아이디 정보와 일치하지 않습니다.");
        }

        $data['member_id'] = $this->input->post("member_id");
        
        $data['pageTitle'] = "비밀번호 변경";
        $data['pageName'] = "front/find/changepasswd";
        $this->load->view($this->global_layout, $data);
        
        $this->_footer();
    }
    
    
	public function updatepasswd() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $option = $this->input->post();
        
        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        
        $option['hash'] = password_hash($option['member_passwd'], PASSWORD_BCRYPT);
        
        // 회원정보
        $member = $this->member_model->getMember($option);
        
        // 본인확인 체크
        if ($member->di) {
            if ($member->di == $option['di']) {
                // 비밀번호만 Update
                $this->member_model->updateMemberPasswd($option);
            } else {
                alert("회원정보와 일치하지 않습니다.");
            }
        } else {
            // 본인확인정보, 비밀번호 함께 Update
            $this->member_model->updateMemberPasswdCheckplus($option);
        }

        $this->session->set_flashdata('message', '정상적으로 변경되었습니다.');
        redirect('login');
        
        $this->_footer();
    }
    
    
}