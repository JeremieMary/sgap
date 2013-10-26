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
			$this->load->helper(array('datefr'));
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
		//Il est possible d'optimiser facilement cette partie en sacrifiant un peu de lisibilité : il ne devrait y avoir qu'une seule requête au modèle des accompagnements.
		if ($this->accompagnement_model->isActif($cycle_id,$matiere_id)){
			$dates = $this->cycles_model->getDates($cycle_id);
			foreach ($dates as &$date) $date=datefr($date);
			$nb_dispo=$this->matieres_model->getPlaces($matiere_id);
			$nb_inscrits=$this->accompagnement_model->getNbInscrits($cycle_id,$matiere_id);
			$salle=$this->accompagnement_model->getSalle($cycle_id,$matiere_id);
			$json=array('places'=>$nb_dispo, 'nb_inscrits'=>$nb_inscrits,'salle'=>$salle, 'dates'=>$dates );
		} else {
			$json = array('places'=>'Couple cycle/matière non disponible.', 'nb_inscrits'=>'.','salle'=>'.', 'dates'=>array('.') );
		}
		$data['json']=$json;
		$this->load->view('templates/json', $data);
	}



}
