<?php
class Gestionmail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('gestionmail_model');
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
		$jetonrappel=$this->gestionmail_model->getrappel();
		if ($jetonrappel) {
			$this->load->library('email');
			$listeEchec=array();
			$listeEnvoye=array();
			$listeCycle=$this->cycles_model->cycleSoon();
			foreach ($listeCycle as $cycle) {
				$listeNonInscrits=$this->inscriptions_model->getNonInscrits($cycle);
				foreach ($listeNonInscrits as $eleve){
					$this->email->clear();
					$this->email->from('alice.no@laposte.net', 'Administrateur');
					$this->email->to($eleve['mail']);
					$this->email->subject('Email');
					$this->email->message("vous devez vous inscrire ".$eleve['nom']." au cycle ".$cycle);	
					if(!$this->email->send()){
					array_push($listeEchec, $eleve['nom']);
						}else{ 
					array_push($listeEnvoye, $eleve['nom']);
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
			echo "email envoye";
		}else{
			echo "email de rappel deja envoye";
		}
	}



}
