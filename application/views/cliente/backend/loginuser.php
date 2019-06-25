<?php

	session_start();
	include ('ClientUser.php');

	$username = "sin nickname";
	$phone = "sin phone";
	$firstname = "";
	$lastname = "";
	$email = $_POST['email'];
	$password = $_POST['password'];
	$gender = "";

	

	$client = new ClientUser($firstname, $lastname, $email, $password, $gender, $phone, $username);
	
	$listar = $client->login();

	if(strcmp($listar, "false")){
		echo "Contraseña o Email incorrectos";
	}else{
		$_SESSION['email']  = $email;
		echo "<script>location.href='http://localhost/stock-v2/application/views/cliente/category.php';</script>";
	}


?>