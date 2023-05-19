<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code extends KURLY_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('Code_model');
		$this->load->helper("alert");
        
        $this->current_menu_code = "0102";
	}

    
	public function index() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        redirect('mgr/code/scheme');
        
		$this->_admin_footer();
    }

    
	public function scheme() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('scheme_code', 'Type Code', 'required');
        $this->form_validation->set_rules('scheme_name', 'Type Name', 'required');
        
		$this->form_validation->set_error_delimiters('<div style="clear: both; padding-left: 15px; color:red;">', '</div>');

		if ($this->form_validation->run() === false) {
            // Code Scheme - List
            $data['schemeList'] = $this->Code_model->getCodeSchemeList();
            
            $data['pageName'] = 'mgr/code/scheme';
            $this->load->view($this->global_layout_manager, $data);
        } else {
            $option = $this->input->post();
            $option['regist_ip'] = $_SERVER['REMOTE_ADDR'];
            $option['update_ip'] = $_SERVER['REMOTE_ADDR'];
            
            // Code Scheme - 중복 Check
            $overlap = $this->Code_model->getCodeSchemeCheck($option);
            
            if ($overlap > 0) {
                $this->session->set_flashdata('message', '중복된 코드입니다.');
            } else {
                // Code Scheme - Insert
                $this->Code_model->insertCodeScheme($option);
            }
            redirect('mgr/code/scheme');
        }
        
		$this->_admin_footer();
    }
    
    
    public function schemeupdate() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->post('scheme_code') == "" || $this->input->post('scheme_name') == "") {
            $this->session->set_flashdata('message', '페이지를 찾을 수 없습니다.');
        } else {
            $option = $this->input->post();
            $option['update_ip'] = $_SERVER['REMOTE_ADDR'];
            
            // Code Scheme - Update
            $this->Code_model->updateCodeScheme($option);
        }
        redirect('mgr/code/scheme');
        
		$this->_admin_footer();
    }


    public function schemedelete() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->post('scheme_code') == "") {
            $this->session->set_flashdata('message', '페이지를 찾을 수 없습니다.');
        } else {
            $option = $this->input->post();
            
            // scheme_code 하위의 코드 갯수
            $code_count = $this->Code_model->getCodeCount($option);
            if ($code_count > 0) {
                $this->session->set_flashdata('message', '하위 코드 삭제 후 다시 시도해주세요.');
            } else {
                // Code Scheme - Delete
                $this->Code_model->deleteCodeScheme($option);
            }
        }
        redirect('mgr/code/scheme');
        
		$this->_admin_footer();
    }


    public function codes() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('code_name', 'Code Name', 'required');
        $this->form_validation->set_rules('sequence', 'Sequence', 'required');
        
		$this->form_validation->set_error_delimiters('<div style="clear: both; padding-left: 15px; color:red;">', '</div>');

		if ($this->form_validation->run() === false) {
            $option['scheme_code'] = $this->input->get('scheme_code');
            
            // Code Scheme 정보 가져오기
            $data['scheme'] = $this->Code_model->getCodeScheme($option);
            
            // Code - List
            $data['codeList'] = $this->Code_model->getCodeList($option);

            $data['pageName'] = 'mgr/code/codes';
            $this->load->view($this->global_layout_manager, $data);
        } else {
            $option = $this->input->post();
            $option['regist_ip'] = $_SERVER['REMOTE_ADDR'];
            $option['update_ip'] = $_SERVER['REMOTE_ADDR'];
            
            // Code - 중복 Check
            $overlap = $this->Code_model->getCodeCheck($option);
            
            if ($overlap > 0) {
                //alert('중복된 코드입니다.');
                $this->session->set_flashdata('message', '중복된 코드입니다.');
            } else {
                // Code Scheme - Insert
                $this->Code_model->insertCode($option);
            }
            redirect('mgr/code/codes?scheme_code='.$option['scheme_code']);
        }
        
		$this->_admin_footer();
    }
    
    
    public function codeupdate() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        if ($this->input->post('scheme_code') == "" || $this->input->post('seq') == "") {
            $this->session->set_flashdata('message', '페이지를 찾을 수 없습니다.');
        } else {
            $option = $this->input->post();
            $option['update_ip'] = $_SERVER['REMOTE_ADDR'];
            
            // Code - Update
            $this->Code_model->updateCode($option);
        }
        redirect('mgr/code/codes?scheme_code='.$option['scheme_code']);
        
		$this->_admin_footer();
    }


    public function codedelete() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->post('seq') == "") {
            alert('페이지를 찾을 수 없습니다.');
        } else {
            $option = $this->input->post();
            
            // Code Scheme - Delete
            $this->Code_model->deleteCode($option);

            redirect('mgr/code/codes?scheme_code='.$option['scheme_code']);
        }
        
		$this->_admin_footer();
    }
}
