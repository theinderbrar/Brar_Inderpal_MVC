<?php
session_start(); 
require_once('./models/EmployeeModel.php');

// A controller class. Handles the linkage between the specific
// URL passed by the user and DB fetch/put methods in the model class.

class Employee {

private $model;
private $database;

public function __construct() {
	$this->model = new EmployeeModel();
	$this->database = new Database();
}

// This file combines specific URL 'routes' with model methods
// we dont have actual routing, but each URL with parameters
// acts as a unique 'pointer' to a resource
// e.g., localhost:8888/pdo_employees/ is unique compared to
// localhost:8888/pdo_employees/index.php?task=delete&id=1

public function loadViews() {
	//get content through the model
	//load views that match the content
	require_once('views/head.php');
	require_once('views/nav.php');
	require_once('views/emp_search.php');


	
	// what content should be passed back based on URL parameters?


	//route: localhost:8888/employees/index.php?id=1

	if(isset($_GET['id']) && !isset($_GET['task'])) {
		//run query method A on the model
		//load view(s) to match the model data
		$employees = $this->model->getOne($_GET['id']);
		require_once('views/emp_detail.php');


	//route: localhost:8888/employees/index.php?str=john

	}else if(isset($_GET['str'])) {
		//run query method B on the model
		//load view(s) to match THAT model data
		$employees = $this->model->search('emp_lname',$_GET['str']);
		$rows = $this->model->rows;
		require_once('views/emp_list.php');


//route: localhost:8888/employees/index.php?task=create
//		 localhost:8888/employees/index.php?task=update
//		 localhost:8888/employees/index.php?task=delete

	}else if(isset($_GET['task'])) {
		if($_GET['task'] == 'create') {
			if(isset($_POST['submit'])) {
			      // Upload the file
				$target_dir = "images/"; // Change this to the path of your folder
				$target_file = $target_dir . basename($_FILES["photo"]["name"]);
				$target_thumb_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
				// Check if file already exists
				if (!(file_exists($target_file))) {
					if (!(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))) {
						echo "Sorry, there was an error uploading your file.";
					} 
				} 
				if (!(file_exists($target_thumb_file))) {
					if (!(move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_thumb_file))) {
						echo "Sorry, there was an error uploading your file.";
					} 
				} 

				// handle form submission
				$formvalues = [$_POST['lname'], $_POST['fname'], $_POST['position'], $_POST['photo'], $_POST['thumbnail'],$_GET['id']];
			      $employees = $this->model->newEmployee($formvalues);
			      header("location:index.php");
			    } else {
			      // display create employee form
			      require_once('views/form.php');
			    }
		} else if($_GET['task'] == 'delete') {
			$employees = $this->model->deleteEmployee($_GET['id']);
			header("location:index.php");
		}
		//route: localhost:8888/employees/index.php?task=update&id=1
		else if(isset($_GET['task']) && $_GET['task'] == 'update' && isset($_GET['id'])) {
		  // fetch current employee details from database using ID
		  $employee = $this->model->getOne($_GET['id']);
		  if(isset($_POST['update'])) {

				// Upload the file
				$target_dir = "images/"; // Change this to the path of your folder
				$target_file = $target_dir . basename($_FILES["photo"]["name"]);
				$target_thumb_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
				// Check if file already exists
				if (!(file_exists($target_file))) {
					if (!(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))) {
						echo "Sorry, there was an error uploading your file.";
					} 
				} 
				if (!(file_exists($target_thumb_file))) {
					if (!(move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_thumb_file))) {
						echo "Sorry, there was an error uploading your file.";
					} 
				} 
				$lname = empty($_POST['lname']) ? $employee[0]->emp_lname : $_POST['lname'];
				$fname = empty($_POST['lname']) ? $employee[0]->emp_fname : $_POST['fname'];
				$position = empty($_POST['position']) ? $employee[0]->emp_job : $_POST['position'];
				$photo = empty($_FILES['photo']['name']) ? $employee[0]->emp_image : $_FILES['photo']['name'];
				$thumbnail = empty($_FILES['thumbnail']['name']) ? $employee[0]->emp_thumb : $_FILES['thumbnail']['name'];
		

				// handle form submission
				// $formvalues = [$lname,$fname,$position,$photo,$thumbnail,$_GET['id']];
				// $employees = $this->model->updateEmployee($formvalues);
				// header("location:employee.php");
				echo "Level".$this->database->getLevel();
			      
			}
		  
		  // check if employee was found in database
		  else if ($employee) {
		    // pass employee details to form view
		    require_once('views/updateform.php');
		  } else {
		    // employee not found, show error view
		    echo "Employee not found";
		  }
		}
		
	// default route:localhost:8888/employees

	}
	// else if(isset($_GET['pg'])&& $_GET['pg'] == 'login') {
	// 	if(isset($_POST['login'])) {
			

	// 	}else{
	// 		// display login form
	// 		require_once('views/login.php');
	// 	}
	// }else if(isset($_GET['pg'])&& $_GET['pg'] == 'register') {
	// 	// display login form
	// 	require_once('views/register.php');
	// }
	
	else{ 
		$employees = $this->model->getAll();
		$rows = $this->model->rows;
		require_once('views/emp_list.php');
	}

	require_once('views/footer.php');

}

}

