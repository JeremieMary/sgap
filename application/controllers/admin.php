<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ( $this->session->userdata['profil'] > 3 ) {
			return(true);
		}  
		
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		$data['title']='Administration';
		$this->load->view('templates/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}


	function uploadUsersFile()
	{
	        $this->load->library('csvreader');
	        $result =   $this->csvreader->parse_file('UsersTest.csv');//path to csv file

	        $data['json'] =  $result;
	        $this->load->view('view_csv', $data); 
			$this->load->view('templates/json', $data); 
	}

}
