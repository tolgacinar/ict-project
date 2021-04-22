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

			$this->form_validation->set_rules('isim', 'Müşteri Adı', 'trim|required');
			$this->form_validation->set_rules('date', 'Tamir Tarihi', 'trim|required');
			$this->form_validation->set_rules('time', 'Tamir Saati', 'trim|required');
			$this->form_validation->set_rules('arac', 'Araç Markası', 'trim|required');
			$this->form_validation->set_rules('model', 'Araç Modeli', 'trim|required');
			$this->form_validation->set_rules('repair_type', 'Tamir Türü', 'trim|required');
			$this->form_validation->set_rules('repair_area', 'Tamir Noktası', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$this->output->set_content_type('application/json')->set_output(json_encode([
					"status"	=>	"error",
					"message"	=>	validation_errors()
				]));
			} else {
				echo "<pre>";
				print_r ($this->input->post());
				echo "</pre>";
			}
		}
	}
}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */