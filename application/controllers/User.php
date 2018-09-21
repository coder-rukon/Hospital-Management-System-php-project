<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		$this->body_Data = array();
		$this->body_Data['title'] = 'Nurse';
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['full_name'] 	=	array(
									'label' => 'Full Name',
									'id' => 'full_name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'full_name',
											'id' => 'full_name',
											'value' => set_value('full_name')
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
		$this->body_Data['inputs']['role'] 	=	array(
									'label' => 'User Role',
									'id' => 'role',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'role',
											'options' => $this->config->item('roles'),
											'id' => 'role',
											'value' => set_value('role')
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
		$this->load->model(array('User_model'));
	}
	public function index()
	{
		$this->page();
	}
	public function page($page= 1)
	{
		$this->body_Data['title'] = "All Users";
		$this->body_Data['all_user'] = $this->User_model->get();
		$this->load->view('header');
		$this->load->view('user/all_user',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		$this->body_Data['title'] = 'Add New User';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'full_name',
					'label' => 'User Full Name',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'email',
					'label' => 'Email address',
					'rules' => 'required|valid_email|callback_email_check',
				);
		$validations[] = array(
					'field' => 'user_name',
					'label' => 'User Name',
					'rules' => 'required|callback_user_name_check',
				);
		$validations[] = array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'password_confirm',
					'label' => 'Confirm Password',
					'rules' => 'required|matches[password]',
				);
		$validations[] = array(
					'field' => 'role',
					'label' => 'User Role',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'picture',
					'label' => 'Picture',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		$this->form_validation->set_error_delimiters('<p class="text-red">','</p>');
		if($this->form_validation->run()){
			$newDataField = array('full_name','user_name','email','role','password','picture');
			$newData = array();
			foreach ($newDataField as $key => $value) {
				$newData[$value] = $this->input->post($value);
			}
			$newData['password'] = md5($this->input->post('password'));
			$this->User_model->add($newData);
			$this->body_Data['message'] = "A User has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update User';
		unset($this->body_Data['inputs']['user_name']);
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'full_name',
					'label' => 'User Full Name',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'email',
					'label' => 'Email address',
					'rules' => 'required|valid_email',
				);
		$validations[] = array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'password_confirm',
					'label' => 'Confirm Password',
					'rules' => 'required|matches[password]',
				);
		$validations[] = array(
					'field' => 'role',
					'label' => 'User Role',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'picture',
					'label' => 'Picture',
					'rules' => 'required',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			$newData["full_name"] = $this->input->post("full_name");
			$newData["email"] = $this->input->post("email");
			$newData["password"] = md5($this->input->post("password"));
			$newData["role"] = $this->input->post("role");
			$newData["picture"] = $this->input->post("picture");
			$this->User_model->update(array("id" => $id), $newData);

			$this->body_Data['message'] = "A User has been updated.";
		}

		$userCurrent = $this->User_model->get(array("id" => $id));
		$this->body_Data['inputs']['full_name']['fn_arg']['value'] = $userCurrent[0]->full_name; 
		$this->body_Data['inputs']['email']['fn_arg']['value'] = $userCurrent[0]->email; 
		$this->body_Data['inputs']['role']['fn_arg']['value'] = $userCurrent[0]->role; 
		$this->body_Data['inputs']['picture']['fn_arg']['value'] = $userCurrent[0]->picture; 

		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	public function logout(){
		$userData = array('is_login','login_user');
		$this->session->unset_userdata($userData);
		$this->session->sess_destroy();
		redirect('login');
	}
	/*
		Delete a user
	*/
	public function delete($id = null){
		if(is_null($id))
			return;
		$this->User_model->delete(array('id'=>$id));
		$this->index();
	}
	public function user_name_check($str){
		return $this->check_field_exist('user_name',$str,'User Name Exist.');
	}
	public function email_check($str){
		return $this->check_field_exist('email',$str,'Email Name Exist');
	}
	private function check_field_exist($field,$str,$message){
		$esixt = $this->User_model->is_exist(array($field=>$str));
		if ($esixt){
			$this->form_validation->set_message($field.'_check', $message);
			return FALSE;
		}
		else{
		return TRUE;
		}
	}
}
