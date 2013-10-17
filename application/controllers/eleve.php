<?php
class Eleve extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ( $this->session->userdata['profil'] > 0 ) {
			return(true);
		}  
		
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		$data['title']='Eleve';
		$this->load->view('templates/header', $data);
		$this->load->view('eleve/index', $data);
		$this->load->view('templates/footer');
	}




}
