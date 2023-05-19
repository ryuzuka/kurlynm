<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends KURLY_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('code_model');
		$this->load->helper('arraytostring');
		$this->load->helper('directory');
		$this->load->helper('paging');
		$this->load->helper('alert');

        $this->current_menu_code = "0103";
	}


	public function index() {
//		$data['current_menu_code'] = $this->current_menu_code;
//        $this->_admin_header($data);
//
//        $data['s_field'] = $this->input->get('s_field');
//        $data['s_string'] = $this->input->get('s_string');
//        $data['adminList'] = $this->admin_model->getAdminList($data);
//
//        $data['pageName'] = 'mgr/admin/list';
//        $this->load->view($this->global_layout_manager, $data);
//
//		$this->_admin_footer();

		$s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');

		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

		if ($this->input->get('page'))
			$page = $this->input->get('page');
		else
			$page = 1;

		$block_size = 10;
		$limit_size = 15;
		$limit_start = ($page - 1) * $limit_size;

		$option = array(
			's_field'		=> $s_field,
			's_string'		=> $s_string,
			'limit_start'	=> $limit_start,
			'limit_size'	=> $limit_size
		);
		$data['s_field'] = $s_field;
		$data['s_string'] = $s_string;
		$params = "";

        // 전체 데이터 수
		$total_count = $this->admin_model->getAdminListCount($option);
		$total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $adminList = $this->admin_model->getAdminList($option);

        // Pagination
        $url = '/mgr/admin' . "?" . $params . "&page=";
		$pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['adminList'] = $adminList;
		$data['total_count'] = $total_count;
		$data['total_page'] = $total_page;
		$data['page'] = $page;
		$data['page_rows'] = $limit_size;
		$data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/admin/list';
		$this->load->view($this->global_layout_manager, $data);

		$this->_admin_footer();
    }


	public function insert() {
            $data['current_menu_code'] = $this->current_menu_code;
            $this->_admin_header($data);

            $this->load->library('form_validation');			//form_validation 로드
            $this->form_validation->set_rules('admin_id', '아이디', 'trim|required|min_length[4]|max_length[20]|is_unique[tb_admin.admin_id]');// is_unique[tb_admin.admin_id] - 내부적으로 DB 연동하여 unique 체크
            $this->form_validation->set_rules('admin_name', '이름', 'trim|required|min_length[2]');
            $this->form_validation->set_rules('admin_passwd', '비밀번호', 'trim|required|min_length[4]|max_length[20]');
            $this->form_validation->set_rules('admin_passwd2', '비밀번호 확인', 'trim|required|matches[admin_passwd]');
            $this->form_validation->set_rules('admin_level', '등급', 'required');
            $this->form_validation->set_rules('status', '상태', 'required');

            $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

            if ($this->form_validation->run() === false) {
                // 관리자 등급 목록 가져오기
                $data['adminLevelList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'AL1'));

                $data['pageName'] = 'mgr/admin/write';
                $this->load->view($this->global_layout_manager, $data);
            } else {
                if(!function_exists('password_hash')){
                    $this->load->helper('password');
                }
                $hash = password_hash($this->input->post('admin_passwd'), PASSWORD_BCRYPT);

                $option = array(
                    'admin_id' => $this->input->post('admin_id'),
                    'admin_passwd' => $hash,
                    'admin_name' => $this->input->post('admin_name'),
                    'admin_level' => $this->input->post('admin_level'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'status' => $this->input->post('status')
                );
                $this->admin_model->insertAdmin($option);

                //$this->session->set_flashdata('message', '새로운 관리자가 정상적으로 등록되었습니다.');
                $this->session->set_flashdata('message', 'Akun in sudah terdaftar');
                redirect('mgr/admin');
            }

            $this->_admin_footer();
    }


	public function update() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

		$this->load->library('form_validation');			//form_validation 로드
		//$this->form_validation->set_rules('admin_id', '아이디', 'trim|required|min_length[4]|max_length[20]|is_unique[tb_admin.admin_id]');// is_unique[tb_admin.admin_id] - 내부적으로 DB 연동하여 unique 체크
        $this->form_validation->set_rules('admin_name', '이름', 'trim|required|min_length[2]');
        if ($this->input->post('admin_passwd') || $this->input->post('admin_passwd2')) {
            $this->form_validation->set_rules('admin_passwd', '비밀번호', 'trim|required|min_length[4]|max_length[20]');
            $this->form_validation->set_rules('admin_passwd2', '비밀번호 확인', 'trim|required|matches[admin_passwd]');
        }
        $this->form_validation->set_rules('admin_level', '등급', 'required');
        $this->form_validation->set_rules('status', '상태', 'required');

		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            // 관리자 등급 목록 가져오기
            $data['adminLevelList'] = $this->code_model->getCodeList(array('scheme_code' => 'AL1'));
            // 관리자 등급 목록 가져오기
            $data['useAdminLevelList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'AL1'));
            // 관리자 정보 가져오기
            $data['admin'] = $this->admin_model->getAdmin(array('admin_id' => $this->input->get('admin_id')));

            $data['pageName'] = 'mgr/admin/info';
            $this->load->view($this->global_layout_manager, $data);
        } else {
            if ($this->input->post('admin_passwd')) {
                if(!function_exists('password_hash')){
                    $this->load->helper('password');
                }
    			$hash = password_hash($this->input->post('admin_passwd'), PASSWORD_BCRYPT);
            } else {
                $hash = "";
            }

            $option = array(
				'admin_id' => $this->input->post('admin_id'),
				'admin_passwd' => $hash,
                'admin_name' => $this->input->post('admin_name'),
				'admin_level' => $this->input->post('admin_level'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
				'status' => $this->input->post('status')
			);
			$this->admin_model->updateAdmin($option);

			$this->session->set_flashdata('message', '관리자 정보가 정상적으로 수정되었습니다.');
			//$this->session->set_flashdata('message', 'Akun ini sudah dirubah');
            redirect('mgr/admin/update?admin_id='.$this->input->post('admin_id'));
        }

		$this->_admin_footer();
    }


	public function delete() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->get('admin_id')) {
            $option = array(
                'admin_id' => $this->input->get('admin_id')
            );
            $this->admin_model->deleteAdmin($option);
            redirect('mgr/admin');
        } else {
            //$this->session->set_flashdata('message', '페이지를 찾을 수 없습니다.');
            alert('페이지를 찾을 수 없습니다.');
        }

		$this->_admin_footer();
    }

}