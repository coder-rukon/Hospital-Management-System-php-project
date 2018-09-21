<?php
if(!isset($sidebar)|| (isset($sidebar) AND $sidebar)){
    $sidebar = true;
}else{
    $sidebar = false;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo (isset($title)?$title:''); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- File Uploader -->
    <link href="<?php echo base_url(); ?>uploader_assets/css/style.css" rel="stylesheet" />
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/front.css" rel="stylesheet">
  </head>

  <body class="<?php echo (isset($body_class)? $body_class: ''); ?>">
        <div class="rs_main_header">
            <div class="container">
                <img style="width: 100%;" src="<?php echo base_url('images/banner.jpg'); ?>" alt="">
            </div>
        </div>
        <div class="container">
            <div class="front_main_menu">
                <ul class="nav nav-defualt nav-pills">
                    <li><a href="<?php echo base_url("page/doctors"); ?>">Doctors</a></li>
                    <?php if(is_login()): ?>
                    <li><a href="<?php echo base_url("page/appoinments"); ?>">Appoinments</a></li>
                    <li><a href="<?php echo base_url("page/profile"); ?>">Profile</a></li>
                    <li><a href="<?php echo base_url("user/logout"); ?>">Logout</a></li>
                    <?php else: ?>
                    <li><a href="<?php echo base_url("login"); ?>">Login</a></li>
                    <li><a href="<?php echo base_url("page/register"); ?>">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- page content -->
        <div class="container">
          <div class="page_contents">
            
