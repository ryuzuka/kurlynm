<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->model('User_model');
        $this->load->helper("alert");
	}

    
	public function index() {
        $data['doc_title'] = "Find Password";
        
        $this->load->view($this->global_device_view.'/password', $data);
    }

    
    // 패스워드 발급하여 메일전송 처리
    public function process()
    {
        $user = $this->User_model->getUser(array('email'=>$this->input->post('email')));
        //var_dump($frontliner); exit;

        if($user && $user->status == "Y"){
            if(!function_exists('password_hash')){
                $this->load->helper('password');
            }
            $rand = rand(1000, 9999);
            $hash = password_hash($rand, PASSWORD_BCRYPT);

            // 재발급 된 비밀번호로 업데이트
            $this->User_model->updatePassword(array('passwd'=>$hash, 'email'=>$this->input->post('email')));
            
            // 재발급 된 비밀번호를 메일로 전송
            $this->load->library('email');
            $this->email->initialize(array('mailtype'=>'html'));
            $this->email->from("noreply@accentuates.co.id", "JOB Accentuates");            
            $this->email->subject("[JOB Accentuates] Kata Sandi baru");
            $msg = "Hai ".$user->name;
            $msg .= "<br>Anda minta kata sandi baru di site : <a href='http://job.accentuates.co.id' target='_blank'>job.accentuates.co.id</a>";
            $msg .= "<br>di bawah adalah kata sandi baru Anda.";
            $msg .= "<br><br><b>".$rand."</b>";
            $msg .= "<br><br>Terima kasih";
            $msg .= "<br>Accentuates.";
            $this->email->message($msg);
            $this->email->to($user->email);
            $this->email->send();
            
            $this->session->set_flashdata('message', 'Kata Sandi sementara sudah dikirim ke E-mail Anda');
            redirect('main');
        } else {
            $this->session->set_flashdata('message', 'E-mail Anda belum terdaftar');
            redirect('main');
        }
        
    }

    
    // 로그아웃
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("login");
    }
}
