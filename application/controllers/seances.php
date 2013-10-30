<?php
class Seances extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ( !isset($this->session->userdata['profil']) ) {
			$data['json']=array('logged'=>false);
			$this->load->view('templates/json', $data);
		};
		if ( $this->session->userdata['profil'] > 0 ) {
			$this->load->model('seances_model');
			return(true);
		}  
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		return(true);
	}

	public function getIdsAndDates($cycle_id, $matiere_id)
	{
		
		$ids=$this->seances_model->getIdsAndDates($cycle_id, $matiere_id);
		$json['seances_ids']=$ids;
		$json['logged']=true;
		$data['json']=$json;
		$this->load->view('templates/json', $data);
	}

	public function getPresences($seance_id)
	{
		if ( $this->session->userdata['profil'] == 1 ) {
			$data['json']=array('logged'=>false);
			$this->load->view('templates/json', $data);
		}  
		$presences=$this->seances_model->getPresences($seance_id);
		$json['presences']=$presences;
		$json['logged']=true;
		$data['json']=$json;
		$this->load->view('templates/json', $data);	
	}

}
