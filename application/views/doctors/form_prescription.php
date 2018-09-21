<?php
	$jsonAr = json_decode($_REQUEST["data"],true);
?>
<form id="rs_form_prescription" onload="done()" data-json='<?php echo $_REQUEST["data"]; ?>'>
  <div class="form-group">
  	<textarea class="form-control" id="prescription" placeholder="Details" rows="15"><?php echo $jsonAr['prescription']; ?></textarea>
  </div>
  <button type="submit" id="form_add_prescription" class="btn btn-primary">Save</button>
</form>