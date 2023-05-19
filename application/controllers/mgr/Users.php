<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends KURLY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
        $this->load->model('Code_model');
        $this->load->library("excel");
        $this->load->helper('directory');
        $this->load->helper('paging');
		$this->load->helper("alert");
        
        $this->current_menu_code = "02";
	}

    
	public function index() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        $s_startdate = $this->input->get('s_startdate');
        $s_enddate = $this->input->get('s_enddate');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        
		if ($this->input->get('page')) 
			$page = $this->input->get('page');
		else
			$page = 1;

		$block_size = 10;
		$limit_size = 20;
		$limit_start = ($page - 1) * $limit_size;
        
		$option = array(
			's_startdate'	=> $s_startdate,
			's_enddate'	=> $s_enddate,
			's_field'	=> $s_field,
			's_string'	=> $s_string,
			'limit_start'	=> $limit_start,
			'limit_size'	=> $limit_size
		);
		$params = "s_startdate=".$s_startdate."&s_enddate=".$s_enddate."&s_field=".$s_field."&s_string=".$s_string;

        // 전체 데이터 수
		$total_count = $this->User_model->getUserListCount($option);
		$total_page = ceil($total_count / $limit_size);
        
        // 데이터 목록
        $users = $this->User_model->getUserList($option);
        
        // Pagination
        $url = base_url('mgr/users') . "?" . $params . "&page=";
		$pagination = getPagingBasic($block_size, $page, $total_page, $url);
        
        $data['s_startdate'] = $s_startdate;
        $data['s_enddate'] = $s_enddate;
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['users'] = $users;
		$data['total_count'] = $total_count;
		$data['total_page'] = $total_page;
		$data['page'] = $page;
		$data['page_rows'] = $limit_size;
		$data['pagination'] = $pagination;
		$data['params'] = $params;
        
        $data['pageName'] = 'mgr/users/list';
		$this->load->view($this->global_layout_manager, $data);
        
		//$this->admin_footer();
    }

    
	public function info() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        if (!$this->input->get('email')) {
            alert('요청하신 페이지를 찾을 수 없습니다.');
        }
        $email = $this->input->get('email');
        $s_startdate = $this->input->get('s_startdate');
        $s_enddate = $this->input->get('s_enddate');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        
		if ($this->input->get('page')) 
			$page = $this->input->get('page');
		else
			$page = 1;

		$params = "s_startdate=".$s_startdate."&s_enddate=".$s_enddate."&s_field=".$s_field."&s_string=".$s_string;

        $data['user'] = $this->User_model->getUser(array('email'=>$email));
        
        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
		$data['page'] = $page;
		$data['params'] = $params;
        
        $data['pageName'] = 'mgr/users/info';
		$this->load->view($this->global_layout_manager, $data);
        
		//$this->admin_footer();
    }
    
    
	public function update() {
		$data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);
        
        if (!$this->input->post('name') || !$this->input->post('email') || !$this->input->post('birthday')) {
            alert("누락된 데이터가 있습니다.");
        }
        
        $s_startdate = $this->input->get('s_startdate');
        $s_enddate = $this->input->get('s_enddate');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        
		if ($this->input->get('page')) 
			$page = $this->input->get('page');
		else
			$page = 1;

		$params = "s_startdate=".$s_startdate."&s_enddate=".$s_enddate."&s_field=".$s_field."&s_string=".$s_string;
        
        if ($this->input->post('passwd')) {
            if(!function_exists('password_hash')){
                $this->load->helper('password');
            }
            $hash = password_hash($this->input->post('passwd'), PASSWORD_BCRYPT);
        } else {
            $hash = "";
        }

        // Frontliner 정보 수정하기
        $option = array(
            'email' => $this->input->post('email'),
            'passwd' => $hash,
            'name' => $this->input->post('name'),
            'birthday' => $this->input->post('birthday'),
            'status' => $this->input->post('status')
        );
        //var_dump($option); exit;
        $this->User_model->updateUser($option);
        
        //alert("정상적으로 수정되었습니다.", "/mgr/frontliner/info?email=".$this->input->post('email')."&".$params."&page=".$page);
        $this->session->set_flashdata('message', 'Berubah data sukses');
        redirect("mgr/users/info?email=".$this->input->post('email')."&".$params."&page=".$page);
        
		//$this->admin_footer();
    }
    
    
	public function excel() {
        $this->output->enable_profiler(false);		// 디버그용 결과
        
        $s_startdate = $this->input->get('s_startdate');
        $s_enddate = $this->input->get('s_enddate');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        
		$option = array(
			's_startdate'	=> $s_startdate,
			's_enddate'	=> $s_enddate,
			's_field'	=> $s_field,
			's_string'	=> $s_string
		);

        // 데이터 목록
        $users = $this->User_model->getUserList($option);
        

        // 파일명
        $filename = "DatabaseCalon_".date("Ymd");
        
		// Sheet명
        $sheet_name = "Sheet1";

		# 시트지정
        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle($sheet_name);

		// CELL 헤더 설정
		$this->excel->getActiveSheet()->setCellValue('A1', 'No');
		$this->excel->getActiveSheet()->setCellValue('B1', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('C1', 'E-Mail');
		$this->excel->getActiveSheet()->setCellValue('D1', 'Tanggal Lahir');
		$this->excel->getActiveSheet()->setCellValue('E1', 'Umur');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Join Date');
		$this->excel->getActiveSheet()->setCellValue('G1', 'Last Login');

		$this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setSize(11);
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

		# 헤더 컬럼 가운데 정렬
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1:G1')->applyFromArray(array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
		));

        
        $cnt = 1;
        foreach ($users as $i => $list) {
            $cnt++;
            
            $this->excel->getActiveSheet()->setCellValue('A'.$cnt, $i+1);
            $this->excel->getActiveSheet()->setCellValue('B'.$cnt, $list->name);
            $this->excel->getActiveSheet()->setCellValue('C'.$cnt, $list->email);
            $this->excel->getActiveSheet()->setCellValue('D'.$cnt, date('d-M-Y', strtotime($list->birthday)));
            $this->excel->getActiveSheet()->setCellValue('E'.$cnt, "");
            $this->excel->getActiveSheet()->setCellValue('F'.$cnt, date('d-M-Y H:i', strtotime($list->regist_date)));
            $this->excel->getActiveSheet()->setCellValue('G'.$cnt, date('d-M-Y H:i', strtotime($list->last_login_date)));
        }
        
		$this->excel->getActiveSheet()->getStyle('A2:G'.$cnt)->getFont()->setSize(11);
		$this->excel->getActiveSheet()->getStyle('A2:G'.$cnt)->applyFromArray(array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
		));

		set_time_limit(0);
		ini_set('memory_limit','512M');
		ini_set('max_execution_time',120);
        
		#파일로 내보낸다.
        if (!$filename) $filename = date('Ymd');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');

		# 두 번째 매개변수를 'Excel2007'로 바꾸면 Excel 2007 .XLSX 포맷으로 저장한다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');

        # 이용자가 다운로드하여 컴퓨터 HDD에 저장하도록 강제한다.
        $objWriter->save('php://output');
    }
}
