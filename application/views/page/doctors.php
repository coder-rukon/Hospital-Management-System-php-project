<?php 
  $departments = get_department();
?>

<div class="page-title">
    <div class="title_left">
      <?php echo form_open('',array("method" => "get")); ?>
      <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12" style="line-height: 38px;">
            Select Department
          </label>
          <div class="col-md-8 col-sm-8 col-xs-12">
            <select class="form-control" name="department" onchange="this.form.submit();">
              <option value="">All</option>
              <?php
                if(!empty($departments)){
                  foreach ($departments as $key => $department) {
                    if(isset($_GET['department']) && $_GET['department'] == $department->id ){
                      echo '<option value="'.$department->id.'" selected>'.$department->name.'</option>';
                    }else{
                      echo '<option value="'.$department->id.'">'.$department->name.'</option>';
                    }
                  }
                }
              ?>
            </select>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>

    <div class="title_right">
        
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <?php echo form_open('',array("method" => "get"));
        if(isset($_GET['department'])) 
          echo '<input type="hidden" name="department" value="'.$_GET['department'].'">';

        ?>
        <div class="input-group">
          <input type="text" class="form-control" name="s" placeholder="Search Doctors">
          <span class="input-group-btn">
            <button  class="btn btn-default" type="submit">Search</button>
          </span>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>

<div class="row">
    <?php
      $bgClass=  array(
        "bg-red",  
        "bg-default",
        "bg-green"
      );
      if(empty($doctors)):
        ?>
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>No Doctors Found!</strong>
          </div>
        <?php
      else:
        foreach ($doctors as $key => $doctor):
        ?>
          <div class="col-md-3 col-xs-12 widget widget_tally_box doctor_profile_widget">
            <div class="x_panel fixed_height_390 <?php echo $bgClass[rand(0,2)]; ?>">
              <div class="x_content">
                <div class="pro_img" style="background-image: url(<?php echo $doctor->picture; ?>);"></div>
               <h3 class="name"><?php echo $doctor->name; ?></h3>
                <div>
                  <ul class="list-inline widget_tally">
                    <li>
                      <p>
                        <strong>D.N:</strong>
                        <span><?php echo get_department(array("id" =>$doctor->department))[0]->name; ?></span>
                      </p>
                    </li>
                    <li>
                      <p>
                        <strong>Country:</strong>
                        <span><?php echo get_country($doctor->country); ?></span>
                      </p>
                    </li>
                    <li>
                      <p>
                        <strong>Email:</strong>
                        <span><?php echo $doctor->email; ?></span>
                      </p>
                    </li>
                  </ul>
                </div>
                <div class="bottom  text-center"><a href="<?php echo base_url("page/TakeAppoinment/".$doctor->id); ?>" class="btn btn-success">Take Appoinment Now</a></div>
                <br>
              </div>
            </div>
          </div>
        <?php
        endforeach;
      endif;
    ?>



</div>