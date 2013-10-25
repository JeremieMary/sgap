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
	
	function getAllActiveHumanReadable()
	{
		$this->db->select('accompagnement.id AS id, cycles.debut AS cycle_debut, cycles.id AS cycle_id ,matieres.nom AS matiere,matieres.id AS matiere_id, users.nom AS nom , users.prenom AS prenom , salle');
		$this->db->from('accompagnement');
		$this->db->where('accompagnement.actif = 1');
		$this->db->join('matieres', 'matieres.id = accompagnement.matiere_id');
		$this->db->join('users', 'users.id = accompagnement.enseignant_id');
		$this->db->join('cycles', 'cycles.id = accompagnement.cycle_id');
		$query=$this->db->get();	
		return($query->result_array());
	}

	function getAllActiveWithCyclesAndMatieres()
	{
		$data['accompagnement']=$this->getAllActiveHumanReadable();
		$cycles=array();
		$matieres=array();
		foreach ( $data['accompagnement'] as $acc ){
			/*if (!isset($cycles[$acc['cycle_id']])) {
			    $cycles[$acc['cycle_id']] = array();
			}
			array_push( $cycles[$acc['cycle_id']], array( 'matiere'=>$acc['matiere'],'matiere_id'=>$acc['matiere_id'] ) );
			*/
			array_push( $cycles, array('id'=>$acc["cycle_id"], 'debut'=>$acc['cycle_debut']) );
			array_push( $matieres, array('id'=>$acc["matiere_id"], 'nom'=>$acc['matiere']) );
		}
		                                                                          
		$newArr = array();         
		foreach ($cycles as $val) {
		    $newArr[$val['id']] = $val;    
		}
		$data['cycles'] = array_values($newArr);
		$newArr = array();
		foreach ($matieres as $val) {
		    $newArr[$val['id']] = $val;    
		}
		$data['matieres'] = array_values($newArr);
		/*
		$data['cycles']=$cycles;          
		$data['matieres']=$matieres; 
		*/
		return($data);
	}
	
	function isActif($cycle_id,$matiere_id){
		$accompagnement = array('matiere_id'=>$matiere_id,'cycle_id'=>$cycle_id,'actif'=>true );
		$this->db->select('accompagnement.id');
		$this->db->from('accompagnement');
		$this->db->where($accompagnement);
		$this->db->limit(1);
		$query=$this->db->get();
		if ($query->num_rows() == 1 ) { 
			return(true);
		} else {
			return(false);
		}
	}

	function getNbInscrits($cycle_id,$matiere_id)
	{	
		$accompagnement = array('matiere_id'=>$matiere_id,'cycle_id'=>$cycle_id );
		$this->db->select('inscriptions.id');
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
