<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('inquiry_model');
        $this->load->model('code_model');
        $this->load->helper('directory');
        $this->load->helper('string');
        $this->load->helper('paging');
        $this->load->helper("alert");
    }

    
    // 문의관리 - 견적문의
    public function estimate() {
        $data['current_menu_code'] = "0402";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_month = $this->input->get('s_month');
        $s_status = $this->input->get('s_status');
        $limit_size = $this->input->get('limit_size');
        
        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;
        
        if ($this->input->get('s_month'))
            $s_month = $this->input->get('s_month');
        else
            $s_month = "30";
        
        if ($this->input->get('s_term'))
            $s_term = $this->input->get('s_term');
        else
            $s_term = "regist_date";
        
        if ($this->input->get('start_date') && $this->input->get('end_date')) {
            
        } else {
            $start_date = date("Y-m-d", strtotime("-1 months"));
            $end_date = date('Y-m-d');
        }
        
        $block_size = 10;

        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 15;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            's_term'		=> $s_term,
            'start_date'	=> $start_date,
            'end_date'		=> $end_date . " 23:59",
            's_status'		=> $s_status,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['s_term'] = $s_term;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['s_month'] = $s_month;
        $data['s_status'] = $s_status;
        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_month=".$s_month."&s_status=".$s_status;

        // 전체 데이터 수
        $total_count = $this->inquiry_model->getEstimateListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 데이터 목록
        $estimateList = $this->inquiry_model->getEstimateList($option);

        // Pagination
        $url = '/mgr/inquiry/estimate' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['estimateList'] = $estimateList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/inquiry/estimate_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    // 공지사항 정보 보기
    public function estimate_info() {
        $data['current_menu_code'] = "0402";
        $this->_admin_header($data);

        $seq = $this->input->get('seq');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_status = $this->input->get('s_status');
        $page = $this->input->get('page');

        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_status=".$s_status;

        // 정보 가져오기
        $data['estimate'] = $this->inquiry_model->getEstimate(array('seq' => $seq));

        $data['params'] = $params;
        $data['pageName'] = 'mgr/inquiry/estimate_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }

    public function send_mail() {
        require_once("system/libraries/PHPmailer/class.phpmailer.php");

        $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

        $mail->IsSMTP(); // telling the class to use SMTP

        try {

        //    $mail->CharSet = "euc-kr";
        //    $mail->Encoding = "base64";

        //    $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
        //    $mail->AddReplyTo('name@yourdomain.com', 'First Last');
        //    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
        //    $mail->AddAttachment('images/phpmailer.gif');      // attachment
        //    $mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
            //$mail->SMTPKeepAlive = true;
            $mail->SMTPDebug = 2;
            $mail->Host = "smtp.gmail.com"; // email 보낼때 사용할 서버를 지정
            $mail->SMTPAuth = true; // SMTP 인증을 사용함
            //$mail->Port = 465; // email 보낼때 사용할 포트를 지정
            //$mail->SMTPSecure = "tls";
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl"; // SSL을 사용함
            $mail->CharSet = "UTF-8";
            $mail->Username   = "networzard@gmail.com"; // Gmail 계정
            $mail->Password   = "reqlnesocornmokl"; // 패스워드
            
            //$mail->Username   = "nm_cs@kurlynextmile.com"; // Gmail 계정
            //$mail->Password   = "kurly123!@@"; // 패스워드
            
            $mail->SetFrom('nm_cs@kurlynextmile.com', '컬리넥스트마일'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
            $mail->AddAddress('networzard@naver.com', 'YOU'); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
            $mail->Subject = '견적문의 답변'; // 메일 제목
            $mail->MsgHTML('견적문의 답변입니다./n견적문의 답변입니다2.'); // 메일 내용 (HTML 형식도 되고 그냥 일반 텍스트도 사용 가능함)

            $mail->Send();

            echo "Message Sent OK";
        }

        catch (phpmailerException $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }
    }

    // 견적문의 답변 처리
    public function estimate_update() {
        $data['current_menu_code'] = "0402";
        $this->_admin_header($data);

        $option = $this->input->post();

        // Upload 디렉토리 설정
        $path = "/estimate/".date('Y')."/".date('m');
        $upload_path = $this->global_upload_path.$path;
        $upload_uri = $this->global_upload_uri.$path;

        // Upload 디렉토리 없으면 생성
        make_directory($upload_uri);

        // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
        $config['upload_path'] = $upload_path;
        // 허용되는 파일의 최대 사이즈
        $config['max_size'] = $this->global_upload_max_size;
        // 이미지인 경우 허용되는 최대 폭
        $config['max_width']  = '0';
        // 이미지인 경우 허용되는 최대 높이
        $config['max_height']  = '0';

        // 첨부 있는 경우..
        if(is_uploaded_file($_FILES["image_file"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("image_file")) {
                echo $this->upload->display_errors();
            } else {
                $file = $this->upload->data();
            }
        } 

        if (isset($file) && $file['file_name']) {
            $option['answer_filepath'] = $upload_uri;
            $option['answer_filename'] = $file['file_name'];
        } else {
            $option['answer_filepath'] = null;
            $option['answer_filename'] = null;
        }

        $notice = $this->inquiry_model->getEstimate(array('seq' => $this->input->post('seq')));

        $option['answer_id'] = $this->session->userdata('AID');
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->inquiry_model->updateEstimate($option);

        if (isset($file) && $notice->file_name) {            
            $oldFile = $this->global_root_path.$notice->file_path."/".$notice->file_name;
            //echo $oldFile; exit;
            if (file_exists($oldFile)) unlink($oldFile);
        }

        $this->session->set_flashdata('message', '답변이 정상적으로 저장되었습니다.');
        redirect('mgr/inquiry/estimate?'.$option['params']);

        $this->_admin_footer();
    }
    
    
    // 공지사항 정보 수정
    public function notice_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $option = $this->input->post();

        // Upload 디렉토리 설정
        $path = "/notice/".date('Y')."/".date('m');
        $upload_path = $this->global_upload_path.$path;
        $upload_uri = $this->global_upload_uri.$path;

        // Upload 디렉토리 없으면 생성
        make_directory($upload_uri);

        // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
        $config['upload_path'] = $upload_path;
        // 허용되는 파일의 최대 사이즈
        $config['max_size'] = $this->global_upload_max_size;
        // 이미지인 경우 허용되는 최대 폭
        $config['max_width']  = '0';
        // 이미지인 경우 허용되는 최대 높이
        $config['max_height']  = '0';

        // 첨부 있는 경우..
        if(is_uploaded_file($_FILES["file"]["tmp_name"])) {
            // git,jpg,png 파일만 업로드를 허용한다.
            $config['allowed_types'] = $this->global_upload_file_allowed;
            $config['file_name'] = time().random_string('alnum', 4);
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("file")) {
                echo $this->upload->display_errors();
            } else {
                $file = $this->upload->data();
            }
        } 

        if (isset($file) && $file['file_name']) {
            $option['file_path'] = $upload_uri;
            $option['file_name'] = $file['file_name'];
        } else {
            $option['file_path'] = null;
            $option['file_name'] = null;
        }

        $notice = $this->site_model->getNotice(array('seq' => $this->input->post('seq')));

        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];

        $this->site_model->updateNotice($option);

        if (isset($file) && $notice->file_name) {            
            $oldFile = $this->global_root_path.$notice->file_path."/".$notice->file_name;
            //echo $oldFile; exit;
            if (file_exists($oldFile)) unlink($oldFile);
        }

        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/site/notice_info?seq='.$option['seq'].'&'.$option['params']);

        $this->_admin_footer();
    }
    
    
    // 사이트관리 - 문의관리
    public function question() {
        $data['current_menu_code'] = "0401";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $s_month = $this->input->get('s_month');
        $s_status = $this->input->get('s_status');
        
        $limit_size = $this->input->get('limit_size');

        if ($this->input->get('page'))
            $page = $this->input->get('page');
        else
            $page = 1;

        if ($this->input->get('s_month'))
            $s_month = $this->input->get('s_month');
        else
            $s_month = "30";
        
        if ($this->input->get('s_term'))
            $s_term = $this->input->get('s_term');
        else
            $s_term = "question_date";

        if ($this->input->get('start_date') && $this->input->get('end_date')) {
            
        } else {
            $start_date = date("Y-m-d", strtotime("-1 months"));
            $end_date = date('Y-m-d');
        }
        
        $block_size = 10;

        if ($limit_size) {
            $limit_size = (int)$limit_size;
        } else {
            $limit_size = 10;
        }

        $limit_start = ($page - 1) * $limit_size;

        $option = array(
            's_field'		=> $s_field,
            's_string'		=> $s_string,
            's_term'		=> $s_term,
            'start_date'	=> $start_date,
            'end_date'		=> $end_date,
            'end_date'		=> $end_date . " 23:59",
            's_status'		=> $s_status,
            'limit_start'	=> $limit_start,
            'limit_size'	=> $limit_size
        );

        $data['s_field'] = $s_field;
        $data['s_string'] = $s_string;
        $data['s_term'] = $s_term;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['s_month'] = $s_month;
        $data['s_status'] = $s_status;
        
        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_month=".$s_month."&s_status=".$s_status;

        // 전체 데이터 수
        $total_count = $this->inquiry_model->getQuestionListCount($option);
        $total_page = ceil($total_count / $limit_size);

        // 문의종류 코드
        //$data['questionCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'Q01'));

        // 데이터 목록
        $questionList = $this->inquiry_model->getQuestionList($option);

        // Pagination
        $url = '/mgr/inquiry/question' . "?" . $params . "&page=";
        $pagination = getPagingBasic($block_size, $page, $total_page, $url);

        $data['params'] = $params;        
        $data['page'] = $page;
        $data['questionList'] = $questionList;
        $data['total_count'] = $total_count;
        $data['total_page'] = $total_page;
        $data['page'] = $page;
        $data['page_rows'] = $limit_size;
        $data['pagination'] = $pagination;

        $data['pageName'] = 'mgr/inquiry/question_list';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 문의 등록
    public function question_insert() {
        $data['current_menu_code'] = "0401";
        $this->_admin_header($data);

        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $page = $this->input->get('page');
        $limit_size = $this->input->get('limit_size');

        $this->load->library('form_validation');			//form_validation 로드
        $this->form_validation->set_rules('question_title', '제목', 'trim|required|min_length[1]');

        $this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

        if ($this->form_validation->run() === false) {
            $params = "limit_size=".$limit_size."&page=".$page."&s_field=".$s_field."&s_string=".$s_string;

            // 문의종류 코드
            $data['questionCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'Q01'));

            $data['params'] = $params;
            $data['pageName'] = 'mgr/inquiry/question_write';

            $this->load->view($this->global_layout_manager, $data);
        } else {			
            $option = $this->input->post();

            // Upload 디렉토리 설정
            $path = "/question/".date('Y')."/".date('m');
            $upload_path = $this->global_upload_path.$path;
            $upload_uri = $this->global_upload_uri.$path;

            // Upload 디렉토리 없으면 생성
            make_directory($upload_uri);

            // 사용자가 업로드 한 파일을 /static/upload/ 디렉토리에 저장한다.
            $config['upload_path'] = $upload_path;
            // 허용되는 파일의 최대 사이즈
            $config['max_size'] = $this->global_upload_max_size;
            // 이미지인 경우 허용되는 최대 폭
            $config['max_width']  = '0';
            // 이미지인 경우 허용되는 최대 높이
            $config['max_height']  = '0';

            // 첨부 있는 경우..
            if(is_uploaded_file($_FILES["image_file"]["tmp_name"])) {
                // git,jpg,png 파일만 업로드를 허용한다.
                $config['allowed_types'] = $this->global_upload_image_allowed;
                $config['file_name'] = time().random_string('alnum', 4);
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload("image_file")) {
                    echo $this->upload->display_errors();
                } else {
                    $image_file = $this->upload->data();
                }
            }            

            if (isset($image_file) && $image_file['file_name']) {
                $option['file_path'] = $upload_uri;
                $option['file_name'] = $image_file['file_name'];
            } else {
                $option['file_path'] = null;
                $option['file_name'] = null;
            }

            $option['regist_ip'] = $_SERVER["REMOTE_ADDR"];

            $this->inquiry_model->insertQuestion($option);

            $this->session->set_flashdata('message', '정상 등록되었습니다.');
            redirect('mgr/inquiry/question');
        }

        $this->_admin_footer();
    }


    // 문의 정보 보기
    public function question_info() {
        $data['current_menu_code'] = "0401";
        $this->_admin_header($data);

        $seq = $this->input->get('seq');
        $s_field = $this->input->get('s_field');
        $s_string = $this->input->get('s_string');
        $s_status = $this->input->get('s_status');
        $s_term = $this->input->get('s_term');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $page = $this->input->get('page');

        $params = "page=".$page."&s_field=".$s_field."&s_string=".$s_string."&s_term=".$s_term."&start_date=".$start_date."&end_date=".$end_date."&s_status=".$s_status;

        // 문의종류 코드
        //$data['questionCodeList'] = $this->code_model->getUseCodeList(array('scheme_code' => 'Q01'));

        // 정보 가져오기
        $data['question'] = $this->inquiry_model->getQuestion(array('seq' => $seq));

        $data['params'] = $params;
        $data['pageName'] = 'mgr/inquiry/question_info';
        $this->load->view($this->global_layout_manager, $data);

        $this->_admin_footer();
    }


    // 문의 정보 수정 (답변)
    public function question_update() {
        $data['current_menu_code'] = $this->current_menu_code;
        $this->_admin_header($data);

        $option = $this->input->post();

        $status = "N";
        if($option['answer_content']) {
            $status = "Y";
        }

        $option['status'] = $status;
        $option['answer_id'] = $this->session->userdata('AID');
        $option['update_ip'] = $_SERVER["REMOTE_ADDR"];
                
        $this->inquiry_model->updateQuestion($option);

        $this->session->set_flashdata('message', '정상적으로 수정되었습니다.');
        redirect('mgr/inquiry/question?'.$option['params']);

        $this->_admin_footer();
    }
    
    public function passwd_reset() {
        $option = $this->input->get();
        $new_passwd = $this->getRandStr();
        
        $option['question_passwd'] = $new_passwd;
        //print_r($option);
        $this->inquiry_model->updateInquiryPasswd($option);
        //print_r($new_passwd);
        echo $new_passwd;
    }
    
    function getRandStr($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }    
}