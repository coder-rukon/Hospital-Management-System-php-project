<?php
/**
* 
*/
class User_model extends Hospital_model
{
	private $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'user';
		parent::set_table($this->table);
	}
	public function add($data){
		$insertedUser = parent::New_Data($data);
		$this->setLoginTime($insertedUser);
		return $insertedUser;
	}
	public function Get($data = array(),$offset = 0){
		return parent::Get_Data($data);
	}
	public function Update($options=array(),$data = array()){
		return parent::Update_Data($options,$data);
	}
	public function setLoginTime($id){
		parent::Update_Data(array('id' => $id),array('last_login'=>date("Y-m-d h:i:s")));
	}
	public function Delete($options=array()){
		return parent::Delete_Data($options);
	}
	public function is_exist($options=array()){
		return parent::exist($options);
	}
}