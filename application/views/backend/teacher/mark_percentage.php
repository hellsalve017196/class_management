<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('Mark percentage');?>
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
                            <input type="button" id="static" value="<?php echo get_phrase('show_percentage');?>" class="btn btn-info" />
                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />



        </div>
        <!----TABLE LISTING ENDS--->

    </div>
</div>
</div>

<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog" style="width:400px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Percentage definer</h4>
            </div>

            <div class="modal-body" style="height:200px; overflow:auto;">
                <div id="res">
                        <p><h4>Full mark:</h4><input id="full" type="number" class="form-control" value="0"/></p>
                        <p><h4>Percentage for this test is:</h4><input id="percent" type="number" class="form-control" value="0"/></p>
                </div>
                <br>
                <button type="button" id="update" class="btn btn-success" data-dismiss="modal">Update</button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    /***basic***/

    $("#static").on('click',function() {


        class_id = $("#class_id").val();
        exam_id = $("#exam_id").val();

        sessionStorage.setItem("class_id",class_id);
        sessionStorage.setItem("exam_id",exam_id);

        http = '<? echo base_url() ?>'+'index.php?teacher/get_percentage/'+class_id+'/'+exam_id;

        $.ajax({
            'url':http,
            'method':'GET',
            'success':function(data) {
                data = JSON.parse(data);

                if(Object.keys(data).length > 0)
                {
                    $("#percent").val(data['value']);
                    $("#full").val(data['full_mark']);
                }
            }
        });

        //loading the ajax model
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

    });

    $("#update").on("click",function() {
        class_id = sessionStorage.getItem("class_id");
        exam_id = sessionStorage.getItem("exam_id");
        percent = $("#percent").val();
        full_mark = $("#full").val();

        if((percent == '') && (full_mark == ''))
        {
            alert("give a value");
        }
        else
        {
            http = '<? echo base_url(); ?>'+'index.php?teacher/set_percentage/'+class_id+'/'+exam_id+'/'+percent+'/'+full_mark;

            $.ajax({
                url:http,
                method:'GET',
                data:{},
                success:function(data)
                {
                    if(data == '1')
                    {
                        $("#percent").val(0);
                        $("#full").val(0);

                        alert("successfully updated");
                    }
                    else
                    {
                        alert("error occured");
                    }
                }
            });
        }
    });


    /***basic***/
</script>
