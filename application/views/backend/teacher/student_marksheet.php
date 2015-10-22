
               <button class="btn btn-success" onclick="zn()" style="float: right">Print Marksheet</button>
               </br>
               </br>
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('roll');?></div></th>
                            <th><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $students	=	$this->db->query('SELECT student_and_course.s_id,student_and_course.c_id,student.name AS jam,student.roll AS roll,student.address AS address,student.email AS email,student.student_id AS student_id FROM student_and_course JOIN student ON student_and_course.s_id = student_id WHERE student_and_course.c_id = '.$class_id)->result_array();
                                foreach($students as $row):
                                    $class_id = $row['c_id'];
                                    ?>

                        <tr>
                            <td><?php echo $row['roll'];?></td>
                            <td align="center"><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['jam'];?></td>
                            <td>
                                <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_student_marksheet/<?php echo $row['c_id'] ?>/<?php echo $row['student_id'];?>');" class="btn btn-default" >
                                      <i class="entypo-chart-bar"></i>
                                          <?php echo get_phrase('view_marksheet');?>
                                      </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

    function zn()
    {
        http = '<? echo base_url() ?>'+'index.php?teacher/print_marksheet_for_class/'+'<? echo $class_id ?>'

        window.open(http,'_blank');
    }
</script>