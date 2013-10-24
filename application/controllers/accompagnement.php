<?php
class Accompagnement extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ( !isset($this->session->userdata['profil']) ) redirect('user/login');
		if ( $this->session->userdata['profil'] > 3 ) {
			$this->load->model('accompagnement_model');
			return(true);
		}  
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		return(true);
	}

	public function creer($cycle_id,$matiere_id,$salle) {
		$this->session->accompagnement_model->creer($cycle_id,$matiere_id,$salle)
		$this->session->set_flashdata('messages', "<p>Accompagnement créé.</p>" );
		redirect('admin/');
	}



}
