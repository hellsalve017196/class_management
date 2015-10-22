<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-body">

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('course');?></label>
                        
						<div class="col-sm-5">
							<select id="class_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
											?>
                                    		<option value="<?php echo $row['class_id'];?>">
													<?php echo $row['name'];?>
                                                    </option>
                                        <?php
										endforeach;
								  ?>
                          </select>
						</div>
                        <button type="button" id="code" class="btn btn-success">Generate Access code</button>

                        <div class="form-group">
                            <label for="comment">Give this access code to the students:</label>
                            <textarea class="form-control" rows="5" id="comment"></textarea>
                        </div>
					</div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("code").addEventListener("click",function(){
            key = btoa(document.getElementById("class_id").value);

            document.getElementById("comment").value = key;
    },false);
</script>