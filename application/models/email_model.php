<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }

	function send_mail($too,$subject,$message)
    {
        $to = $too;
        $sub = $subject;
        $msg = $message;

        /*important lines for html mails*/
        $header = "MIME-Version:1.0"."\r\n";
        $header = $header."Content-type:text/html;charset=utf-8"."\r\n";
        /*important lines for html mails*/

        $header = $header."From:northsouthuniversity <northsouthuniversity.edu>"."\r\n";
        $header = $header.'Cc: Grademachine@northsouthuniversity.edu' . "\r\n";
        $header = $header.'Bcc: Grademachine@northsouthuniversity.edu' . "\r\n";

        if(mail($to,$sub,$msg,$header))
        {

        }
        else
        {

        }
    }

    function password_retrive($type,$email)
    {
        $data = array();

        if($type === 'student')
        {
            $query = $this->db->get_where('student',array("email"=>$email));

            if($query->num_rows() > 0)
            {
                $data = $query->row_array();
            }
        }
        else if($type === 'teacher')
        {
            $query = $this->db->get_where('teacher',array("email"=>$email));

            if($query->num_rows() > 0)
            {
                $data = $query->row_array();
            }
        }
        else if($type === 'parent')
        {
            $query = $this->db->get_where('parent',array("email"=>$email));

            if($query->num_rows() > 0)
            {
                $data = $query->row_array();
            }
        }

        return $data;
    }
}

