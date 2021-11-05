<?php
require "control/controller.php";
require "model/database.php";

$db = new Database();
$controller = new Controller($db);
$controller->index();
?>