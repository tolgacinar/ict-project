<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	public function getTransactions() {
		return $this->db->select("transaction_id, customer_name, transaction_date, created_at, transaction_status, brand_name, model_name, type_name, area_name")
		->from("transactions")
		->where("transaction_status !=", 0)
		->join("customers", "customers.customer_id = transactions.customer_id")
		->join("car_brands", "car_brands.brand_id = transactions.brand_id")
		->join("car_models", "car_models.model_id = transactions.model_id")
		->join("repair_types", "repair_types.type_id = transactions.type_id")
		->join("repair_areas", "repair_areas.area_id = transactions.area_id")
		->get()
		->result();
	}

	public function getCarBrands() {
		return $this->db->select("*")
		->from("car_brands")
		->where("brand_status", 1)
		->get()
		->result();
	}

	public function getRepairTypes() {
		return $this->db->select("*")
		->from("repair_types")
		->where("type_status", 1)
		->get()
		->result();
	}

	public function getCarModels($brand_id) {
		return $this->db->select("*")
		->from("car_models")
		->where(["model_status" => 1, "brand_id" => $brand_id])
		->get()
		->result();
	}

	public function getRepairAreas($type_id) {
		$this->load->helper('general');
		$areas = $this->db->select("*")
		->from("repair_areas")
		->where(["area_status" => 1, "type_id" => $type_id])
		->get()
		->result();

		foreach ($areas as $key => $value) {
			$areas[$key]->fill = $this->db->from("transactions")->where('area_id', $value->area_id)->count_all_results();
		}
		usort($areas, "cmp");
		return $areas;
	}
}

/* End of file Main_model.php */
/* Location: ./application/models/Main_model.php */