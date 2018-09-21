<?php
?>
<div class="clearfix"></div>

<div class="about_top">
  <div class="well profile_view">
    <div class="col-sm-12">
      <div class="left col-xs-7">
        <h2><?php echo $doctor[0]->name; ?></h2>
        <p><strong>Mobile: </strong><?php echo $doctor[0]->phone; ?></p>
        <p><?php echo $doctor[0]->about; ?></p>
      </div>
      <div class="right col-xs-5 text-center">
        <img src="<?php echo $doctor[0]->picture; ?>" alt="" class="img-responsive avatar-view">
      </div>
    </div>
  <div class="clearfix"></div>
  </div>
</div>
<div class="x_panel">
  <div class="x_content">
    <div class="" role="tabpanel" data-example-id="togglable-tabs">
      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Shedule</a></li>
        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a></li>
        <li role="presentation" class=""><a href="<?php echo base_url('doctors/appoinments/'.$doctor[0]->id); ?>">Appoinments</a></li>
      </ul>
      <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
              <div class="x_title">
                <h2>All Schedule</h2>
                <a class="btn btn-success pull-right" href="<?php echo base_url('doctors/createSchedule/'.$doctor[0]->id); ?>">Create Schedule</a>
              <div class="clearfix"></div>
              </div>
               <table class="table table-striped jambo_table ">
                <thead>
                  <tr>
                    <th  style="width:50px">#</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Maximum Patients</th>
                    <th>Fees</th>
                    <th style="width:30px;">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if(!empty($allSchedule)):
                      foreach ($allSchedule as $key => $value) {
                        ?>
                        <tr>
                          <th scope="row" style="vertical-align: middle; text-align: center;" >
                              <strong><?php echo ($key+1); ?></strong>
                          </th>
                          <td>
                              <strong><?php echo $value->day_of_week; ?></strong>
                              <p><?php echo $value->comment; ?></p>
                          </td>
                          <td><?php echo $value->start_time.' To '.$value->end_time; ?></td>
                          <td><?php echo $value->max_num_of_patients; ?></td>
                          <td><?php echo $value->fees; ?></td>
                          <td>
                            <a href="<?php echo base_url('doctors/deleteSchedule/'.$doctor[0]->id.'/'.$value->id); ?>" class="btn btn-xs btn-danger delete_confirm"><i class="fa fa-trash-o fa-2" aria-hidden="true"></i> Delete</a>
                          </td>
                        </tr>
                        <?php
                      }
                    endif;
                  ?>
                </tbody>
              </table>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
          <div class="row">
                <div class="col-xs-12 col-md-6">
                  <table class="table">
                    <?php
                      $printArray  = array(
                            'name' => 'Doctor Name',
                            'nic' => 'National Id Number',
                            'department' => 'Department',
                            'blood_group' => 'Glood Group',
                            'birth_date' => 'Birth Day',
                            'sex' => 'Gender',
                            'email' => 'Email Address',
                            'phone' => 'Phone Number',
                            'country' => 'Country',
                            'state' => 'City/State',
                            'address' => 'Address',
                        );
                      foreach ($printArray as $key => $value) {
                        ?>
                        <tr>
                          <td><?php echo $value; ?></td>
                          <?php
                            if($key == "sex"){
                              echo '<td>'.($doctor[0]->$key==0? "Male": "Female").'</td>';
                              continue;
                            }
                            if($key == "country"){
                              echo '<td>'.get_country($doctor[0]->$key).'</td>';
                              continue;
                            }
                            if($key == "department"){
                              echo '<td>'.get_department(array("id" => $doctor[0]->$key))[0]->name.'</td>';
                              continue;
                            }
                            if($key == "blood_group"){
                              echo '<td>'.$this->config->item('blood_group')[$doctor[0]->$key].'</td>';
                              continue;
                            }
                          ?>
                          <td><?php echo $doctor[0]->$key; ?></td>
                        </tr>
                        <?php
                      }
                    ?>
                  </table>
                </div>
                <div class="col-xs-12 col-md-6">
                  <div class="about_text">
                    <?php echo $doctor[0]->about; ?>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>

