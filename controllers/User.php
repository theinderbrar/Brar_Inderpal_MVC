<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once('./models/UserModel.php');

// A controller class. Handles the linkage between the specific
// URL passed by the user and DB fetch/put methods in the model class.

class User
{

	private $model;
	private $database;

	public function __construct()
	{
		$this->model = new UserModel();
		$this->database = new Database();
	}

	// This file combines specific URL 'routes' with model methods
// we dont have actual routing, but each URL with parameters
// acts as a unique 'pointer' to a resource
// e.g., localhost:8888/pdo_employees/ is unique compared to
// localhost:8888/pdo_employees/index.php?task=delete&id=1

	public function loadViews()
	{
		//get content through the model
		//load views that match the content
		require_once('views/head.php');
		require_once('views/nav.php');



		// what content should be passed back based on URL parameters?


		//route: localhost:8888/employees/index.php?id=1

		if (isset($_GET['pg']) && $_GET['pg'] == 'login') {
			if (isset($_POST['submit'])) {
				$password = $_POST['password'];
				$user = $this->model->searchUser($_POST['username']);

				// if login success
				if($user){
					$hash = $user[0]->password;
					if (password_verify($password, $hash)) {
						// get user role
						$role = $user[0]->role;
						$_SESSION["role"] = $role;
						$this->database->setLevel($role);
						header('Location: employee.php');
					} else {
						echo 'Invalid password.';
					}
				} else{
					echo "Wrong credentials. Please try again";
				}

			} else {
				// display login form;
				require_once('views/login.php');
			}
		} else if (isset($_GET['pg']) && $_GET['pg'] == 'logout') {
			unset($_SESSION["role"]);
			header('Location: index.php');

		} else if (isset($_GET['pg']) && $_GET['pg'] == 'register') {
			if (isset($_POST['register'])) {
				// check if existing user via username
				$user = $this->model->searchUser($_POST['username']);
				if ($user) {
					echo "Existing user";
					header('Location: index.php?pg=login');
				}


				// hash password
				$password = $_POST['password'];
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				// $role= $this->model->getRoleId($_POST['role']);
				// $roleId = $role[0]->id;
				$roleId = 2;
				$formvalues = [$_POST['lname'], $_POST['fname'], $_POST['username'], $hashed_password, $_FILES["photo"]["name"], $roleId];

				// upload image
				// Upload the file
				$target_dir = "images/"; // Change this to the path of your folder
				$target_file = $target_dir . basename($_FILES["photo"]["name"]);
				// Check if file already exists
				if (!(file_exists($target_file))) {
					if (!(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))) {
						echo "Sorry, there was an error uploading your file.";
					} else {
						echo "sucessfully uploaded";
					}
				} else {
					echo "already exists";
				}
				//insert in db

				$user = $this->model->newUser($formvalues);

				//redirect to login
				header('Location: index.php?pg=login');


			} else {
				// display login form
				require_once('views/register.php');
			}
		} else if(isset($_GET['id']) && isset($_GET['task']) && $_GET['task'] == 'rolechange') {
			$users = $this->model->getOne($_GET['id']);
			$role = $this->model->getRole($users[0]->role);
			require_once('views/user_detail.php');
		}
		else if($_GET['task'] == 'rolechange') {
			$users = $this->model->getAll();
			$rows = $this->model->rows;
			require_once('views/emp_search.php');
			require_once('views/user_roles.php');
		}else if($_GET['task'] == 'delete') {
			$users = $this->model->deleteUser($_GET['id']);
			header("location:index.php?task=rolechange");
		}
		//route: localhost:8888/employees/index.php?task=update&id=1
		else if(isset($_GET['task']) && $_GET['task'] == 'update' && isset($_GET['id'])) {
			$user = $this->model->getOne($_GET['id']);
		  	if(isset($_POST['update'])) {

				// change role
				$role = $_POST['role'];
				echo "Roleeeeeeeeeeee".$role;

				// handle form submission
				$formvalues = [$role,$_GET['id']];
				$users = $this->model->updateUserRole($formvalues);
				echo $role;
				header("location:employee.php");
			      
			}
		  
		  // check if employee was found in database
		  else if ($user) {
			$userRoles = $this->model->getAllRoles();
		    // pass employee details to form view
		    require_once('views/updateRole.php');
		  } else {
		    // employee not found, show error view
		    echo "User not found";
		  }
		}
		else {
			require_once('views/unregistered.php');
		}

		require_once('views/footer.php');

	}

}