<?
class Inscriptions_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	function getAll()
	{
		$query = $this -> db -> get( 'inscriptions' );
		return($query->result_array()); 
	}
	
	function getHistory($eleve_id)
	{
		$this->db->select('cycles.id AS cycle_id, cycles.debut AS cycle_debut, matieres.id AS matiere_id , matieres.nom AS matiere_nom');
		$this->db->from('inscriptions');
		$this->db->where(array('eleve_id'=>$eleve_id));
		$this->db->join('accompagnement', 'accompagnement.id = inscriptions.accompagnement_id');
		$this->db->join('matieres', 'matieres.id = accompagnement.matiere_id');
		$this->db->join('cycles', 'cycles.id = accompagnement.cycle_id');
		$query=$this->db->get();
		$res=$query->result_array();
		return($res);	
	}
	
	function validate($eleve_id,$accompagnement_id)
	{
		//TODO 
		return(true);
	}
	
	function inscrire($eleve_id,$accompagnement_id)
	{
		if (!$this->validate($eleve_id,$accompagnement_id)){ 
			return(array('success'=>false,'message'=>'<p>Inscription impossible.</p>'));
		}
		$inscription=array('accompagnement_id'=>$accompagnement_id,'eleve_id'=>$eleve_id);
		$query = $this->db->get_where('inscriptions',$inscription,1);
		if ($query->num_rows() == 0) {
			$this->db->insert('inscriptions', $inscription);
			return(array('success'=>true,'message'=>'<p>Inscription effectuée.</p>'));
		 } else {
			return(array('success'=>false,'message'=>'<p>Éleve déjà inscrit !</p>'));
		 }
		
	}
		
	
	
}
