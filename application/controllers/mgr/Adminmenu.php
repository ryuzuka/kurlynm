<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminMenu extends KURLY_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('Adminmenu_model');
		$this->load->helper("alert");
        
        $this->current_menu_code = "0104";
	}

    
	public function index() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        // $parent_code
		$option['parent'] = $this->input->get('parent_code');
        
//        echo $option['parent']."xxxx";
        
        // 조상 코드 가져오기
        $arrayAncestor = array();
        if ($option['parent']) {
            for ($i=2; $i<=strlen($option['parent']); $i+=2) {
                $ancestor = $this->Adminmenu_model->getAdminMenu(array('menu_code'=>substr($option['parent'], 0, $i)));
                array_push($arrayAncestor, array('menu_code'=>$ancestor->menu_code, 'menu_name'=>$ancestor->menu_name));
            }
        }

        // 현재 자식 코드 길이
        $menu_code_length = 2;
        if ($option['parent']) $menu_code_length = strlen($option['parent']) + 2;
        $option['menu_code_length'] = $menu_code_length;
        
        // 부모 code 하위의 code list 가져오기
        $adminMenuList = $this->Adminmenu_model->getAdminMenuList($option);
        
        // 부모 code에 해당하는 sequence의 Max 값
        $maxSequence = $this->Adminmenu_model->getMaxSequence($option);
        
        // data 적재
		$data['parent'] = $this->input->get('parent_code');
        $data['ancestors'] = $arrayAncestor;
        $data['adminMenuList'] = $adminMenuList;
        $data['next_seq'] = $maxSequence->sequence + 1;
        
        $data['pageName'] = 'mgr/adminmenu/adminmenu';
        $this->load->view($this->global_layout_manager, $data);
        
		$this->_admin_footer();
    }
    
    
    public function insert() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if (!$this->input->post('menu_name') || !$this->input->post('is_use') || !$this->input->post('sequence')) {
            $this->session->set_flashdata('message', 'Wajib diisi dengan lengkap');
        } else {
            $option = $this->input->post();
            
            $menu_code_length = 2;
            if ($option['parent']) $menu_code_length = strlen($option['parent']) + 2;
            $option['menu_code_length'] = $menu_code_length;

            // parent에 맞는 마지막 code 값 가져오기
            $maxCode = $this->Adminmenu_model->getTopMenuCode($option);
            
            // code 값 생성
            if ($maxCode->menu_code) {
                $code = substr("0".((int)$maxCode->menu_code + 1), $menu_code_length*(-1));
            } else {
                $code = $option['parent']."01";
            }
            $option['menu_code'] = $code;
            
            // parent에 맞는 sequence의 Max 값
            $maxSequence = $this->Adminmenu_model->getMaxSequence($option);
            
			// 다음 sequence의 Max+1 값보다 큰 경우.. Max+1 으로..
			if ($this->input->post('sequence') > ($maxSequence->sequence + 1)) {
				$option['sequence'] = $maxSequence->sequence + 1;
			} else {
				$option['sequence'] = $this->input->post('sequence');
			}
            
            // insert code
            $this->Adminmenu_model->insertAdminMenu($option);
            
            // sequence 가 중간에 삽입되는 경우
			$this->Adminmenu_model->updateSortInsert($option);
        }
        
        redirect('mgr/adminmenu?parent_code='.$this->input->post('parent'));
        
		$this->_admin_footer();
    }
    
    
    public function update() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->post('menu_code') && $this->input->post('menu_name') &&  $this->input->post('is_use') && $this->input->post('sequence')) {			// 필수 입력 체크
			$option = $this->input->post();

            // 수정할 sequence 가져오기
			$adminMenu = $this->Adminmenu_model->getAdminMenu(array('menu_code'=>$this->input->post('menu_code')));
			$prev_sequence = $adminMenu->sequence;

			// 부모코드에 해당하는 sequence의 Max 값
            $option['menu_code_length'] = strlen($this->input->post('menu_code'));
            if ($option['menu_code_length'] > 2) $option['parent'] = substr($this->input->post('menu_code'), 0, $option['menu_code_length']-2);
			$maxSequence = $this->Adminmenu_model->getMaxSequence($option);
            
            //echo $this->input->post('sequence')."<br>".$maxSequence->sequence; exit;
            
			// 다음 sequence의 Max 값보다 큰 경우.. Max 으로..
			if ($this->input->post('sequence') > $maxSequence->sequence) {
				$option['sequence'] = $maxSequence->sequence;
			} else {
				$option['sequence'] = $this->input->post('sequence');
			}

			// update code
			$this->Adminmenu_model->updateAdminMenu($option);

			// sequence 가 중간에 삽입되는 경우
			$option['prev_sequence'] = $prev_sequence;
			$this->Adminmenu_model->updateSortUpdate($option);

		} else {
			$this->session->set_flashdata('message', 'Wajib diisi dengan lengkap');
		}

		redirect('mgr/adminmenu?parent_code='.$this->input->post('parent'));
        
		$this->_admin_footer();
    }
    
    
	public function delete() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        if ($this->input->post('menu_code')) {			// 필수 입력 체크
			// 삭제할 sequence 가져오기
			$adminMenu = $this->Adminmenu_model->getAdminMenu(array('menu_code'=>$this->input->post('menu_code')));
			$sequence = $adminMenu->sequence;

			// sub code 존재하는지 체크
			$sub_chk = $this->Adminmenu_model->getAdminMenuListCount(array('menu_code'=>$this->input->post('menu_code')));

			if ($sub_chk < 1) {		// sub code가 없다면..
				// delete code
				$this->Adminmenu_model->deleteAdminMenu(array('menu_code'=>$this->input->post('menu_code')));

				// sequence 가 중간에 삭제될 경우
				$option['menu_code_length'] = strlen($this->input->post('menu_code'));
				if ($option['menu_code_length'] > 2) $option['parent'] = substr($this->input->post('menu_code'), 0, $option['menu_code_length']-2);
				$option['sequence'] = $sequence;
				$this->Adminmenu_model->updateSortDelete($option);
			} else {		// sub code가 존재한다면..
				$this->session->set_flashdata('message', '서브 코드가 존재합니다.\n서브 코드를 모두 삭제 후 다시 시도하십시오.');
			}

		} else {
			$this->session->set_flashdata('message', 'Wajib diisi dengan lengkap');
		}

		redirect('mgr/adminmenu?parent_code='.$this->input->post('parent'));
        
		$this->_admin_footer();
	}
    
}