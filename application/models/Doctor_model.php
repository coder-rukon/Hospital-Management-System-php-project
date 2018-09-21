<?php
/**
* 
*/
class Doctor_model extends Hospital_model
{
	private $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'doctor';
		parent::set_table($this->table);
	}
	public function add($data){
		return parent::New_Data($data);
	}
	public function Get($data = array()){
		/*if(isset($_GET['s']) && !empty($_GET['s'])){
			$data['name'] = $this->input->get("s");
		}*/
		if(isset($_GET['department']) && !empty($_GET['department'])){
			$data['department'] = $this->input->get("department");
		}
		return parent::Get_Data($data);
	}
	public function Update($options=array(),$data = array()){
		return parent::Update_Data($options,$data);
	}
	public function Delete($options=array()){
		return parent::Delete_Data($options);
	}

	public function AddAppoinment($doctorId,$patientId,$date,$scheduleId,$max_patients_allow,$details = "")
	{
		$result = array();
		$errorFound = false;
		$message = "";
		
		$newData = array();
		$newData['doctor_id'] = $doctorId;
		$newData['details'] = $details;
		$newData['patient_id'] = $patientId;
		$newData['date'] = $date;
		$isExistAppinment = parent::exist($newData,"appoinment");
		$currentDateAppoinments = $this->db->query("select MAX(serial_no) as serial_no, count(id) as total from appoinment where date='".$date."' AND doctor_id = '".$doctorId."'");
		$currentDateAppoinmentsResult = $currentDateAppoinments->result();
		if($isExistAppinment){
			$errorFound = true;
			$message = "We have founded an appoinment at $date for you.";
		}else if($currentDateAppoinmentsResult){
			if($currentDateAppoinmentsResult[0]->total >= $max_patients_allow){
				$errorFound = true;
				$message = "Appoinment is not available at $date. Plese try another date.";
			}else{
				$newData['serial_no'] = $currentDateAppoinmentsResult[0]->serial_no + 1;
			}
		}else{
			$newData['serial_no'] = 1;
		}
		// Check if Current Appoinment Exist;
		
		if(!$errorFound){
			$newData['schedule_id'] = $scheduleId;
			$newData['created_date'] = date("d/m/y");
			$newData['status'] = "pending";
			$this->db->insert("appoinment",$newData);
			$message = "Congratulation! Your appoinment has been placed at $date. <br>Your Serial Number: ".$newData['serial_no'];
		}
		$result["result"] = ($errorFound ? false:true);
		$result["message"] =$message;
		return $result;
	}


	public function addSchedule($data = array())
	{
		$this->db->insert("doctors_schedule",$data);
	}
	public function getSchedule($dataArg = array())
	{
		if(!empty($dataArg)){
			foreach ($dataArg as $key => $value) {
				$this->db->where($key,$value);
			}
		}
		$qurey = $this->db->get("doctors_schedule");
		return $qurey->result();

	}
	public function deleteSchedule($doctorId,$scheduleId)
	{
		$this->db->where("id",$scheduleId);
		$this->db->where("doctor_id",$doctorId);
		$this->db->delete("doctors_schedule");
	}
}