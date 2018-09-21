<?php
/**
* 
*/
class Department_model extends Hospital_model
{
	private $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'department';
		parent::set_table($this->table);
	}
	public function add($data){
		return parent::New_Data($data);
	}
	public function Get($data = array()){
		return parent::Get_Data($data);
	}
	public function Update($options=array(),$data = array()){
		return parent::Update_Data($options,$data);
	}
	public function Delete($options=array()){
		return parent::Delete_Data($options);
	}
}