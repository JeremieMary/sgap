<?php
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo $this->session->userdata('id');
		$data['title']='Administration';
		$this->load->view('templates/header', $data);
		$this->load->view('eleve/index', $data);
		$this->load->view('templates/footer', $data);
	}




}
