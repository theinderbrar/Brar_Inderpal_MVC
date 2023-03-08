<?php
session_start(); 
require_once('Database.php');

class EmployeeModel extends Database {

public function __construct() {
	parent::__construct();
	$this->table = 'tbl_employees';
	$this->fields = "emp_lname,emp_fname,emp_job,emp_image,emp_thumb";
}

public function newEmployee($formvalues) {
	$statement = "(" . $this->fields . ") VALUES (?,?,?,?,?)";
	$this->create($statement,$formvalues);
}

public function updateEmployee($formvalues) {
	$statement = " SET emp_lname=?,emp_fname=?,emp_job=?,emp_image=?,emp_thumb=? WHERE id=?";
	$this->update($statement,$formvalues);
}

public function deleteEmployee($id) {
	//code to be sure the deletion should happen
	$this->delete($id);
}


}