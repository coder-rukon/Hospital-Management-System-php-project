<?php
if(!function_exists('rs_form_group')){
	function rs_form_group($data = array(),$input = ''){
		static $form_group_id = 0;
		$form_group_id++;
		?>
		<div id="<?php echo 'from_group_'.$form_group_id; ?>" class="<?php echo (isset($data['group_class'])? $data['group_class']: 'form-group'); ?> <?php echo ($data['media']? 'media_upload': ''); ?>">
			<label class="<?php echo (isset($data['label_class'])? $data['label_class']: 'control-label col-md-3 col-sm-3 col-xs-12'); ?>" for="<?php echo (isset($data['id'])? $data['id']: ''); ?>">
				<?php echo $data['label']; ?>
				<?php if(isset($data['required']) && $data['required']){
					echo '<span class="required">*</span>';
				} ?>
			</label>
			<div class="<?php echo (isset($data['input_class'])? $data['input_class']: 'col-md-6 col-sm-6 col-xs-12'); ?>">
				<?php
				echo $input;
				if($data['media']){
					?>
						<span class="input-group-btn"> <button class="btn btn-default dialog_open" data-title="Media Library" data-url="<?php echo base_url('ajax_query/uploader/'); ?>" type="button"><span class="glyphicon glyphicon-cloud-upload"></span> Select</button> </span>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}


if(!function_exists('get_country')){
	function get_country($data = null){
		if(is_null($data)){
			$country = file_get_contents(base_url().'Ajax_query/get_coutry');
			return json_decode($country,true);
		}else{
			return file_get_contents(base_url().'Ajax_query/get_coutry/'.$data);
		}
	}
}

if(!function_exists('get_days')){
	function get_days(){
		$days = array(
		    "Sunday"=>'Sunday',
		    "Monday"=>'Monday',
		    "Tuesday"=>'Tuesday',
		    "Wednesday"=>'Wednesday',
		    "Thursday"=>'Thursday',
		    "Friday"=>'Friday',
		    "Saturday"=>'Saturday'
		);
		return $days;
	}
}




if(!function_exists('get_department')){
	function get_department($data = array()){
		$CI =& get_instance(); 
		$CI->load->model("Department_model");
		return $CI->Department_model->Get($data);
		
	}
}


if(!function_exists('get_schedule')){
	function get_schedule($data = array()){
		$CI =& get_instance(); 
		$CI->load->model("Hospital_model");
		$CI->Hospital_model->set_table('doctors_schedule');
		return $CI->Hospital_model->Get_Data($data);
		
	}
}
if(!function_exists('get_doctors')){
	function get_doctors($data = array()){
		$CI =& get_instance(); 
		$CI->load->model("Hospital_model");
		$CI->Hospital_model->set_table('doctor');
		return $CI->Hospital_model->Get_Data($data);
		
	}
}
if(!function_exists('get_users')){
	function get_users($data = array()){
		$CI =& get_instance(); 
		$CI->load->model("Hospital_model");
		$CI->Hospital_model->set_table('user');
		return $CI->Hospital_model->Get_Data($data);
		
	}
}



if(!function_exists('is_login')){
	function is_login(){
		$CI =& get_instance(); 
		$CI->load->library(array('session'));
		if(isset($CI->session->userdata['is_login']) && $CI->session->userdata['is_login']){
			return true;
		}else{
			return false;
		}
	}
}
if(!function_exists('only_access')){
	function only_access($dataArray = array()){
		$CI =& get_instance();
		$loginUserRule = $CI->session->userdata("login_user")["role"];
		$CI->load->library(array('session'));
		if(!in_array($loginUserRule,$dataArray))
		redirect(base_url());
	}
}

