<?php
  $login_user = $this->session->userdata('login_user');
?>
<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo base_url(); ?>" class="site_title"><i class="fa fa-paw"></i> <span>HMS</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="<?php echo $login_user['picture']; ?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $login_user['full_name']; ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>&nbsp;</h3>
        <ul class="nav side-menu">
          <!-- <li>
            <a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a>
          </li> -->
          <li>
            <a href="<?php echo base_url(); ?>department"><i class="fa fa-sitemap"></i> Department</a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>department">All Departments</a></li>
              <li><a href="<?php echo base_url(); ?>department/add">New Department</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>doctors"><i class="fa fa-user"></i> Doctor</a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>doctors">All Doctor</a></li>
              <li><a href="<?php echo base_url(); ?>doctors/add">New Doctor</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>patient"><i class="fa fa-user-md"></i> Patient</a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>patient">All Patient</a></li>
              <li><a href="<?php echo base_url(); ?>patient/add">Admit Patient</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>nurse"><i class="fa fa-plus-square"></i> Nurse</a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>nurse">All nurse</a></li>
              <li><a href="<?php echo base_url(); ?>nurse/add">Add New nurse</a></li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>user"><i class="fa fa-plus-square"></i> Users</a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>user">All user</a></li>
              <li><a href="<?php echo base_url(); ?>user/add">Add New user</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-file-o"></i>Invoice</a>
            <ul class="nav child_menu">
              <li><a href="<?php echo base_url(); ?>invoice">All Invoice</a></li>
              <li><a href="<?php echo base_url(); ?>invoice/add">Create Invoice</a></li>
            </ul>
          </li>
          <!-- 
          <li>
            <a><i class="fa fa-medkit"></i> Pharmacist</a>
          </li>
          <li>
            <a><i class="fa fa-flask"></i> Laboratorist</a>
          </li>
          <li>
            <a><i class="fa fa-user"></i> Accountant</a>
          </li>
          <li>
            <a><i class="fa fa-user"></i> Receptionist</a>
          </li>
          <li>
            <a><i class="fa fa-home"></i> Monitor Hospital</a>
          </li>
          <li>
            <a><i class="fa fa-bell-o"></i> Noticeboard</a>
          </li>
          <li>
            <a><i class="fa fa-user-plus"></i> Account</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>settings"><i class="fa fa-cogs"></i> Settings</a>
          </li> -->

          <!-- <li>
            <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="index.html">Dashboard</a></li>
              <li><a href="index2.html">Dashboard2</a></li>
              <li><a href="index3.html">Dashboard3</a></li>
            </ul>
          </li> -->

        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      
      <a href="<?php echo base_url('user/logout'); ?>" data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>
        
<!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="<?php echo $login_user['picture']; ?>" alt=""><?php echo $login_user['full_name']; ?>
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <!-- <li><a href="javascript:;"> Profile</a></li>
              <li>
                <a href="javascript:;">
                  <span>Settings</span>
                </a>
              </li><li><a href="javascript:;">Help</a></li> -->
              <li><a href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
            </ul>
          </li>

        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->
