<?php
class Ajax_query extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		$this->body_Data = array();
		
	}
	public function index(){
		echo ":(";
	}
	public function get_coutry($country = null){
		$this->load->helper(array('file'));
		$country_names = read_file('files/country/names.json');
		if(is_null($country)){
			echo $country_names;
		}else{
			echo json_decode($country_names,true)[strtoupper($country)];
		}
	}
	public function get_city($country='',$city = ''){
		$this->load->helper(array('file'));
		$country_city = read_file('files/country/capital.json');
		$country_city = json_decode($country_city,true);
		echo json_encode($country_city[$country]);
	}
	/*
	
	*/
	public function uploader(){
		$this->load->view('uploader');
	}
	public function do_upload(){
		$response = array();
		$allowed = array('png', 'jpg', 'gif','zip');

		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				return;
			}

			if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
				$response['url'] = base_url('uploads/'.$_FILES['upl']['name']);
				echo json_encode($response);
				return;
			}
		}

		echo '{"status":"error"}';
		return;
	}
}
