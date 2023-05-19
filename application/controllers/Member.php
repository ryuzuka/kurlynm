<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->model('member_model');
        $this->load->model('privates_model');
        $this->load->helper('paging');
        $this->load->helper("alert");

        $this->current_menu_code = "00";
        $this->global_layout = $this->global_layout_pc_prefix."main";

        $this->kakao_client_id = '05fb048b0d19e0d73128cfcff3673069';
        $this->kakao_client_secret = 'wf3W8zGPaUIBwHJNDOwPWYftpxOtwZJB';
        $this->kakao_auth_url = 'https://kauth.kakao.com/oauth/authorize?response_type=code&client_id={client_id}&redirect_uri={redirect_uri}&state={state}';
        $this->kakao_token_url = 'https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&client_secret={client_secret}&code={code}';
        $this->kakao_redirect_uri = 'http'.(!empty($_SERVER['HTTPS']) ? 's':null).'://'.$_SERVER['HTTP_HOST'].'/member/kakao_auth';
        $this->kakao_profile_url = 'https://kapi.kakao.com/v2/user/me';

        $this->google_client_id = '202307683195-uha4porfejhvehh4p2m282e9kju2ob41.apps.googleusercontent.com';
        $this->google_auth_url = 'https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=offline&client_id={client_id}&redirect_uri={redirect_uri}&scope={scope_url}&state={state}';
        $this->google_token_url = "https://www.googleapis.com/oauth2/v4/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&client_secret={client_secret}&code={code}";
        $this->google_profile_url = 'https://www.googleapis.com/oauth2/v3/userinfo';
        $this->google_client_secret = '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';
        $this->google_grant_type = 'authorization_code';
        $this->google_redirect_uri = 'http'.(!empty($_SERVER['HTTPS']) ? 's':null).'://'.$_SERVER['HTTP_HOST'].'/member/google_auth';
        
        $this->naver_client_id = 'TJep7ZcLjEmvSLgK_jBz';
        $this->naver_client_secret = 'JQzPrVOgZg';
        $this->naver_auth_url = 'https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id={client_id}&redirect_uri={redirect_uri}&state={state}';
        $this->naver_token_url = 'https://nid.naver.com/oauth2.0/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&client_secret={client_secret}&code={code}&state={state}';
        $this->naver_redirect_uri = 'http'.(!empty($_SERVER['HTTPS']) ? 's':null).'://'.$_SERVER['HTTP_HOST'].'/member/naver_auth';
        $this->naver_profile_url = 'https://openapi.naver.com/v1/nid/me';
    }

    
	public function login() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = "";
        
        $data['pageTitle'] = "컬리넥스트마일";

        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/member/login";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."member", $data);
        } else {
            $pagename = "mobile/member/login";
            $data['sub'] = "sub";
            $data['subTitle'] = "로그인";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."member_sub", $data);
        }
        
        $this->_footer();
    }
    
    public function kakao_login() {
        // 정보치환 
        $replace = array(
            '{client_id}'=>$this->kakao_client_id,
            '{redirect_uri}'=>$this->kakao_redirect_uri,
            '{state}'=>md5(mt_rand(111111111,999999999)),
        );
        
        setcookie('state',$replace['{state}'],time()+300); // 300 초동안 유효

        $kakao_login_auth_url = str_replace(array_keys($replace), array_values($replace),$this->kakao_auth_url);
        
        redirect($kakao_login_auth_url);
    }

    public function google_login() {
        $scope = array(
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        );

        // 정보치환 
        $replace = array(
            '{scope_url}' => implode(' ', $scope),
            '{client_id}'=>$this->google_client_id,
            '{redirect_uri}'=>$this->google_redirect_uri,
            '{state}'=>md5(mt_rand(111111111,999999999)),
        );
        
        setcookie('state',$replace['{state}'],time()+300); // 300 초동안 유효

        $google_login_auth_url = str_replace(array_keys($replace), array_values($replace),$this->google_auth_url);
//echo $google_login_auth_url; exit;        

        redirect($google_login_auth_url);
    }

    public function naver_login() {
        // 정보치환 
        $replace = array(
            '{client_id}'=>$this->naver_client_id,
            '{redirect_uri}'=>$this->naver_redirect_uri,
            '{state}'=>md5(mt_rand(111111111,999999999)),
        );
        
        setcookie('state',$replace['{state}'],time()+300); // 300 초동안 유효
        
        $naver_login_auth_url = str_replace(array_keys($replace), array_values($replace),$this->naver_auth_url);
        
        redirect($naver_login_auth_url);
    }
    
    // 로그인 처리
    public function kakao_auth() 
    {
        try{
            // 기본 응답 설정
            $res = array('rst'=>'fail','code'=>(__LINE__*-1),'msg'=>'');

            // code && state 체크
            if( empty($_GET['code']) || empty($_GET['state']) ||  $_GET['state'] != $_COOKIE['state']){ throw new Exception("인증실패", (__LINE__*-1) );}

            // 토큰 요청
            $replace = array(
                '{grant_type}'=>'authorization_code',
                '{client_id}'=>$this->kakao_client_id,
                '{redirect_uri}'=>$this->kakao_redirect_uri,
                '{client_secret}'=>$this->kakao_client_secret,
                '{code}'=>$_GET['code']
            );
            
            $login_token_url = str_replace(array_keys($replace), array_values($replace), $this->kakao_token_url);
            $token_data = json_decode($this->curl_kakao($login_token_url));
            
            if( empty($token_data)){ throw new Exception("토큰요청 실패", (__LINE__*-1) ); }
            if( !empty($token_data->error) || empty($token_data->access_token) ){ 
                throw new Exception("토큰인증 에러", (__LINE__*-1) ); 
            }

            // 프로필 요청 
            $header = array("Authorization: Bearer ".$token_data->access_token);
            $profile_url = $this->kakao_profile_url;
            $profile_data = json_decode($this->curl_kakao($profile_url,$header));
            if( empty($profile_data) || empty($profile_data->id) ){ throw new Exception("프로필요청 실패", (__LINE__*-1) ); }

            //print_r($profile_data); exit;
            
            $option = array(
                'member_type'     	=> 'K',
                'member_id'     	=> $profile_data->id,
                'member_nickname'	=> $profile_data->properties->nickname,
                'member_email'  	=> $profile_data->kakao_account->email,
            );
            
            $member = $this->member_model->getJoinMember($option);
            
            if($member) {   // 이미 가입했을 경우 로그인 처리
                if($member->status == "Y") {
                    // state 초기화 
                    setcookie('state','',time()-3000); // 300 초동안 유효

                    $this->session->set_userdata('MID', $profile_data->id);
                    
                    // 로그인 기록
                    $option = array(
                        'member_id'     	=> $member->member_id,
                    );
                    
                    $this->member_model->updateJoinLogin($option);
                    
                    redirect("/");
                } else {
                    // 탈퇴한 회원 재가입
//                    $option = array(
//                        'member_id'     	=> $member->member_id,
//                    );
//                    
//                    $this->member_model->updateReJoinMember($option);
//                    $this->session->set_userdata('MID', $member->member_id);
//                    
//                    $this->session->set_flashdata('message', '회원 재가입이 완료되었습니다.');
                    
                    // 개인정보 보관 기간
                    $privates = $this->privates_model->getPrivatesInfo();
        
                    $option = array(
                        'join_day'     	=> $privates->join_day,
                        'member_id'    	=> $member->member_id,
                    );
                    
                    $join_count = $this->member_model->getReJoinCount($option);
                    
                    if($join_count == "0") {
                        $this->session->set_flashdata('message', '회원 탈퇴 후 '.$privates->join_day.'일간 재가입이 불가능합니다.');
                        redirect("/");
                    } else {
                        $this->member_model->updateReJoinMember($option);
                        $this->session->set_userdata('MID', $member->member_id);

                        $this->session->set_flashdata('message', '회원 재가입이 완료되었습니다.');
                        redirect("/");
                    }
                }
            } else {    // 신규 가입일 경우
                // state 초기화 
                setcookie('state','',time()-3000); // 300 초동안 유효
                
                // 가입 처리 / 로그인 처리
                //echo "신규가입 => ".$profile_data->id ."//". $profile_data->properties->nickname ."//". $profile_data->kakao_account->email; exit;
                $this->member_model->insertJoinMember($option);
                
                $this->session->set_userdata('MID', $profile_data->id);
                
                $this->session->set_flashdata('message', '회원가입이 완료되었습니다.');
                redirect("/");
            }
        } catch(Exception $e) {
            if(!empty($e->getMessage())){ $res['msg'] = $e->getMessage(); }
            if(!empty($e->getMessage())){ $res['code'] = $e->getCode(); }
        }
    }
    
    // 로그인 처리
    public function google_auth() 
    {
        try{
            // 기본 응답 설정
            $res = array('rst'=>'fail','code'=>(__LINE__*-1),'msg'=>'');
            
            // code && state 체크
            if( empty($_GET['code']) ){ throw new Exception("인증실패", (__LINE__*-1) );}

            $scope = array(
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile',
            );

            // 토큰 요청
            $replace = array(
                '{grant_type}'=>'authorization_code',
                '{client_id}'=>$this->google_client_id,
                '{redirect_uri}'=>$this->google_redirect_uri,
                '{client_secret}'=>$this->google_client_secret,
                '{code}'=>$_GET['code']
            );
            
            $login_token_url = str_replace(array_keys($replace), array_values($replace), $this->google_token_url);
            $token_data = json_decode($this->curl_kakao($login_token_url));
            
            //print_r($token_data); exit;

            if( empty($token_data)){ throw new Exception("토큰요청 실패", (__LINE__*-1) ); }
            if( empty($token_data->access_token) ){ 
                throw new Exception("토큰인증 에러", (__LINE__*-1) ); 
            }

            // 프로필 요청 
            $header = array("Authorization: Bearer ".$token_data->access_token);
            $profile_url = $this->google_profile_url;
            $profile_data = json_decode($this->curl_google($profile_url,$header));
            //print_r($profile_data); exit;
            //echo $profile_data->sub ."/". $profile_data->email; exit;
            if( empty($profile_data) || empty($profile_data->sub) ){ throw new Exception("프로필요청 실패", (__LINE__*-1) ); }

            $option = array(
                'member_type'     	=> 'G',
                'member_id'     	=> $profile_data->sub,
                'member_nickname'	=> "",
                'member_email'  	=> $profile_data->email,
            );
            
            $member = $this->member_model->getJoinMember($option);
            
            if($member) {   // 이미 가입했을 경우 로그인 처리
                if($member->status == "Y") {
                    // state 초기화 
                    setcookie('state','',time()-3000); // 300 초동안 유효

                    $this->session->set_userdata('MID', $profile_data->sub);
                    
                    // 로그인 기록
                    $option = array(
                        'member_id'     	=> $member->member_id,
                    );
                    
                    $this->member_model->updateJoinLogin($option);
                    
                    redirect("/");
                } else {
                    // 탈퇴한 회원 재가입
//                    $option = array(
//                        'member_id'     	=> $member->member_id,
//                    );
//                    
//                    $this->member_model->updateReJoinMember($option);
//                    $this->session->set_userdata('MID', $member->member_id);
//                    
//                    $this->session->set_flashdata('message', '회원 재가입이 완료되었습니다.');
                    
                    // 개인정보 보관 기간
                    $privates = $this->privates_model->getPrivatesInfo();
        
                    $option = array(
                        'join_day'     	=> $privates->join_day,
                        'member_id'    	=> $member->member_id,
                    );
                    
                    $join_count = $this->member_model->getReJoinCount($option);
                    
                    if($join_count == "0") {
                        $this->session->set_flashdata('message', '회원 탈퇴 후 '.$privates->join_day.'일간 재가입이 불가능합니다.');
                        redirect("/");
                    } else {
                        $this->member_model->updateReJoinMember($option);
                        $this->session->set_userdata('MID', $member->member_id);

                        $this->session->set_flashdata('message', '회원 재가입이 완료되었습니다.');
                        redirect("/");
                    }
                }
            } else {    // 신규 가입일 경우
                // state 초기화 
                setcookie('state','',time()-3000); // 300 초동안 유효
                
                // 가입 처리 / 로그인 처리
                //echo "신규가입 => ".$profile_data->id ."//". $profile_data->properties->nickname ."//". $profile_data->kakao_account->email; exit;
                $this->member_model->insertJoinMember($option);
                
                $this->session->set_userdata('MID', $profile_data->sub);
                
                $this->session->set_flashdata('message', '회원가입이 완료되었습니다.');
                redirect("/");
            }
        } catch(Exception $e) {
            if(!empty($e->getMessage())){ $res['msg'] = $e->getMessage(); }
            if(!empty($e->getMessage())){ $res['code'] = $e->getCode(); }
        }
    }
    
    // 로그인 처리
    public function naver_auth() 
    {
        try{
            // 기본 응답 설정
            $res = array('rst'=>'fail','code'=>(__LINE__*-1),'msg'=>'');

            // code && state 체크
            if( empty($_GET['code']) || empty($_GET['state']) ||  $_GET['state'] != $_COOKIE['state']){ throw new Exception("인증실패", (__LINE__*-1) );}

            // 토큰 요청
            $replace = array(
                '{grant_type}'=>'authorization_code',
                '{client_id}'=>$this->naver_client_id,
                '{redirect_uri}'=>$this->naver_redirect_uri,
                '{client_secret}'=>$this->naver_client_secret,
                '{code}'=>$_GET['code']
            );
            
            $login_token_url = str_replace(array_keys($replace), array_values($replace), $this->naver_token_url);
            $token_data = json_decode($this->curl_kakao($login_token_url));
            //print_r($token_data); exit;
            if( empty($token_data)){ throw new Exception("토큰요청 실패", (__LINE__*-1) ); }
            if( !empty($token_data->error) || empty($token_data->access_token) ){ 
                throw new Exception("토큰인증 에러", (__LINE__*-1) ); 
            }

            // 프로필 요청 
            $header = array("Authorization: Bearer ".$token_data->access_token);
            $profile_url = $this->naver_profile_url;
            $profile_data = json_decode($this->curl_kakao($profile_url,$header));
            
            //echo $profile_data->response->id ."//". $profile_data->response->email; exit;
            //print_r($profile_data); exit;
            if( empty($profile_data) || empty($profile_data->response->id) ){ throw new Exception("프로필요청 실패", (__LINE__*-1) ); }
            
            $option = array(
                'member_type'     	=> 'N',
                'member_id'     	=> $profile_data->response->id,
                'member_nickname'	=> '',
                'member_email'  	=> $profile_data->response->email,
            );
            
            $member = $this->member_model->getJoinMember($option);
            
            if($member) {   // 이미 가입했을 경우 로그인 처리
                if($member->status == "Y") {
                    // state 초기화 
                    setcookie('state','',time()-3000); // 300 초동안 유효

                    $this->session->set_userdata('MID', $profile_data->response->id);
                    
                    // 로그인 기록
                    $option = array(
                        'member_id'     	=> $member->member_id,
                    );
                    
                    $this->member_model->updateJoinLogin($option);
                    
                    redirect("/");
                } else {
                    // 탈퇴한 회원 재가입
//                    $option = array(
//                        'member_id'     	=> $member->member_id,
//                    );
//                    
//                    $this->member_model->updateReJoinMember($option);
//                    $this->session->set_userdata('MID', $member->member_id);
//                    
//                    $this->session->set_flashdata('message', '회원 재가입이 완료되었습니다.');
                    
                    // 개인정보 보관 기간
                    $privates = $this->privates_model->getPrivatesInfo();
        
                    $option = array(
                        'join_day'     	=> $privates->join_day,
                        'member_id'    	=> $member->member_id,
                    );
                    
                    $join_count = $this->member_model->getReJoinCount($option);
                    
                    if($join_count == "0") {
                        $this->session->set_flashdata('message', '회원 탈퇴 후 '.$privates->join_day.'일간 재가입이 불가능합니다.');
                        redirect("/");
                    } else {
                        $this->member_model->updateReJoinMember($option);
                        $this->session->set_userdata('MID', $member->member_id);

                        $this->session->set_flashdata('message', '회원 재가입이 완료되었습니다.');
                        redirect("/");
                    }
                }
            } else {    // 신규 가입일 경우
                // state 초기화 
                setcookie('state','',time()-3000); // 300 초동안 유효
                
                // 가입 처리 / 로그인 처리
                //echo "신규가입 => ".$profile_data->id ."//". $profile_data->properties->nickname ."//". $profile_data->kakao_account->email; exit;
                $this->member_model->insertJoinMember($option);
                
                $this->session->set_userdata('MID', $profile_data->response->id);
                
                $this->session->set_flashdata('message', '회원가입이 완료되었습니다.');
                redirect("/");
            }
        } catch(Exception $e) {
            if(!empty($e->getMessage())){ $res['msg'] = $e->getMessage(); }
            if(!empty($e->getMessage())){ $res['code'] = $e->getCode(); }
        }
    }
    
    // 함수: 카카오 curl 통신 
    function curl_kakao($url,$headers = array()){
        if(empty($url)){ return false ; }

        // URL에서 데이터를 추출하여 쿼리문 생성
        $purl = parse_url($url); $postfields = array();
        if( !empty($purl['query']) && trim($purl['query']) != ''){
            $postfields = explode("&",$purl['query']);
        }

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields); 
        if( count($headers) > 0){ 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        }

        ob_start(); // prevent any output
        $data = curl_exec($ch); 
        ob_end_clean(); // stop preventing output

        if (curl_error($ch)){ return false;} 

        curl_close($ch); 
        return $data;		
    }    
    
    // 함수: 카카오 curl 통신 
    function curl_google($url,$headers = array()){
        if(empty($url)){ return false ; }

        // URL에서 데이터를 추출하여 쿼리문 생성
        $purl = parse_url($url); $postfields = array();
        if( !empty($purl['query']) && trim($purl['query']) != ''){
            $postfields = explode("&",$purl['query']);
        }

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields); 
        if( count($headers) > 0){ 
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
        }

        ob_start(); // prevent any output
        $data = curl_exec($ch); 
        ob_end_clean(); // stop preventing output

        if (curl_error($ch)){ return false;} 

        curl_close($ch); 
        return $data;		
    }    
    
    // 회원정보 수정
    public function info() {
        // 로그인 체크
        $this->_require_login();
        
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = array(
            'member_id'    	=> $this->session->userdata('MID'),
        );

        $member = $this->member_model->getMember($option);

        // 개인정보 보관 기간
        $data['privates'] = $this->privates_model->getPrivatesInfo();
        
        $data['member'] = $member;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/member/info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_pc_prefix."member", $data);
        } else {
            $pagename = "mobile/member/info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."member", $data);
        }
        
        $this->_footer();
    }
    
    public function update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = $this->input->post();

        $this->member_model->updateJoinMember($option);
        
        $this->_footer();
    }
    
    public function secession() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $option = $this->input->post();
        $option['status'] = "N";
        
        $this->member_model->deleteJoinMember($option);
        
        $this->session->sess_destroy();
        
        $this->_footer();
    }    
    
    // 회원 견적문의
    public function estimate() {
        // 로그인 체크
        $this->_require_login();
        
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $rdo = $this->input->get('rdo');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        $block_size = 10;
        $limit_size = 10;
        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            'member_id'     => $this->session->userdata('MID'),
            'start_date'    => $start_date,
            'end_date'      => $end_date . " 23:59",
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $params = "page=".$page."&rdo=".$rdo."&start_date=".$start_date."&end_date=".$end_date;

        // 전체 데이터 수
        $total_count = $this->member_model->getMemberEstimateListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $estimateList = $this->member_model->getMemberEstimateList($option);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['rdo'] = $rdo;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['estimateList'] = $estimateList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;        
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            // Pagination
            $url = '/member/estimate' . "?" . $params . "&page=";
            $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);
        
            $pagename = "front/member/estimate";
            $data['pageName'] = $pagename;
            $data['pagination'] = $pagination;
            $this->load->view($this->global_layout_pc_prefix."member", $data);
        } else {
            // Pagination
            $url = '/member/estimate' . "?" . $params . "&page=";
            $pagination = getPagingBasicFront($block_size, $page, $total_page, $url);
        
            $pagename = "mobile/member/estimate";
            $data['pageName'] = $pagename;
            $data['pagination'] = $pagination;
            $this->load->view($this->global_layout_mo_prefix."member", $data);
        }
        
        $this->_footer();
    }
    
    // 회원 견적문의 보기
    public function estimate_info() {
        // 로그인 체크
        $this->_require_login();
        
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);

        $seq = $this->input->get('seq');
        $rdo = $this->input->get('rdo');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $page = $this->input->get('page');

        $params = "page=".$page."&rdo=".$rdo."&start_date=".$start_date."&end_date=".$end_date;

        // 정보 가져오기
        $data['estimate'] = $this->member_model->getMemberEstimate(array('seq' => $seq));

        $data['params'] = $params;
        $data['pageTitle'] = "컬리넥스트마일";
        
        $pagename = "";
        if($this->global_device == "pc") {
            $pagename = "front/member/estimate_info";
            $data['pageName'] = $pagename;

            $this->load->view($this->global_layout_pc_prefix."member", $data);
        } else {
            $pagename = "mobile/member/estimate_info";
            $data['pageName'] = $pagename;
            $this->load->view($this->global_layout_mo_prefix."member", $data);
        }

        $this->_footer();
    }
    
    
    // 로그아웃
    public function logout() {
        $this->session->sess_destroy();
        redirect("/");
    }
}