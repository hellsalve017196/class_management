<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	//$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	//$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo get_phrase('login');?> | <?php //echo $system_title;?></title>
	

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.0.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="assets/images/favicon.png">
	
</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
var baseurl = '<?php echo base_url();?>';
</script>

<div class="login-container">
	
	<div class="login-header">
		
		<div class="login-content" style="width:100%;">
			
			<a href="<?php echo base_url();?>" class="logo">
				<img src="uploads/logo.png" height="100" alt="" />
			</a>
			
			<p class="description">
            	<h2 style="color:#222; font-weight:700; font-size: 42px;">
					<?php //echo $system_name;?>
              </h2>
           </p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<div class="form-login-error">
				<h3>Invalid login</h3>
				<p>Please enter correct email and password!</p>
			</div>
			
			<form method="post" role="form" id="form_login">
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
						
						<input type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off" data-mask="email" />
					</div>
					
				</div>
				
				<div class="form-group">
					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
				
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">
						<i class="entypo-login"></i>
						Login
					</button>
				</div>

                <div class="form-group">
                    <button type="button" id="s" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-bag"></i>
                        Sign Up
                    </button>
                </div>

                <div class="form-group">
                    <button id="f" type="button" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-air"></i>
                        Forgot password ?
                    </button>
                </div>
						
			</form>
			
			
			<!--<div class="login-bottom-links">
				<a href="#" class="link">Forgot your password?</a>
			</div>-->
			
		</div>
		
	</div>
	
</div>

<!-- forgot password -->
<div class="modal fade" id="model_forgot">
    <div class="modal-dialog" style="width:600px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1>iF YOU FORGET PASSWORD</h1>
            </div>
            <div class="modal-body" style="height:200px; overflow:auto;font-weight: bold;color: #000000">
                <form role="form">

                    <div class="form-group">
                        <label for="account">Select Account type:</label>
                        <select id="account" class="form-control">
                            <option value="student">student</option>
                            <option value="teacher">teacher</option>
                            <option value="parent">parent</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email">Enter email address:</label>
                        <input type="email" class="form-control" id="user_id" required="">
                    </div>

                    <button type="button" id="send" class="btn btn-success">Retrive password</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- sign up model -->
