<?
class Accompagnement_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	function getAll()
	{
		$query = $this -> db -> get( 'accompagnement' );
		return ( $query->result_array() ); 
	}
	
	function getAllHumanReadable()
	{
		$this->db->select('accompagnement.id AS id, matieres.nom AS matiere, users.nom AS nom , users.prenom AS prenom , salle');
		$this->db->from('accompagnement');
		$this->db->where('accompagnement.actif = 1');
		$this->db->join('matieres', 'matieres.id = accompagnement.matiere_id');
		$this->db->join('users', 'users.id = accompagnement.enseignant_id');
		$this->db->join('cycles', 'cycles.id = accompagnement.cycle_id');
		$query=$this->db->get();	
		return($query->result_array());
	}

	function getNbInscrits($cycle_id,$matiere_id)
	{	
		$accompagnement = array('matiere_id'=>$matiere_id,'cycle_id'=>$cycle_id );
		$this->db->select('*');
		$this->db->from('inscriptions');
		$this->db->where($accompagnement);
		$this->db->join('accompagnement', 'accompagnement.id = inscriptions.accompagnement_id');
		$query=$this->db->get();	
		return($query->num_rows());	
	}
	
	function getId($cycle_id, $matiere_id)
	{
		$accompagnement = array('matiere_id'=>$matiere_id,'cycle_id'=>$cycle_id );
		$query = $this->db->get_where('accompagnement',$accompagnement,1);
		if ($query->num_rows() == 1 ) { 
			$res = $query->row_array();
			return( $res['id'] ) ;
		} else {
			$res = -1; 
			return($res);
			//$this->db->insert('accompagnement', $accompagnement);
			//return( $this->db->insert_id() );
		}
	}
	
	function creer($cycle_id,$matiere_id,$prof_id,$salle) 
	{
		$accompagnement = array('matiere_id'=>$matiere_id,'cycle_id'=>$cycle_id , 'salle'=>$salle, 'enseignant_id'=>$prof_id);
		$this->db->insert('accompagnement', $accompagnement);
	} 	
	
	
}
