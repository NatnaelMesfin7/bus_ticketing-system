<?php
session_start();
if (isset($_SESSION['admin'])){
require "admin_header.php";
require "../model/database.php";
	$db = new Database();
  function status($val){
  if($val == 0)
    return "<td style='color: red;'>Deactivated</td>";
  else
    return "<td style='color: blue;'>Active</td>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusOrganizationManagement</title>
    <link rel="stylesheet" href="css/borgmng.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-4.0.0-dist/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
</head>
<body>

<!-- Modal for add bus organization-->
<div class="modal fade" id="addbusorg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Bus Organization info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form class="needs-validation" method="POST" action="../indx.php?page=add_bus_organization" novalidate>
          <div class="form-row">
            <div class="col-md-4 mb-3">
              <label for="validationCustom02">First name</label>
              <input type="text" class="form-control" id="validationCustom02" placeholder="First name" name="first_name"  required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom02">Fathers name</label>
              <input type="text" class="form-control" id="validationCustom02" placeholder="Fathers name" name="fathers_name"  required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>           
            <div class="col-md-4 mb-3">
              <label for="validationCustom02">Last name</label>
              <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="last_name"  required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom02">Phone number</label>
              <input type="number" class="form-control" id="validationCustom02" placeholder="Phone number" name="phone_number"  required>
              <div class="valid-feedback">
                continue filling!
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustom02">Bus Org Name</label>
              <input type="text" class="form-control" id="validationCustom02" placeholder="Bus Org"  name="bus_organizations_name"  required>
              <div class="valid-feedback">
                Looks good!
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <label for="validationCustomEmail">Email</label>
                <input type="email" class="form-control" id="validationCustomEmail" placeholder="Email" aria-describedby="emailHelp" name="email" required>
                <div class="invalid-feedback">
                  Please input valid email.
                </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="validationCustomUsername">Username</label>
              <input type="text" class="form-control" id="validationCustom04" placeholder="Username" name="user_name" required>
              <div class="invalid-feedback">
                Please provide a valid Username.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="validationCustomUsername">Password</label>
              <input type="password" class="form-control" id="validationCustom04" placeholder="password" name="password" required>
              <!-- <input type="password" class="form-control" id="validationCustom04" placeholder="password" name="password" required> -->
              <div class="invalid-feedback">
                Must be 8-20 characters long.
              </div>
            </div>
           </div>
           <button type="submit" class="btn btn-primary" >Add Bus Organization</button>
        </form>
        
        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
          'use strict';
          window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
              form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
                }
                form.classList.add('was-validated');
              }, false);
            });
          }, false);
        })();
        </script>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Modal for deactivate bus organization-->
<div class="modal fade" id="removebusorg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Deactivate Bus Organization Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form class="form-inline" method="POST"  action="../indx.php?page=deactivate_bus_organization">
          <label class="my-1 mr-2">Bus org name</label>
          <select  class="custom-select my-1 mr-sm-3" name="user">
         
  
              <?php
              $result = $db->get_bus_organization();
                while ($row = $result->fetch_assoc()){
                   $boid = $row['bus_organization_id'];
                   $status = $row['status'];
                   if($status==1)
                    echo "<option value='" .$boid."'>" . $row['bus_organization_name'] . "</option>";
                  }
              ?>
               
          </select>
          
          <label class="my-1 mr-2" for="inputPassword6">Password</label>
          <input type="hidden" name="adminddid" value="<?php echo $_SESSION['admin'];?>">
          <input type="password"   name="passworddd" required>
          <input type="submit" class="btn btn-primary my-1" value="Deactivate">
        </form>
      </div>




      <!-- <div class="modal-footer">
        <button type="submit" class="btn btn-primary my-1">Remove</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Modal for reactivate bus organization-->
<div class="modal fade" id="reactivatebusorg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Reactivate Bus Organization Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form class="form-inline" method="POST"  action="../indx.php?page=reactivate_bus_organization">
          <label class="my-1 mr-2">Bus org name</label>
          <select  class="custom-select my-1 mr-sm-3" name="user">
      
              <?php
              $result = $db->get_bus_organization();
                while ($row = $result->fetch_assoc()){
                   $boid = $row['bus_organization_id'];
                   $status = $row['status'];
                   if($status==0)
                    echo "<option value='" .$boid."'>" . $row['bus_organization_name'] . "</option>";
                  }
              ?>
               
          </select>
          
          <label class="my-1 mr-2" for="inputPassword6">Password</label>
          <input type="hidden" name="adminddid" value="<?php echo $_SESSION['admin'];?>">
          <input type="password"   name="passworddd" required>
          <input type="submit" class="btn btn-primary my-1" value="Reactivate">
        </form>
      </div>




      <!-- <div class="modal-footer">
        <button type="submit" class="btn btn-primary my-1">Remove</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Modal for pay bus organization-->
<div class="modal fade" id="paybusorg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pay Bus Organization </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form class="form-inline" method="POST"  action="../indx.php?page=pay_bus_organization">
          <label class="my-1 mr-2">Bus org name</label>
          <select  class="custom-select my-1 mr-sm-3" name="user">
         
  
              <?php
              $result = $db->get_bus_organization();
                while ($row = $result->fetch_assoc()){
                   $boid = $row['bus_organization_id'];
                   $status = $row['status'];
                   if($status==1)
                    echo "<option value='" .$boid."'>" . $row['bus_organization_name'] . "</option>";
                  }
              ?>
               
          </select>
          <label class="my-1 mr-2">Amount</label>
          <input type="number" name="amount">
          <br>
          <br>
          <label class="my-1 mr-2" for="inputPassword6">Password</label>
          <input type="hidden" name="adminddid" value="<?php echo $_SESSION['admin'];?>">
          <input type="password"   name="passworddd" required>
          <input type="submit" class="btn btn-primary my-1" value="Pay">
        </form>
      </div>




      <!-- <div class="modal-footer">
        <button type="submit" class="btn btn-primary my-1">Remove</button>
      </div> -->
    </div>
  </div>
</div>

   


    <div class="container jumbotron w-100">
        
        <div class="container text-center">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addbusorg">Add Bus Organization</button>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#removebusorg">Deactivate Account</button>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#reactivatebusorg">Reactivate Account</button>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#paybusorg">Pay</button>
        </div>

        <br>
        <br>
        
        <table class="table">
			<thead class="thead-dark">
			  <tr>
				<th scope="col">Bus Organization Name</th>
				<th scope="col">Phone Number</th>
        <th scope="col">Balance</th>
        <th scope="col">Status</th>
			  </tr>
			</thead>
			<tbody>
				<?php
				$result = $db->get_bus_organization();
				while ($rows = $result->fetch_assoc()){
					echo "
						<tr>
						<td >".$rows['bus_organization_name']."</td>
						<td>".$rows['phone_no']."</td>
        		<td>".$rows['balance']."</td>
             ".status($rows['status'])."
			  			</tr>";
				}
				?>
			  
			  
			  </tr>
			</tbody>
		  </table>
		

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	

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
    
</body>
</html>
<?php
}

else
header("location:login.php");
?>