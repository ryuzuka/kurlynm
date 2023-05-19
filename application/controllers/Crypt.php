<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crypt extends KURLY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('crypt_model');
    }


    public function index() {
        if(!function_exists('password_hash')){
            $this->load->helper('password');
        }
        //$hash = password_hash($this->input->post('admin_passwd'), PASSWORD_BCRYPT);
        
        $start = $this->input->get('start');
        if ($start) {
            $start = (int)$start;
        } else {
            $start = 0;
        }
        $end = $start + 500;
        
        $option = array(
            'start' => $start,
            'end' => 500
        );
        
        $count = 0;
        $members = $this->crypt_model->getList($option);
        
        foreach ($members as $i => $list) {
            if (strlen($list->member_passwd) <= 20) {
                $hash = password_hash($list->member_passwd, PASSWORD_BCRYPT);

                $option = array(
                    'member_id' => $list->member_id,
                    'member_passwd' => $hash
                );
                $this->crypt_model->updatePassword($option);

                $count++;
            }
        }
        
        echo $end."번까지 - Success!!";
        echo "<br>".$count."개 처리..";
        
        $start = $end;
        echo "<script>";
        echo "  setTimeout(function() { ";
        echo "    location.href = '/crypt?start=".$start."'; ";
        echo "  }, 3000); ";
        echo "</script>";
    }
    
    
}