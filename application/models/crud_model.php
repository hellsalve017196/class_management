<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
    }
	
	function clear_cache()
	{
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
	}
	function get_type_name_by_id($type,$type_id='',$field='name')
	{
		return	$this->db->get_where($type,array($type.'_id'=>$type_id))->row()->$field;	
	}
	
	////////STUDENT/////////////
	function get_students($class_id)
	{
		$query	=	$this->db->query('SELECT student_and_course.s_id,student.name AS jam,student.roll AS roll,student.address AS address,student.email AS email,student.student_id AS student_id FROM student_and_course JOIN student ON student_and_course.s_id = student_id WHERE student_and_course.c_id = '.$class_id);
		return $query->result_array();
	}
	
	function get_student_info($student_id)
	{
		$query	=	$this->db->get_where('student' , array('student_id' => $student_id));
		return $query->result_array();
	}

	/////////TEACHER/////////////
	function get_teachers()
	{
		$query	=	$this->db->get('teacher' );
		return $query->result_array();
	}
	function get_teacher_name($teacher_id)
	{
		$query	=	$this->db->get_where('teacher' , array('teacher_id' => $teacher_id));
		$res	=	$query->result_array();
		foreach($res as $row)
			return $row['name'];
	}
	function get_teacher_info($teacher_id)
	{
		$query	=	$this->db->get_where('teacher' , array('teacher_id' => $teacher_id));
		return $query->result_array();
	}
    //get marks by exam id
	function get_marks_by_exam_id($class_id,$exam_id)
    {
        $query = $this->db->get_where('mark', array('exam_id' => $exam_id,'class_id'=>$class_id));
        return $query->result_array();
    }


	////////////CLASS///////////
	function get_class_name($class_id)
	{
		$query	=	$this->db->get_where('class' , array('class_id' => $class_id));
		$res	=	$query->result_array();
		foreach($res as $row)
			return $row['name'];
	}

    function get_class_by_teacher($teacher_id)
    {
        $query	=	$this->db->query("SELECT class_id,name,name_numeric FROM class WHERE teacher_id = ".$teacher_id." ORDER BY class_id DESC");
        $res	=	$query->result_array();

        return $res;
    }
	
	function get_class_name_numeric($class_id)
	{
		$query	=	$this->db->get_where('class' , array('class_id' => $class_id));
		$res	=	$query->result_array();
		foreach($res as $row)
			return $row['name_numeric'];
	}
	
	function get_classes()
	{
		$query	=	$this->db->get('class');
		return $query->result_array();
	}	
	function get_class_info($class_id)
	{
		$query	=	$this->db->get_where('class' , array('class_id' => $class_id));
		return $query->result_array();
	}
	
	//////////EXAMS/////////////
	function get_exams()
	{
		$query	=	$this->db->get('exam' );
		return $query->result_array();
	}	
	function get_exam_info($exam_id)
	{
		$query	=	$this->db->get_where('exam' , array('exam_id' => $exam_id));
		return $query->result_array();
	}
    function get_exam_by_student($class_id,$student_id)
    {
        $query  =  $this->db->query('SELECT mark.mark_id,mark.mark_obtained,mark.mark_total,exam.name,percentage.value,percentage.full_mark FROM mark JOIN exam ON mark.exam_id = exam.exam_id JOIN percentage ON (mark.class_id = percentage.class_id) AND (mark.exam_id = percentage.exam_id) WHERE mark.class_id = '.$class_id.' AND mark.student_id = '.$student_id);

        $data = array();

        if($query->num_rows() > 0)
        {
            $data = $query->result_array();
        }
        return $data;
    }
    function get_exam_by_class($class_id)
    {
        $data = array();
        $query = $this->db->query('SELECT mark.mark_id,exam.name FROM mark JOIN exam ON mark.exam_id = exam.exam_id WHERE mark.class_id = '.$class_id.' GROUP BY exam.name ORDER BY mark.mark_id ASC');

        if($query->num_rows() > 0)
        {
            $data = $query->result_array();
        }

        return $data;
    }
    function check_class($class_id)
    {
        $flag = false;
        $query = $this->db->get_where("class",array("class_id"=>$class_id));

        if($query->num_rows() == 1)
        {
            $flag = true;
        }

        return $flag;
    }
    function student_on_class($class_id,$student_id)
    {
        $flag = false;
        $query = $this->db->query("SELECT s_c_id FROM student_and_course WHERE c_id=".$class_id." AND s_id=".$student_id);
        if($query->num_rows() > 0)
        {
            $flag = true;
        }
        return $flag;
    }
    function add_to_class($class_id,$student_id)
    {
        $flag = false;

        if($this->db->insert("student_and_course",array("c_id"=>$class_id,"s_id"=>$student_id)))
        {
            $flag = true;
        }

        return $flag;
    }
    function class_list($student_id)
    {
        $data = array();
        $query = $this->db->query("SELECT class.name,teacher.name,student_and_course.c_id FROM class JOIN teacher JOIN student_and_course ON class.teacher_id = teacher.teacher_id AND class.class_id = student_and_course.c_id WHERE student_and_course.s_id = ".$student_id);

        if($query->num_rows() > 0)
        {
            $data = $query->result_array();
        }
        return $data;
    }
    function class_name($class_id)
    {
        $data = array();
        $query = $this->db->query("SELECT class.name FROM class WHERE class.class_id = ".$class_id);

        if($query->num_rows() > 0)
        {
            $data = $query->row_array();
        }
        return $data;
    }

    //////attendance/////////////
    function get_attendance($class_id)
    {
        $data = array();
        $query = $this->db->get_where('student_and_course',array('c_id'=>$class_id));

        if($query->num_rows() > 0)
        {
            $student_ids = $query->result_array();

            foreach($student_ids as $id)
            {
                $query = $this->db->query("SELECT COUNT(attendance.attendance_id) AS present,student.name,student.roll FROM attendance JOIN student ON attendance.student_id = student.student_id WHERE student.student_id = ".$id['s_id']." AND attendance.class_id = ".$id['c_id']." AND attendance.status = 1");

                if($query->num_rows() > 0)
                {
                    $data[] = $query->row_array();
                }
            }
        }

        return $data;
    }

	//////////GRADES/////////////
	function get_grades()
	{
		$query	=	$this->db->get('grade' );
		return $query->result_array();
	}	
	function get_grade_info($grade_id)
	{
		$query	=	$this->db->get_where('grade' , array('grade_id' => $grade_id));
		return $query->result_array();
	}	
	function get_grade($mark_obtained)
	{
		$query	=	$this->db->get('grade' );
		$grades	=	$query->result_array();
		foreach($grades as $row)
		{
			if($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
				return $row;
		}
	}

	function create_log($data)
	{
		$data['timestamp']	=	strtotime(date('Y-m-d').' '.date('H:i:s'));
		$data['ip']			=	$_SERVER["REMOTE_ADDR"];
		$location 			=	new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/'.$_SERVER["REMOTE_ADDR"]));
		$data['location']	=	$location->City.' , '.$location->CountryName;
		$this->db->insert('log' , $data);
	}
	function get_system_settings()
	{
		$query	=	$this->db->get('settings' );
		return $query->result_array();
	}
	
		
	
	////////BACKUP RESTORE/////////
	function create_backup($type)
	{
		$this->load->dbutil();
		
		
		$options = array(
                'format'      => 'txt',             // gzip, zip, txt
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );
		
		 
		if($type == 'all')
		{
			$tables = array('');
			$file_name	= 'system_backup';
		}
		else 
		{
			$tables = array('tables'	=>	array($type));
			$file_name	=	'backup_'.$type;
		}

		$backup =& $this->dbutil->backup(array_merge($options , $tables)); 


		$this->load->helper('download');
		force_download($file_name.'.sql', $backup);
	}
	
	
	/////////RESTORE TOTAL DB/ DB TABLE FROM UPLOADED BACKUP SQL FILE//////////
	function restore_backup()
	{
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
		$this->load->dbutil();
		
		
		$prefs = array(
            'filepath'						=> 'uploads/backup.sql',
			'delete_after_upload'			=> TRUE,
			'delimiter'						=> ';'
        );
		$restore =& $this->dbutil->restore($prefs); 
		unlink($prefs['filepath']);
	}
	
	/////////DELETE DATA FROM TABLES///////////////
	function truncate($type)
	{
		if($type == 'all')
		{
			$this->db->truncate('student');
			$this->db->truncate('mark');
			$this->db->truncate('teacher');
			$this->db->truncate('subject');
			$this->db->truncate('class');
			$this->db->truncate('exam');
			$this->db->truncate('grade');
		}
		else
		{	
			$this->db->truncate($type);
		}
	}
	
	
	////////IMAGE URL//////////
	function get_image_url($type = '' , $id = '')
	{
		if(file_exists('uploads/'.$type.'_image/'.$id.'.jpg'))
			$image_url	=	base_url().'uploads/'.$type.'_image/'.$id.'.jpg';
		else
			$image_url	=	base_url().'uploads/user.jpg';
			
		return $image_url;
	}

    // Mark
    function update_marks($exam_id,$marks)
    {
        $query = $this->db->query("SELECT mark_id FROM mark WHERE exam_id = ".$exam_id);
        $res = $query->result_array();

        for($i=0 ; $i < sizeof($res) ; $i++)
        {
            $mark_id = $res[$i]['mark_id'];

            $this->db->query("UPDATE mark SET mark_obtained = ".$marks[$i]." WHERE mark_id = ".$mark_id);
        }

        return true;
    }

    //mark percentage
    function set_percentage($class_id,$exam_id,$percentage,$full_mark)
    {
        if($this->db->query("UPDATE percentage SET full_mark=".$full_mark.",value =".$percentage." WHERE class_id = ".$class_id." AND exam_id =".$exam_id))
        {
            $flag = true;
        }

        return $flag;
    }

    function get_percentage($class_id,$exam_id)
    {
        $data = $this->db->get_where("percentage",array("class_id"=>$class_id,"exam_id"=>$exam_id))->row_array();
        $new = array();

        if(sizeof($data) > 0)
        {
            $new = $data;
        }
        else{
            $this->db->insert("percentage",array("class_id"=>$class_id,"exam_id"=>$exam_id));
        }

        return $new;
    }

    function get_full_mark($class_id,$exam_id)
    {
        $data = $this->db->get_where("percentage",array("class_id"=>$class_id,"exam_id"=>$exam_id))->row_array();
        $new = array();

        if(sizeof($data) > 0)
        {
            $new = $data;
        }
        return $new;
    }

    function get_grade_chart()
    {
        $data = $this->db->query("SELECT mark_from,mark_upto,name FROM grade")->result_array();
        return $data;
    }

    /**************message**************/
    function insert_simple_message($data)
    {
        $flag = false;

        if($this->db->insert('message',$data))
        {
            $flag = true;
        }

        return $flag;
    }

    function message_list($email)
    {
        $data = array();

        $query = $this->db->query("SELECT m_id,m_from,m_title,m_date,m_read FROM message WHERE m_to = '".$email."' ORDER BY m_id DESC");

        if($query->num_rows() > 0)
        {
            $data = $query->result_array();
        }

        return $data;
    }

    function message_read($m_id)
    {
        $data = array();
        $query = $this->db->query("UPDATE message SET m_read = 0 WHERE m_id =".$m_id);

        $query = $this->db->get_where("message",array("m_id"=>$m_id));

        if($query->num_rows() > 0)
        {
            $data = $query->row_array();
        }

        return $data;
    }

    function message_reply($data)
    {
        $flag = false;

        $this->db->where('m_id',$data['m_id']);
        if($this->db->update('message',$data))
        {
            $flag = true;
        }

        return $flag;
    }

    function delete_message($msg_id)
    {
        $flag = false;

        if($this->db->query("DELETE FROM message WHERE m_id =".$msg_id))
        {
            $flag = true;
        }

        return $flag;
    }

    /*******************file upload******************/
    function file_insert($data)
    {
        $flag = false;

        if($this->db->insert('file',$data))
        {
            $flag = true;
        }

        return $flag;
    }

    function file_select($class_id)
    {
        $data = array();

        $query = $this->db->get_where("file",array('class_id'=>$class_id));

        if($query->num_rows() > 0)
        {
            $data = $query->result_array();
        }

        return $data;
    }

    function file_delete($file_id)
    {
        $flag = false;

        $query = $this->db->get_where("file",array('f_id' => $file_id));

        if($query->num_rows() > 0)
        {
            $file = $query->row_array();

            $dir = 'uploads/'.$file['f_dir'];

            if(unlink($dir))
            {
                if($this->db->query("DELETE FROM file WHERE f_id = ".$file['f_id']))
                {
                    $flag = true;
                }
            }
        }

        return $flag;
    }
}

