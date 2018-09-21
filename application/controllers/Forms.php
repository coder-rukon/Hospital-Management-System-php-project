<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		$this->body_Data = array();
		$this->body_Data['sidebar'] = false;
		$this->body_Data[''] = '';
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('blank');
		$this->load->view('footer');
	}
	public function add($data = null){
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs'][] 	=	array(
									'label' => 'name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name'
										)
								);
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	public function update($data = null){
		$this->load->view('header');
		$this->load->view('forms');
		$this->load->view('footer');
	}
}
