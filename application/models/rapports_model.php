<?
class Rapports_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	function getListeElevesCSV(){
		$this->db->select('classe, id, nom, prenom');
		$this->db->from('users');
		$this->db->where(array('profil'=>1));
		$this->db->order_by("classe");
		$query=$this->db->get();
		return($query);
	}    
}
