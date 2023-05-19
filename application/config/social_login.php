<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * SOCIAL Setting
 **/

        
//        $this->kakao_client_id = '05fb048b0d19e0d73128cfcff3673069';
//        $this->kakao_client_secret = 'wf3W8zGPaUIBwHJNDOwPWYftpxOtwZJB';
//        $this->kakao_auth_url = 'https://kauth.kakao.com/oauth/authorize?response_type=code&client_id={client_id}&redirect_uri={redirect_uri}&state={state}';
//        $this->kakao_token_url = 'https://kauth.kakao.com/oauth/token?grant_type=authorization_code&client_id={client_id}&redirect_uri={redirect_uri}&client_secret={client_secret}&code={code}';
//        $this->kakao_redirect_uri = 'http'.(!empty($_SERVER['HTTPS']) ? 's':null).'://'.$_SERVER['HTTP_HOST'].'/member/kakao_auth';
//        $this->kakao_profile_url = 'https://kapi.kakao.com/v2/user/me';

//        $this->google_client_id = '202307683195-uha4porfejhvehh4p2m282e9kju2ob41.apps.googleusercontent.com';
//        $this->google_auth_url = 'https://accounts.google.com/o/oauth2/auth?response_type=code&client_id={client_id}&redirect_uri={redirect_uri}&scope={scope_url}';
//        $this->google_token_url = "https://accounts.google.com/o/oauth2/token";
//        $this->google_scope_url = 'https://www.googleapis.com/auth/userinfo.email&approval_prompt=force&access_type=offline';
//        $this->google_client_secret = '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';
//        $this->google_grant_type = 'authorization_code';
//        $this->google_redirect_uri = 'http'.(!empty($_SERVER['HTTPS']) ? 's':null).'://'.$_SERVER['HTTP_HOST'].'/member/google_auth';
        
        
$config['naver_login']['client_id']         = "네아로 클라이언트 ID";
$config['naver_login']['client_secret']     = "네아로 클라이언트 secret";
$config['naver_login']['redirect_uri']  = "네아로 Redirect URI";
$config['naver_login']['authorize_url'] = "https://nid.naver.com/oauth2.0/authorize";
$config['naver_login']['token_url']     = "https://nid.naver.com/oauth2.0/token";
$config['naver_login']['info_url']      = "https://openapi.naver.com/v1/nid/me";
$config['naver_login']['token_request_post'] = FALSE;
 
$config['facebook_login']['client_id']  = "페이스북 앱 ID";      // 페이스북 앱 ID 입력
$config['facebook_login']['client_secret']= "페이스북 앱 시크릿";   // 페이스북 앱 시크릿 코드
$config['facebook_login']['redirect_uri']   = "페이스북 Redirect URI";
$config['facebook_login']['authorize_url']= "https://www.facebook.com/dialog/oauth";
$config['facebook_login']['token_url']  = "https://graph.facebook.com/v2.4/oauth/access_token";
$config['facebook_login']['info_url']       = "https://graph.facebook.com/v2.4/me";
$config['facebook_login']['token_request_post'] = FALSE;
 
$config['kakao_login']['client_id']     = "05fb048b0d19e0d73128cfcff3673069";   // REST API 키를 입력
$config['kakao_login']['client_secret'] = "wf3W8zGPaUIBwHJNDOwPWYftpxOtwZJB";   // 카카오는 Client Secret을 사용하지 않습니다. 공백으로 지정
$config['kakao_login']['redirect_uri']  = "https://bsweb01.cafe24.com/member/kakao_auth";
$config['kakao_login']['authorize_url'] = "https://kauth.kakao.com/oauth/authorize";
$config['kakao_login']['token_url']     = "https://kauth.kakao.com/oauth/token";
$config['kakao_login']['info_url']      = "https://kapi.kakao.com/v2/user/me";
$config['kakao_login']['token_request_post'] = FALSE;
 
$config['google_login']['client_id']        = "202307683195-uha4porfejhvehh4p2m282e9kju2ob41.apps.googleusercontent.com";
$config['google_login']['client_secret']    = "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";
$config['google_login']['redirect_uri']     = $_SERVER['HTTP_HOST']."/member/google_auth";
$config['google_login']['authorize_url']    = "https://accounts.google.com/o/oauth2/auth";
$config['google_login']['token_url']        = "https://www.googleapis.com/oauth2/v4/token";
$config['google_login']['info_url']         = "https://www.googleapis.com/plus/v1/people/me";
$config['google_login']['token_request_post'] = TRUE;