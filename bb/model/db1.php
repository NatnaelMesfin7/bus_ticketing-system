<?php 
class Database{
	public $con;
	public function __construct(){
	$server_name = "localhost";
	$user_name = "id17273452_naty";
	$password = "+vm4uxb-r7ZP|9ht";
	$dbs = "id17273452_bus";
  	$this->con = new mysqli($server_name, $user_name, $password, $dbs);	
	}

	public function login($table,$id,$pass,$role){
		 $sql = "select ".$role." from ".$table." where account_id = (select account_id from account where username = '".$id."' and password = '".$pass."')";
		 $result = mysqli_query($this->con,$sql)or die('connection to database error'.mysqli_error($this->con));
		 	$row = $result->fetch_assoc();
        return   ($row)?$row[$role]:-1; 
	}

	public function add_bo($first_name,$father_name,$last_name,$phone_number,$email,$bus_organization_name,$user_name,$password){
		$sql = "insert into account(first_name,father_name,last_name,phone_no,email,username,password) values ('".$first_name."','".$father_name."','".$last_name."','".$phone_number."','".$email."','".$user_name."','".$password."')";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
		$sql = "insert into bus_organization(bus_organization_name,account_id) values ('".$bus_organization_name."',(select account_id from account where username = '".$user_name."'))";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	return 1;
}

	public function add_voucher($voucher_no,$balance,$admin_id,$status){
		$sql = "insert into voucher(admin_id,voucher_no,balance,status) values(".$admin_id.",".$voucher_no.",".$balance.",".$status.")";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));

	}
	public function add_bus($plate_no,$seat_no,$user){
		$sql = "insert into bus(plate_no,seat_no,bus_organization_id) values (".$plate_no.", ".$seat_no.",".$user.")";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
	public function add_city($city_name,$region){
		$sql = "insert into city(city,region) values ('".$city_name."', '".$region."')";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}



	public function tlog($username,$password){
		$sql = "select account_id from account where username = '".$username."' and password = '".$password."'";
		$result = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows($result);
		return $count;
	}

	public function add_traveller($name,$father_name,$last_name,$phone_number,$uname,$password){
		$email = null;
		$sql = "insert into account(first_name,father_name,last_name,phone_no,username,password,email) values ('".$name."','".$father_name."','".$last_name."','".$phone_number."','".$uname."','".$password."','".$email."')";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
		$sql = "insert into traveller(account_id) values ((select account_id from account where username = '".$uname."'))";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
		return 1;
	}

}
 ?>
