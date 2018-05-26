<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('employee_model');
	}
	
	public function index() {
		$data['login_id'] = 1;
		$this->load->view('employee/list', $data);
	}
	
	/**
	 * method to get employees with pagination
	 */
	public function getEmployeesList() {
		$post_data = $this->input->get();
		
		// pagination...
		$offset = (array_key_exists('start', $post_data))?$post_data['start']:'';
		$length = (array_key_exists('length', $post_data))?$post_data['length']:'';
		
		// get result from model
		$result = $this->employee_model->getEmployees($post_data, $offset, $length);
		
		// preapre for data-table
		$i = 0;
		$data = array();
		foreach($result['result'] as $record) {
			$temp = array();
			$temp['employee_id'] = $record->emp_id;
			$temp['employee_joining_date'] = date('m-d-Y', strtotime($record->emp_start_date));
			$temp['employee_name'] = $record->emp_name;
			$temp['employee_number'] = $record->emp_no;
			if($record->emp_status == 1) {
				$temp['action'] = "<a href='javascript:void(0);' onclick='makeEmpInactive(this)' data-empid='".$record->emp_id."'>Active</a>";
			} else if($record->emp_status == 0) {
				$temp['action'] = "<a href='javascript:void(0);' onclick='makeEmpActive(this)' data-empid='".$record->emp_id."'>In-active</a>";
			}
			$temp['DT_RowId'] = 'row_'.$i;
			$temp['DT_RowData']['pkey'] = $i;
			$i++;
			$data[] = $temp;
		}
		
		$num_rows = $result['total_rows'];
		$json_data = array(
			"draw"            => intval( $_REQUEST['draw'] ),
			"recordsTotal"    => intval( $num_rows ),
			"recordsFiltered" => intval( $num_rows ),
			"data"            => $data
		);
		echo json_encode($json_data);
	}
}