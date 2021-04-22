<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	protected $ci;

	public function __construct() {
        $this->ci =& get_instance();
	}

	public function render($view, $page_data) {
		$this->ci->load->view("header", $page_data);
		$this->ci->load->view($view, $page_data);
		$this->ci->load->view("footer", $page_data);
	}

	

}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */
