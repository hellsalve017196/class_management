<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : mahtab
 *	date	: dec, 2014
 *	north South University
 *	Grading system
 */


class Parents extends CI_Controller
{
    
    
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
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
    }
    function f()
	{
		echo 'h';	
	}
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('parent_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('manage_teacher');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /***********************************************************************************************************/
    
    
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
        $parent_profile         = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->row();
        $parent_class_id        = $parent_profile->class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $parent_class_id
        ))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE EXAM MARKS*****/
    function marks($exam_id = '', $class_id = '', $subject_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
		
        $student_id     =	$this->db->get_where('parent', array( 'parent_id' => $this->session->userdata('parent_id') 
							))->row()->student_id;
		 $class_id		=	$this->db->get_where('student', array( 'student_id' => $student_id 
							))->row()->class_id;
        $page_data['student_id'] 	= $student_id;
        $page_data['class_id'] 		= $class_id;
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            //$page_data['class_id']	=	$this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
                redirect(base_url() . 'index.php?parents/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?parents/marks/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        //$page_data['class_id']	=	$class_id;
        $page_data['subject_id'] = $subject_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /**********MANAGING CLASS ROUTINE******************/
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_id     =	$this->db->get_where('parent', array( 'parent_id' => $this->session->userdata('parent_id') 
							))->row()->student_id;
		$class_id		=	$this->db->get_where('student', array( 'student_id' => $student_id 
							))->row()->class_id;
        $page_data['student_id'] 	= $student_id;
        $page_data['class_id'] 		= $class_id;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        //if($this->session->userdata('parent_login')!=1)redirect(base_url() , 'refresh');
        if ($param1 == 'make_payment') {
            $invoice_id      = $this->input->post('invoice_id');
            $system_settings = $this->db->get_where('settings', array(
                'type' => 'paypal_email'
            ))->row();
            $invoice_details = $this->db->get_where('invoice', array(
                'invoice_id' => $invoice_id
            ))->row();
            
            /****TRANSFERRING USER TO PAYPAL TERMINAL****/
            $this->paypal->add_field('rm', 2);
            $this->paypal->add_field('no_note', 0);
            $this->paypal->add_field('item_name', $invoice_details->title);
            $this->paypal->add_field('amount', $invoice_details->amount);
            $this->paypal->add_field('custom', $invoice_details->invoice_id);
            $this->paypal->add_field('business', $system_settings->description);
            $this->paypal->add_field('notify_url', base_url() . 'index.php?parents/invoice/paypal_ipn');
            $this->paypal->add_field('cancel_return', base_url() . 'index.php?parents/invoice/paypal_cancel');
            $this->paypal->add_field('return', base_url() . 'index.php?parents/invoice/paypal_success');
            
            $this->paypal->submit_paypal_post();
            // submit the fields to paypal
        }
        if ($param1 == 'paypal_ipn') {
            if ($this->paypal->validate_ipn() == true) {
                $ipn_response = '';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $ipn_response .= "\n$key=$value";
                }
                $data['payment_details']   = $ipn_response;
                $data['payment_timestamp'] = strtotime(date("m/d/Y"));
                $data['payment_method']    = 'paypal';
                $data['status']            = 'paid';
                $invoice_id                = $_POST['custom'];
                $this->db->where('invoice_id', $invoice_id);
                $this->db->update('invoice', $data);
            }
        }
        if ($param1 == 'paypal_cancel') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_cancelled'));
            redirect(base_url() . 'index.php?parents/invoice/', 'refresh');
        }
        if ($param1 == 'paypal_success') {
            $this->session->set_flashdata('flash_message', get_phrase('payment_successfull'));
            redirect(base_url() . 'index.php?parents/invoice/', 'refresh');
        }
        $parent_profile         = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->row();
        
		$student_id     =	$this->db->get_where('parent', array( 'parent_id' => $this->session->userdata('parent_id') 
							))->row()->student_id;
		$class_id		=	$this->db->get_where('student', array( 'student_id' => $student_id 
							))->row()->class_id;
        $page_data['student_id'] 	= $student_id;
        $page_data['class_id'] 		= $class_id;
		
        $page_data['invoices']   = $this->db->get_where('invoice', array(
            'student_id' => $student_id
        ))->result_array();
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->load->view('backend/index', $page_data);
    }
    
    /**********MANAGE LIBRARY / BOOKS********************/
    
    /**********MANAGE TRANSPORT / VEHICLES / ROUTES********************/
    
    /**********MANAGE DORMITORY / HOSTELS / ROOMS ********************/
   
    /**********WATCH NOTICEBOARD AND EVENT ********************/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('noticeboard');
        $this->load->view('backend/index', $page_data);
        
    }
    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('parent_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('parent_id', $this->session->userdata('parent_id'));
            $this->db->update('parent', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?parents/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('parent', array(
                'parent_id' => $this->session->userdata('parent_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('parent_id', $this->session->userdata('parent_id'));
                $this->db->update('parent', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?parents/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('parent', array(
            'parent_id' => $this->session->userdata('parent_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    /****************messageing****************/
    public function send_msg_form()
    {
        $page_data['page_name']  = 'send';
        $page_data['page_title'] = get_phrase('send_message');

        $this->load->view('backend/index', $page_data);
    }

    public function single_msg()
    {
        $main = array();
        $data = $this->input->post('msg');


        $data = json_decode($data,true);
        $main['msg'] = array(array("from"=>$data['m_from'],"said"=>$data['m_msg']));
        $data['m_msg'] = json_encode($main);


        if($this->message_insert($data))
        {
            echo "successfully send";
        }
    }

    public function message_insert($data)
    {
        $this->load->model("crud_model","L");
        $this->load->model("email_model","E");

        $flag = $this->L->insert_simple_message($data);

        $this->E->send_mail($data['m_to'],$data['m_title'],"<p>you have urgent message,please log in to your account on <a style='text-decoration: none,color:red' href='http://academicgrade.com'>academicgrade.com</a></p>");

        return $flag;
    }

    public function message_list()
    {
        $page_data['page_name']  = 'msg_list';
        $page_data['page_title'] = get_phrase('message_list');

        $this->load->model('crud_model','L');
        $data = $this->L->message_list($this->session->userdata("email"));

        $page_data['msg_list'] = $data;

        $this->load->view('backend/index', $page_data);
    }

    public function message_read($m_id)
    {
        $page_data['page_name']  = 'msg_read';
        $page_data['page_title'] = get_phrase('message');

        $this->load->model('crud_model','L');
        $data = $this->L->message_read($m_id);

        $page_data['msg'] = $data;

        $this->load->view('backend/index', $page_data);
    }

    public function message_reply()
    {
        $data = json_decode($this->input->post("msg_reply"),true);

        $this->load->model('crud_model','L');

        if($this->L->message_reply($data))
        {
            echo "successfully replied";
        }
    }

    public function delete_message($m_id)
    {
        $this->load->model('crud_model','L');

        if($this->L->delete_message($m_id))
        {
            $this->message_list();
        }
        else
        {
            $this->message_list();
        }
    }
}
