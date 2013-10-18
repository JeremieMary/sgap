<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
		if ( !isset($this->session->userdata['profil']) ) redirect('user/login');
		if ( $this->session->userdata['profil'] > 3 ) {
			return(true);
		}  
		
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		$data['title']='Administration';
		$this->load->view('templates/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}
	
	private function prepareArrayforUsers($tab){
		$this->load->model('users_model');
		$data = $this->users_model->check($tab);
		return($data);
	}

	private function prepareArrayforCycles($tab){
		//$this->load->model('cyles_model');
		$data['desactive']=array();
		$data['ajouts']=$tab;
		$data['modifications']=array();
		$data['errors']=array();
		return($data);
	}
	
	private function prepareArrayforMatieres($tab){
		//$this->load->model('matieres_model');
		$data['ajouts']=$tab;
		$data['modifications']=array();
		$data['errors']=array();
		$data['desactive']=array();	
		return($data);
	}

	public function uploadFile($type)
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($type.'file') )
				{
					$error = array('messages' => $this->upload->display_errors());
					$error['title']='Administration';
					$this->load->view('templates/header', $error);
					$this->load->view('admin/index', $error);
					$this->load->view('templates/footer');
				}
				else
				{ 	
					$uploaded =  $this->upload->data();
		   	     	$this->load->library('csvreader');
					$result =   $this->csvreader->parse_file($uploaded['full_path']);
					switch ($type){
						case 'users':
							$data = $this->prepareArrayforUsers($result);
							break;
						case 'cycles':
							$data = $this->prepareArrayforCycles($result);
							break;
						case 'matieres':
							$data = $this->prepareArrayforMatieres($result);
							break;
					}
					$data['type']=$type;
					// Supprimer le fichier uploadé 
					unlink($uploaded['full_path']);
					//$this->load->view('templates/json', $data);
					$this->load->view('templates/header', array("title"=>'CSV '.$type));
					$this->load->view('admin/arrayUpdate', $data); 
					$this->load->view('templates/footer');
				}
	
	     
	}
	
	public function exportToCSV($type) {
		//$this->load->helper('csv');
		//echo array_to_csv($array);
	}

}