<div class="modal fade" id="modal_ajax">
    <div class="modal-dialog" style="width:680px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1>Sign Up</h1>
            </div>
            <div class="modal-body" style="background-color:#d3d3d3;height:500px; overflow:auto;">
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#student" aria-controls="home" role="tab" data-toggle="tab">Student Signup</a></li>
                        <li role="presentation"><a href="#teacher" aria-controls="profile" role="tab" data-toggle="tab">Teacher Signup</a></li>
                        <li role="presentation"><a href="#parent" aria-controls="profile" role="tab" data-toggle="tab">Parent Signup</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="student">

                            <!-- Student -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary" data-collapsed="0">
                                        <div class="panel-body">

                                            <?php echo form_open('' , array('class' => 'form-horizontal form-groups-bordered validate',"id"=>"form_1", 'enctype' => 'multipart/form-data'));?>

                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="text" class="form-control" name="roll" value="" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="email" class="form-control datepicker" name="email" value="" data-start-view="2">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

                                                <div class="col-sm-5">
                                                    <select name="sex" class="form-control" required>
                                                        <option value=""><?php echo get_phrase('select');?></option>
                                                        <option value="male"><?php echo get_phrase('male');?></option>
                                                        <option value="female"><?php echo get_phrase('female');?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="address" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

                                                <div class="col-sm-5">
                                                    <input type="number" class="form-control" name="phone" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

                                                <div class="col-sm-5">
                                                    <input type="password" max="20" maxlength="20" class="form-control" name="password" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('retype_password');?></label>

                                                <div class="col-sm-5">
                                                    <input type="password" max="20" maxlength="20" class="form-control" name="r_password" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-5">
                                                    <input type="submit" class="btn btn-info" value="Sign up"/>
                                                </div>
                                            </div>
                                            <?php echo form_close();?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- student end -->

                        </div>

                        <div role="tabpanel" class="tab-pane" id="teacher">
                            <!--teacher -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary" data-collapsed="0">
                                        <div class="panel-body">

                                            <?php echo form_open('' , array('class' => 'form-horizontal form-groups-bordered validate', "id" => "form_2",'enctype' => 'multipart/form-data'));?>

                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="email" class="form-control datepicker" name="email" value="" data-start-view="2">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

                                                <div class="col-sm-5">
                                                    <select name="sex" class="form-control" required>
                                                        <option value=""><?php echo get_phrase('select');?></option>
                                                        <option value="male"><?php echo get_phrase('male');?></option>
                                                        <option value="female"><?php echo get_phrase('female');?></option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="address" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

                                                <div class="col-sm-5">
                                                    <input type="number" class="form-control" name="phone" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

                                                <div class="col-sm-5">
                                                    <input type="password" max="20" maxlength="20" class="form-control" name="password" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('retype_password');?></label>

                                                <div class="col-sm-5">
                                                    <input type="password" max="20" maxlength="20" class="form-control" name="r_password" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-5">
                                                    <input type="submit" class="btn btn-info" value="Sign up"/>
                                                </div>
                                            </div>

                                            <?php echo form_close();?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- teacher end -->

                        </div>

                        <div role="tabpanel" class="tab-pane" id="parent">

                            <!-- parent -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-primary" data-collapsed="0">
                                        <div class="panel-body">

                                            <?php echo form_open('teacher/student/create/' , array("id" => "form_3",'class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                                            <div class="form-group">
                                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="email" class="form-control datepicker" name="email" value="" data-start-view="2">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('student email address');?></label>

                                                <div class="col-sm-5">
                                                    <input required type="email" class="form-control datepicker" name="student_email" value="" data-start-view="2">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>

                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="address" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

                                                <div class="col-sm-5">
                                                    <input type="number" class="form-control" name="phone" value="" required>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>

                                                <div class="col-sm-5">
                                                    <input type="password" max="20" maxlength="20" class="form-control" name="password" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('retype_password');?></label>

                                                <div class="col-sm-5">
                                                    <input type="password" max="20" maxlength="20" class="form-control" name="r_password" value="" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-5">
                                                    <input type="submit" class="btn btn-info" value="Sign up"/>
                                                </div>
                                            </div>

                                            <?php echo form_close();?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- parent end -->

                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



	<!-- Bottom Scripts -->
	<script src="assets/js/gsap/main-gsap.js"></script>
	<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/joinable.js"></script>
	<script src="assets/js/resizeable.js"></script>
	<script src="assets/js/neon-api.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/neon-login.js"></script>
	<script src="assets/js/neon-custom.js"></script>
	<script src="assets/js/neon-demo.js"></script>
    <script>
        $("#s").on('click',function() {
            jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        });

        $("#f").on('click',function() {
            jQuery("#model_forgot").modal('show',{backdrop:'true'});
        });

        //forget password
        $("#send").click(
            function() {

                type = $("#account").val();
                email = $("#user_id").val();

                http = '<? echo base_url() ?>'+'index.php?login/forget_password/';

                $.ajax({
                    url:http,
                    method:'post',
                    data:{'type':type,'email':email},
                    success:function(data)
                    {
                        alert(data);
                        $("#model_forgot").modal('hide');
                    }
                });

            }
        );

        //student sign up
        $("#form_1").submit(function(e) {

            data = $(this).serializeArray();

            pass = data[6]['value'];
            r_pass = data[7]['value'];

            if(pass === r_pass)
            {
                data.pop();

                http  = '<? echo base_url() ?>'+'index.php?login/sign_up_student/';

                $.ajax({
                    'url':http,
                    'method':'POST',
                    'data':{'student':JSON.stringify(data)},
                    success:function(msg)
                    {
                        alert(msg);
                        $("#model_ajax").modal('hide');
                    }
                });
            }
            else
            {
                alert("check ur password and repyted password");
            }

            e.preventDefault();
        });

        //teacher sign up
        $("#form_2").submit(function(e) {

            var data = $(this).serializeArray();

            pass = data[5]['value'];
            r_pass = data[6]['value'];

            if(pass === r_pass)
            {
                data.pop();

                http  = '<? echo base_url() ?>'+'index.php?login/sign_up_teacher/';

                $.ajax({
                    'url':http,
                    'method':'POST',
                    'data':{'teacher':JSON.stringify(data)},
                    success:function(msg)
                    {
                        alert(msg);
                        $("#model_ajax").modal('hide');
                    }
                });
            }
            else
            {
                alert("check ur password and repyted password");
            }

            e.preventDefault();
        });

        //parent sign up
        $("#form_3").submit(function(e) {
            var data = $(this).serializeArray();

            console.log(data);

            pass = data[5]['value'];
            r_pass = data[6]['value'];

            if(pass === r_pass)
            {
                data.pop();

                http  = '<? echo base_url() ?>'+'index.php?login/sign_up_parent/';

                $.ajax({
                    'url':http,
                    'method':'POST',
                    'data':{'parent':JSON.stringify(data)},
                    success:function(msg)
                    {
                        alert(msg);
                        $("#model_ajax").modal('hide');
                    }
                });
            }
            else
            {
                alert("check ur password and repyted password");
            }

            e.preventDefault();
        });
    </script>
</body>
</html>