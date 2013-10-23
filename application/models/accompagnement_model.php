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
	
	function getId($cycle_id, $matiere_id){
		echo $cycle_id;
		echo $matiere_id;	
	}
		
	
	
}
