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
	
	
	function commitUser( $user )
		{
			//Ajouter des vérifications de cohérence ? 
			$this->load->helper('string');
			$user['passwd']=random_string('alnum',8);
			$user['actif']=1;
			$dup ='  ON DUPLICATE KEY UPDATE';
			$fieldsToUpdate = array('prenom','nom','mail','mail_parent','profil','classe','groupe','actif' );
			foreach ( $fieldsToUpdate as $champ ) $dup .= " `$champ`=VALUES(`$champ`)," ;
			$dup = rtrim($dup, ",");
			$dup .= ';';
			$sql = $this->db->insert_string('users', $user) . $dup;
			$this->db->query($sql);
			$id = $this->db->insert_id();
		}
		
	function commitArray($tab)
		{
			//Inactive all users not in array. It will temporally blocks logins
			$this->db->update('users', array('actif'=>0) ); 
			foreach ($tab as $user ){
				$this->commitUser($user);
			}
		}	
		
	function check( $tab )
		{
			//Quick and dirty. I just assume it's not used often not for big files
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
			foreach( $tab as $user ){
				if (  in_array( $user['login'], $dblogins ) ) { 
						array_push( $data['modifications'], $user );
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
