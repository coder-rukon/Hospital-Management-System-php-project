<?php
	
?>

<div class="x_panel">
  <div class="x_title">
    <h2><?php echo (isset($title)? $title: '&nbsp;'); ?></h2>
    <ul class="nav navbar-right panel_toolbox">
    	<?php if(isset($back_url)){
    		?>
      		<li><a href="<?php echo $back_url; ?>"><i class="fa fa-chevron-left"></i> Back</a></li>
    		<?php 
    	}
    	?>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">

    <br>
    <?php if(isset($message) && !empty($message)): ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <?php echo $message; ?>
    </div>
  <?php endif; ?>
    <?php 
    	echo form_open(false,array(
    				'class' => 'form-horizontal form-label-left',
    				'method' => 'post',
    			));

		if(validation_errors()){
			echo '<div class="validations_error">';
			echo validation_errors();
			echo '</div>';
		}
    ?>
		<?php
			foreach ($inputs as $key => $value) {
				$tempArg = array();
				if(isset($value['label']))
				$tempArg['label'] = $value['label'];
      if(isset($value['id']))
        $tempArg['id'] = $value['id'];
      if(isset($value['group_class']))
        $tempArg['group_class'] = $value['group_class'];
			if(isset($value['media'])){
        $tempArg['media'] = $value['media'];
      }else{
				$tempArg['media'] = false;
        
      }

			$functionName = 'form_input';
			if(isset($value['fn']))
			$functionName = $value['fn'];
				rs_form_group(
					$tempArg,
					$functionName(
						$value['fn_arg']
					)
				);
			}
			
		?>
      <div class="ln_solid"></div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <button type="reset" class="btn btn-primary reset_form">Reset Form</button>
          <button type="submit" class="btn btn-success"><?php echo (isset($submitTitle)?$submitTitle: "Submit"); ?></button>
        </div>
      </div>

    <?php echo form_close(); ?>
  </div>
</div>
