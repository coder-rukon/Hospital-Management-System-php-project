<?php
/**
* 
*/
class Invoice_model extends Hospital_model
{
	private $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'invoice';
		parent::set_table($this->table);
	}
	public function add($data){
		return parent::New_Data($data);
	}
	public function Get($data = array()){
		if(isset($_GET["s"])){
			$data['id'] = $this->input->get("s");
		}
		return parent::Get_Data($data);
	}
	public function Update($options=array(),$data = array()){
		return parent::Update_Data($options,$data);
	}
	public function Delete($options=array()){
		return parent::Delete_Data($options);
	}
}