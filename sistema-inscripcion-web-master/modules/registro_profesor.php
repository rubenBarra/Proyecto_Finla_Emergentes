<?php 

	session_start();

	include "../bd/database.php";

	$connection = connectDatabase();

	$inputName = $_POST["userName"];
	$inputLastName = $_POST["userLastName"];
	$inputId = $_POST["userId"];
	$inputPhone = $_POST["userPhone"];

	
?>