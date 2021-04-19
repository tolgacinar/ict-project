<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->input->is_ajax_request()) {
			die();
		}
	}

	public function index() {
		
	}

}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */