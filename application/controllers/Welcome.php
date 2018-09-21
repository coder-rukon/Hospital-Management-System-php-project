<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->load->model("Doctor_model");
		$this->body_Data['doctors'] = $this->Doctor_model->Get();
		$this->load->view('header_front');
		$this->load->view('page/doctors',$this->body_Data);
		$this->load->view('footer_front');
	}
}
