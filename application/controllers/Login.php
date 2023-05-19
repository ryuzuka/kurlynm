<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends KURLY_Controller {

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
        
        if($this->session->userdata('MID')){
            redirect("main");
        } else {
            $data['returnURL'] = $this->input->get('returnURL');

            $data['pageTitle'] = "로그인";
            $data['pageName'] = "front/login/login";
            $this->load->view($this->global_layout, $data);
        }
        
        $this->_footer();
    }

    
    // 로그인 처리
    public function auth()
    {
        $returnURL = $this->input->post('returnURL');
        
        $login_id = strtolower($this->input->post('login_id'));

        $member = $this->member_model->getMember(array('member_id'=>$login_id));
        //var_dump($user); exit;

        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        
        if($member && $member->member_id && $member->status == "Y"){
            if ($login_id == $member->member_id && password_verify($this->input->post('login_passwd'), $member->member_passwd)) {			// 비밀번호가 일치 할 경우
                $this->session->set_userdata('MID', $member->member_id);

                $option = array(
                    'member_id' => $member->member_id,
                    'login_device' => $this->global_device,
                    'login_ip' => $this->global_user_ip,
                    'login_agent' => $this->global_user_agent
                );

                /** 트랜잭션 수행 **/
                $this->db->trans_start();

                // Update - Login info
                $this->member_model->updateLogin($option);

                // Insert - login history
                $this->member_model->insertLoginHistory($option);

                /** 트랜잭션 완료 **/
                $this->db->trans_complete();

                /** 트랜잭션 에러 **/
                if ($this->db->trans_status() === FALSE) {
                    alert("DB Error!!");
                }

                redirect($returnURL ? $returnURL : 'main');
            } else {
                // 비밀번호가 일치하지 않을 경우
                $this->session->set_flashdata('message', '비밀번호가 일치하지 않습니다.');
                redirect("login");
            }
        } else {
            // 일치하는 정보가 없을 경우
            $this->session->set_flashdata('message', '일치하는 정보가 없습니다.');
            redirect("login");
        }
    }
    
    
    // 본인확인 처리
    public function checkplus()
    {
        // 로그인 하지 않았다면 로그인 페이지로..
        if(!$this->session->userdata('MID')){
            redirect('/login');
        }
        
        // 로그인 하였고 본인확인 거쳤다면 메인페이지로..
        if ($this->member && $this->member->di) {
            redirect('/');
        }
        
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);


        //**************************************************************************************************************
        //NICE평가정보 Copyright(c) KOREA INFOMATION SERVICE INC. ALL RIGHTS RESERVED
        //서비스명 :  체크플러스 - 안심본인인증 서비스
        //페이지명 :  체크플러스 - 메인 호출 페이지
        //보안을 위해 제공해드리는 샘플페이지는 서비스 적용 후 서버에서 삭제해 주시기 바랍니다. 
        //**************************************************************************************************************
        $sitecode = config_item('sitecode');				// NICE로부터 부여받은 사이트 코드
        $sitepasswd = config_item('sitepasswd');			// NICE로부터 부여받은 사이트 패스워드
        $cb_encode_path = config_item('cb_encode_path');
        /*
        ┌ cb_encode_path 변수에 대한 설명  ──────────────────────────────────
            모듈 경로설정은, '/절대경로/모듈명' 으로 정의해 주셔야 합니다.
            + FTP 로 모듈 업로드시 전송형태를 'binary' 로 지정해 주시고, 권한은 755 로 설정해 주세요.
            + 절대경로 확인방법
              1. Telnet 또는 SSH 접속 후, cd 명령어를 이용하여 모듈이 존재하는 곳까지 이동합니다.
              2. pwd 명령어을 이용하면 절대경로를 확인하실 수 있습니다.
              3. 확인된 절대경로에 '/모듈명'을 추가로 정의해 주세요.
        └────────────────────────────────────────────────────────────────────
        */

        $authtype = "M";      		// 없으면 기본 선택화면, X: 공인인증서, M: 핸드폰, C: 카드

        $popgubun 	= "N";			//Y : 취소버튼 있음 / N : 취소버튼 없음
        $customize 	= "";			//없으면 기본 웹페이지 / Mobile : 모바일페이지

        $gender = "";      			// 없으면 기본 선택화면, 0: 여자, 1: 남자

        $reqseq = "REQ_0123456789";     // 요청 번호, 이는 성공/실패후에 같은 값으로 되돌려주게 되므로
                                        // 업체에서 적절하게 변경하여 쓰거나, 아래와 같이 생성한다.

        // 실행방법은 싱글쿼터(`) 외에도, 'exec(), system(), shell_exec()' 등등 귀사 정책에 맞게 처리하시기 바랍니다.
        $reqseq = `$cb_encode_path SEQ $sitecode`;

        // CheckPlus(본인인증) 처리 후, 결과 데이타를 리턴 받기위해 다음예제와 같이 http부터 입력합니다.
        // 리턴url은 인증 전 인증페이지를 호출하기 전 url과 동일해야 합니다. ex) 인증 전 url : http://www.~ 리턴 url : http://www.~
