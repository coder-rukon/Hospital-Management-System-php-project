<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		only_access(array("doctor","admin"));
		$this->body_Data = array();
		$this->body_Data['title'] = 'Doctors';
		$this->load->model(array('Department_model','Doctor_model'));
		$allDepartments = $this->Department_model->get();
		$departmentArrray = array();
		foreach ($allDepartments as $key => $value) {
			$departmentArrray[$value->id] = $value->name;
		}
		$countries = get_country();
		/*
			Form
		*/
		$this->body_Data['inputs'] = array();
		$this->body_Data['inputs']['name'] 	=	array(
									'label' => 'Doctor Name',
									'id' => 'name',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'name',
											'id' => 'name',
											'value' => set_value('name')
										)
								);
		$this->body_Data['inputs']['nic'] 	=	array(
									'label' => 'National ID Card Number',
									'id' => 'nic',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'nic',
											'id' => 'nic',
											'value' => set_value('nic')
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
											'options' => $departmentArrray,
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
		$this->body_Data['inputs']['country'] 	=	array(
									'label' => 'Country',
									'id' => 'country',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control rs_country',
											'name' => 'country',
											'id' => 'country',
											'options' => $countries,
											'value' => set_value('country')
										)
								);
		$this->body_Data['inputs']['state'] 	=	array(
									'label' => 'Distric / State',
									'id' => 'state',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'state',
											'id' => 'state',
											'value' => set_value('state')
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
									'label' => 'About Doctor',
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
									'label' => 'Picture',
									'id' => 'picture',
									'media' => true,
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'picture',
											'id' => 'picture',
											'value' => set_value('picture')
										)
								);
	}
	public function index()
	{
		$this->page();
	}
	
	public function page($page = 1)
	{
		$this->body_Data['title'] = "All Doctors";
		$this->body_Data['all_doctors'] = $this->Doctor_model->get();
		$this->load->view('header');
		$this->load->view('doctors/all_doctors',$this->body_Data);
		$this->load->view('footer');
	}

	public function add(){
		$this->body_Data['title'] = 'Add New Doctor';
		
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
		$validations[] = array(
					'field' => 'nic',
					'label' => 'National ID Card',
					'rules' => 'required|callback__doctor_check',
				);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			foreach ($this->input->post() as $key => $value) {
				$newData[$key] = $value;
			}
			$this->Doctor_model->add($newData);
			$this->body_Data['message'] = "A doctor has been added.";
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){
		if(is_null($id))
			return;
		$this->body_Data['title'] = 'Update Doctor';
		
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$this->load->model("Doctor_model");
		$validations = array();
		$validations[] = array(
					'field' => 'name',
					'label' => 'Department Name',
					'rules' => 'required',
				);
		$doctor = $this->Doctor_model->Get(array("id" => $id));

		if(isset($doctor[0]->id)){
			$this->body_Data['inputs']['name']['fn_arg']['value'] 	= $doctor[0]->name;
			$this->body_Data['inputs']['nic']['fn_arg']['value'] 	= $doctor[0]->nic;
			$this->body_Data['inputs']['department']['fn_arg']['value'] 	= $doctor[0]->department;
			$this->body_Data['inputs']['blood_group']['fn_arg']['value'] 	= $doctor[0]->blood_group;
			$this->body_Data['inputs']['birth_date']['fn_arg']['value'] 	= $doctor[0]->birth_date;
			$this->body_Data['inputs']['sex']['fn_arg']['value'] 	= $doctor[0]->sex;
			$this->body_Data['inputs']['email']['fn_arg']['value'] 	= $doctor[0]->email;
			$this->body_Data['inputs']['phone']['fn_arg']['value'] 	= $doctor[0]->phone;
			$this->body_Data['inputs']['country']['fn_arg']['value'] 	= $doctor[0]->country;
			$this->body_Data['inputs']['state']['fn_arg']['value'] 	= $doctor[0]->state;
			$this->body_Data['inputs']['address']['fn_arg']['value'] 	= $doctor[0]->address;
			$this->body_Data['inputs']['about']['fn_arg']['value'] 	= $doctor[0]->about;
			$this->body_Data['inputs']['picture']['fn_arg']['value'] 	= $doctor[0]->picture;
		}
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$newData = array();
			$dataNeed = array("name","nic","department","blood_group","birth_date","sex","email","phone","country","state","address","about","picture");
			foreach ($dataNeed as $dataNeedKey => $dataNeedValue) {
				$newData[$dataNeedValue] = $this->input->post($dataNeedValue);
				$this->body_Data['inputs'][$dataNeedValue]['fn_arg']['value'] = $this->input->post($dataNeedValue);
			}
			$this->Doctor_model->Update(array("id" => $id),$newData);
			$this->body_Data['message'] = "A doctor has been updated.";
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
		$this->Doctor_model->delete(array('id'=>$id));
		$this->index();
	}
	/*
		View all details about a department
	*/
	public function about($id = null){
		if(is_null($id))
			return;
		$this->body_Data['inputs'] = '';
		$this->body_Data['doctor'] = $this->Doctor_model->get(array('id'=>$id));
		$this->body_Data['allSchedule'] = $this->Doctor_model->getSchedule(array("doctor_id" => $id));
		$this->load->view('header');
		$this->load->view('doctors/about',$this->body_Data);
		$this->load->view('footer');
	}
	/*
		Delete a department
	*/
	public function createSchedule($id){
		$this->body_Data['title'] = 'Create new schedule';
		$this->body_Data['inputs']= array();
		$this->body_Data['inputs']['day_of_week'] 	=	array(
									'label' => 'Day of the week',
									'id' => 'day_of_week',
									'fn' => 'form_dropdown',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'day_of_week',
											'id' => 'day_of_week',
											'options' => get_days(),
											'value' => set_value('day_of_week')
										)
								);
		$this->body_Data['inputs']['start_time'] 	=	array(
									'label' => 'Start Visiting Time',
									'id' => 'start_time',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'start_time',
											'id' => 'start_time',
											'value' => set_value('start_time')
										)
								);
		$this->body_Data['inputs']['end_time'] 	=	array(
									'label' => 'End Visiting Time',
									'id' => 'end_time',
									'fn_arg' => array(
											'class' => 'form-control',
											'name' => 'end_time',
											'id' => 'end_time',
											'value' => set_value('end_time')
										)
								);
		$this->body_Data['inputs']['max_num_of_patients']=	array(
												'label' => 'Maximum Patients Will Visit',
												'id' => 'max_num_of_patients',
												'fn_arg' => array(
														'class' => 'form-control',
														'name' => 'max_num_of_patients',
														'id' => 'max_num_of_patients',
														'value' => set_value('max_num_of_patients')
													)
											);
		$this->body_Data['inputs']['fees']=	array(
												'label' => 'Visiting Fees',
												'id' => 'fees',
												'fn_arg' => array(
														'class' => 'form-control',
														'name' => 'fees',
														'id' => 'fees',
														'value' => set_value('fees')
													)
											);
		$this->body_Data['inputs']['comment']=	array(
												'label' => 'Comments',
												'id' => 'comment',
												'fn_arg' => array(
														'class' => 'form-control',
														'name' => 'comment',
														'id' => 'comment',
														'value' => set_value('comment')
													)
											);
		if($this->isValidForSchedule()){
			$newData = array();
			$newData['day_of_week'] = $this->input->post("day_of_week");
			$newData['start_time'] = $this->input->post("start_time");
			$newData['end_time'] = $this->input->post("end_time");
			$newData['max_num_of_patients'] = $this->input->post("max_num_of_patients");
			$newData['fees'] = $this->input->post("fees");
			$newData['comment'] = $this->input->post("comment");
			$newData['doctor_id'] = $id;
			$this->Doctor_model->addSchedule($newData);
			$this->body_Data['message'] = "Schedule Added";
			$this->body_Data['type'] = "success";
			redirect(base_url('doctors/about/'.$id));
		}
		$this->load->view('header');
		$this->load->view('forms',$this->body_Data);
		$this->load->view('footer');
	}
	private function isValidForSchedule()
	{
		$this->load->library(array('form_validation'));
		$validationsRules = array();
		$validationsRules[] = array(
						'field'	=> 'day_of_week',
						'label'	=> 'Day Of Week',
						'rules'	=> 'required'
					);
		$validationsRules[] = array(
						'field'	=> 'start_time',
						'label'	=> 'Visiting Time Start',
						'rules'	=> 'required'
					);
		$validationsRules[] = array(
						'field'	=> 'end_time',
						'label'	=> 'Visiting Time End',
						'rules'	=> 'required'
					);
		$validationsRules[] = array(
						'field'	=> 'max_num_of_patients',
						'label'	=> 'Maximum Patients',
						'rules'	=> 'required|integer'
					);
		$validationsRules[] = array(
						'field'	=> 'fees',
						'label'	=> 'Fees',
						'rules'	=> 'required'
					);
		$this->form_validation->set_rules($validationsRules);
		return $this->form_validation->run();
	}
	public function deleteSchedule($doctorId,$scheduleId)
	{
		$this->Doctor_model->deleteSchedule($doctorId,$scheduleId);
		redirect(base_url('doctors/about/'.$doctorId));
	}

	public function Appoinments($id,$patientId = null)
	{
		$this->load->model(array("Hospital_model"));
		$this->load->library("form_validation");
		$this->body_Data['inputs'] = '';
		$this->body_Data['doctorId'] = $id;
		$this->body_Data['patientId'] = $patientId;
		$this->body_Data['doctor'] = $this->Doctor_model->get(array('id'=>$id));

		$this->body_Data['allSchedule'] = $this->Doctor_model->getSchedule(array("doctor_id" => $id));

		$this->form_validation->set_rules("date","Date","required");
		if($this->form_validation->run()){
			$this->Hospital_model->set_table('appoinment');
			$date = $this->input->post("date");
			$this->body_Data["appoinments"] = $this->Hospital_model->Get_Data(array("doctor_id" => $id, "date" => $date),array("serial_no","asc"));
		}elseif($patientId != null){
			$this->Hospital_model->set_table('appoinment');
			$this->body_Data["appoinments"] = $this->Hospital_model->Get_Data(array("doctor_id" => $id, "patient_id" => $patientId),array("serial_no","asc"));
		}else{

		}

		$this->load->view('header');
		$this->load->view('doctors/appoinments',$this->body_Data);
		$this->load->view('footer');
	}
	public function Addprescription(){
		$this->load->model(array("Hospital_model","Doctor_model"));
		$this->load->library("form_validation");
		$this->load->view("doctors/form_prescription");
	}
	public function AddprescriptionSave(){
		if($this->input->post("apionment_id")){
			$data = array();
			$apionment_id = $this->input->post("apionment_id");
			$data["prescription"] =  $this->input->post("prescription");
			$this->Hospital_model->set_table('appoinment');	
			$this->Hospital_model->Update_Data(array('id' => $apionment_id),$data);	
		}
		
	}
	public function _doctor_check($data){
		if ($this->Doctor_model->exist(array('nic'=>$this->input->post('nic'))))
        {
                $this->form_validation->set_message('_doctor_check', 'Doctor Exist');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
	}
}
