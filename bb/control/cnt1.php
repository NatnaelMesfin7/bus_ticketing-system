<?php

class Controller{
	private $db;
	public function __construct(Database $db)
	{
		$this->db = $db;
	}
	public function index(){
		$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
		 function testinput($data){
			      $data = trim($data);
			      $data = addslashes($data);
			      $data = htmlspecialchars($data);
			      return $data;
			  }
		switch ($page) {
			//login
			case ($page === "login"):
				$uname = testinput($_POST['user']);
	            $pass = testinput($_POST['pass']);
	            $user_type = $_POST["loginas"];

	            if ($user_type =="bus_organization") {
	             	$table = "bus_organization";
	             	$role = "bus_organization_id";
	             	$va = $this->db->login($table,$uname,$pass,$role);
	             	if ($va===-1) 
	            		{
		            		header("location:./view/nsuc.php");
	           		}
	         	    else
	               		{
	               		session_start();
	               		$_SESSION['bus_organization'] = $va;
	            		header("location:./view/bus.php");
	            	}
	            }
	            else
	             	{
	             		$table = "adminstrator";
	             		$role = "admin_id";
	             		$va = $this->db->login($table,$uname,$pass,$role);
	            		if ($va===-1) 
	            		{
		            		header("location:./view/nsuc.php");
	           			}
	         	    else
	               		{
	               		session_start();
	               		$_SESSION['admin'] = $va;
	            		header("location:./view/voucher.php");
	            	}
	            }
				break;
			//add busorganization
			case ($page == "add_bus_organization"):
				$first_name = testinput($_POST['first_name']);
				$father_name = testinput($_POST['fathers_name']);
				$last_name = testinput($_POST['last_name']);
				$phone_number = testinput($_POST['phone_number']);
				$email = testinput($_POST['email']);
				$bus_organization_name = testinput($_POST['bus_organizations_name']);
				$user_name = testinput($_POST['user_name']);
				$password = testinput($_POST['password']);
				$this->db->add_bo($first_name,$father_name,$last_name,$phone_number,$email,$bus_organization_name,$user_name,$password);

				break;
				//add voucher
			case ($page == "add_voucher"):
				session_start();
				$voucher_no = testinput($_POST['voucher_no']);
				$balance = testinput($_POST['balance']);
				$user = $_SESSION['admin'];
				echo '<script> alert("'.$user.'")</script>';
				$status = true;
				$this->db->add_voucher($voucher_no,$balance,$user,$status);

				break;
				//add bus
			case ($page == "add_bus"):
				session_start();
				$plate_no = testinput($_POST['plate_no']);
				$seat_no = testinput($_POST['seat_no']);
				$user = $_SESSION['bus_organization'];
				echo $user;
				$this->db->add_bus($plate_no,$seat_no,$user);

				break;

			case ($page === "add_city"):
				$city_name = testinput($_POST['city_name']);
				$region = $_POST['region'];
				$this->db->add_city($city_name,$region);

					break;

						//app
			case ($page === "tlog"):
				$username = $_POST['username'];
				$password = $_POST['password'];
				$count = $this->db->tlog($username,$password);
				if ($count == 1) {
					echo json_encode("login");
				}
				else
					echo json_encode("error");
				break;
			case($page === "add_traveller"):
				$name=$_POST['name'];
				$father_name = $_POST['fathername'];
				$last_name=$_POST['lastname'];
				$phone_number=$_POST['phoneno'];
				$uname=$_POST['uname'];
				$password=$_POST['password'];
				$check = $this->db->add_traveller($name,$father_name,$last_name,$phone_number,$uname,$password);
				if ($check == 1) 
					echo json_encode("accountadded");
				else
					echo json_encode("notadded");




		}

	}
}
?>