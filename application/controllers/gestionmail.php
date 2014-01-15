<?php
class Gestionmail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('accompagnement_model');
		$this->load->model('inscriptions_model');
		$this->load->model('matieres_model');
		$this->load->model('cycles_model');
		$this->load->helper(array('datefr'));
		
	
		
	}

	public function index()
	{
		return(true);
	}



		
	public function checkDateCycle(){
		$this->load->library('email');
		$date0=date("m/d/y");
		$cycles=$this->cycles_model->getAll();
		$date1 = new DateTime($date0);
		$listeEchec=array();
		$listeEnvoye=array();
		foreach ($cycles as $cycle){
			$liste=$this->inscriptions_model->getNonInscrits($cycle['id']);
			$date2 = new DateTime($cycle['debut']);
			$interval = date_diff($date1,$date2);
			$interval2 = intval($interval->format('%R%a'));
			if($interval2 < 10 and $interval2> 0){
		                //$liste=$this->inscriptions_model->getNonInscrits($cycle['id']);
				foreach ($liste as $eleve){
					//$this->load->library('email');
					$this->email->clear();
					$this->email->from('alice.no@laposte.net', 'Administrateur');
					$this->email->to($eleve['mail']);
					$this->email->subject('Email');
					$this->email->message("vous devez vous inscrire ".$eleve['nom']." au cycle ".$cycle['id']);	
					if(!$this->email->send()){
					array_push($listeEchec, $eleve['nom']);
						}else{ 
					array_push($listeEnvoye, $eleve['nom']);
					}
				}
			}
		}
		$resEchec=array_unique($listeEchec);
		$resEnvoye=array_unique($listeEnvoye);
		$this->email->clear();
		$this->email->from('alice.no@laposte.net', 'Administrateur');
		$this->email->to('alice.nowicki@etu.univ-lille3.fr');
		$this->email->subject('Email de rappel aux inscriptions');
		$this->email->message("echec de l envoie pour les eleves suivants : ".implode(",", $resEchec)."email de rappel envoyes aux eleves suivants : ".implode(",", $resEnvoye));
		$this->email->send();
	}
	



}
