<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminAuth extends KURLY_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('Adminauth_model');
		$this->load->model('Adminmenu_model');
		$this->load->helper("alert");
        
        $this->current_menu_code = "0105";
	}

    
	public function index() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        
        $data['adminAuthList'] = $this->Adminauth_model->getAdminAuthList();
        
        
        $data['pageName'] = 'mgr/adminauth/adminauth';
        $this->load->view($this->global_layout_manager, $data);
        
		$this->_admin_footer();
    }
    
    
    public function insert() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $menu_code = $this->input->post('menu_code');
		$arrayAdmin_id = $this->input->post('admin_id');
        $admin_length = count($arrayAdmin_id);
        
        if (!$menu_code || $admin_length < 1) {
            alert('페이지를 찾을 수 없습니다.');
        }
        
        for ($i=0; $i<$admin_length; $i++) {
            $option = array(
                'admin_id' => $arrayAdmin_id[$i],
                'menu_code' => $menu_code
            );
            
            // 현재 권한이 있는지 유무 체크.. 없으면 추가
            $checkAdminAuth = $this->Adminauth_model->getAdminMenuAuthCount($option);
            if ($checkAdminAuth < 1) {
                // 해당 메뉴에 권한을 추가한다
                $this->Adminauth_model->insertAdminAuth($option);

                // 해당 메뉴의 메인메뉴에 권한이 없다면 추가한다
                $option['menu_code'] = substr($menu_code, 0, strlen($menu_code)-2);
                $checkMainMenu = $this->Adminauth_model->getAdminMenuAuthCount($option);
                if ($checkMainMenu < 1) {
                    $this->Adminauth_model->insertAdminAuth($option);
                }
            }
        }
        alert_opener_close('정상적으로 처리되었습니다.');
//      echo "<script type='text/javascript'> alert('정상적으로 처리되었습니다'); opener.location.reload(); window.close(); </script>";
//		exit;
        
		$this->_admin_footer();
    }
    
    
	public function delete() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->get('admin_id') && $this->input->get('menu_code')) {			// 필수 입력 체크
            $option = array(
                'admin_id' => $this->input->get('admin_id'),
                'menu_code' => $this->input->get('menu_code'),
                'menu_code_length' => strlen($this->input->get('menu_code'))
            );
            
            // 해당 메뉴에 해당되는 권한을 삭제한다
            $this->Adminauth_model->deleteAdminAuth($option);
            
            // 서브 메뉴에 권한이 하나 이상 없다면 메인메뉴 권한도 삭제한다
            $option['menu_code'] = substr($this->input->get('menu_code'), 0, $option['menu_code_length']-2);
            $checkSubMenu = $this->Adminauth_model->getAdminAuthSubCount($option);
            if ($checkSubMenu < 1) {
                $this->Adminauth_model->deleteAdminAuth($option);
            }
		} else {
			$this->session->set_flashdata('message', 'Wajib diisi dengan lengkap');
		}

		redirect('mgr/adminauth');
        
		$this->_admin_footer();
	}
    
    
	public function popAdminList() {
		// 팝업페이지는 모두에게 권한이 있는 관리자 메인페이지와 같은 메뉴코드 "00"을 사용한다
        $data['current_menu_code'] = "00";
        $this->_admin_header($data);

        // 관리자 메뉴코드
        $option['menu_code'] = $this->input->get('menu_code');
        $data['adminMenu'] = $this->Adminmenu_model->getAdminMenu($option);

        // 관리자 목록
        $data['adminList'] = $this->Adminauth_model->getAdminList($option);
        
        
		// 팝업페이지는 페이지 제목 사용
        $data['pageTitle'] = '관리자 권한 추가';
        $data['pageName'] = 'mgr/adminauth/pop_adminlist';
        $this->load->view($this->global_layout_manager_popup, $data);
        
		$this->_admin_footer();
    }
    
}