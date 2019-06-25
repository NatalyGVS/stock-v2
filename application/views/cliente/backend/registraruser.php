<!DOCTYPE html>
<html lang="es" xmlns:th="http://www.thymeleaf.org">
<head>
	 <title>Registro Restaurant La Reserva</title>
	</head>
	<body>
<?php
	
	include ('ClientUser.php');


	$username = "sin nickname";
	$phone = "sin phone";
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$gender = $_POST['sexo'];

	$client = new ClientUser($firstname, $lastname, $email, $password, $gender, $phone, $username);
	$client->register_user();
	//mysqli_close( $conexion );

	
?>

</body>
</html>


