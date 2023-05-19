<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->helper('cookie');
    }


    public function index()
    {
//        if(!function_exists('password_hash')){
//                $this->load->helper('password');
//        }
//        
//        echo password_hash('dkagh', PASSWORD_BCRYPT); exit;
            
        if($this->session->userdata('AID')){
            $this->load->helper('url');
            redirect("mgr/main");
        } else {
            $data['doc_title'] = "LOGIN";
            $data['returnURL'] = $this->input->get('returnURL');
            $data['remember'] = $this->input->cookie('remember');

            $this->load->view('mgr/login', $data);
        }
    }


    // 로그인 처리
    public function auth()
    {
        $returnURL = $this->input->get('returnURL');

        $admin = $this->Admin_model->getAdmin(array('admin_id'=>$this->input->post('login_id')));

        if(!function_exists('password_hash')){
                $this->load->helper('password');
        }
		
        // 관리자 계정 사용 유무(Y/N)
        if($admin->status == "Y"){
            if ($this->input->post('login_id') == $admin->admin_id && password_verify($this->input->post('login_passwd'), $admin->admin_passwd)) {			// 비밀번호가 일치 할 경우
                $this->session->set_userdata('AID', $admin->admin_id);
                $this->session->set_userdata('AEmail', $admin->email);
                $this->session->set_userdata('AName', $admin->admin_name);
                $this->session->set_userdata('ALevel', $admin->admin_level);
                $this->session->set_userdata('ALastLoginDate', $admin->last_login_date);
                $this->session->set_userdata('ALoginCount', $admin->login_count);

                // login info update
                $this->Admin_model->updateAdminLogin(array('admin_id'=>$admin->admin_id));

                if ($this->input->post('remember') == "Y") {
                    $this->input->set_cookie('remember', $admin->admin_id, '2592000', $this->global_domain, '/', '', FALSE);
                } else {
                    delete_cookie('remember', $this->global_domain, '/', '');
                }
//print_r($this->session->userdata('AID')); exit;

                redirect('mgr/site/notice');
            } else {
                //print_r("aa"); exit;
                // 비밀번호가 일치하지 않을 경우
                $this->session->set_flashdata('message', '로그인 정보가 일치하지 않습니다.');
                redirect($returnURL ? 'mgr/login?returnURL='.rawurlencode($returnURL) : 'mgr/login');
            }
        } else {
            //print_r("bb"); exit;
            // 관리자 상태가 N인경우
            $this->session->set_flashdata('message', '접속할 수 없는 계정입니다.');
            redirect($returnURL ? 'mgr/login?returnURL='.rawurlencode($returnURL) : 'mgr/login');
        }
    }


    // 로그아웃
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("mgr/login");
    }
}
