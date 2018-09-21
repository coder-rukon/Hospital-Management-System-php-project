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
    <link href="<?php echo base_url(); ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
  </head>

  <body class="nav-md <?php echo (isset($body_class)? $body_class: ''); ?>">
    <div class="container body">
      <div class="main_container">

        <?php 
        if($sidebar)
        require_once('sidebar.php'); 
        ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
