<?
class Cycles_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	function getAll(){
		$query = $this -> db -> get( 'cycles' );
		$cycles = $query->result_array();
		for ($i=0; $i<count($cycles); $i++) {
			$cycles[$i]['dates'] = unserialize($cycles[$i]['dates']);
		}
		return ( $cycles ); 
	}
	
	function getDates($cycles_id)
	{
		$this->db-> select('dates');
		$this->db-> limit(1);
		$this->db-> where(array('id'=>$cycles_id));
		$this->db-> from('cycles');
		$query=$this->db->get();
		$cycle=$query->row_array();
		return(unserialize($cycle['dates']));
	}
	
	function commitCycle( $cycle )
	{
		//Ajouter des vérifications de cohérence ? 
		$cycle['actif']=1;
		$dup ='  ON DUPLICATE KEY UPDATE';
		$fieldsToUpdate = array('dates','actif' );
		foreach ( $fieldsToUpdate as $champ ) $dup .= " `$champ`=VALUES(`$champ`)," ;
		$dup = rtrim($dup, ",");
		$dup .= ';';
		$sql = $this->db->insert_string('cycles', $cycle) . $dup;
		$this->db->query($sql);
	}
		
	
	private function formatForDB($cycle) {
		return ( array( 'debut'=>reset($cycle), 'dates'=>serialize(array_values($cycle) ) ) );
	}
	
	function commitArray($tab)
	{
		//Inactive all users not in array. It will temporarly break everything
		$this->db->update('cycles', array('actif'=>0) ); 
		foreach ($tab as $cycle ){
			$this->commitCycle( $this->formatForDB($cycle) );
		}
	}	
		
	function check( $tab )
	{
		//Quick and dirty. I just assume it's not used often nor for big files
		$data['ajouts']=array();
		$data['modifications']=array();
		$data['desactive']=array();	
		$debuts = array();
		foreach ($tab as $row ){
			array_push( $debuts, reset($row) );
		}
			
		$this -> db -> select('debut,dates');
		$this -> db -> from('cycles');
		$query = $this -> db -> get();
		$allcycles= $query->result_array();
		$dbdebuts = array();
		foreach( $allcycles as $cycle ){
			$first = reset($cycle);
			array_push( $dbdebuts, $first );
			if ( ! in_array( $first, $debuts ) ) {
				array_push( $data['desactive'], $cycle );
			}
		}
		foreach( $tab as $cycle ){
			$first = reset($cycle);
			if (  in_array( $first, $dbdebuts ) ) { 
				array_push( $data['modifications'], $cycle );
			} else {
				array_push( $data['ajouts'], $cycle );
			}
		}
		return($data);
	}
	
}