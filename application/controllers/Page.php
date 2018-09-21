<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		$this->body_Data = array();
	}
	public function index()
	{
		$this->Doctors();
	}
	public function Doctors()
	{
		$this->load->model("Doctor_model");
		$this->body_Data['doctors'] = $this->Doctor_model->Get();
		$this->load->view('header_front');
		$this->load->view('page/doctors',$this->body_Data);
		$this->load->view('footer_front');
	}
	public function Invoice()
	{
		$this->load->model("Doctor_model");
		$this->body_Data['doctors'] = $this->Doctor_model->Get();
		$this->load->view('header_front');
		$this->load->view('page/doctors',$this->body_Data);
		$this->load->view('footer_front');
	}
	public function Profile()
	{
		$user = $this->session->userdata("login_user");
		$this->load->model("Patient_model");
		$patientData = array();
		$this->body_Data['patient'] = $this->Patient_model->Get(array("id" => $user["id"]));
		$patientData["name"]  = $this->body_Data['patient'][0]->name;
		$patientData["phone"]  = $this->body_Data['patient'][0]->phone;
		$patientData["email"]  = $this->body_Data['patient'][0]->email;
		$patientData["sex"]  = $this->body_Data['patient'][0]->sex;
		$patientData["blood_group"]  =$this->body_Data['patient'][0]->blood_group;
		$patientData["birth_date"]  = $this->body_Data['patient'][0]->birth_date;
		$patientData["age"]  = $this->body_Data['patient'][0]->age;
		$patientData["county"]  = $this->body_Data['patient'][0]->county;
		$patientData["city"]  = $this->body_Data['patient'][0]->city;
		$patientData["address"]  = $this->body_Data['patient'][0]->address;
		$patientData["about"]  = $this->body_Data['patient'][0]->about;
		$patientData["guardian_name"]  = $this->body_Data['patient'][0]->guardian_name;
		$patientData["guardian_details"]  = $this->body_Data['patient'][0]->guardian_details;
		$patientData["bad_no"]  = $this->body_Data['patient'][0]->bad_no;
		$patientData["reg_date"]  = $this->body_Data['patient'][0]->reg_date;
		$patientData["descriptions"]  = $this->body_Data['patient'][0]->descriptions;

		$this->load->library("form_validation");
		$validation = array();
		$validation[] = array(
						"label" => "Name",
						"field" => "name",
						"rules" => "required"
					);
		$validation[] = array(
						"label" => "Phone",
						"field" => "phone",
						"rules" => "required"
					);
		$this->form_validation->set_rules($validation);

		if($this->form_validation->run()){
			$this->load->model(array("User_model"));
			$userTableData = array();
			$userTableData['full_name'] =$this->input->post("full_name");
			$userTableData['email'] = $this->input->post("email");



			$patientData["name"]  = $this->input->post("name");
			$patientData["phone"]  = $this->input->post("phone");
			$patientData["email"]  = $this->input->post("email");
			$patientData["sex"]  = $this->input->post("sex");
			$patientData["blood_group"]  = $this->input->post("blood_group");
			$patientData["birth_date"]  = $this->input->post("birth_date");
			$patientData["age"]  = $this->input->post("age");
			$patientData["county"]  = $this->input->post("county");
			$patientData["city"]  = $this->input->post("city");
			$patientData["address"]  = $this->input->post("address");
			$patientData["about"]  = $this->input->post("about");
			$patientData["guardian_name"]  = $this->input->post("guardian_name");
			$patientData["guardian_details"]  = $this->input->post("guardian_details");
			$patientData["bad_no"]  = $this->input->post("bad_no");
			$patientData["reg_date"]  = $this->input->post("reg_date");
			$patientData["descriptions"]  = $this->input->post("descriptions");
			$this->Patient_model->Update(array("id" => $user["id"]) ,$patientData );

			$this->body_Data["message"] = "Profile Updated.";
			$this->body_Data["type"] = "success";

		}

		$this->FormPatientProfileEdit($patientData);
		$this->load->view('header_front');
		$this->load->view("forms",$this->body_Data);
		$this->load->view('footer_front');
	}
	public function Appoinments()
	{
		$this->load->model(array("Doctor_model","Hospital_model"));
		$this->body_Data['doctors'] = $this->Doctor_model->Get();
		$userdata = $this->session->userdata("login_user");
		$this->Hospital_model->set_table('appoinment');
		$this->body_Data["appoinments"] = $this->Hospital_model->Get_Data(array("patient_id" => $userdata['id'] ));
		$this->load->view('header_front');
		$this->load->view('page/appoinments',$this->body_Data);
		$this->load->view('footer_front');
	}
	public function appoinmentsDelete($id)
	{
		$this->load->model(array("Doctor_model","Hospital_model"));
		$this->Hospital_model->set_table("appoinment");
		if($id){
			$this->Hospital_model->Delete_Data(array("id" => $id));
		}
		redirect(base_url().'page/appoinments');
	}
	public function TakeAppoinment($doctorId)
	{
		$this->load->model("Doctor_model");
		$this->load->model("Hospital_model");
		$this->load->library("form_validation");
		$this->body_Data['doctors'] = $this->Doctor_model->Get(array("id" => $doctorId));
		$this->body_Data['schedule'] = $this->Doctor_model->getSchedule(array("doctor_id" => $doctorId));
		$rules = array();
		$rules[] = array(
					"field" => 'date',
					"label" => 'Appoinment Date',
					"rules" => 'required|date',
				);
		$rules[] = array(
					"field" => 'schedule',
					"label" => 'Schedule',
					"rules" => 'required|integer',
				);
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run()){
			if(!is_login())
				redirect("login");
			$appinmentDate = $this->input->post("date");
			$appinmentDateAr = explode("/",$appinmentDate);

			$date=date_create("$appinmentDateAr[2]-$appinmentDateAr[1]-$appinmentDateAr[0]");
			$day = strtolower(date_format($date,"l"));
			$is_day_exist = false;
			$maximum_allow_appoinment = 0;
			foreach ($this->body_Data['schedule'] as $keySc => $valueSc) {
				if(strtolower($valueSc->day_of_week) == $day){
					$is_day_exist = true;
					$maximum_allow_appoinment = $valueSc->max_num_of_patients;
					break;
				}
			}
			if($is_day_exist){
				
				$user_data = $this->session->userdata('login_user');
				$scheduleId = $this->input->post("schedule");
				$details = $this->input->post("details");
				$resultData = $this->Doctor_model->AddAppoinment($doctorId,$user_data['id'],$appinmentDate,$scheduleId,$maximum_allow_appoinment,$details);
				$this->body_Data['type'] = ( !$resultData['result'] ? "error":'success' );
				$this->body_Data['message'] = $resultData['message'];
			}else{
				$this->body_Data['type'] = "error";
				$this->body_Data['message'] = "Doctor will not available at ".$appinmentDate;
			}


		}
		$this->load->view('header_front');
		$this->load->view('page/take_appoinment',$this->body_Data);
		$this->load->view('footer_front');
	}
	public function Register()
	{
		$this->body_Data['title'] = 'Register Patients';
		$this->body_Data['inputs'] = array();
		$this->load->library("form_validation");

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
									'label' => 'Email',
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => set_value('email')
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
									'label' => 'Password',
									'id' => 'password',
									'fn' => 'form_password',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'password',
											'id' => 'password',
											'value' => set_value('password')
										)
								);
		$validation = array();
		$validation[] = array(
						"label" => "Full Name",
						"field" => "full_name",
						"rules" => "required"
					);
		$validation[] = array(
						"label" => "Email",
						"field" => "email",
						"rules" => "trim|required|valid_email|is_unique[user.email]"
					);
		$validation[] = array(
						"label" => "User Name",
						"field" => "user_name",
						"rules" => "trim|required|is_unique[user.user_name]"
					);
		$validation[] = array(
						"label" => "Password",
						"field" => "password",
						"rules" => "required|trim"
					);
		$this->form_validation->set_rules($validation);

		if($this->form_validation->run()){
			$this->load->model(array("User_model","Patient_model"));
			$newData = array();
			$newData['user_name'] = $this->input->post("user_name");
			$newData['password'] = md5($this->input->post("password"));
			$newData['full_name'] =$this->input->post("full_name");
			$newData['email'] = $this->input->post("email");
			$newData['role'] = "patient";
			$newData['last_login'] = date("Y-m-d H:i:s");

			$userID = $this->User_model->add($newData);

			$patientId = $this->Patient_model->add(array("name" =>$newData['full_name'],"email" => $newData['email'] ));
			$this->User_model->Update(array("id" => $userID),array("profile_id" => $patientId));
			$this->body_Data["message"] = "Registration Success. Please login.";
			$this->body_Data["type"] = "success";

		}

		$this->load->view('header_front');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer_front');
	}
	private function FormPatientProfileEdit($value='')
	{
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['phone'] 	=	array(
									'label' => 'Phone',
									'id' => 'phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'phone',
											'id' => 'phone',
											'value' => (isset($value['phone'])? $value['phone'] : "")
										)
								);
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => 'Patient Name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'value' => (isset($value['name'])? $value['name'] : "")
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
											'options' => $this->config->item('blood_group'),
											'selected' => (isset($value['blood_group'])? $value['blood_group'] : "")
										)
								);
		$this->body_Data['inputs']['birth_date'] 	=	array(
									'label' => 'Date of Birth',
									'id' => 'birth_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'birth_date',
											'id' => 'birth_date',
											'value' => (isset($value['birth_date'])? $value['birth_date'] : "")
										)
								);
		$this->body_Data['inputs']['age'] 	=	array(
									'label' => 'Patient Age',
									'id' => 'age',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'age',
											'id' => 'age',
											'value' => (isset($value['age'])? $value['age'] : "")
										)
								);	
		$this->body_Data['inputs']['sex'] 	=	array(
									'label' => 'Gender',
									'id' => 'sex',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'id' => 'sex',
											'name' => 'sex',
											'options' => array('Male','Female'),
											'selected' => (isset($value['sex'])? $value['sex'] : "")
										)
								);
		$this->body_Data['inputs']['email'] 	=	array(
									'label' => 'Email',
									'id' => 'email',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'email',
											'id' => 'email',
											'value' => (isset($value['email'])? $value['email'] : "")
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
											'selected' => (isset($value['county'])? $value['county'] : "")
										)
								);
		$this->body_Data['inputs']['city'] 	=	array(
									'label' => 'Distric / State',
									'id' => 'city',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'city',
											'id' => 'city',
											'value' => (isset($value['city'])? $value['city'] : "")
										)
								);
		$this->body_Data['inputs']['address'] 	=	array(
									'label' => 'Address',
									'id' => 'address',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'address',
											'id' => 'address',
											'value' => (isset($value['address'])? $value['address'] : "")
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
											'value' => (isset($value['about'])? $value['about'] : "")
										)
								);
		$this->body_Data['inputs']['guardian_name'] 	=	array(
									'label' => 'Guardian name',
									'id' => 'guardian_name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_name',
											'id' => 'guardian_name',
											'value' => (isset($value['guardian_name'])? $value['guardian_name'] : "")
										)
								);
		$this->body_Data['inputs']['guardian_phone'] 	=	array(
									'label' => 'Guardian Phone',
									'id' => 'guardian_phone',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'guardian_phone',
											'id' => 'guardian_phone',
											'value' => (isset($value['guardian_phone'])? $value['guardian_phone'] : "")
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
											'value' => (isset($value['guardian_details'])? $value['guardian_details'] : "")
										)
								);
		$this->body_Data['inputs']['bad_no'] 	=	array(
									'label' => 'Bad No/Word No',
									'id' => 'bad_no',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'bad_no',
											'id' => 'bad_no',
											'value' => (isset($value['bad_no'])? $value['bad_no'] : "")
										)
								);
		$this->body_Data['inputs']['reg_date'] 	=	array(
									'label' => 'Admitted Date',
									'id' => 'reg_date',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'reg_date',
											'id' => 'reg_date',
											'value' => (isset($value['reg_date'])? $value['reg_date'] : "")
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
											'value' => (isset($value['descriptions'])? $value['descriptions'] : "")
										)
								);
		return $this->body_Data['inputs'];
	}
}
