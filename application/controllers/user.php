<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('url'); //Autoloaded (see config/autoload.php)
		$this->load->model('users_model');
	}

	public function index()
	{
		redirect('user/login');
	}

	public function login()
	{
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login', 'login', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwd', 'passwd','trim|required|xss_clean|callback_check_database');
		$data['title'] = "SGAP login";	
		$this->load->view('templates/header', $data);
		$this->load->view('user/login', $data);
		$this->load->view('templates/footer', $data);
	}
	
	public function checkLogin(){
		$login = $this->input->post('login');
		$passwd = $this->input->post('passwd');
		if ($this->users_model->login($login,$passwd) ) {
			// Ajouter le switch case
			// Initialiser les variables de session
			redirect('eleve/index');
		} else {
			// Ajouter un flashmessage
			redirect('user/login');
		}
	}
	
}