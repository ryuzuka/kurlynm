<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class KURLY_Controller extends CI_Controller {

        function __construct() {
            parent::__construct();		// 부모 클래스 CI_Controller 생성자를 호출

            //$this->output->set_header("Content-Type: text/html; charset=UTF-8;");

            //$this->output->enable_profiler(true);		// 디버그용 결과

            if ( $_SERVER['HTTP_HOST'] == 'kurlynextmile.com' )
            {
                $this->goto_url('https://www.kurlynextmile.com');
                exit;
            }
            

            if ( $_SERVER['HTTP_HOST'] == 'kurlynextmile.co.kr' )
            {
                $this->goto_url('https://www.kurlynextmile.com');
                exit;
            }
            
            if ( $_SERVER['HTTP_HOST'] == 'www.kurlynextmile.co.kr' )
            {
                $this->goto_url('https://www.kurlynextmile.com');
                exit;
            }            
            
//            $full_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//
//            // https 도메인 redirect 하기
//            if (stripos($full_url, "https://kurlynextmile.com") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }
//            // http 도메인 redirect 하기
//            if (stripos($full_url, "http://kurlynextmile.com") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }
//            // http 도메인 redirect 하기
//            if (stripos($full_url, "http://www.kurlynextmile.com") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }
//            // http 도메인 redirect 하기
//            if (stripos($full_url, "http://www.kurlynextmile.com") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }
//            
//            // http 도메인 redirect 하기
//            if (stripos($full_url, "https://kurlynextmile.co.kr") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }
//            // http 도메인 redirect 하기
//            if (stripos($full_url, "https://www.kurlynextmile.co.kr") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }
//            // http 도메인 redirect 하기
//            if (stripos($full_url, "http://kurlynextmile.co.kr") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }
//            // http 도메인 redirect 하기
//            if (stripos($full_url, "http://www.kurlynextmile.co.kr") !== false) {
//                $this->goto_url("https://www.kurlynextmile.com" . $_SERVER['REQUEST_URI']);
//            }

            $this->_ip_auth();
            /*******************************
             * Global 변수
             *******************************/
            $this->global_site_name = "KURLY";
            $this->global_domain = "www.kurlynextmile.com";

            $this->global_root_path = $_SERVER['DOCUMENT_ROOT'];
            $this->global_server_addr = $_SERVER['SERVER_ADDR'];
            $this->global_server_no = "80";

            // Layout Container 경로
            $this->global_layout_manager = "mgr/layout/container";
            $this->global_layout_manager_popup = "mgr/layout/pop_container";
            $this->global_layout_pc_prefix = "front/layout/container_";
            $this->global_layout_mo_prefix = "mobile/layout/container_";

            // Upload 관련
            $this->global_upload_uri = "/upload";
            $this->global_upload_path = $this->global_root_path . $this->global_upload_uri;
            $this->global_upload_file_allowed = "pdf|txt|zip|rar|hwp|ppt|pptx|xls|xlsx|doc|docx|swf|mp3|avi|html|htm|gif|jpg|png|mp4|bmp";
            $this->global_upload_image_allowed = "gif|jpg|jpeg|png|mp4";
            $this->global_upload_media_allowed = "*";
            $this->global_upload_max_size = 200 * 1024;      // 20M

            $this->global_admin_id = "admin";
            /*******************************/


            /*******************************
             * 접속 환경
             *******************************/
            $this->global_uri = $_SERVER['REQUEST_URI'];
            $this->global_user_ip = $_SERVER['REMOTE_ADDR'];
            $this->global_user_agent = $_SERVER['HTTP_USER_AGENT'];
            if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) 
                $this->global_referer = $_SERVER['HTTP_REFERER']; 
            else 
                $this->global_referer = "";

            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$this->global_user_agent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($this->global_user_agent,0,4))) {
                $this->global_device = "mobile";
            } else {
                $this->global_device = "pc";
            }

            // Member Info
            $this->member = null;
            if ($this->session->userdata('MID')) {
                $this->load->model('member_model');
                $this->member = $this->member_model->getMember(array('member_id'=>$this->session->userdata('MID')));
            }


            // Operation - Footer 공통 정보
            //$this->load->model('main_model');
            //$this->operation = $this->main_model->getOperation();
        }

        // header
        function _header($data=null) {

            $this->load->vars($data);
        }

        // footer
        function _footer($data=null) {
        }

        function goto_url($url)
        {
            $url = str_replace("&", "&", $url);
            echo "<script> location.replace('$url'); </script>";

            if (!headers_sent())
                header('Location: '.$url);
            else {
                echo '<script>';
                echo 'location.replace("'.$url.'");';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
                echo '</noscript>';
            }
            exit;
        }
        
        // admin header
        public function _admin_header($data) {
            //print_r($this->session->userdata('AID')); exit;
            // Login Check
            $this->_require_admin_login($_SERVER['REQUEST_URI']);

            // DB, Helper Load
            $this->load->model('Adminmenu_model');
            $this->load->model('Adminauth_model');
            $this->load->helper("alert");
            
            if ($data['current_menu_code']) {
                // 현재 메뉴 정보
                $currentAdminMenu = $this->Adminmenu_model->getAdminMenu(array("menu_code"=>$data['current_menu_code']));
                $data['adminMenu'] = $currentAdminMenu;

                // 부모 메뉴 정보 (네비게이션)
                $arrayNavi = array();
                if ($data['current_menu_code']) {
                    for ($i=2; $i<=strlen($data['current_menu_code'])-2; $i+=2) {
                        $navi = $this->Adminmenu_model->getAdminMenu(array('menu_code'=>substr($data['current_menu_code'], 0, $i)));
                        array_push($arrayNavi, array('menu_name'=>$navi->menu_name, 'url'=>$navi->url));
                    }
                }
                $data['navis'] = $arrayNavi;

                // 전체 메뉴 노출 정보
                $data['adminMenus'] = $this->Adminmenu_model->getAdminMenuDisplay(array('admin_level'=>$this->session->userdata('ALevel'), 'admin_id'=>$this->session->userdata('AID')));
            }
//print_r($data['current_menu_code']); exit;
            $this->load->vars($data);

        }

        // admin footer
        public function _admin_footer() {

        }

        // admin footer
        public function _ip_auth() {
            $UserIP = $_SERVER['REMOTE_ADDR'];  // 접속한 사용자의 IP주소 불러오기
            
            $ip_extract = explode(".",$UserIP);  //.로 분리해서 배열로 저장
            $UserIP_trim = $ip_extract[0].".".$ip_extract[1].".".$ip_extract[2];

            $ipcheck_1 = "114.201.229"; // 접속 허용 IP 블럭
            
            if($UserIP_trim <> $ipcheck_1) {                
//                 echo "<script>alert('허용된 사용자가 아닙니다.');'</script>";
//                 exit;
             }
        }
        
        // 회원 로그인 체크
        function _require_login() {

            // 관리자 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
            if(!$this->session->userdata('MID')) {
                $this->session->set_flashdata('message', '로그인이 필요한 서비스입니다.');
                redirect('/member/login');
                
                //redirect('/');
            }
        }

        // admin login check
        public function _require_admin_login($return_url) {
            //echo rawurlencode($return_url);
            //echo "==".$this->session->userdata('AID'); exit;

            // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
            if(!$this->session->userdata('AID')){
                redirect('mgr/login?returnURL='.rawurlencode($return_url));
            }
        }
        
        // 프론티어 오리엔테이션 접근 체크
        function _require_final($return_url) {
            $this->load->model('applicant_model');
            $this->load->model('site_model');
            
            // 활성화된 기수정보 가져오기
            $group = $this->site_model->getGroup();
            
            // 데이터 개수
            $cnt = $this->applicant_model->getFinalMemberListCount(array('member_id' => $this->session->userdata('MID'), 'group_cd' => $group->ot_group_cd));
        
            // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
            if(!$this->session->userdata('MID')){
                redirect('/login?returnURL='.rawurlencode($return_url));
                //$this->session->set_flashdata('message', '로그인 하십시오.');
                //redirect('/');
            } else {
                if ($cnt < 1) { //최종선발된 사람이 아니면
                    $this->session->set_flashdata('message', '오리엔테이션 회원만 접근 가능합니다.');
                    redirect('/');
                }
            }
        }
        
        // 프론티어클럽 소개, 게시판 접근 체크
        function _require_frontier($return_url) {
            $this->load->model('frontier_model');
            
            // 데이터 개수
            $cnt = $this->frontier_model->getFrontierMemberCount(array('member_id' => $this->session->userdata('MID')));
        
            // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
            if(!$this->session->userdata('MID')){
                redirect('/login?returnURL='.rawurlencode($return_url));
                //$this->session->set_flashdata('message', '로그인 하십시오.');
                //redirect('/');
            } else {
                if ($cnt < 1) { // 프론티어 id가 없으면
                    $this->session->set_flashdata('message', '프론티어 클럽 회원만 접근 가능합니다.');
                    redirect('/');
                }
            }
        }

        // Log 저장
        public function _save_log($data) {
            $this->load->model('statistics_model');
            $option = array(
                'page' => $data['page'],
                'device' => $data['device'],
                'ip' => $data['user_ip'],
                'agent' => $data['user_agent'],
                'referer' => $data['referer'],
                'date' => date('Y-m-d')
            );

            // 오늘 접속 정보 있는지 체크
            $option['logCheck'] = $this->statistics_model->getLogCheck($option);

            // 오늘 통계 정보 있는지 체크
            $statisticsCheck = $this->statistics_model->getStatisticsCheck($option);

            // 통계 카운팅 업데이트 (통계 정보 없으면 인서트)
            if ($statisticsCheck > 0) {
                $this->statistics_model->updateStatistics($option);
            } else {
                $this->statistics_model->insertStatistics($option);
            }

            // 로그 저장
            $this->statistics_model->insertLog($option);
        }




        //********************************************************************************************
        // NICE평가정보 본인확인 관련
        // 해당 함수에서 에러 발생 시 $len => (int)$len 로 수정 후 사용하시기 바랍니다. (하기소스 참고)
        //********************************************************************************************
        function GetValue($str , $name) 
        {
            $pos1 = 0;  //length의 시작 위치
            $pos2 = 0;  //:의 위치

            while( $pos1 <= strlen($str) )
            {
                $pos2 = strpos( $str , ":" , $pos1);
                $len = substr($str , $pos1 , $pos2 - $pos1);
                $key = substr($str , $pos2 + 1 , (int)$len);
                $pos1 = $pos2 + $len + 1;
                if( $key == $name )
                {
                    $pos2 = strpos( $str , ":" , $pos1);
                    $len = substr($str , $pos1 , $pos2 - $pos1);
                    $value = substr($str , $pos2 + 1 , $len);
                    return $value;
                }
                else
                {
                    // 다르면 스킵한다.
                    $pos2 = strpos( $str , ":" , $pos1);
                    $len = substr($str , $pos1 , $pos2 - $pos1);
                    $pos1 = $pos2 + $len + 1;
                }            
            }
        }



        /**
         * _remap
         * @param type $method
         */
        public function _remap($method) {
            if (method_exists($this, $method)) {
                $parameters = array_slice($this->uri->rsegments, 2);
                call_user_func_array(array($this, $method), $parameters);
            } else {
                $parameters = array_slice($this->uri->rsegments, 1);
                call_user_func_array(array($this, 'index'), $parameters);
            }
        }

    }