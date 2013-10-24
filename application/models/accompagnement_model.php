<?
class Accompagnement_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	function getAll(){
		$query = $this -> db -> get( 'accompagnement' );
		return ( $query->result_array() ); 
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
	
	function creer($cycle_id,$matiere_id,$salle) 
	{
		$accompagnement = array('matiere_id'=>$matiere_id,'cycle_id'=>$cycle_id , 'salle'=>$salle);
		$this->db->insert('accompagnement', $accompagnement);
	} 	
	
	
}
