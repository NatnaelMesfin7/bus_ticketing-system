<?php
session_start();
if (isset($_SESSION['admin'])){
require "admin_header.php";
require_once "../model/database.php";
	$db = new Database();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="css/report.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-4.0.0-dist/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <style>
        body{
            background: rgb(219, 226, 226);
        }
    </style>
</head> 
    <div class="container mt-5">
        <h1 class="text-center mb-3">Report</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr class="bg-dark text-white">
                        <th scope="col">Bus #</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Bus Terminal</th>
                        <th scope="col">Departure</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Abay</th>
                        <td>Addis Ababa</td>
                        <td>BahirDar</td>
                        <td>5</td>
                        <td>10:00</td>
                        <td>Departed</td>
                      </tr>
                      <tr>
                        <th scope="row">Selam</th>
                        <td>Addis Ababa</td>
                        <td>Hawassa</td>
                        <td>2</td>
                        <td>11:45</td>
                        <td>Departed</td>
                      </tr>
                      <tr>
                        <th scope="row">Africa</th>
                        <td>Addis Ababa</td>
                        <td>Gondar</td>
                        <td>3</td>
                        <td>13:25</td>
                        <td class="bg-danger text-white" data-toggle="tooltip" data-placement="left"
                          title="The bus had minor problem">Cancelled</td>
                      </tr>
                      <tr>
                        <th scope="row">Selam</th>
                        <td>Addis Ababa</td>
                        <td>Jimma</td>
                        <td>1</td>
                        <td>18:45</td>
                        <td>On time</td>
                      </tr>
                      <tr>
                        <th scope="row">Abay</th>
                        <td>Addis Ababa</td>
                        <td>Gambela</td>
                        <td>5</td>
                        <td>20:00</td>
                        <td>On time</td>
                      </tr>
                  </tbody>
            </table>
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

</body>
</html>
<?php
}
else
header("location:login.php");
?>