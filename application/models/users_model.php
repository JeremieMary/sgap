<?
class Users_model extends CI_Model {
	
	public function __construct()
		{
			$this->load->database();
		}
		
 	function login($login, $password)  
		{
			$query = $this -> db -> get_where( 'users', array('login'=> $login, 'passwd'=>$password ), 1 );
   	 		return ($query->num_rows() == 1 ); 
		}
		
	function getUser( $login ) 
		{
			$query = $this -> db -> get_where( 'users', array('login'=> $login ), 1 );
 			return ( $query->row_array() ); 
		}
		

}
