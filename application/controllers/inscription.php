<?php
class Inscription extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ( !isset($this->session->userdata['profil']) ) redirect('user/login');
		if ( $this->session->userdata['profil'] > 0 ) {
			$this->load->model('accompagnement_model');
			$this->load->model('inscriptions_model');
			$this->load->model('matieres_model');
			$this->load->model('cycles_model');
			//$this->load->helper(array('form'));
			return(true);
		}  
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		return(true);
	}

	public function getNbPlacesRestantes($cycle_id,$matiere_id) {
		$nb_dispo = $this->matieres_model->getPlaces($matiere_id);
		$nb_inscrits = $this->accompagnement_model->getNbInscrits($cycle_id,$matiere_id);
		$json=array('places'=>$nb_dispo, 'nb_inscrits'=>$nb_inscrits );
		$data['json']=$json;
		$this->load->view('templates/json', $data);
	}



}
