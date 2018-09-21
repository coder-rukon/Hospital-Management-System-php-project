<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nurse extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		only_access(array("doctor","admin","nurse"));
		$this->body_Data = array();
		$this->body_Data['title'] = 'Nurse';
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
									'label' => 'Name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'value' => set_value('name')
										)
								);
		$this->body_Data['inputs']['email'] 	=	array(
									'label' => 'Email Address',
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => set_value('email')
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
									'label' => 'About Details',
									'id' => 'about',
									'fn' => 'form_textarea',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'about',
											'id' => 'about',
											'value' => set_value('about')
										)
								);
		$this->body_Data['inputs']['picture'] 	=	array(
									'label' => 'Photo',
									'id' => 'picture',
									'media' => true,
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'picture',
											'id' => 'picture',
											'value' => set_value('picture')
										)
								);
		$this->body_Data['inputs']['user_name'] 	=	array(
									'label' => 'User Name',
									'id' => 'user_name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'user_name',
											'id' => 'user_name',
											'value' => set_value('user_name')
										)
								);
		$this->body_Data['inputs']['password'] 	=	array(
									'label' => 'User password',
									'id' => 'password',
									'fn' => 'form_password',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'password',
											'id' => 'password',
											'value' => set_value('password')
										)
								);
		$this->body_Data['inputs']['password_confirm'] 	=	array(
									'label' => 'Confirm password',
									'id' => 'password_confirm',
									'fn' => 'form_password',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'password_confirm',
											'id' => 'password_confirm',
											'value' => set_value('password_confirm')
										)
								);
		$this->load->model(array('Nurse_model'));
	}
	public function index()
	{
		$this->page();
	}
	public function page($page= 1)
	{
		$this->body_Data['title'] = "All Nurse";
		$this->body_Data['all_nurse'] = $this->Nurse_model->get();
		$this->load->view('header');
		$this->load->view('nurse/all_nurse',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		$this->body_Data['title'] = 'Add New Nurse';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Nurse Name',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'phone',
					'label' => 'Nurse Phone',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'user_name',
					'label' => 'User Name',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'picture',
					'label' => 'Picture',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newDataField = array('name','phone','email','address','picture','about');
			$newData = array();
			foreach ($newDataField as $key => $value) {
				$newData[$value] = $this->input->post($value);
			}
			$this->Nurse_model->add($newData);
			$this->body_Data['message'] = "A Nurse has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update Nurse';
		unset($this->body_Data['inputs']['user_name']);
		unset($this->body_Data['inputs']['password_confirm']);
		unset($this->body_Data['inputs']['password']);
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Nurse Name',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);

		if($this->form_validation->run()){
			$newData = array();
			$newData["phone"] = $this->input->post("phone");
			$newData["name"] = $this->input->post("name");
			$newData["email"] = $this->input->post("email");
			$newData["address"] = $this->input->post("address");
			$newData["about"] = $this->input->post("about");
			$newData["picture"] = $this->input->post("picture");
			$this->Nurse_model->update(array("id" => $id), $newData);

			$this->body_Data['message'] = "A Nurse has been updated.";
		}
		$this->body_Data["nurse"] = $this->Nurse_model->get(array("id" => $id));
		if($this->body_Data["nurse"]){
			$tempNurse = $this->body_Data["nurse"][0];
			$this->body_Data['inputs']['phone']['fn_arg']['value'] =$tempNurse->phone; 
			$this->body_Data['inputs']['name']['fn_arg']['value'] =$tempNurse->name; 
			$this->body_Data['inputs']['email']['fn_arg']['value'] =$tempNurse->email; 
			$this->body_Data['inputs']['address']['fn_arg']['value'] =$tempNurse->address; 
			$this->body_Data['inputs']['about']['fn_arg']['value'] =$tempNurse->about; 
			$this->body_Data['inputs']['picture']['fn_arg']['value'] =$tempNurse->picture; 
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
		$this->Nurse_model->delete(array('id'=>$id));
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
		$this->load->view('nurse/about',$this->body_Data);
		$this->load->view('footer');
	}
}
