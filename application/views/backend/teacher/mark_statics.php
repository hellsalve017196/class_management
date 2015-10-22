<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('Mark Statistics');?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->


        <!----TABLE LISTING STARTS--->
        <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
            <center>
                <?php echo form_open('teacher/marks');?>

                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                    <tr>
                        <td><?php echo get_phrase('select_exam');?></td>
                        <td><?php echo get_phrase('select_class');?></td>
                    </tr>
                    <tr>
                        <td>
                            <select id="exam_id" class="form-control"  style="float:left;">
                                <option value=""><?php echo get_phrase('select_an_exam');?></option>
                                <?php
                                $exams = $this->db->get('exam')->result_array();
                                foreach($exams as $row):
                                    ?>
                                    <option value="<?php echo $row['exam_id'];?>"
                                        <?php if($exam_id == $row['exam_id'])echo 'selected';?>>
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                            <select id="class_id" class="form-control"  onchange="show_subjects(this.value)"  style="float:left;">
                                <option value=""><?php echo get_phrase('select_a_class');?></option>
                                <?php
                                $classes = $this->db->query("SELECT class_id,name FROM class WHERE teacher_id = ".$this->session->userdata("teacher_id")." ORDER BY class_id DESC")->result_array();
                                foreach($classes as $row):
                                    ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="operation" value="selection" />
                            <input type="button" id="static" value="<?php echo get_phrase('show_data');?>" class="btn btn-info" />
                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />



            <?php if($exam_id >0 && $class_id >0 && $subject_id >0 ):?>
                <?php
                ////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
                $students	=	$this->crud_model->get_students($class_id);
                foreach($students as $row):
                    $verify_data	=	array(	'exam_id' => $exam_id ,
                        'class_id' => $class_id ,
                        'subject_id' => $subject_id ,
                        'student_id' => $row['student_id']);
                    $query = $this->db->get_where('mark' , $verify_data);

                    if($query->num_rows() < 1)
                        $this->db->insert('mark' , $verify_data);
                endforeach;
                ?>
                <table class="table table-bordered" >
                    <thead>
                    <tr>
                        <td><?php echo get_phrase('student');?></td>
                        <td><?php echo get_phrase('mark_obtained');?>(out of 100)</td>
                        <td><?php echo get_phrase('attendance');?></td>
                        <td><?php echo get_phrase('comment');?></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    $students	=	$this->crud_model->get_students($class_id);
                    foreach($students as $row):

                        $verify_data	=	array(	'exam_id' => $exam_id ,
                            'class_id' => $class_id ,
                            'subject_id' => $subject_id ,
                            'student_id' => $row['student_id']);

                        $query = $this->db->get_where('mark' , $verify_data);
                        $marks	=	$query->result_array();
                        foreach($marks as $row2):
                            ?>
                            <?php echo form_open('teacher/marks');?>
							<tr>
								<td>
									<?php echo $row['name'];?>
								</td>
								<td>
									 <input type="number" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained" class="form-control"  />
												
								</td>
                                <td>
                                	<input type="number" value="<?php echo $row2['attendance'];?>" name="attendance" class="form-control"  />
                                </td>
								<td>
									<textarea name="comment" class="form-control"><?php echo $row2['comment'];?></textarea>
								</td>
                                <td>
                                	<input type="hidden" name="mark_id" value="<?php echo $row2['mark_id'];?>" />
                                    
                                	<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                                	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                                	<input type="hidden" name="subject_id" value="<?php echo $subject_id;?>" />
                                    
                                	<input type="hidden" name="operation" value="update" />
                                	<button type="submit" class="btn btn-primary"> Update</button>
                                </td>
							 </tr>
                             </form>
                         	<?php
                        endforeach;
                    endforeach;
                    ?>
                    </tbody>
                </table>

            <?php endif;?>
        </div>
        <!----TABLE LISTING ENDS--->

    </div>
</div>
</div>

<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog" style="width:680px">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Graph generated from marks</h4>
            </div>

            <div class="modal-body" style="height:500px; overflow:auto;">
                <img src="" id="test" style="display: none" />
            </div>

            <div class="modal-footer">
                <span>
                    <span><input type="radio" name="test" id="inc"/><strong>Increase</strong></span>
                    <span><input type="radio" name="test" id="dec"/><strong>Decrease</strong></span>
                    <span><strong>(add/deduct mark)</strong><input type="text" id="mark"/></span>
                    <button type="button" class="btn btn-success" id="check_graph">Check graph</button>
                    <button type="button" class="btn btn-danger" style="display: none" data-dismiss="modal" id="save">save</button>
                </span>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    /* advance */
    function generate_graph(flag,mark)
    {
        http = "<? echo base_url(); ?>"+"index.php?teacher/graph_test/"+sessionStorage.getItem("class_id")+"/"+sessionStorage.getItem("exam_id")+"/"+flag+"/"+mark;

        $("#test").attr("src",http);

        $("#save").show();
    }

    document.getElementById("check_graph").addEventListener("click",function() {
        flag1 = document.getElementById("inc").checked;
        flag2 = document.getElementById("dec").checked;
        mark = document.getElementById("mark").value;
        flag = "";

        if(flag1)
        {
            flag = '1';
        }
        else if(flag2)
        {
            flag = '-1';
        }
        else
        {
            alert("check radio button");
        }

        if(mark != '')
        {
            generate_graph(flag,mark);
        }
        else
        {
            alert("please enter mark number");
        }
    },false);

    document.getElementById("save").addEventListener("click",function() {
            flag1 = document.getElementById("inc").checked;
            flag2 = document.getElementById("dec").checked;
            mark = document.getElementById("mark").value;

            class_id = sessionStorage.getItem("class_id");
            exam_id = sessionStorage.getItem("exam_id");

            flag1 = document.getElementById("inc").checked;
            flag2 = document.getElementById("dec").checked;
            mark = document.getElementById("mark").value;
            flag = "";

            if(flag1)
            {
                flag = '1';
            }
            else if(flag2)
            {
                flag = '-1';
            }
            else
            {
                alert("check radio button");
            }

            if(mark != '')
            {
                req = new XMLHttpRequest();

                req.onreadystatechange = function()
                {
                    if((req.readyState == 4) && (req.status == 200))
                    {
                        alert("done");
                    }
                }

                http = "<? echo base_url() ?>index.php?teacher/save_mark/"+class_id+"/"+exam_id+"/"+flag+"/"+mark;

                req.open("GET",http,false);
                req.send(null);
            }
            else
            {
                alert("please enter mark number");
            }

    },false)

    function show_subjects(class_id)
    {
        for(i=0;i<=100;i++)
        {
            try
            {
                document.getElementById('subject_id_'+i).style.display = 'none' ;
                document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
            }
            catch(err){}
        }
        document.getElementById('subject_id_'+class_id).style.display = 'block' ;
        document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
    }
    /* advance */


    /***basic***/

    $("#static").on('click',function() {
        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

        class_id = $("#class_id").val();
        exam_id = $("#exam_id").val();

        sessionStorage.setItem("class_id",class_id);
        sessionStorage.setItem("exam_id",exam_id);

        str = '<? echo base_url().'index.php?teacher/image_static/' ?>'+class_id+'/'+exam_id;

        $("#test").attr('src',str).fadeIn(500);

    });



    /***basic***/
</script>

