<div class="sidebar-menu">
		<header class="logo-env" >
			
            <!-- logo -->
			<div class="logo" style="">
				<a href="<?php echo base_url();?>">
					<img src="uploads/logo.png"  style="max-height:60px;"/>
				</a>
			</div>
            
			<!-- logo collapse icon -->
			<div class="sidebar-collapse" style="">
				<a href="#" class="sidebar-collapse-icon with-animation">
                
					<i class="entypo-menu"></i>
				</a>
			</div>
			
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation">
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
		
		<div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
		<ul id="main-menu" class="">
			<!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            
           
           <!-- DASHBOARD -->
           <li class="<?php if($page_name == 'dashboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/dashboard">
					<i class="entypo-gauge"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
           </li>
           
           
            
           <!-- FACULTY -->
           <li class="<?php if($page_name == 'teacher' )echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/teacher_list">
					<i class="entypo-users"></i>
					<span><?php echo get_phrase('teacher');?></span>
				</a>
           </li>

            <!-- Classes -->
            <li>
                <a href="#">
                    <i class="entypo-graduation-cap"></i>
                    <span><?php echo get_phrase('classes');?></span>
                </a>
                <ul>
                    <li class="<?php if($page_name == 'add class')echo 'active';?> ">
                        <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/add_class_form">
                            <span><i class="entypo-dot"></i> <?php echo get_phrase('add class');?></span>
                        </a>

                        <?
                            $query = $this->db->query("SELECT class.class_id,class.name,student_and_course.s_c_id FROM class JOIN student_and_course ON class.class_id = student_and_course.c_id  WHERE student_and_course.s_id = ".$this->session->userdata("student_id"));

                            $data = $query->result_array();

                            if(count($data) > 0)
                            {
                                foreach($data as $d)
                                {
                                    ?>
                                    <a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/class_des/<? echo $d['class_id'] ?>">
                                        <span><i class="entypo-dot"></i> <?php echo get_phrase($d["name"]);?></span>
                                    </a>
                                    <?
                                }
                            }
                        ?>
                    </li>
                </ul>
            </li>
            
           <!-- EXAMS -->
           <li class="<?php if($page_name == 'exam' ||
		   								$page_name == 'grade' ||
												$page_name == 'marks')echo 'opened active';?> ">
				<a href="#">
					<i class="entypo-graduation-cap"></i>
					<span><?php echo get_phrase('exam');?></span>
				</a>
                <ul>
					
					<li class="<?php if($page_name == 'marks')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/marks">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks');?></span>
						</a>
					</li>
                </ul>
           </li>
           
           <!-- PAYMENT -->
          
            
            
           <!-- LIBRARY -->
          
            
           <!-- TRANSPORT -->
          
            
           <!-- NOTICEBOARD -->
           <li class="<?php if($page_name == 'noticeboard')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/noticeboard">
					<i class="entypo-doc-text-inv"></i>
					<span><?php echo get_phrase('noticeboard');?></span>
				</a>
           </li>
            
            
           <!-- ACCOUNT -->
           <li class="<?php if($page_name == 'manage_profile')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('account');?></span>
				</a>
           </li>
                
           
           
		</ul>
        		
</div>