<?php
class Eleve extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']='Eleve';
		$this->load->view('templates/header', $data);
		$this->load->view('eleve/index', $data);
		$this->load->view('templates/footer', $data);
	}




}
