<?php
// include database configuration file
include 'dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>La Reserva | Restaurante</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/login.css">
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
    <style>
    .container{padding: 50px;}
    .cart-link{width: 100%;text-align: right;display: block;font-size: 22px;}
    </style>
</head>
</head>
<body>
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.html" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-5 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Buscar productos...">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-5 col-lg-4" align="right">
						
						<div class="user-panel">
							<div class="up-item">
								<nav class="tios">
                                    <a id="login" href="#">
                                    <i class="flaticon-profile"></i>
								<span style="font-size: 18px;">Iniciar Sesión</span></a> 
								<div id="login-content" style="margin-top: 5px;">
		            				<form action="loginuser.php" method="post">
		            					<hr>
		            					<span ><h6 style="margin-bottom: 10px;">Bienvenido, ingresa con tu cuenta.</h6></span>
		            					<hr>
		            					 <i class="flaticon-profile"></i>
										<input id="user" type="email" name="email" placeholder="email" required>  
										 <i class="flaticon-profile"></i> 
										<input id="pass" type="password" name="password" placeholder="Contraseña" required>
										<button type="submit" class="btn btn-primary col-lg-4" >login</button>
										<button type="button" class="btn btn-danger">Cerrar</button> 
			        				</form>
			     				</div>
			     			</nav>
			     			</div>
			     		<div class="up-item">
                            <a id="registrarse" href="registrar.php">
			     				<i class="flaticon-edit"></i>
								<span style="font-size: 18px;">Registrarse</span></a>
			     			</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
			
			</div>
		</nav>
	</header>
<div class="container">
    <h1>Platos del día</h1>
    <a href="viewCart.php" class="cart-link" title="View Cart"><i class="glyphicon glyphicon-shopping-cart"></i>Carrito de Compras</a>
    <div id="products" class="row list-group">
        <?php
        //get rows query
        $query = $db->query("SELECT * FROM products ORDER BY id DESC LIMIT 10");
        if($query->num_rows > 0){ 
            while($row = $query->fetch_assoc()){
        ?>
        <div class="item col-lg-4">
            <div class="thumbnail">
                <div class="caption">
                    <h4 class="list-group-item-heading"><?php echo $row["name"]; ?></h4>
                    <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="lead"><?php echo 'S./'.$row["price"].' soles'; ?></p>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-success" href="cartAction.php?action=addToCart&id=<?php echo $row["id"]; ?>">Añadir al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }else{ ?>
        <p>Product(s) not found.....</p>
        <?php } ?>
    </div>
</div>
<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="assets/plugins/iCheck/icheck.min.js"></script>
<script>
			$(function(){
		       $('#login').click(function(){
			   $(this).next('#login-content').slideToggle();
			   $(this).toggleClass('active');          
			   });
			});
		</script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

</body>
</html>