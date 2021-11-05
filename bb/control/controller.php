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
//---------------------------------------------------------------------------------------------
//							Website section
//---------------------------------------------------------------------------------------------

//login-----------------------------------------------------------------------------------
			case ($page == "login"):
				$uname = testinput($_POST['user']);
	            $pass = testinput($_POST['pass']);
	            $user_type = $_POST["loginas"];
	            foreach($cupcakes as &$cupcake) echo $cupcake;
	            print_r($cupcakes);

	            if ($user_type =="bus_organization") {
	             	$table = "bus_organization";
	             	$role = "bus_organization_id";
	             	$va = $this->db->login($table,$uname,$pass,$role);
	             	if ($va===-1) 
	            		{
		            		header("location:./view/login.php");
	           		}
	         	    else
	               		{
	               		session_start();
	               		$_SESSION['bus_organization'] = $va;
	            		header("location:./view/post_ticket.php");
	            	}
	            }
	            else
	             	{
	             		$table = "adminstrator";
	             		$role = "admin_id";
	             		$va = $this->db->login($table,$uname,$pass,$role);
	            		if ($va===-1) 
	            		{
		            		header("location:./view/login.php");
	           			}
	         	    else
	               		{
	               		session_start();
	               		$_SESSION['admin'] = $va;
	            		header("location:./view/bo_managenment.php");
	            	}
	            }
				break;
//-----------------------------------------------------------------------------------------
//change password
			case ($page == "Achange_password"):
					$user_id = $_POST['id'];
					$current_password = testinput($_POST['oldpass']);
					$new_password1 = testinput($_POST['newpass1']);
					$new_password2 = testinput($_POST['newpass2']);
					if ($new_password1==$new_password2) {
						$res = $this->db->Achange_password($user_id,$current_password,$new_password1);
						if ($res == 1) 
							header("location:./view/Achange_password.php");
						else
							header("location:./view/login.php");
					}
					else
						header("location:./view/login.php");
					break;
			case ($page == "Bchange_password"):
					$user_id = $_POST['id'];
					$current_password = testinput($_POST['oldpass']);
					$new_password1 = testinput($_POST['newpass1']);
					$new_password2 = testinput($_POST['newpass2']);
					if ($new_password1==$new_password2) {
						$res = $this->db->Achange_password($user_id,$current_password,$new_password1);
						if ($res == 1) 
							header("location:./view/Achange_password.php");
						else
							header("location:./view/login.php");
					}
					else
						header("location:./view/login.php");
					break;	

//------------------------------------------------------------------------------------------
//bo section--------------------------------------------------------------------------------

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
				header("Location: ./view/bo_managenment.php");
				break;

		 	case($page == "deactivate_bus_organization"):
				//	$boid = $_POST['boid'];
					$admin_id = $_POST['adminddid'];
					$password = $_POST['passworddd'];
					$boid = $_POST['user'];
					$res = $this->db->check_admin($admin_id,$password);
					if($res == 1){
						$this->db->deactivate_bus_organization($boid);
						echo '<script>alert("Account deactivated")</script>';
						header("Location: ./view/bo_managenment.php");

					}
					else{
						echo '<script>alert("Admin Password incorrect")</script>';
						header("Location: ./view/login.php");

					}
				break;

			case($page == "reactivate_bus_organization"):
				//	$boid = $_POST['boid'];
					$admin_id = $_POST['adminddid'];
					$password = $_POST['passworddd'];
					$boid = $_POST['user'];
					$res = $this->db->check_admin($admin_id,$password);
					if($res == 1){
						$this->db->reactivate_bus_organization($boid);
						echo '<script>alert("Account deactivated")</script>';
						header("Location: ./view/bo_managenment.php");

					}
					else{
						echo '<script>alert("Admin Password incorrect")</script>';
						header("Location: ./view/login.php");

					}
				break;

//---------------------------------------------------------------------------------------------

//voucher--------------------------------------------------------------------------------------
			case ($page == "add_voucher"):
				session_start();
				$voucher_no = testinput($_POST['voucher_no']);
				$balance = testinput($_POST['balance']);
				$user = $_SESSION['admin'];
				$status = true;
				$this->db->add_voucher($voucher_no,$balance,$user,$status);
				header("location:./view/voucher_managenment.php");

				break;

//----------------------------------------------------------------------------------------------

//city-----------------------------------------------------------------------------------------
				case ($page == "add_city"):
				$city_name = testinput($_POST['city_name']);
				$region = $_POST['region'];
				$this->db->add_city($city_name,$region);
				header("Location:./view/city_managenment.php");

				break;
//---------------------------------------------------------------------------------------------	


//bus-------------------------------------------------------------------------------------------
			case ($page == "add_bus"):
				session_start();
				$plate_no = testinput($_POST['plate_no']);
				$seat_no = testinput($_POST['seat_no']);
				$user = $_SESSION['bus_organization'];
				$this->db->add_bus($plate_no,$seat_no,$user);
				header("location:./view/bus_managenment.php");
				break;
			case ($page == "remove_bus"):
				$bus_id = $_POST['bus_id'];
				$user_id = $_SESSION['bus_organization'];
				$password = testinput($_POST['password']);
				$this->db->remove_bus($bus_id,$user_id,$password);
				header("location:./view/bus_managenment.php");
				break;
