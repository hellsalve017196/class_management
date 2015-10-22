<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends CI_Controller {

	
	function __construct()
    {
        parent::__construct();
		$this->load->database();
		/*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
    }
	
	/***default functin, redirects to login page if no admin logged in yet***/
	public function index()
	{
		
	}
	
	
	/*
	*	$page_name		=	The name of page
	*/
	function popup($page_name = '' , $param2 = '' , $param3 = '')
	{
		$account_type		=	$this->session->userdata('login_type');
		$page_data['param2']		=	$param2;
		$page_data['param3']		=	$param3;
        $data = array();

        if($page_name === 'modal_student_marksheet')
        {
            $this->load->model("crud_model","c");

            $data = $this->c->get_exam_by_student($param2,$param3);
            $grade_list = $this->c->get_grade_chart();

            $page_data['data']          =  $data;
            $page_data['grade_list'] = $grade_list;
        }
        else if($page_name === 'file_manage')
        {
            $this->load->model('crud_model',"c");

            $data = $this->c->file_select($param2);
            $page_data['file_list'] = $data;
        }


        $this->load->view( 'backend/'.$account_type.'/'.$page_name.'.php' ,$page_data);
		
		echo '<script src="assets/js/neon-custom-ajax.js"></script>';
	}
}

