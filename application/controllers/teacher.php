<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : mahtab
 *	date	: 4 dec, 2014	
 */

class Teacher extends CI_Controller
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

    /****MANAGE CLASSES*****/
    function classes($param1 = '', $param2 = '')
    {
        if ($param1 == 'create') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');
            $this->db->insert('class', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']         = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id']   = $this->input->post('teacher_id');

            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                'class_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        $page_data['classes']    = $this->db->get('class')->result_array();
        $page_data['page_name']  = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }
    
    /***default functin, redirects to login page if no teacher logged in yet***/
    public function index()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
    }
    
    /***FACULTY dashboard***/
    function dashboard()
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('teacher_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    
    /*ENTRY OF A NEW STUDENT*/
    
    
    /****MANAGE STUDENTS CLASSWISE*****/
    function student_add()
	{
		if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
			
		$page_data['page_name']  = 'student_add';
		$page_data['page_title'] = get_phrase('add_student');
		$this->load->view('backend/index', $page_data);
	}
	
	function student_information($class_id = '')
	{
		if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']  	= 'student_information';
		$page_data['page_title'] 	= get_phrase('student_information'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
	
	function student_marksheet($class_id = '')
	{
		if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']  = 'student_marksheet';
		$page_data['page_title'] 	= get_phrase('student_marksheet'). " - ".get_phrase('class')." : ".
											$this->crud_model->get_class_name($class_id);
		$page_data['class_id'] 	= $class_id;
		$this->load->view('backend/index', $page_data);
	}
	
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['password']    = $this->input->post('password');
            $data['class_id']    = $this->input->post('class_id');
            $data['roll']        = $this->input->post('roll');
            $this->db->insert('student', $data);
            $student_id = mysql_insert_id();

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?teacher/student_add/' . $data['class_id'], 'refresh');
        }
        if ($param2 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['class_id']    = $this->input->post('class_id');
            $data['roll']        = $this->input->post('roll');
            
            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            $this->crud_model->clear_cache();
            
            redirect(base_url() . 'index.php?teacher/student_information/' . $param1, 'refresh');
        } 
		
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?teacher/student_information/' . $param1, 'refresh');
        }
    }
    
    /****MANAGE TEACHERS*****/
    function teacher_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'personal_profile') {
            $page_data['personal_profile']   = true;
            $page_data['current_teacher_id'] = $param2;
        }
        $page_data['teachers']   = $this->db->get('teacher')->result_array();
        $page_data['page_name']  = 'teacher';
        $page_data['page_title'] = get_phrase('teacher_list');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE SUBJECTS*****/
    function subject($param1 = '', $param2 = '' , $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('subject', $data);
            redirect(base_url() . 'index.php?teacher/subject/'.$data['class_id'], 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name']       = $this->input->post('name');
            $data['class_id']   = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            
            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            redirect(base_url() . 'index.php?teacher/subject/'.$data['class_id'], 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(base_url() . 'index.php?teacher/subject/'.$param3, 'refresh');
        }
		 $page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('backend/index', $page_data);
    }
    
    
    
    /****MANAGE EXAM MARKS*****/
    function marks($exam_id = '', $class_id = '', $subject_id = '')
    {

        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['class_id']   = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {

                redirect(base_url() . 'index.php?teacher/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {

                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?teacher/marks/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            $data['mark_obtained'] = $this->input->post('mark_obtained');
            $data['attendance']    = $this->input->post('attendance');
            $data['comment']       = $this->input->post('comment');
            
            $this->db->where('mark_id', $this->input->post('mark_id'));
            $this->db->update('mark', $data);
            
            redirect(base_url() . 'index.php?teacher/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['subject_id'] = $subject_id;
        
        $page_data['page_info'] = 'Exam marks';
        
        $page_data['page_name']  = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('backend/index', $page_data);
    }

    /********noticeboard**********/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');


        $page_data['page_name']  = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();

        $this->load->view('backend/index', $page_data);

    }

    /******Mark Statictis*********/
    function mark_percentage()
    {
        $page_data['page_info'] = 'Mark percentage';

        $page_data['page_name']  = 'mark_percentage';

        $page_data['page_title'] = get_phrase('Mark percentage');
        $this->load->view('backend/index', $page_data);
    }

    function get_percentage($class_id,$exam_id)
    {
        $this->load->model("crud_model","c");

        $data = $this->c->get_percentage($class_id,$exam_id);

        echo json_encode($data);
    }

    function set_percentage($class_id,$exam_id,$percentage,$full_mark)
    {
        $this->load->model("crud_model","c");

        if($this->c->set_percentage($class_id,$exam_id,$percentage,$full_mark))
        {
            echo 1;
        }
        else{
            echo 0;
        }
    }

    function mark_statictis()
    {
        $page_data['page_info'] = 'Mark Statistics';

        $page_data['page_name']  = 'mark_statics';

        $page_data['page_title'] = get_phrase('Checking Mark Statistics');
        $this->load->view('backend/index', $page_data);
    }

    function graph_test($class_id,$exam_id,$flag,$add)
    {
        $this->load->model('Crud_model','c');

        $data = $this->c->get_marks_by_exam_id($class_id,$exam_id);

        if(sizeof($data) > 0)
        {
            $marks = array();
            $count = array();
            $i = 1;

            foreach($data as $d)
            {
                $marks[] = $d['mark_obtained'];
                $count[] = $i;
                $i++;
            }

            $res = array();

            if($flag == '1')
            {
                $res = $this->add_mark($marks,$add);
            }
            else if($flag == '-1')
            {
                $res = $this->deduct_mark($marks,$add);
            }

            //library
            require_once ('assets/library/jpgraph.php');
            require_once ('assets/library/jpgraph_line.php');


// Setup the graph
            $graph = new Graph(600,500); //height,width of the canvas
            $graph->SetScale("textlin");

            $theme_class=new UniversalTheme;

            $graph->SetTheme($theme_class);
            $graph->img->SetAntiAliasing(false);
            $graph->title->Set('mark distribution'); //title of the page
            $graph->SetBox(false);

            $graph->img->SetAntiAliasing();

            $graph->yaxis->HideZeroLabel();
            $graph->yaxis->HideLine(false);
            $graph->yaxis->HideTicks(false,false);

            $graph->xgrid->Show();
            $graph->xgrid->SetLineStyle("solid");
            $graph->xaxis->SetTickLabels($count);
            $graph->xgrid->SetColor('#E3E3E3');

            // Create the first line
            $p1 = new LinePlot($marks);
            $graph->Add($p1);
            $p1->SetColor("#6495ED");
            $p1->SetLegend('marks gained by students');

            // Create the second line
            $p2 = new LinePlot($res);
            $graph->Add($p2);
            $p2->SetColor("#ff0000");
            $p2->SetLegend('after adding marks by you');


            $graph->legend->SetFrameWeight(1);

// Output line
            $graph->Stroke();

            //library
        }
    }

    function save_mark($class_id,$exam_id,$flag,$add)
    {
        $this->load->model('Crud_model', 'c');

        $data = $this->c->get_marks_by_exam_id($class_id, $exam_id);

        if (sizeof($data) > 0)
        {
            $marks = array();
            $count = array();
            $i = 1;

            foreach ($data as $d) {
                $marks[] = $d['mark_obtained'];
                $count[] = $i;
                $i++;
            }

            $res = array();

            if ($flag == '1') {
                $res = $this->add_mark($marks, $add);
            } else if ($flag == '-1') {
                $res = $this->deduct_mark($marks, $add);
            }

            $this->c->update_marks($exam_id,$res);

            echo "done";
        }
    }

    function add_mark($data,$value)
    {
          $new_array = array();

          foreach($data as $d)
          {
              $new_array[] = $d + $value;
          }

          return $new_array;
    }

    function deduct_mark($data,$value)
    {
        $new_array = array();

        foreach($data as $d)
        {
            $new_array[] = $d - $value;
        }

        return $new_array;
    }


    function calculating_statictis($class_id,$exam_id)
    {
        $this->load->model('Crud_model','c');

        $data = $this->c->get_marks_by_exam_id($class_id,$exam_id);

        if(sizeof($data) > 0)
        {
            $marks = array();
            $count = array();
            $i = 1;

            foreach($data as $d)
            {
                $marks[] = $d['mark_obtained'];
                $count[] = $i;
                $i++;
            }

            //library
            require_once ('assets/library/jpgraph.php');
            require_once ('assets/library/jpgraph_line.php');


// Setup the graph
            $graph = new Graph(600,500); //height,width of the canvas
            $graph->SetScale("textlin");

            $theme_class=new UniversalTheme;

            $graph->SetTheme($theme_class);
            $graph->img->SetAntiAliasing(false);
            $graph->title->Set('mark distribution'); //title of the page
            $graph->SetBox(false);

            $graph->img->SetAntiAliasing();

            $graph->yaxis->HideZeroLabel();
            $graph->yaxis->HideLine(false);
            $graph->yaxis->HideTicks(false,false);

            $graph->xgrid->Show();
            $graph->xgrid->SetLineStyle("solid");
            $graph->xaxis->SetTickLabels($count);
            $graph->xgrid->SetColor('#E3E3E3');

            // Create the first line
            $p1 = new LinePlot($marks);
            $graph->Add($p1);
            $p1->SetColor("#6495ED");
            $p1->SetLegend('marks gained by students');


            $graph->legend->SetFrameWeight(1);

// Output line
            $graph->Stroke();

        }
        else
        {
            echo -1;
        }
    }

    public function image_static($class_id,$exam_id)
    {
         echo '<img src="data:image/png;base64,'.$this->calculating_statictis($class_id,$exam_id).'" />';

    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?teacher/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?teacher/backup_restore/', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name']        = $this->input->post('name');
            $data['birthday']    = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['religion']    = $this->input->post('religion');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            
            $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
            $this->db->update('teacher', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('teacher', array(
                'teacher_id' => $this->session->userdata('teacher_id')
            ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('teacher_id', $this->session->userdata('teacher_id'));
                $this->db->update('teacher', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?teacher/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('teacher', array(
            'teacher_id' => $this->session->userdata('teacher_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

	
	/****** DAILY ATTENDANCE *****************/
	function manage_attendance($date='',$month='',$year='',$class_id='')
	{
		if($this->session->userdata('teacher_login')!=1)redirect('login' , 'refresh');
		
		if($_POST)
		{
			$verify_data	=	array(	'student_id' 		=> $this->input->post('student_id'),
										'date' 				=> $this->input->post('date'),
                                        'class_id'          => $this->input->post('class_id')
                                    );

			$attendance = $this->db->get_where('attendance' , $verify_data)->row();
			$attendance_id		= $attendance->attendance_id;
			
			$this->db->where('attendance_id' , $attendance_id);
			$this->db->update('attendance' , array('status' => $this->input->post('status')));
			
			redirect(base_url() . 'index.php?teacher/manage_attendance/'.$date.'/'.$month.'/'.$year.'/'.$class_id , 'refresh');
		}

		$page_data['date']			=	$date;
		$page_data['month']		=	$month;
		$page_data['year']			=	$year;
		$page_data['class_id']	=	$class_id;
		
		$page_data['page_name']		=	'manage_attendance';
		$page_data['page_title']		=	get_phrase('manage_daily_attendance');
		$this->load->view('backend/index', $page_data);
	}

	function attendance_selector()
	{
		redirect(base_url() . 'index.php?teacher/manage_attendance/'.$this->input->post('date').'/'.
					$this->input->post('month').'/'.
						$this->input->post('year').'/'.
							$this->input->post('class_id') , 'refresh');
	}

    function attendance_printout($class_id)
    {

        $this->load->model('crud_model','c');
        $data = $this->c->get_attendance($class_id);
        $str = '';

        if(sizeof($data) > 0)
        {
            $class_data = $this->c->class_name($class_id);
            $str = '<h1 align="center">'.$class_data['name'].'</h1>';

            header("Content-type:text/html");

            header("Content-Disposition:attachment;filename='".$class_data['name'].".html'");


            $str = $str . '<table width="500" border="1" style="margin:0 auto"><tr><td>Name</td><td>Id</td><td>Attendance</td></tr>';
            $option = '';

            foreach($data as $d)
            {
                $option = $option . '<tr><td>'.$d['name'].'</td><td>'.$d['roll'].'</td><td>'.$d['present'].'</td></tr>';
            }
            $str = $str . $option;
            $str = $str . '</table>';
            echo $str;
        }
        else
        {
            echo '<p>Class does n\'t exists</p>';
        }
    }

    
    /**********MANAGE DOCUMENT / home work FOR A SPECIFIC CLASS or ALL*******************/
    function document($do = '', $document_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
            redirect('login', 'refresh');
        if ($do == 'upload') {
            move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/document/" . $_FILES["userfile"]["name"]);
            $data['document_name'] = $this->input->post('document_name');
            $data['file_name']     = $_FILES["userfile"]["name"];
            $data['file_size']     = $_FILES["userfile"]["size"];
            $this->db->insert('document', $data);
            redirect(base_url() . 'teacher/manage_document', 'refresh');
        }
        if ($do == 'delete') {
            $this->db->where('document_id', $document_id);
            $this->db->delete('document');
            redirect(base_url() . 'teacher/manage_document', 'refresh');
        }
        $page_data['page_name']  = 'manage_document';
        $page_data['page_title'] = get_phrase('manage_documents');
        $page_data['documents']  = $this->db->get('document')->result_array();
        $this->load->view('backend/index', $page_data);
    }


    /*********print marksheet for specific course*******************/
    function grade_detec($mark)
    {
        $grade = '';
        $grade_list = $this->db->query("SELECT name,mark_from,mark_upto FROM grade")->result_array();
        foreach($grade_list as $g)
        {
            if(($mark >= $g['mark_from']) and ($mark <= $g['mark_upto']))
            {
                $grade = $g['name'];
                break;
            }
        }

        return $grade;
    }

    function print_marksheet_for_class($class_id)
    {
        $this->load->model("crud_model",'c');
        $header = array("Name","ID");
        $exams = $this->c->get_exam_by_class($class_id);
        $class_name = $this->c->class_name($class_id);
        $student = $this->c->get_students($class_id);
        $main = array();


        if(sizeof($exams) > 0)
        {
            foreach($exams as $e)
            {
                $header[] = $e['name'].' total';
                $header[] = $e['name'].' got';
                $header[] = $e['name'].' percntg fac(%)';
                $header[] = $e['name'].' percntg achived)(%)';
            }
            $header[] = "total percentage(%)";
            $header[] = "grade";

            foreach($student as $s)
            {
                $temp = array("name"=>$s['jam'],"id"=>$s['roll']);

                $data = $this->c->get_exam_by_student($class_id,$s['s_id']);
                $total_percentage = 0;
                $percentage_fac = 0;

                foreach($data as $d)
                {
                    $temp[$d['name'].'_total'] = $d['mark_total'];
                    $temp[$d['name'].'_obtained'] = $d['mark_obtained'];
                    $temp[$d['name'].'_percentage'] = $d['value'];
                    $percentage_fac = $percentage_fac + $temp[$d['name'].'_percentage'];
                    $temp[$d['name'].'_percentage_obtained'] = intval(($d['mark_obtained']*$d['value'])/$d['mark_total']);

                    $total_percentage = $total_percentage + $temp[$d['name'].'_percentage_obtained'];
                }

                $temp['total_percentage'] = intval(($total_percentage*100)/$percentage_fac);
                $temp['grade'] = $this->grade_detec($temp['total_percentage']);
                //name,id,total,obtained,value

                $main[] = $temp;
            }

            header("Content-type:text/html");
            header("Content-Disposition:attachment;filename='".$class_name['name']."(marksheet).html");

            $main_str = '';
            $main_str = $main_str.'<h1>'.$class_name['name'].'</h1>';
            $main_str = $main_str.'<table border="1"><tr>';

            foreach($header as $h)
            {
                $main_str = $main_str ."<td>" .$h.'</td>';
            }

            $main_str = $main_str . '</tr>';
            $total = 0;

            foreach($main as $m)
            {
                $main_str = $main_str . '<tr>';

                foreach($m as $key=>$value)
                {
                    $main_str = $main_str . '<td>'.$value.'</td>';
                }

                $main_str = $main_str . '</tr>';
            }

            $main_str = $main_str . '<table>';

            echo $main_str;
        }
        else
        {
            echo "exams havenot taken yet";
        }

    }


    /****************messageing****************/
    public function send_msg_form()
    {
        $page_data['page_name']  = 'send';
        $page_data['page_title'] = get_phrase('send_message');

        //for teacher only
        $this->load->model('crud_model','L');
        $data = $this->L->get_class_by_teacher($this->session->userdata("teacher_id"));

        $page_data['class_data'] = $data;

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

    public function class_msg()
    {
        $this->load->model('crud_model','c');

        $data = $this->input->post('msg');

        $data = json_decode($data,true);

        $student_data = $this->c->get_students($data['class_id']);

        if(sizeof($student_data) > 0)
        {
            foreach($student_data as $s)
            {
                $set = array("m_from"=>$data['m_from'],"m_to"=>$s['email'],'m_title'=>$data['m_title'],'m_msg'=>json_encode(array("msg"=>array(array("from"=>$data['m_from'],"said"=>$data['m_msg'])))));
                $this->message_insert($set);
            }

            echo "message successfully send";
        }
        else
        {
            echo "there is no student in your class";
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


    /************file*************/

    public function file_upload_view()
    {
        $page_data['page_name']  = 'file';
        $page_data['page_title'] = get_phrase('File');

        $this->load->model('crud_model','L');
        $data = $this->L->get_class_by_teacher($this->session->userdata("teacher_id"));
        $page_data['class'] = $data;



        $this->load->view('backend/index', $page_data);
    }

    public function file_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = "*";
        $config['encrypt_name'] = TRUE;

        $file_data = json_decode($this->input->post('file_data'),true);


        $this->load->library('upload',$config);

        if($this->upload->do_upload())
        {
            $file = $this->upload->data();

            $file_data['f_dir'] = $file['file_name'];

            $this->load->model('crud_model','L');

            if($this->L->file_insert($file_data))
            {
                echo "file uploaded";
            }
            else
            {
                echo "error";
            }
        }
    }

    public function file_delete($f_id)
    {
        $this->load->model('crud_model','c');

        $flag = $this->c->file_delete($f_id);

        $this->file_upload_view();
    }
}