//----------------------------------------------------------------------------------------------


//ticket----------------------------------------------------------------------------------------
			case ($page == "add_ticket"):
				session_start();
				$price = testinput($_POST['price']);
				$bus_id = $_POST['bus_id'];
				$dep_city = $_POST['dep_city'];
				$des_city = $_POST['des_city'];
				$date = $_POST['date'];
				$time = $_POST['time'];
				$user = $_SESSION['bus_organization'];
				$this->db->add_ticket($price,$bus_id,$dep_city,$des_city,$date,$user,$time);
				header("location:./view/post_ticket.php");
				break;
//---------------------------------------------------------------------------------------------				
//notification---------------------------------------------------------------------------------
				case($page == "send_notification"):
					$ticket_id=$_POST['ticket_id'];
					$notification_body = $_POST['notification_body'];
					$this->db->send_notification($ticket_id,$notification_body);
					header("location:./view/post_ticket.php");
				break;

				

//..............................................................................................

//pay bo----------------------------------------------------------------------------------------

				case($page == "pay_bus_organization"):
					$boid = $_POST['user'];
					$amount = $_POST['amount'];
					$admin_id = $_POST['adminddid'];
					$password = $_POST['passworddd'];
					$res = $this->db->check_admin($admin_id,$password);
					if($res == 1){
						$this->db->pay_bus_organization($boid,$amount);
						header("Location: ./view/bo_managenment.php");
					}
					else
						header("Location: ./view/login.php");

					break;

//---------------------------------------------------------------------------------------------
						//Application
//---------------------------------------------------------------------------------------------

//login----------------------------------------------------------------------------------------
			case ($page === "tlog"):
					$username = testinput($_POST['user']); 
				$password = testinput($_POST['pass']);
				$result = $this->db->tlog($username,$password);	
			    
						$myArray = array();
						$myArray = $result;
					//	echo $myArray;
						echo json_encode($myArray);
						break;
//--------------------------------------------------------------------------------------------

//sign up-------------------------------------------------------------------------------------
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
				break;
//---------------------------------------------------------------------------------------------

//fill voucher---------------------------------------------------------------------------------
			case($page =="fill_voucher"):
				$voucher_no = testinput($_POST['voucher_no']);
				$user_id = (int)testinput($_POST['user_id']);
				$balance = (int)testinput($_POST['balance']);
				$check = $this->db->fill_voucher($voucher_no,$user_id,$balance);
				echo json_encode($check);
			break;

//get city--------------------------------------------------------------------------------------

			case($page === "get_city"):
			   $result = $this->db->get_city();				    
					$myArray = array();
					$myArray = $result;
					//	echo $myArray;
						echo json_encode($myArray);
			    break;

//search ticket---------------------------------------------------------------------------------
			case($page ==="search_ticket"):
				$departure = testinput($_POST['dep']);
				$destination = testinput($_POST['des']);
				$dat = $_POST['dat'];
				$check = $this->db->search_ticket($departure,$destination,$dat);
				 if($check == 0)
				 	echo json_encode("noticket");
				else{
				 	$myArray = array();
				 	$myArray = $check;
				 	echo json_encode($myArray);
				 }
				break;

//purchase ticket------------------------------------------------------------------------------
			case($page ==="purchase_ticket"):
				$ticketid = (int)$_POST['ticket_id'];
				$user_id = (int)$_POST['user_id'];
				$price = (int)$_POST['price'];
				$seat_no =(int)$_POST['seat_no'];
				$purcase = $this->db->purchase_ticket($ticketid,$user_id,$price,$seat_no);
				if($purcase==1)
					echo json_encode("success");
				else
					echo json_encode("error");
				break;
//view ticket----------------------------------------------------------------------------------

			case($page === "view_ticket"):
				$user_id = (int)testinput($_POST['user_id']);
				$check = $this->db->view_ticket($user_id);
				$myArray = array();
				$myArray = $check;
				echo json_encode($myArray);
				//echo json_encode($res);
				break;
//get notification-----------------------------------------------------------------------------
			case($page == "get_notification"):
					$user_id =(int)testinput($_POST['user_id']);
					$notifications = $this->db->get_notification($user_id);
					echo json_encode($notifications);
				break;

			case($page == "changepass"):
				$user_id = (int)testinput($_POST['user_id']);
				$oldpass = $_POST['oldpass'];
				$newpass = $_POST['newpass'];
				$check = $this->db->checkuser($user_id,$oldpass);
				if($check == 1){
					$res = $this->db->changepassword($user_id,$newpass);
					if ($res == 1) 
						echo json_encode("success");
					else
						echo json_encode("failed");
				}
				else 
					echo json_encode("error");	
				break;	
		}
	}
}
?>