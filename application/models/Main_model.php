<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

	public function insertTransaction() {
		$this->load->helper('date');
		$this->form_validation->set_rules('isim', 'Müşteri Adı', 'trim|required');
		$this->form_validation->set_rules('date', 'Tamir Tarihi', 'trim|required');
		$this->form_validation->set_rules('time', 'Tamir Saati', 'trim|required');
		$this->form_validation->set_rules('arac', 'Araç Markası', 'trim|required');
		$this->form_validation->set_rules('model', 'Araç Modeli', 'trim|required');
		$this->form_validation->set_rules('repair_type', 'Tamir Türü', 'trim|required');
		$this->form_validation->set_rules('repair_area', 'Tamir Noktası', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			return json_encode([
				"status"	=>	"error",
				"message"	=>	validation_errors()
			]);
		} else {
			$post_data = $this->input->post(NULL, TRUE);
			$customer = $this->checkUser($post_data['isim']);
			$manipulated_date = $post_data['date'] . " " . $post_data['time'];
			$transaction_date = nice_date($manipulated_date, "Y-m-d H:i");
			$now = unix_to_human(now("Europe/Istanbul"), FALSE, "euro");
			$insertData = [
				"customer_id"			=>	$customer,
				"brand_id"				=>	$post_data['arac'],
				"model_id"				=>	$post_data['model'],
				"type_id"				=>	$post_data['repair_type'],
				"area_id"				=>	$post_data['repair_area'],
				"transaction_date"		=>	$transaction_date,
				"created_at"			=>	$now,
				"transaction_status"	=>	1
			];
			if (strtotime($transaction_date) < strtotime($now)) {
				return json_encode([
					"status"	=>	"error",
					"message"	=>	"Geçmişe işlem oluşturamazsınız."
				]);
			}else {
				if ($this->db->get_where("transactions", ['transaction_status' => 1, 'area_id' => $post_data['repair_area'], 'transaction_date' => $transaction_date])->num_rows() > 0) {
					return json_encode([
						"status"	=>	"error",
						"message"	=>	"Bu tarih ve saatte, bu tamir noktasında bir işlem mevcut."
					]);
				}else {
					if($this->db->insert("transactions", $insertData)) {
						return json_encode([
							"status"	=>	"success",
							"message"	=>	"İşlem başarılı bir şekilde oluşturuldu."
						]);
					}else {
						return json_encode([
							"status"	=>	"error",
							"message"	=>	$this->db->error()
						]);
					}
				}
			}
			// $this->db->insert("transactions", $insertData);
		}
	}

	private function checkUser($name) {
		$user = $this->db->get_where("customers", ['customer_name' => $name]);
		if ($user->num_rows() > 0) {
			return $user->row()->customer_id; 
		}else {
			$this->db->insert("customers", [
				"customer_name" => $name,
				"customer_status" => 1
			]);
			return $this->db->insert_id();
		}
	}

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
		$this->load->helper('date');
		$this->load->helper('general');
		$areas = $this->db->select("*")
		->from("repair_areas")
		->where(["area_status" => 1, "type_id" => $type_id])
		->get()
		->result();
		foreach ($areas as $key => $value) {
			$areas[$key]->fill = $this->db->from("transactions")->where(['area_id' => $value->area_id, 'transaction_date >' => unix_to_human(now("Europe/Istanbul"), FALSE, "euro")])->count_all_results();
		}
		usort($areas, "cmp");
		return $areas;
	}
}

/* End of file Main_model.php */
/* Location: ./application/models/Main_model.php */