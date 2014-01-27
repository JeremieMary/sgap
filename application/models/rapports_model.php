<?
class Rapports_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	function getListeEleves()
	{
		$this->db->select('classe, nom, prenom');
		$this->db->from('users');
		$this->db->where(array('profil'=>1));
		$this->db->order_by("classe");
		$this->db->order_by("nom");
		$this->db->order_by("prenom");
		$query=$this->db->get();
		return($query);
	}    
	
	function getListeInscriptions()
	{
		$this->db->select('cycles.debut AS cycle, users.nom, users.prenom, classe, matieres.nom AS matiere');
		$this->db->from('users');
		$this->db->join('inscriptions', 'users.id=inscriptions.eleve_id');
		$this->db->join('accompagnement', 'accompagnement.id = inscriptions.accompagnement_id');
		$this->db->join('cycles', 'cycles.id = accompagnement.cycle_id');
		$this->db->join('matieres', 'matieres.id = accompagnement.matiere_id');
		$this->db->where(array('profil'=>1));
		$this->db->order_by("cycle");
		$this->db->order_by("nom");
		$this->db->order_by("prenom");
		$query=$this->db->get();
		return($query);
	}
	
	function getListeAbsents()
	{
		//Si désinscrit alors que déclaré absent on ne reporte plus l'absence
		$this->db->select('classe, users.nom, prenom, seances.date, matieres.nom AS matiere' );
		$this->db->from('presences');
		$this->db->join('users', 'users.id = presences.eleve_id');
		$this->db->join('seances', 'seances.id = presences.seance_id');
		$this->db->join('accompagnement', 'accompagnement.id = seances.accompagnement_id');
		$this->db->join('matieres', 'matieres.id = accompagnement.matiere_id');
		$this->db->join('inscriptions', 'inscriptions.accompagnement_id=accompagnement.id AND users.id = inscriptions.eleve_id' ); //Cette ligne vérifie l'inscription
		$this->db->where(array('absent'=>true));
		$this->db->order_by("classe");
		$this->db->order_by("nom", "asc");
		$this->db->order_by("prenom", "asc");
		$this->db->order_by("date", "asc");
		$query=$this->db->get();
		return($query);
	}
	
	
}
