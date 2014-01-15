<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
		if ( !isset($this->session->userdata['profil']) ) redirect('user/login');
		if ( $this->session->userdata['profil'] > 3 ) {
			$this->load->helper('datefr');
			//$this->output->enable_profiler(TRUE);
			return(true);
		}  
		$this->session->set_flashdata('messages', "<p>Vos droits actuels sont insuffisants pour afficher la page demandée. Vous avez été redirigé vers l'écran d'authentification.</p>" );
		redirect('user/login');
	}

	public function index()
	{
		$this->load->model('cycles_model');
		$this->load->model('matieres_model');
		$this->load->model('inscriptions_model');
		$this->load->model('accompagnement_model');
		$this->load->model('users_model');
		$data['title']='Administration';
		$data['messages'] = $this->session->flashdata('messages');
		$data['matieres'] = $this->matieres_model->getAll();
		$data['cycles']   = $this->cycles_model->getAll();
		$data['profs']    = $this->users_model->getAllProfs();
		$data['salles']   = $this->accompagnement_model->getAllSalles();
		#$data['accompagnement']   = $this->accompagnement_model->getAllActiveHumanReadable();
		$data['accompagnement']   = $this->accompagnement_model->getAllHumanReadable();
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
		$this->load->model('cycles_model');
		$data = $this->cycles_model->check($tab);
		return($data);
	}
	
	private function prepareArrayforMatieres($tab){
		$this->load->model('matieres_model');
		$data = $this->matieres_model->check($tab);
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
			$this->session->set_userdata('file'.$type, $uploaded['full_path'] ); 
			//$this->load->view('templates/json', $data);
			$this->load->view('templates/header', array("title"=>'CSV '.$type));
			$this->load->view('admin/arrayUpdate', $data); 
			$this->load->view('templates/footer');
		}
	
	     
	}
	
	public function cancelUpload(){
		// unlink($this->session->userdata['file'.$type]);
		$files = glob('./uploads/*'); 
		foreach($files as $file){ 
			if(is_file($file))
			unlink($file); 
		}
		redirect('admin');
	}
	
	public function confirm($type){
		//print_r($this->session->userdata['commitData'.$type]);
		//$result = ( $this->session->userdata['commitData'.$type] );
		$this->load->library('csvreader');
		$result = $this->csvreader->parse_file($this->session->userdata['file'.$type]);
		unlink($this->session->userdata['file'.$type]);
		switch ($type){
			case 'users':
			$this->load->model('users_model');
			$data = $this->users_model->commitArray($result);
			break;
			case 'cycles':
			$this->load->model('cycles_model');
			$data = $this->cycles_model->commitArray($result);
			break;
			case 'matieres':
			$this->load->model('matieres_model');
			$data = $this->matieres_model->commitArray($result);
			break;
		}
		$this->session->set_flashdata('messages', 'Fichier des '.$type.' mis à jour');
		redirect('admin');
	}
	
	public function exportToCSV() {
		$this->load->model('rapports_model');
		$this->load->dbutil();
		$this->load->helper('download');
		$report = $this->rapports_model->getListeElevesCSV();
		$new_report=$this->dbutil->csv_from_result($report, ";", "\n");	
		force_download('listeEleves.csv', $new_report); 		
	}

	public function rapportEleves(){
		$this->load->model('rapports_model');
		$data['liste'] = $this->rapports_model->getListeElevesCSV();
		$this->load->view('templates/header',$data);
		$this->load->view('admin/rapport',$data);
		$this->load->view('templates/footer');
	}


}
