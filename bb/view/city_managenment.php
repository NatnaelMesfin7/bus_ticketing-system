<?php
session_start();
if (isset($_SESSION['admin'])){
	require "admin_header.php";
	require_once "../model/database.php";
	$db = new Database();

?>
<!--<?php?>-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/city.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
	<script src="bootstrap-4.0.0-dist/js/jquery-3.4.1.js"></script>
	<link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">

	<title></title>
</head>
<body>
	
	<div class="container jumbotron w-70">

		<form  method="POST" class="container" action="../indx.php?page=add_city">
			<div class="form-group align-items-center">
			  <label for="exampleInputEmail1">City Name</label>
			  <input type="text" name="city_name" class="form-control w-80"  aria-describedby="emailHelp" placeholder="Enter City Name">
			</div>
			<div class="form-group">
			<label for="regionSelect">Region</label>
			<select class="form-control w-80" id="regionSelect" name="region">
				<option value="addis_ababa">Addis Ababa</option>
				<option value="afar_region">Afar Region</option>
				<option value="amhara region">Amhara Region</option>
				<option value="benishangul-gumuz_region">Benishangul-Gumuz Region</option>
				<option value="dire_dawa">Dire Dawa</option>
				<option value="gambela_region">Gambela Region</option>
				<option value="harari_region">Harari Region</option>
				<option value="oromia_region">Oromia Region</option>
				<option value="sidama_region">Sidama Region</option>
				<option value="somali_region">Somali Region</option>
				<option value="snnpr">Southern Nations, Nationalities, and Peoples Region</option>
				<option value="tigray_region">Tigray Region</option>
			  </select>
			</div>
			<input type="submit" class="btn btn-primary" value="Add city">
		  </form>	
		  <br>

		  <table class="table">
			<thead class="thead-dark">
			  <tr>
				<th scope="col">City</th>
				<th scope="col">Region</th>
			  </tr>
			</thead>
			<tbody>
				<?php
				$result = $db->get_city();
				while ($rows = $result->fetch_assoc()){
					echo "
						<tr>
						<td >".$rows['city']."</td>
						<td>".$rows['region']."</td>
			  			</tr>";
				}
				?>



			  
			</tbody>
		  </table>
	</div>
	<br>
	<br>
	


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