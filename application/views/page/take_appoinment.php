<?php 
  $departments = get_department();
?>


<div class="row">
    <?php
      if(!isset($doctors[0])):
        ?>
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>No Doctors Found!</strong>
          </div>
        <?php
      else:
        $doctor = $doctors[0];
        ?>
          <div class="col-md-3 col-xs-12 widget widget_tally_box doctor_profile_widget">
            <h3 class="title">Doctor Information</h3>
            <hr>
            <div class="x_panel fixed_height_390">
              <div class="x_content">
                <div class="pro_img" style="height: auto;"><img src="<?php echo $doctor->picture; ?>" class="img-responsive" style="width: 100%;" alt=""></div>
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
                <br>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-md-9">
            <h3 class="title">Confirm Your Appoinment</h3>
            <hr>
            <?php
              if(isset($message) && !empty($message)){
                ?>
                <div role="alert" class=" alert  alert-dismissible fade in <?php echo ($type == "error" ? 'alert-danger': 'alert-success'); ?>">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                  </button>
                  <strong style="color:#fff;"><?php echo $message; ?></strong>
                  
                </div>
                <?php
              }
            ?>
            <?php
                if(validation_errors()){
                  echo '<div class="bg-red">'.validation_errors().'</div>';
                }
              ?>
           <?php echo form_open("",array("class" => "form-horizontal")); ?>
            <h4 class="title">Select Schedule</h4>
            <div class="row">
              <?php
                if(!empty($schedule)):
                  $tempI = 0;
                  foreach ($schedule as $keySchedule => $valueSchedule) {
                    $tempI++;
                    if($tempI == 2)
                      $tempI = 0;
                    ?>
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                      <div class="tile-stats bg-green rs_single_schedule">
                        <div class="count"><?php echo $valueSchedule->day_of_week; ?></div>
                        <p><strong>Fee:</strong> <span><?php echo $valueSchedule->fees; ?></span></p>
                        <p><strong>Schedule:</strong><span><?php echo $valueSchedule->start_time." to ".$valueSchedule->end_time; ?></span></p>
                        <p><strong>Patient Allow:</strong> <span><?php echo $valueSchedule->max_num_of_patients; ?></span></p>
                        <div class="text-center" style="margin-top: 10px;">
                          <label class="btn btn-round btn-info btn_schedule_select_btn"><input type="radio" name="schedule" value="<?php echo $valueSchedule->id; ?>" class="hidden"> Select Schedule</label>
                          <label class="btn btn-round btn-info hidden btn_checked"><i class="glyphicon glyphicon-ok"></i></label>
                        </div>
                      </div>
                    </div>
                    <?php
                  }
                endif;
              ?>
              
            </div>
           <div class="confirm_appoinment_section">
              
              <div class="row">
                <div class="col-xs-12">
                  <div class="form-group">
                      <textarea name="details" placeholder="Comments" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 col-md-offset-4">
                  <div class="x_panel">

                    <div class="x_title">
                      <h2>Select Date</h2>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        
                        <div class="form-group">
                          <div class="col-xs-12">
                            <input class="form-control datepicker" name="date" type="text">
                            <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                          <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-md btn-success">Confirm</button>
                          </div>
                        </div>
                     
                        
                    </div>
                      
                  </div>
                </div>
              </div>

            </div>
             <?php echo form_close(); ?>

          </div>
        <?php
       
      endif;
    ?>



</div>