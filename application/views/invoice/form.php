<?php
  if(validation_errors()){
    echo '<div class="alert alert-danger">'.validation_errors().'</div>';
  }
  if(isset($message) && !empty($message)){
    echo '<div class="alert alert-success">'.$message.'</div>';
  }
?>
<div class="clearfix"></div>
<div class="x_panel" style="max-width: 760px;">
  <div class="x_content">
      <form method="post" class="form-horizontal form-label-left">

        <div class="form-group">
          <label for="invoice_title">Title <span class="required">*</span></label>
          <input name="title" id="invoice_title" value="<?php echo set_value('title'); ?>" required="required" class="form-control" type="text">
        </div>
        <div class="form-group">
          <label for="patient">Select Patient <span class="required">*</span></label>
          <?php

            $options = array();
            if(isset($patients) && !empty($patients)){
              foreach ($patients as $key => $patientValue) {
                $options[$patientValue->id] = $patientValue->full_name;
              }
            }
            echo form_dropdown(array(
                "class" => 'form-control',
                "name" => 'patient',
                'options' => $options,
                'value' => set_value('patient'),
            ));
          ?>
        </div>
        <hr>
        <div class="row">
          <div class="col-xs-12 col-md-4">
            <div class="form-group">
              <h5>Invoice Items:</h5>
            </div>
          </div>
          <div class="col-xs-12 col-md-8">
            <div id="invoice_items">
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="items_name[]" required="required" class="form-control col-md-7 col-xs-12" type="text" placeholder="Label">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input name="items_price[]" class="form-control col-md-7 col-xs-12" type="number" placeholder="Amount">
                </div>
              </div>
            </div>
            
            <div class="clearfix">
              <a href="javascript:void(0);" id="btn_new_item" class="btn btn-primary">Add Items</a>
            </div>
          </div>
        </div>
        



        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button class="btn btn-primary" type="button">Cancel</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>

      </form>
  </div>
</div>