//        $returnurl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/login/checkplus_success"; 	// 성공시 이동될 URL
        $returnurl = config_item('nice_login_returnurl'); 	// 성공시 이동될 URL
        $errorurl = config_item('nice_errorurl');		// 실패시 이동될 URL

        // reqseq값은 성공페이지로 갈 경우 검증을 위하여 세션에 담아둔다.

        $_SESSION["REQ_SEQ"] = $reqseq;

        // 입력될 plain 데이타를 만든다.
        $plaindata = "7:REQ_SEQ" . strlen($reqseq) . ":" . $reqseq .
                     "8:SITECODE" . strlen($sitecode) . ":" . $sitecode .
                     "9:AUTH_TYPE" . strlen($authtype) . ":". $authtype .
                     "7:RTN_URL" . strlen($returnurl) . ":" . $returnurl .
                     "7:ERR_URL" . strlen($errorurl) . ":" . $errorurl .
                     "11:POPUP_GUBUN" . strlen($popgubun) . ":" . $popgubun .
                     "9:CUSTOMIZE" . strlen($customize) . ":" . $customize .
                     "6:GENDER" . strlen($gender) . ":" . $gender ;

        $enc_data = `$cb_encode_path ENC $sitecode $sitepasswd $plaindata`;

        $returnMsg = "";

        if( $enc_data == -1 )
        {
            $returnMsg = "암/복호화 시스템 오류입니다.";
            $enc_data = "";
        }
        else if( $enc_data== -2 )
        {
            $returnMsg = "암호화 처리 오류입니다.";
            $enc_data = "";
        }
        else if( $enc_data== -3 )
        {
            $returnMsg = "암호화 데이터 오류 입니다.";
            $enc_data = "";
        }
        else if( $enc_data== -9 )
        {
            $returnMsg = "입력값 오류 입니다.";
            $enc_data = "";
        }

        
        $data['returnMsg'] = $returnMsg;
        $data['enc_data'] = $enc_data;
        
        $data['pageTitle'] = "본인인증";
        $data['pageName'] = "front/login/checkplus";
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
                    // 본인인증 거쳐 가입한 정보가 있는지 체크
                    $checkplus = $this->member_model->getDICheck(array('di'=>$dupinfo));
                    if ($checkplus > 0) {
                        echo "<script type='text/javascript'> alert('이미 가입된 회원정보입니다.'); window.close(); </script>";
                        exit;
                    } else {
                        $option['member_id'] = $this->session->userdata('MID');
                        $option['member_name'] = $name;
                        $option['mobile'] = $mobileno;
                        $option['mobileco'] = $mobileco;
                        $option['birthday'] = $birthdate;
                        $option['gender'] = $gender;
                        $option['forigner'] = $nationalinfo;
                        $option['di'] = $dupinfo;
                        
                        // Update - 본인인증
                        $this->member_model->updateMemberCheckplus($option);
                        
                        echo "<script type='text/javascript'> alert('본인인증이 정상적으로 처리되었습니다.'); opener.location.href='/mypage'; window.close(); </script>";
                        exit;
                    }
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


}
