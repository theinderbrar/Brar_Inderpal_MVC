<?php
session_start(); 
require_once('Database.php');

class UserModel extends Database {

public function __construct() {
	parent::__construct();
	$this->table = 'users';
	$this->fields = "lname, fname, username, password, photo, role";
}

public function newUser($formvalues) {
	$statement = "(" . $this->fields . ") VALUES (?,?,?,?,?,?)";
	$this->create($statement,$formvalues);
}

public function updateUser($formvalues) {
	$statement = " SET lname=?, fname=?, photo=?, role=? WHERE id=?";
	$this->update($statement,$formvalues);
}
public function updateUserRole($formvalues) {
	$statement = " SET role=? WHERE id=?";
	$this->update($statement,$formvalues);
}

public function deleteUser($id) {
	//code to be sure the deletion should happen
	$this->delete($id);
}


}