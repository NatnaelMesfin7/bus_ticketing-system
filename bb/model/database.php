<?php 
class Database{
	public $con;
	public function __construct(){
	$server_name = "localhost";
	$user_name = "root";
	$password = "";
	$dbs = "busdatabase";
  	$this->con = new mysqli($server_name, $user_name, $password, $dbs);	
	}
//login-------------------------------------------------------------------------------------
	public function login($table,$id,$pass,$role){
		$sql = "select ".$role." from ".$table." where account_id = (select account_id from account where username = '".$id."' and password = '".$pass."')";
		$result = mysqli_query($this->con,$sql)or die('connection to database error'.mysqli_error($this->con));
		 	$row = $result->fetch_assoc();
        return   ($row)?$row[$role]:-1; 
	}
	public function check_admin($admin_id,$password){
		$sql = "select * from account where account_id = (select account_id from adminstrator where admin_id = ".$admin_id.") and password = '".$password."'";
		$result = mysqli_query($this->con,$sql)or die('connection to database error'.mysqli_error($this->con));
		$row = $result->fetch_assoc();
		return   ($row)?1:0;
	}
	public function check_bo($bo_id,$password){
		$sql = "select * from account where account_id = (select account_id from bus_organization where admin_id = ".$admin_id.") and password = '".$password."'";
		$result = mysqli_query($this->con,$sql)or die('connection to database error'.mysqli_error($this->con));
		$row = $result->fetch_assoc();
		return   ($row)?1:0;
	}
	public function Achange_password($user_id,$current_password,$new_password){
		$sql1 = "select * from account where account_id = (select account_id from adminstrator where admin_id = ".$user_id.") and password = '".$current_password."'";
		$result = mysqli_query($this->con,$sql1)or die('connection to database error'.mysqli_error($this->con));
		$row = $result->fetch_assoc();
		if($row){
			$sql2 = "update account set password = '".$new_password."' where account_id = (select account_id from adminstrator where admin_id = ".$user_id.")";
		mysqli_query($this->con,$sql2) or die("unable to execute insert".mysqli_error($this->con));
		return 1;
		}
		else
			return 0;	
	}
	public function Bchange_password($user_id,$current_password,$new_password){
		$sql1 = "select * from account where account_id = (select account_id from bus_organization where bus_organization_id = ".$user_id.") and password = '".$current_password."'";
		$result = mysqli_query($this->con,$sql1)or die('connection to database error'.mysqli_error($this->con));
		$row = $result->fetch_assoc();
		if($row){
			$sql2 = "update account set password = '".$new_password."' where account_id = (select account_id from bus_organization where bus_organization_id = ".$user_id.")";
		mysqli_query($this->con,$sql2) or die("unable to execute insert".mysqli_error($this->con));
		return 1;
		}
		else
			return 0;

		
	}

//-------------------------------------------------------------------------------------


//bus_organization--------------------------------------------------------------------------
	//add_bus_organization
	public function add_bo($first_name,$father_name,$last_name,$phone_number,$email,$bus_organization_name,$user_name,$password){
		$sql = "insert into account(first_name,father_name,last_name,phone_no,email,username,password) values ('".$first_name."','".$father_name."','".$last_name."','".$phone_number."','".$email."','".$user_name."','".$password."')";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
		$sql = "insert into bus_organization(bus_organization_name,account_id) values ('".$bus_organization_name."',(select account_id from account where username = '".$user_name."'))";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	return 1;
	}
	public function get_bus_organization(){ 
		$sql =  "select b.bus_organization_id,b.status,b.bus_organization_name,b.balance,b.account_id,a.account_id,a.phone_no from bus_organization as b left join account as a on b.account_id = a.account_id";
		$result = mysqli_query($this->con,$sql);		
		return $result;
	}
	public function get_bus_organization_name(){
		$sql = "select bus_organization_id,bus_organization_name form bus_organization";
		$result = mysqli_query($this->con,$sql);		
		return $result;
	}
	public function deactivate_bus_organization($boid){
		$sql = "update bus_organization set status = 0 where bus_organization_id = ".$boid."";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
	public function reactivate_bus_organization($boid){
		$sql = "update bus_organization set status = 1 where bus_organization_id = ".$boid."";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
	public function pay_bus_organization($boid,$amount){
		 	$sql = "update bus_organization set balance = balance - ".$amount."   where  bus_organization_id= ".$boid." ";
			mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));

	}		
//-------------------------------------------------------------------------------------


//voucher----------------------------------------------------------------------------------
	public function add_voucher($voucher_no,$balance,$admin_id,$status){
		$sql = "insert into voucher(admin_id,voucher_no,balance,status) values(".$admin_id.",".$voucher_no.",".$balance.",".$status.")";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
	public function get_voucher(){
		$sql = "select * from voucher";
		$result = mysqli_query($this->con,$sql);
		return $result;
	}
//-------------------------------------------------------------------------------------


//city--------------------------------------------------------------------------------------------------
	public function add_city($city_name,$region){
		$sql = "insert into city(city,region) values ('".$city_name."', '".$region."')";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
	public function get_city(){
		$sql =  "select * from city";
		$result = mysqli_query($this->con,$sql);	
		return $result;
	}
//-------------------------------------------------------------------------------------

//bus----------------------------------------------------------------------------------------
	public function add_bus($plate_no,$seat_no,$user){
		$sql = "insert into bus(plate_no,seat_no,bus_organization_id) values (".$plate_no.", ".$seat_no.",".$user.")";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
	public function remove_bus($bus_id,$user_id,$password){
		$sql = "delete from bus where bus_id = ".$bus_id."";
		mysqli_query($this->con,$sql);

	}
	public function get_bus($bus_organization_id){
		$sql = "select * from bus where bus_organization_id = ".$bus_organization_id." ";
		$result = mysqli_query($this->con,$sql);
		return $result;
	}
//-------------------------------------------------------------------------------------

//ticket-------------------------------------------------------------------------------------------
	public function add_ticket($price,$bus_id,$dep_city,$des_city,$date,$user,$time){
		$sql="insert into ticket(bus_organization_id,price,bus_id,icity_id,dcity_id,date,available_seats,time) values(".$user.",".$price.",".$bus_id.",'".$dep_city."','".$des_city."','".$date."',(select seat_no from bus where bus_id = ".$bus_id."),'".$time."')";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
	public function get_tickets($bus_organization_id){
		$sql = "select ticket.ticket_id,ticket.icity_id,ticket.dcity_id,ticket.price,bus.plate_no,ticket.date,ticket.available_seats from ticket inner join bus on ticket.bus_organization_id = ".$bus_organization_id." and ticket.bus_id = bus.bus_id and ticket.date>=(SELECT CAST(CURRENT_TIMESTAMP() AS Date)) order by ticket.date desc";
		$result = mysqli_query($this->con,$sql);
		return $result;
		}
	public function get_ticket_id($bus_organization_id){
		$sql = "SELECT * FROM ticket WHERE bus_organization_id =".$bus_organization_id."    and date >= CURDATE()";
		$result = mysqli_query($this->con,$sql);
		return $result;
	}
//-------------------------------------------------------------------------------------


//notification-------------------------------------------------------------------------
	public function send_notification($ticket_id,$notification_body){
		$sql = "insert into notification (notification_body,ticket_id,date) values ('".$notification_body."',".$ticket_id.",'2021-09-17')";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
	}
//-------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------	

//app--------------------------------------------------------------------------------------
	public function tlog($id,$pass){
		 $sql = "select * from traveller where account_id = (select account_id from account where username = '".$id."' and password = '".$pass."')";
		$result = mysqli_query($this->con,$sql);
		$row = $result->fetch_assoc();
        return   ($row)?$row:-1; 
	}

	public function add_traveller($name,$father_name,$last_name,$phone_number,$uname,$password){
				$email = null;
				$sql = "insert into account(first_name,father_name,last_name,phone_no,username,password,email) values ('".$name."','".$father_name."','".$last_name."','".$phone_number."','".$uname."','".$password."','".$email."')";
				mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
				$sql = "insert into traveller(account_id) values ((select account_id from account where username = '".$uname."'))";
				mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
				return 1;         	
         }
		
	


	public function fill_voucher($voucher_no,$user_id,$balance){
		$sql = "select balance from voucher where voucher_no= ".$voucher_no." and status = 1";
		$result = mysqli_query($this->con,$sql);
		$count = mysqli_num_rows ( $result );
		

		if ($count == 1) {
			$sql1 = "update traveller set balance = balance + (select balance from voucher where voucher_no= ".$voucher_no." and status = 1)   where  user_id= ".$user_id." ";
			mysqli_query($this->con,$sql1) or die("unable insert".mysqli_error($this->con));
			$sql2 = "update voucher set user_id = ".$user_id.", status = 0 where voucher_no = ".$voucher_no." "; 
			mysqli_query($this->con,$sql2) or die("unable to  insert".mysqli_error($this->con));
			$sql3 = "select balance form traveller where user_id= ".$user_id." ";
			$res = mysqli_query($this->con,$sql3);
			return mysqli_fetch_assoc($res);
		}
		else
			return "error";
	}


		public function search_ticket($departure,$destination,$dat){
    	$sql = "select * from ticket where icity_id ='".$departure."' and dcity_id ='".$destination."' and date = '$dat'";
    		$result = mysqli_query($this->con,$sql);
    	        if($result!=null){
    	        
    			$res = array();
    			while($row=mysqli_fetch_assoc($result)){
    		    	$res[] = $row;	
    			
    			return $res;}
    		}
    			else
    			return 0;
    	
	}
	public function purchase_ticket($ticketid,$user_id,$price,$seat_no){
		$sql1 = "insert into transaction(ticket_id,account_id,seat_no) values (".$ticketid.",".$user_id.",".$seat_no.")";
		$sql2 = "update ticket set available_seats = available_seats - 1 where ticket_id = ".$ticketid."";
		$sql3 = "update traveller set balance = balance -".$price." where account_id = ".$user_id."";
		$sql4 = "update bus_organization set balance = balance + ".$price." where bus_organization_id = (select bus_organization_id from ticket where ticket_id = ".$ticketid.")";
		
		try {
			mysqli_query($this->con,$sql1) or die("unable to execute insert".mysqli_error($this->con));
		mysqli_query($this->con,$sql2) or die("unable to execute insert".mysqli_error($this->con));
		mysqli_query($this->con,$sql3) or die("unable to execute insert".mysqli_error($this->con));
		mysqli_query($this->con,$sql4) or die("unable to execute insert".mysqli_error($this->con));
			return 1;
		} catch (Exception $e) {
			return 0;	
		}
		
		

	}
	public function view_ticket($acc_id){
		$sql ="select ticket.ticket_id,ticket.time,ticket.price,transaction.seat_no,ticket.icity_id,ticket.dcity_id,ticket.date,bus.plate_no from transaction left join ticket  on ticket.ticket_id = transaction.ticket_id and transaction.account_id = ".$acc_id." inner join bus on bus.bus_id = ticket.bus_id order by ticket.date";
		$result = mysqli_query($this->con,$sql);
    	        if($result!=null){
    	        
    			$res = array();
    			while($row=mysqli_fetch_assoc($result)){
    		    	$res[] = $row;	
    			}
    			return $res;}

	}
	public function get_notification($acc_id){
		$sql = "select notification.notification_body,notification.date,notification.notification_id,notification.ticket_id from transaction left join notification on notification.ticket_id = transaction.ticket_id and transaction.account_id = ".$acc_id." order by notification.ticket_id";
		$result = mysqli_query($this->con,$sql);
		$cons = 0;
		$res = array();
    	while($row=mysqli_fetch_assoc($result)){
    			if($cons != $row['ticket_id']){
    				$cons = $row['ticket_id']; 
    				$res[] = $row;
    			}	
    		}
    	return $res;	
	}
	public function checkuser($user_id,$oldpass){
		$sql = "select * from account where account_id = (select account_id from traveller where user_id = ".$user_id.") and password = '".$oldpass."'";
		$result = mysqli_query($this->con,$sql)or die('connection to database error'.mysqli_error($this->con));
		$row = $result->fetch_assoc();
		return   ($row)?1:0;
		
	}
	public function changepassword($user_id,$newpass){
		$sql = "update account set password = '".$newpass."' where account_id = (select account_id from traveller where user_id = ".$user_id.")";
		mysqli_query($this->con,$sql) or die("unable to execute insert".mysqli_error($this->con));
		return 1;
		
	}
	
}
 ?>
