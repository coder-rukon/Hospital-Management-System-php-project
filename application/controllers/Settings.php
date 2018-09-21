<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		$this->body_Data = array();
		$this->body_Data['title'] = 'Department';
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => 'Hospital Name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'value' => set_value('name')
										)
								);
		$this->body_Data['inputs']['address'] 	=	array(
									'label' => 'Address',
									'id' => 'address',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'address',
											'value' => set_value('address')
										)
								);
		$this->body_Data['tab_active'] = 'othere_tab';
		$this->body_Data['tab']['basic_tab']['title'] = "Basic Settings";
		$this->body_Data['tab']['othere_tab']['title'] = "Other Options";
	}
	public function index($tab_active = '')
	{
		$this->options($tab_active);
	}
	public function options($tab_active = ''){
		if(!empty($tab_active))
			$this->body_Data['tab_active'] = $tab_active;
		$this->body_Data['title'] = "Title of tab";
		
		$this->load->view('header');
		$this->load->view('settings/settings',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		$this->body_Data['title'] = 'Add New Department';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$this->body_Data['message'] = "A department has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	public function update($id = null){
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update Department';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$this->body_Data['message'] = "A department has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	/*
		Delete a department
	*/
	public function delete($id = null){
		if(is_null($id))
			return;
		
		$this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->load->view('header');
		$this->load->view('departments/about',$this->body_Data);
		$this->load->view('footer');
	}
}
