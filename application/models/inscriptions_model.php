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
	
	function getNonInscrits($cycle_id){
		$this->db->select('users.id');
		$this->db->from('users');
		$this->db->join('inscriptions', 'users.id=inscriptions.eleve_id');
		$this->db->join('accompagnement', 'accompagnement.id = inscriptions.accompagnement_id');
		$this->db->join('cycles', 'cycles.id = accompagnement.cycle_id');
		$this->db->where(array('cycles.id'=>$cycle_id));
		$query=$this->db->get();
		$inscrits=$query->result_array();
		
		$this->db->select('users.id AS eleve_id, nom, prenom, classe, groupe');
		$this->db->from('users');
		$this->db->where(array('profil'=>1));
		$this->db->where_not_in(array('users.id'=>$inscrits));
		$this->db->order_by("nom", "asc");
		$query=$this->db->get(); 
		$res=$query->result_array();
		return($res);	
	}
	
	function delete( $accompagnement_id, $eleve_id )
	{
		$this->db->delete('inscriptions', array('eleve_id' => $eleve_id, 'accompagnement_id'=>$accompagnement_id)); 
		//Supprimer aussi les absences et commentaires ? 
	}
	
	function rencontre( $classe, $groupe, $accompagnement_id ) {
		$this->db->select('users.id AS eleve_id');
		$this->db->from('users');
		$this->db->where(array('classe'=>$classe, 'groupe'=>$groupe));
		$query=$this->db->get(); 
		$inscriptions=$query->result_array();
		foreach ($inscriptions as &$ins){
			$ins['accompagnement_id']=$accompagnement_id ;
		}
		$this->db->insert_batch('inscriptions', $inscriptions );
	}
	
	function getGroups(){
		$this->db->select('classe, groupe');
		$this->db->distinct();
		$this->db->from('users');
		$this->db->where(array('profil'=>1));
		$this->db->order_by("classe", "asc");
		$this->db->order_by("groupe", "asc");
		$query=$this->db->get(); 
		$res=$query->result_array();
		return($res);	
	}
	
	function getHistory($eleve_id)
	{
		$this->db->select('cycles.id AS cycle_id, cycles.debut AS cycle_debut, matieres.id AS matiere_id , matieres.nom AS matiere_nom, accompagnement.commentaire AS commentaire_general, inscriptions.commentaire AS commentaire_perso');
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
