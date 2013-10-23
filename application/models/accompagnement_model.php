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
		echo 'foo';
		$accompagnement = array('matiere_id'=>$matiere_id,'cycle_id'=>$cycle_id );
		$query = $this->db->get_where('accompagnement_id',$accompagnement,1);
		if ($query->num_rows() == 1 ) { 
			$res = $query->row_array();
			return( $res['id'] ) ;
		} else {
			$sql = $this->db->insert_string('accompagnement', $accompagnement);
			$this->db->query($sql);
			return( $this->db->insert_id();)
		}
	}
		
	
	
}
