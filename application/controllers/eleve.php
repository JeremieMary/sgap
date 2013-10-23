<?php
class Eleve extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ( !isset($this->session->userdata['profil']) ) redirect('user/login');
		if ( $this->session->userdata['profil'] > 0 ) {
			$this->load->model('cycles_model');
			$this->load->model('matieres_model');
			$this->load->helper(array('form'));
			return(true);
		}  
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		$data['title']='Eleve';
		$data['messages'] = $this->session->flashdata('messages');
		$data['matieres'] = $this->matieres_model->getAll();
		$data['cycles']   = $this->cycles_model->getAll();
		$this->load->view('templates/header', $data);
		$this->load->view('eleve/index', $data);
		$this->load->view('templates/footer');
	}

	public function inscription() {
		if (count($_POST)==0) redirect('eleve/');
		// Faire une validation ? Il s'agit de listes déroulantes donc la faire dans le modele est suffisant pour le niveau applicatif, reste à blinder la sécurité.  
		$cycle_id = $this->input->post('cycle_id');
		$matiere_id = $this->input->post('matiere_id');
		$this->load->model('accompagnement_model');
		$accompagnement_id = $this->accompagnement_model->getId($cycle_id,$matiere_id);
		$this->load->model('inscriptions_model');
		$eleve_id = $this->session->userdata['id'];
		$ins = $this->inscriptions_model->inscrire($eleve_id,$accompagnement_id); 
		$this->session->set_flashdata('messages', $ins['message'] );
		redirect('eleve/');
	}



}
