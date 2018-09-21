<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		only_access(array("doctor","admin","nurse","employee"));
		$this->body_Data = array();
		$this->body_Data['title'] = 'Patient';
		$this->load->model(array('Patient_model','Doctor_model','Department_model'));
		$allDoctors = $this->Doctor_model->get();
		$allDepartment = $this->Department_model->get();
		$dbData = array();
		$dbData['doctors'] = array();
		$dbData['department'] = array();
		foreach ($allDoctors as $key => $value) {
			$dbData['doctors'][$value->id] = $value->name;
		}
		foreach ($allDepartment as $key => $value) {
			$dbData['department'][$value->id] = $value->name;
		}
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['phone'] 	=	array(
									'label' => 'Phone',
									'id' => 'phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'phone',
											'id' => 'phone',
											'value' => set_value('phone')
										)
								);
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => 'Patient Name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'value' => set_value('name')
										)
								);

		$this->body_Data['inputs']['department'] 	=	array(
									'label' => 'Department',
									'id' => 'department',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'department',
											'id' => 'department',
											'options' => $dbData['department'],
											'value' => set_value('department')
										)
								);

		
		$this->body_Data['inputs']['blood_group'] 	=	array(
									'label' => 'Blood Group',
									'id' => 'blood_group',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'blood_group',
											'id' => 'blood_group',
											'options' => array('A+','B-','O+','O-','AB+','AB-'),
											'value' => set_value('blood_group')
										)
								);
		$this->body_Data['inputs']['birth_date'] 	=	array(
									'label' => 'Date of Birth',
									'id' => 'birth_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'birth_date',
											'id' => 'birth_date',
											'value' => set_value('birth_date')
										)
								);
		$this->body_Data['inputs']['age'] 	=	array(
									'label' => 'Patient Age',
									'id' => 'age',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'age',
											'id' => 'age',
											'value' => set_value('age')
										)
								);	
		$this->body_Data['inputs']['sex'] 	=	array(
									'label' => 'Sex',
									'id' => 'sex',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'id' => 'sex',
											'name' => 'sex',
											'options' => array('Male','Female'),
											'value' => set_value('sex')
										)
								);
		$this->body_Data['inputs']['email'] 	=	array(
									'label' => 'Email',
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => set_value('email')
										)
								);
		
		$this->body_Data['inputs']['county'] 	=	array(
									'label' => 'County',
									'id' => 'county',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'county',
											'id' => 'county',
											'options' => get_country(),
											'value' => set_value('county')
										)
								);
		$this->body_Data['inputs']['city'] 	=	array(
									'label' => 'Distric / State',
									'id' => 'city',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'city',
											'id' => 'city',
											'value' => set_value('city')
										)
								);
		$this->body_Data['inputs']['address'] 	=	array(
									'label' => 'Address',
									'id' => 'address',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'address',
											'id' => 'address',
											'value' => set_value('address')
										)
								);
		$this->body_Data['inputs']['about'] 	=	array(
									'label' => 'About Patient',
									'id' => 'about',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'about',
											'id' => 'about',
											'value' => set_value('about')
										)
								);
		$this->body_Data['inputs']['guardian_name'] 	=	array(
									'label' => 'Guardian name',
									'id' => 'guardian_name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_name',
											'id' => 'guardian_name',
											'value' => set_value('guardian_name')
										)
								);
		$this->body_Data['inputs']['guardian_phone'] 	=	array(
									'label' => 'Guardian Phone',
									'id' => 'guardian_phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_phone',
											'id' => 'guardian_phone',
											'value' => set_value('guardian_phone')
										)
								);
		$this->body_Data['inputs']['guardian_details'] 	=	array(
									'label' => 'Guardian Details',
									'id' => 'guardian_details',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_details',
											'name' => 'guardian_details',
											'id' => 'guardian_details',
											'id' => 'guardian_details',
											'value' => set_value('guardian_details')
										)
								);
		$this->body_Data['inputs']['bad_no'] 	=	array(
									'label' => 'Bad No/Word No',
									'id' => 'bad_no',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'bad_no',
											'id' => 'bad_no',
											'value' => set_value('bad_no')
										)
								);
		$this->body_Data['inputs']['referred_by'] 	=	array(
									'label' => 'Referred by',
									'id' => 'referred_by',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control select2_single',
											'name' => 'referred_by',
											'id' => 'referred_by',
											'options' => $dbData['doctors'],
											'value' => set_value('referred_by')
										)
								);
		$this->body_Data['inputs']['reg_date'] 	=	array(
									'label' => 'Admitted Date',
									'id' => 'reg_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'reg_date',
											'id' => 'reg_date',
											'value' => set_value('reg_date')
										)
								);
		$this->body_Data['inputs']['descriptions'] 	=	array(
									'label' => 'Descriptions',
									'id' => 'descriptions',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'descriptions',
											'id' => 'descriptions',
											'value' => set_value('descriptions')
										)
								);
	}
	public function index()
	{
		$this->page();
	}
	public function page($page = 1)
	{
		$this->body_Data['title'] = "All Patient";
		$offset = ($page*10) - 10;
		$this->body_Data['patients'] = $this->Patient_model->get(array(),$offset);
		$this->load->view('header');
		$this->load->view('patient/all_patient',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		$this->body_Data['title'] = 'Add New Patient';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Patient Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			foreach ($this->input->post() as $key => $value) {
				$newData[$key] = $value;
			}
			$this->Patient_model->add($newData);
			$this->body_Data['message'] = "A patient has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update patient';
		$this->body_Data['patient'] = $this->Patient_model->Get(array("id" => $id));
		$formKey = array('phone','name','department','blood_group','birth_date','age','sex','email','county','city','address','about','guardian_name','guardian_phone','guardian_details','bad_no','referred_by','reg_date','descriptions');
		
		if($this->body_Data['patient']){
			foreach ($formKey as $formKeyKey => $formKeyValue) {
				$this->body_Data['inputs'][$formKeyValue]['fn_arg']['value'] =$this->body_Data['patient'][0]->{$formKeyValue};
			}
		}
		
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
			$newData = array();
			foreach ($formKey as $formKeyKey => $formKeyValue) {
				$newData[$formKeyValue] =$this->input->post($formKeyValue);
				$this->body_Data['inputs'][$formKeyValue]['fn_arg']['value'] =$this->input->post($formKeyValue);
			}
			$this->Patient_model->update(array("id" => $id),$newData);
			$this->body_Data['message'] = "A patient has been updated.";
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
		$this->Patient_model->delete(array('id'=>$id));
		$this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->body_Data['patient'] = $this->Patient_model->get(array('id'=>$id));
		$this->load->view('header');
		$this->load->view('patient/about',$this->body_Data);
		$this->load->view('footer');
	}
}
