
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

	if($listar['id']!=""){ ?>
	
<!DOCTYPE html>
<html lang="es" xmlns:th="http://www.thymeleaf.org">
<head>
    <title>Registro</title>

    <!--JQUERY-->
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!-- Nuestro css-->
    <link rel="stylesheet" type="text/css" href="../css/index.css" th:href="@{css/index.css}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/style_duv.css">

 <script>
		           $(document).ready(function()
		           {
		              $("#addModal").modal("show");
		           });
		    </script>
<!--===============================================================================================-->

<script src="https://kit.fontawesome.com/d484b80541.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 

</head>
<body>
    <div class="modal-dialog text-center">
        <div class="col-sm-14 main-section">
            <div class="modal-content" style="background-color: white;">
                <div class="col-12 user-img">
                    <img src="../img/user.png" th:src="@{../img/user.png}"/>
                </div>

                <form class="col-12" action="backend/registrar.php" method="post">
                    <div class="row">
                    <div class="col-sm-5">
                     <div class="wrap-input100 validate-input" data-validate="Datos requeridos" align="left">
                        <label class="label-input100" for="name">Nombres (requerido)</label>
                        <input type="text" class="input100" id="nombre" placeholder="* Nombres" name="firstname" required />
                        <span class="focus-input100"></span>
                     
                    </div>
                </div>
                   
                   <div class="col-sm-7">
                   <div class="wrap-input100 validate-input" data-validate="Datos requeridos" align="left">
                    
                            <label class="label-input100" for="name">Apellidos (requerido)</label>
                            <input type="text" id="apellidos" class="input100" placeholder="* Apellidos completos" name="lastname"/>
                    
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

                    <div class="wrap-input100 validate-input" data-validate = "Ingresa un correo válido: juan@correo.com" align="left">
                        <label class="label-input100" for="email">Email (requerido)</label>
                            <input type="email" class="input100" id="email" placeholder="example@example.com" name="email" required/>
                            <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Ingresa un correo válido" align="left">
                        <label class="label-input100" for="password">Password (requerido)</label>
                        <input type="password" class="input100" id="password" placeholder="********" name="password" required />
                    </div>
    
                    <div class="wrap-input100">
                            <div class="label-input100" align="left">Sexo (requerido)</div>
                                <div align="left">
                                    <select class="js-select2" name="sexo" required id="sexo">
                                            <option value="">Seleccionar</option>
                                            <option value="Hombre">Hombre</option>
                                                    <option value="Mujer">Mujer</option>
                                                    <option value="Otro">Otro</option>

                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                <span class="focus-input100"></span>
                        </div>
                             
                    <button type="submit" class="btn btn-primary" style="width: 100% !important; margin-bottom: 15px;"><i class="fas fa-sign-in-alt"></i>  Registrarme </button>
                </form>
                
        </div>
    </div>

<!--===============================================================================================-->
    <script src="../vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
        $(".js-select2").each(function(){
            $(this).on('select2:open', function (e){
                $(this).parent().next().addClass('eff-focus-selection');
            });
        });
        $(".js-select2").each(function(){
            $(this).on('select2:close', function (e){
                $(this).parent().next().removeClass('eff-focus-selection');
            });
        });
    </script>

<div class="modal fade" tabindex="-1" role="dialog" id="addModal" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Registrar Usuario</h4>
      </div>

      <form role="form" action="<?php echo base_url('mesas/create') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">El email ingresado ha sido registrado anteriormente.</label>
          </div>
          
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>

<?php }else{
		
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
	header ("Cache-Control: no-cache, must-revalidate");
	//
	$ref = 'http://localhost/stock-v2/application/views/cliente/email/envioemail.php?&firstname='.$firstname.'&lastname='.$lastname.'&email='.$email.'&gender='.$gender;
  	echo "<script>location.href='$ref';</script>";
	}
	mysqli_close( $conexion );
?>

