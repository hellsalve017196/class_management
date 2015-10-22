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
				<a href="<?php echo base_url();?>index.php?<? echo $this->session->userdata('login_type') ?>/dashboard">
					<i class="entypo-gauge"></i>
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
           </li>
           
           
            
           <!-- FACULTY -->
           <li class="<?php if($page_name == 'teacher' )echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<? echo $this->session->userdata('login_type') ?>/teacher_list">
					<i class="entypo-users"></i>
					<span><?php echo get_phrase('teacher');?></span>
				</a>
           </li>


            <!-- NOTICEBOARD -->
            <li class="<?php if($page_name == 'noticeboard')echo 'active';?> ">
                <a href="<?php echo base_url();?>index.php?<? echo $this->session->userdata('login_type') ?>/noticeboard">
                    <i class="entypo-doc-text-inv"></i>
                    <span><?php echo get_phrase('noticeboard');?></span>
                </a>
            </li>
            
           <!-- ACCOUNT -->
           <li class="<?php if($page_name == 'manage_profile')echo 'active';?> ">
				<a href="<?php echo base_url();?>index.php?<? echo $this->session->userdata('login_type') ?>/manage_profile">
					<i class="entypo-lock"></i>
					<span><?php echo get_phrase('account');?></span>
				</a>
           </li>
                
           
           
		</ul>
        		
</div>