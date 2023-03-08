<?php
session_start(); 
require_once("./includes/config.php");

class Database {  // our base model class we will extend

	protected $connection;
	protected $table;
	public $rows;
	protected $fields = array();
	protected $level;
	

	public function __construct() {
		$dsn = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4";
		try {
		  $this->connection = new PDO($dsn, DB_USER, DB_PASS);
		} catch (Exception $e) {
		  error_log($e->getMessage());
		  exit('unable to connect');
		}
	}
	
	public function setLevel($level){
		$this->level = $level;
	 }
	 public function getLevel(){
		return $this->level;
	 }

	public function getAll() {
		$stmt = $this->connection->prepare("SELECT * FROM ".$this->table);
		$stmt->execute();
		$this->rows = $stmt->rowCount();
		$arr = $stmt->fetchAll(PDO::FETCH_OBJ);
		if(!$arr) exit('No results returned.');
		return $arr;
	}
	
	public function getOne($id) {
		$stmt = $this->connection->prepare("SELECT * FROM ".$this->table." WHERE id = ?");
		$stmt->execute([$id]);
		$arr = $stmt->fetchAll(PDO::FETCH_OBJ);
		if(!$arr) exit('No results returned.');
		return $arr;
	}

	public function getRoleId($role) {
		$stmt = $this->connection->prepare("SELECT id FROM roles WHERE name = ?");
		$stmt->execute([$role]);
		$arr = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $arr;
	}
	public function getAllRoles() {
		$stmt = $this->connection->prepare("SELECT * FROM roles");
		$stmt->execute();
		$arr = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $arr;
	}
	public function getRole($roleId) {
		$stmt = $this->connection->prepare("SELECT name FROM roles WHERE id = ?");
		$stmt->execute([$roleId]);
		$arr = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $arr;
	}

	public function search($fld, $str) {
		$stmt = $this->connection->prepare("SELECT * FROM ".$this->table." WHERE ".$fld." LIKE ?");
		$stmt->execute(["%$str%"]);
		$this->rows = $stmt->rowCount();
		$arr = $stmt->fetchAll(PDO::FETCH_OBJ);
		if(!$arr) exit('No Results Found.');
		return $arr;
	}

	public function searchUser($uname) {
		$stmt = $this->connection->prepare("SELECT * FROM users WHERE username = ? ");
		$stmt->execute([$uname]);
		$this->rows = $stmt->rowCount();
		$arr = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $arr;
	}

	protected function create($statement,$values) {
		$stmt = $this->connection->prepare("INSERT INTO ".$this->table.$statement);
		$stmt->execute($values);
		$stmt = null;
	}

	protected function update($statement,$values) {
		$stmt = $this->connection->prepare("UPDATE ".$this->table.$statement);
		$stmt->execute($values);
		$stmt = null;
	}

	protected function delete($id) {
		$stmt = $this->connection->prepare("DELETE FROM ".$this->table." WHERE id=?");
		$stmt->execute([$id]);
		$stmt = null;
	}


}