<?php

	
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
		session_start();
		$_SESSION['email']  = $listar['email'];
		$_SESSION['username'] = $listar['username'];
		header("Location: index.php");
	}


?>