<?php
session_start();
if (isset($_SESSION['bus_organization'])){
require "bus_organization_header.php";
require_once "../model/database.php";
	$db = new Database();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/voucher.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-4.0.0-dist/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">

	<title></title>
</head>
<body>
	
  <div class="modal fade" id="exampleModaladdCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLongTitle">Add Bus</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		<form  method="POST" action="../indx.php?page=add_bus">
					<div class="form-group">
					<label>Plate Number</label>
					<input class="form-control" type="number" name="plate_no" required>
					</div>
					<div class="form-group">
                        <label>Seat Number</label>
                        <input class="form-control" type="number" name="seat_no" required>	
                    </div>
						<!-- <button type="submit" class="btn-primary" >Add Bus</button> -->
						<div class="container text-center">
					 	<input class="btn btn-primary" type="submit" name="Add" value="Add Bus">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</form>
	
		</div>
		<!-- <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		</div> -->
	  </div>
	</div>
  </div>

  
 
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLongTitle">Confirmation Form</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<form  method="POST" action="../indx.php?page=remove_bus">
			<label class="my-1 mr-2">Bus org name</label>
			<select  class="custom-select my-1 mr-sm-3" name="bus_id">
			<!-- <?php
            //   $result = $db->get_bus_organization();
            //     while ($row = $result->fetch_assoc()){
            //        $boid = $row['bus_organization_id'];
            //        $status = $row['status'];
            //        if($status==1)
            //         echo "<option value='" .$boid."'>" . $row['bus_organization_name'] . "</option>";
            //       }
              ?> -->

			</select>	
		

			<!-- <p>You are about to remove the selected bus to continue enter your password and save changes</p> -->
				<div class="form-group">
				<label>Enter your Password</label>
				<input class="form-control" type="Password" name="plate_no" required>
				</div>
			</form>	
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		  <button type="button" class="btn btn-primary">Save changes</button>
		</div>
	  </div>
	</div>
  </div>


  <div class="row">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xsm-2"></div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xsm-8">
				<div class="jumbotron">
					
						<div class="container text-center">
					 	
						 <button type='submit' value='add' name='Add' class='btn btn-primary' data-toggle='modal' data-target='#exampleModaladdCenter'>Add Bus</button>
						<button type='submit' value='remove' name='Remove' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter'>Remove Bus</button>
						</div>
				
					
				</div>	
			</div>	
			<div class="col-lg-2 col-md-2 col-sm-2 col-xsm-2"></div>  
	</div>
	
	<div class="row">	 
		<div class="col-lg-2 col-md-2 col-sm-2 col-xsm-2"></div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xsm-8">	  
				<table class="table">



					<thead class="thead-dark">
						<tr>
							<th scope="col">Bus ID</th>
							<th scope="col">Plate Number</th>
							<th scope="col">Seat Number</th>
						
						  </tr>
					</thead>
					<tbody>

				<?php
				$result = $db->get_bus($_SESSION['bus_organization']);
				while ($rows = $result->fetch_assoc()){
					echo "
						<tr>
						<td >".$rows['bus_id']."</td>
						<td>".$rows['plate_no']."</td>
						<td>".$rows['seat_no']."</td>
			  			</tr>";
				}
				?>		 
					</tbody>
				</table>
			</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xsm-2"></div>
	</div>	  
		  
	</div>

	    <script>

        const mobileBtn = document.getElementById('mobile-cta')
              nav = document.querySelector('nav')
              mobileBtnExit = document.getElementById('mobile-exit');
    
        mobileBtn.addEventListener('click', () =>{
            nav.classList.add('menu-btn');
        })        
    
        mobileBtnExit.addEventListener('click', () =>{
            nav.classList.remove('menu-btn');
        })        
    
    </script>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
</body>
</html>
<?php
}
else
	header("location:login.php");
?>