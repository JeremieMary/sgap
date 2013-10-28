<?
class Seances_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	
	
	function creer($accompagnement_id,$cycle_id,$enseignant_id) 
	{
		$this->load->model('cycles_model');
		$dates = $this->cycles_model->getDates($cycle_id);
		foreach($dates as $date){
			$date=date_create_from_format("d/m/Y",$date);
			$timestamp=$date->getTimestamp(); 
			$date=strftime( "%Y-%m-%d", $timestamp );
			$seance = array( 'accompagnement_id'=>$accompagnement_id,'date'=>$date, 'enseignant_id'=>$enseignant_id);
			$this->db->insert('seances', $seance);
		}
	} 	
	
	
	
}
