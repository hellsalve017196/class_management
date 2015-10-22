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
				<a href="<?php echo base_url();?>index.php?admin/dashboard">
					<i class="entypo-gauge"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
           </li>
            
           <!-- TEACHER -->
           <li class="<?php if($page_name == 'teacher' )echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/teacher">
					<i class="entypo-users"></i>
					<span><?php echo get_phrase('teacher');?></span>
				</a>
           </li>
            
           <!-- CLASS -->
           <li class="<?php if($page_name == 'class')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/classes">
					<i class="entypo-flow-tree"></i>
					<span><?php echo get_phrase('class');?></span>
				</a>
                
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
					<li class="<?php if($page_name == 'exam')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/exam">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('exam_list');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'grade')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/grade">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('exam_grades');?></span>
						</a>
					</li>
					<li class="<?php if($page_name == 'marks')echo 'active';?> ">
						<a href="<?php echo base_url();?>index.php?admin/marks">
							<span><i class="entypo-dot"></i> <?php echo get_phrase('manage_marks');?></span>
						</a>
					</li>
                </ul>
           </li>
            
           <!-- notice board -->
            <li class="<?php if($page_name == 'noticeboard')echo 'active';?> ">
                <a href="<?php echo base_url();?>index.php?admin/noticeboard">
                    <i class="entypo-lock"></i>
                    <span><?php echo get_phrase('noticeboard');?></span>
                </a>
            </li>
            
           <!-- ACCOUNT -->
           <li class="<?php if($page_name == 'manage_profile')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?admin/manage_profile">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('account');?></span>
				</a>
           </li>

		</ul>
        		
</div>