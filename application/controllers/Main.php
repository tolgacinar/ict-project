<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('main_model', "main");
	}

	public function index() {
		$data = [
			"brands"		=> $this->main->getCarBrands(),
			"types" 		=> $this->main->getRepairTypes(),
			"transactions"	=> $this->main->getTransactions(),
		];

		$this->load->view("main_form", $data);
	}

	public function fetch_models($brand_id) {
		if (!$this->input->is_ajax_request()) {
			die();
		}else {
			$this->output->set_content_type('application/json')->set_output(json_encode([
				"status"	=>	"success",
				"list"		=>	$models = $this->main->getCarModels($brand_id)
			]));
		}
	}

	public function fetch_areas($type_id) {
		if (!$this->input->is_ajax_request()) {
			die();
		}else {
			$this->output->set_content_type('application/json')->set_output(json_encode([
				"status"	=>	"success",
				"list"		=>	$models = $this->main->getRepairAreas($type_id)
			]));
		}
	}

	public function insert_transaction() {
		if (!$this->input->is_ajax_request()) {
			die();
		}else {
			$this->output->set_content_type('application/json')->set_output($this->main->insertTransaction());
		}
	}
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */