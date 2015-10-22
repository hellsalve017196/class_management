<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('manage_marks');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('student/marks');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                	<tr>
                        <td><?php echo get_phrase('select_course');?></td>
                        <td>&nbsp;</td>
                	</tr>
                	<tr>
                        <td>
                        	<select id="class_id" class="form-control"  style="float:left;">
                                <option value=""><?php echo get_phrase('select_class');?></option>
                                <?php 
                                $exams = $this->db->query("SELECT class.class_id,class.name,student_and_course.s_c_id FROM class JOIN student_and_course ON class.class_id = student_and_course.c_id WHERE student_and_course.s_id = ".$this->session->userdata("student_id")." ORDER BY class_id DESC")->result_array();
                                foreach($exams as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($exam_id == $row['class_id'])echo 'selected';?>>
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>

                        <td>
                         <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                        	<input type="hidden" name="operation" value="selection" />
                    		<input type="button" onclick="show_result()" value="<?php echo get_phrase('show_details');?>" class="btn btn-info" />
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
    <div class="modal-dialog" style="width:680px">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Class Data</h4>
            </div>

            <div class="modal-body" style="height:500px; overflow:auto;font-weight:bold;color:black">
                <div id="res"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  function mark_range_load()
  {
      str = '<? echo base_url() ?>'+'index.php?student/get_grade_list/';
      $.ajax({
          method:'GET',
          url:str,
          data:{},
          success:function(data) {
              sessionStorage.setItem("grade",data);
          }
      });
  }
  mark_range_load();

  function grade_calculate(mark)
  {
      mark = parseInt(mark);
      grade_data = JSON.parse(sessionStorage.getItem("grade"));
      grade = '';
      if(grade_data.length > 0)
      {
          for(i=0;i<grade_data.length;i++)
          {
              if((mark >= grade_data[i]['mark_from']) && (mark <= grade_data[i]['mark_upto']))
              {
                  grade = grade_data[i]['name'];
              }
          }
      }
      else
      {
          alert("grade range is not set");
      }

      return grade;
  }

  function show_result()
  {
      class_id = $("#class_id").val();
      student_id = '<? echo $this->session->userdata("student_id"); ?>';

      if($.trim(class_id) != '')
      {
          str = '<? echo base_url() ?>'+'index.php?student/get_result/'+class_id+'/'+student_id;

          $.ajax({
              'url':str,
              'method':'GET',
              'data':{},
              'success':function(data)
              {
                  data = JSON.parse(data);

                  if(data.length > 0)
                  {
                      str = '<table class="table table-bordered" ><thead><tr><td>Name</td><td>Mark total</td><td>Mark obtained</td><td>Percentage set by faculty</td><td>You obtained(percentage)</td></tr></thead>';

                      var table = '';
                      var total = 0;
                      var fac_per = 0;

                      for(var key in data)
                      {
                          obtained = parseInt((data[key]['mark_obtained']*data[key]['value'])/data[key]['mark_total']);
                          total = total + obtained;
                          fac_per = fac_per + parseInt(data[key]['value']);
                          table = table+'<tr><td>'+data[key]['name']+'</td><td>'+data[key]['mark_total']+'</td><td>'+data[key]['mark_obtained']+'</td><td>'+data[key]['value']+'%</td><td>'+obtained+'%</td></tr>';
                      }
                      current_mark = parseInt((total/fac_per)*100);
                      str = str + table + '<tr><td></td><td></td><td></td><td>total percentage:'+fac_per+'%</td><td>percentage obtained:    '+total+'%<br>(out of 100):     '+current_mark+'<br>Grade obtained:   '+grade_calculate(current_mark)+'</td><tr>' + '</table>';

                      $("#res").html(str);
                  }
                  else
                  {
                      $("#res").html("<h1>You are seeing this because <ul><li>You are not in the class</li><li>Faculty have n't take any exams</li></ul></h1>");
                  }

                  jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
              }
          });

      }
      else
      {
          alert("select a class");
      }
  }

</script> 