
<?php

	include ('config/dbunmsm/config.php');
	include ('config/dbunmsm/functions.php');
	include ('config/dbunmsm/mysql.php');

	//conexion a la base de datos
	$base_datos = "stock";
	$usuario = "root";
	$contrasena = "";
	$servidor = "localhost";

	$connection = mysqli_connect( $servidor, $usuario, $contrasena) or die ("No se pudo conectar con el servidor");
	$db = mysqli_select_db ($connection, $base_datos) or die ( "No se pudo conectar a la BD" );
	//conexion a la base de datos

	//post
	$username = "sin nickname";
	$phone = "sin phone";
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$gender = $_POST['sexo'];
	//post

	//realizar la consulta para que no se registren varias veces con el mismo email
	$consulta = "SELECT * FROM users WHERE email = '$email' ";
	$resultado = mysqli_query($connection, $consulta) or die ( "Algo ha ido mal en la consulta a la base de datos");
	$listar = mysqli_fetch_array( $resultado);

	if($listar['id']!=""){
		echo "<script>location.href = 'http://localhost/stock-v2/application/views/cliente/registrar.html';</script>";
	}else{
		
		$_GRABAR_SQL = "INSERT INTO users (
		firstname,
		lastname,
		email,
		password,
		gender,
		phone,
		username)
		VALUES (
		'$firstname',
		'$lastname',
		'$email',
		'$password',
		'$gender',
		'$phone',
		'$username')";

	mysqli_query ($connection,$_GRABAR_SQL);
	printf ("Nuevo registro con el id %d.\n", mysqli_insert_id($_GRABAR_SQL));
	header ("Cache-Control: no-cache, must-revalidate");
	//
	$ref = 'http://localhost/stock-v2/application/views/cliente/email/envioemail.php?&firstname='.$firstname.'&lastname='.$lastname.'&email='.$email.'&gender='.$gender;
  	echo "<script>location.href='$ref';</script>";
	}
	mysqli_close( $conexion );
?>
