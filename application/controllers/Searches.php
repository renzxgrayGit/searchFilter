<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searches extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("Search");
	}

	public function index_html()
	{
		$result["items"] = $this->Search->fetch_all();
		$this->load->view('partials/items', $result);
	}

	public function index_html_filtered()
    {
        $searchTerm = $this->input->post('search');
        $result["items"] = $this->Search->fetch_filtered($searchTerm); // Modify this method to fetch filtered data
        $this->load->view('partials/items', $result);
    }

	public function index_html_sorted()
	{
		$sortOrder = $this->input->post('sort_order');
		$searchTerm = $this->input->post('search');
		$minPrice = $this->input->post('min');
		$maxPrice = $this->input->post('max');

		// Ensure minPrice and maxPrice are null if blank
		if ($minPrice === '') $minPrice = null;
		if ($maxPrice === '') $maxPrice = null;

		$result["items"] = $this->Search->fetch_sorted($sortOrder, $searchTerm, $minPrice, $maxPrice);
		$this->load->view('partials/items', $result);
	}


	public function index()
	{
		$this->load->view('index');
	}
}
