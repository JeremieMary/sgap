<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
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


	public function uploadFile()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'csv';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile'))
				{
					$error = array('messages' => $this->upload->display_errors());
					$error['title']='Administration';
					$this->load->view('templates/header', $error);
					$this->load->view('admin/index', $error);
					$this->load->view('templates/footer');
				}
				else
				{
					//For export
					//$this->load->helper('csv');
					//echo array_to_csv($array);
		   	     	
					$uploaded =  $this->upload->data();
		   	     	$this->load->library('csvreader');
					$result =   $this->csvreader->parse_file($uploaded['full_path']);
					$data['json'] =  $result;
					$this->load->view('templates/json', $data); 
				}
	
	     
	}

}
