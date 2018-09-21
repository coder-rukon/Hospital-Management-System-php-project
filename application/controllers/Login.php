<?php
/**
* 
*/
class Login extends CI_Controller
{
	private $headerData;
	function __construct()
	{
		parent::__construct();
		$this->headerData = array();
		$this->headerData['sidebar'] = false;
		$this->headerData['body_class'] = 'login';
	}
	public function index(){
		$this->load->library(array('form_validation'));
		$validations = array(
				array(
					'field' => 'u_name',
					'label'	=> 'User Name',
					'rules'	=> 'required'
				),
				array(
					'field' => 'u_pass',
					'label'	=> 'User Password',
					'rules'	=> 'required'
				)
			);
		$this->form_validation->set_rules($validations);
		if($this->form_validation->run()){
			$this->load->model('User_model');
			$findUser = $this->User_model->is_exist(array(
															'user_name'=> $this->input->post('u_name'),
															'password'=> md5($this->input->post('u_pass')),
														));
			if($findUser){
				$login_userObj = $this->User_model->get(array(
															'user_name'=> $this->input->post('u_name'),
															'password'=> md5($this->input->post('u_pass')),
														))[0];
				$login_user = array();
				foreach ($login_userObj as $key => $value) {
					if($key != 'password')
					$login_user[$key] = $value;
				}
				$this->session->set_userdata('login_user',$login_user);
				$this->session->set_userdata('is_login',true);
				//redirect('welcome');
				if($login_user['role'] =="patient"){
					redirect('page/doctors');
				}else{
					redirect('department');
				}
			}else{
				$this->headerData['message'] = "User name Or Password Not Matches.";
			}
		}
		$this->load->view('header',$this->headerData);
		$this->load->view('login');
		$this->load->view('footer');
	}
}