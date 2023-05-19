<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Resume_model');
		$this->load->helper("alert");
        
        $this->current_menu_code = "0";
	}

    
	public function index() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_header($data);
        
        $data['pageTitle'] = "REGISTER";
        $data['pageName'] = $this->global_device_view.'/register';
		
        $this->load->view($this->global_layout_front, $data);
    }

    
	public function process() {
        //var_dump($this->input->post());
        if (!$this->input->post('name') || !$this->input->post('email') || !$this->input->post('passwd')) {
            alert("Wajib diisi dengan lengkap");
        }
        
        $checkEmail = $this->User_model->getEmailCheck(array('email'=>$this->input->post('email')));
        if ($checkEmail > 0) {
            alert("Saya telah menjadi anggota");
        }
            
        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        $hash = password_hash($this->input->post('passwd'), PASSWORD_BCRYPT);
        
        
        $this->db->trans_start();
        
        // 회원가입
        $option = array(
            'email' => $this->input->post('email'),
            'passwd' => $hash,
            'name' => $this->input->post('name'),
            'birthday' => $this->input->post('birthday'),
            'status' => "Y"
        );
        $this->User_model->insertUser($option);

        // 이력서 기본정보 추가
        $option2 = array(
            'email' => $this->input->post('email'),
            'regist_ip' => $_SERVER["REMOTE_ADDR"],
            'update_ip' => $_SERVER["REMOTE_ADDR"],
            'status' => "0"
        );
        $this->Resume_model->insertResume($option2);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            alert("회원가입 중 에러가 발생하였습니다. 관리자에게 문의하십시오.");
        }
                
        $this->session->set_flashdata('message', 'Selamat akun Anda berhasil dibuat');
        redirect('main');
    }

}
