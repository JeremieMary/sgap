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
		
	function check( $tab )
		{
			$data['ajouts']=array();
			$data['errors']=array();
			$data['modifications']=array();
			$data['desactive']=array();
			
			$logins = array();
			foreach ($tab as $row ){
				array_push( $logins, $row['login'] );
			}
			
			$this -> db -> select('nom, prenom, mail, mail_parent, profil, classe, groupe, login');
			$this -> db -> from('users');
			$query = $this -> db -> get();
			$allUsers= $query->result_array();
			$dblogins = array();
			foreach( $allUsers as $user ){
				array_push( $dblogins, $user['login'] );
				if ( ! in_array( $user['login'], $logins ) ) {
					array_push( $data['desactive'], $user );
				}
			}
			
			$n=0;
			foreach( $tab as $user ){
				$n += 1;
				if (  in_array( $user['login'], $dblogins ) ) { 
					if (!($user == $allUsers[$n])) {
						array_push( $data['modifications'], $user );
					}
				} else {
					array_push( $data['ajouts'], $user );
				}
			}
			
			/*
			$this -> db -> select('*');
			$this -> db -> from('users');
			$this -> db -> where_not_in('login', $logins);	
			$query = $this -> db -> get();
			$data['desactive']= $query->result_array();
		
			
			$this -> db -> select('*');
			$this -> db -> from('users');
			$this -> db -> where_in('login', $logins);
			$query = $this -> db -> get();
			$data['modifications']=$query->result_array();
		*/
		return($data);
		}
		
}
