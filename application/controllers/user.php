<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('url'); //Autoloaded
		//$this->load->model('users_model');
	}

	public function index()
	{
		redirect('user/login');
	}

	public function login()
	{
		$this->load->helper(array('form'));
		$data['title'] = "SGAP login";	
		$this->load->view('templates/header', $data);
		$this->load->view('user/login', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function checkLogin(){
		
		redirect('user/login');
	}
	
}