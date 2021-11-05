<?php
session_start();
if (isset($_SESSION['bus_organization'])){
require "bus_organization_header.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<form method="POST" action="../indx.php?page=Bchange_password">
	<input type="hidden" name="id" value="<?php echo $_SESSION['bus_organization'];?>">
	<label>old password</label>
	<input type="text" name="oldpass">
	<label>new password</label>
	<input type="text" name="newpass1">
	<label>re-enter new password</label>
	<input type="text" name="newpass2">
	<input type="submit" name="" value="change">


</form>
</body>
</html>
<?php
}
else
	header("location:login.php");
?>