
<div class="clearfix"></div>
<?php echo form_open("",array("class" => "form-horizontal")); ?>
<div class="confirm_appoinment_section">
  
  <div class="row">
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
                <button type="submit" class="btn btn-md btn-success">Search</button>
              </div>
            </div>
         
            
        </div>
          
      </div>
    </div>
  </div>

</div>
 <?php echo form_close(); ?>
<?php
 if(isset($appoinments) && !empty($appoinments)): ?>
<table class="table table-striped jambo_table ">
  <thead>
    <tr>
      <th style="width:50px">#</th>
      <th>Patients name</th>
      <th>Serial No</th>
      <th>Date</th>
      <th>Fees</th>
      <th>Details</th>
      <th style="width:30px;">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
      
        foreach ($appoinments as $appoinmentKay => $appoinment) {
          $patient = get_users(array('id' => $appoinment->patient_id));
          $schedule = get_schedule(array('id' => $appoinment->schedule_id));
          $jsonData = array();
          $jsonData['apionment_id'] = $appoinment->id;
          $jsonData['prescription'] = $appoinment->prescription;
        ?>
        <tr>
          <th scope="row" style="vertical-align: middle; text-align: center;">
            <strong><?php echo $appoinmentKay+1; ?></strong>
          </th>
          <td>
          <strong><?php echo (isset($patient[0]->full_name) ? $patient[0]->full_name : ""); ?></strong>
          <p></p>
          </td>
          <td><?php echo $appoinment->serial_no; ?></td>
          <td><?php echo $appoinment->date; ?></td>
          <td><?php echo (isset($schedule[0]->fees) ? $schedule[0]->fees : ""); ?></td>
          <td><?php echo $appoinment->details; ?></td>
          <td width="100">
            
           <a href="" data-title="Add Prescription" data-json='<?php echo json_encode( $jsonData ); ?>' data-url="<?php echo base_url(); ?>/Doctors/Addprescription" class="btn btn-sm btn-danger btn-inline delete_confirm dialog_open"><i class="fa fa-plus" aria-hidden="true"></i> </a>
           <a href="<?php echo base_url().'/doctors/appoinments/'.$doctorId.'/'.$patient[0]->id; ?>" class="btn btn-sm btn-danger btn-inline delete_confirm"><i class="fa fa-list" aria-hidden="true"></i></a>
          
          </td>
        </tr>
        <?php
        }
     
    ?>
    
  </tbody>
</table>
<?php  endif; ?>