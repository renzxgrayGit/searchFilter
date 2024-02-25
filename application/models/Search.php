<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Model {
    public function fetch_all()
    {
      return $this->db->query("SELECT * FROM items")->result_array();
    }

    public function fetch_filtered($searchTerm)
    {
        // Modify this query to fetch filtered data based on the search term
        return $this->db->query("SELECT * FROM items WHERE item_name LIKE '%$searchTerm%'")->result_array();
    }

    public function fetch_sorted($sortOrder, $searchTerm = null, $minPrice = null, $maxPrice = null)
    {
        $orderBy = ($sortOrder == 'Low_to_High') ? 'ASC' : 'DESC';
        $sql = "SELECT * FROM items";

        // Add search term filter if provided
        if ($searchTerm !== null) {
            $sql .= " WHERE item_name LIKE '%$searchTerm%'";
        }

        // Add minimum and maximum price filters if provided
        if ($minPrice !== null) {
            $sql .= " AND price >= $minPrice";
        }
        if ($maxPrice !== null) {
            $sql .= " AND price <= $maxPrice";
        }

        // Add ORDER BY clause
        $sql .= " ORDER BY price $orderBy";

        return $this->db->query($sql)->result_array();
    }


}