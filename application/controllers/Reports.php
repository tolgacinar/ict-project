<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
	}

	public function index() {
		$data = [];
		$this->template->render("reports", $data);
	}

}

/* End of file Reports.php */
/* Location: ./application/controllers/Reports.php */