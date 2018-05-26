<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model {
	
	public function __construct() {
        parent::__construct();
    }
	
	public function getEmployees($post_data, $offset = 0, $length = 20) {
		$query = "SELECT * FROM emp";
		
		$result_set_count  = $this->db->reader()->query($query);
        $total_rows = $result_set_count->num_rows();
        
        if(!empty($offset) && !empty($length)) {
            $query .= " LIMIT ".$offset.", ".$length." ";
        }
		
		$result_set  = $this->db->reader()->query($query);
        $result =  $result_set->result();
        $query_result['total_rows'] = $total_rows;
        $query_result['result'] = $result;
        return $query_result;
	}
}