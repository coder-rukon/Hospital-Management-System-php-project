<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		only_access(array("doctor","admin"));
		$this->body_Data = array();
		$this->body_Data['title'] = 'Department';
		$this->load->model('Department_model');
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => 'Department name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'value' => set_value('name')
										)
								);
		$this->body_Data['inputs']['description'] 	=	array(
									'label' => 'Department Descriptions',
									'id' => 'description',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'description',
											'value' => set_value('description')
										)
								);
	}
	public function index()
	{
		$this->body_Data['title'] = "All Departments";
		$this->body_Data['departments'] = $this->Department_model->Get();
		$this->load->view('header');
		$this->load->view('departments/all_departments',$this->body_Data);
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
			$data = array();
			foreach ($this->input->post() as $key => $value) {
				$data[$key] = $value;
			}
			$this->Department_model->add($data);
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
			$data = array();
			foreach ($this->input->post() as $key => $value) {
				$data[$key] = $value;
			}
			$this->Department_model->Update(array('id'=>$id),$data);
			$this->body_Data['message'] = "A department has been Updated.";
		}
		$department = $this->Department_model->Get(array('id'=>$id));
		$this->body_Data['inputs']['name']['fn_arg']['value'] = $department[0]->name; 
		$this->body_Data['inputs']['description']['fn_arg']['value'] = $department[0]->description; 
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
		$this->Department_model->delete(array('id'=> $id));
		$this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->body_Data['department']= $this->Department_model->Get(array('id'=>$id));
		$this->load->view('header');
		$this->load->view('departments/about',$this->body_Data);
		$this->load->view('footer');
	}
}
