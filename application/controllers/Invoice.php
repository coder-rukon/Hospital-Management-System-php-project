<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
	private $body_Data;
	function __construct()
	{
		parent::__construct();
		if(!is_login()){
			redirect(base_url('login'));
		}
		$this->body_Data = array();
		$this->body_Data['title'] = 'Invoice';
		$this->load->model(array("Invoice_model","Hospital_model"));
		
	}
	public function index()
	{
		only_access(array("doctor","admin"));
		$this->body_Data['title'] = "All Invoice";
		$this->body_Data['all_invoice'] = $this->Invoice_model->Get();
		$this->load->view('header');
		$this->load->view('invoice/invoice_list',$this->body_Data);
		$this->load->view('footer');
	}
	public function add(){
		only_access(array("doctor","admin"));
		$this->body_Data['title'] = 'New Invoice';
		$this->Hospital_model->set_table("user");
		$this->body_Data['patients'] = $this->Hospital_model->Get_Data(array("role" => "patient"));
		/*
			Form Validations
		*/
		$this->load->library(array('form_validation'));
		$validations = array();
		$validations[] = array(
					'field' => 'title',
					'label' => 'Invoice Title',
					'rules' => 'required',
				);
		$validations[] = array(
					'field' => 'patient',
					'label' => 'Patient',
					'rules' => 'required',
				);

		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$data = array();
			$invoiceItemNames = $this->input->post("items_name");
			$invoiceItemPrice = $this->input->post("items_price");
			$total = 0;
			$itemsData = array();
			if(isset($invoiceItemNames) && is_array($invoiceItemNames)){
				foreach ($invoiceItemNames as $key => $valueItems) {
					if(!empty($valueItems)){
						$total += $invoiceItemPrice[$key];
						$itemsData[] = array(
							'label' => $valueItems,
							'price' => $invoiceItemPrice[$key],
						);
					}
				}
			}
			$login_user = $this->session->userdata('login_user');
			$data['data'] = json_encode($itemsData);
			$data['title'] = $this->input->post("title");
			$data['total'] = $total;
			$data['created_by'] = $login_user['id'];
			$data['patient'] = $this->input->post("patient");
			$data['date'] = date("m/d/Y");
			$this->Invoice_model->add($data);
			$this->body_Data['message'] = "New Invoice Created";
		}
		$this->load->view('header');
		$this->load->view('invoice/form',$this->body_Data);
		$this->load->view('footer');
	}

	public function update($id = null){

	}
	public function print($id = null){
		$this->body_Data['invoice'] = $this->Invoice_model->Get_Data(array("id" => $id));
		$this->load->view('invoice/print',$this->body_Data);
	}
	/*
		Delete a department
	*/
	public function delete($id = null){
		only_access(array("doctor","admin"));
		if(is_null($id))
			return;
		$this->Invoice_model->delete(array('id'=> $id));
		$this->index();
	}
	
}
