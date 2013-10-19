<?php
class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->helper(array('form'));
	}

	public function index()
	{
		redirect('user/login');
	}

	public function login()
	{		
		$data['title'] = "SGAP login";	
		
		$data['messages'] = $this->session->flashdata('messages');
		$this->load->view('templates/header', $data);
		$this->load->view('user/login');
		$this->load->view('templates/footer');
	}
	
	public function checkLogin(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login', 'login', 'trim|required|xss_clean');
		$this->form_validation->set_rules('passwd', 'passwd','trim|required|xss_clean'); //XSS clean a supprimer quand les passwd seront stockés cryptés
		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('messages', validation_errors());
			redirect('user/login');
		}
		$login = $this->input->post('login');
		$passwd = $this->input->post('passwd');
		if ($this->users_model->login($login,$passwd) ) {
			$user = $this->users_model->getUser($login);
			$this->session->set_userdata($user);
			switch ($user['profil']) {
				case 1:
				redirect('eleve/');
				break;
				case 2:
				case 3:
				redirect('enseignant/');
				break;
				case 4:
				redirect('admin/');
				break;	
				default:
				echo "User sans status. La BD aurait du refuser cette insertion. Contactez un administateur avec une copie de ce message. ";
				print_r($user);
			}	
		} else {
			$this->session->set_flashdata('messages', '<p>Couple login/password incorrect</p>' );
			redirect('user/login');
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('user/login');
	}
	
	
	
}