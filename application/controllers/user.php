<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('users_model');
	}

	public function index()
	{
		redirect('user/login');
	}

	public function login()
	{
		$data['title'] = "SGAP login";	
		$this->load->view('templates/header', $data);
		$this->load->view('user/login', $data);
		$this->load->view('templates/footer', $data);
	}
}