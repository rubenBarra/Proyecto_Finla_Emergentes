

<?php

session_start();

if (isset($_SESSION['user'])) {
	header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Webpage Design</title>
	<!-- <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/materialize.min.css"> -->
	<link rel="stylesheet" href="css/style-iniciar-secion.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

	<div class="main">
		<div class="navbar">
			<div class="icon">
				<h2 class="logo  bx bxl-audible icon">Webify</h2>
			</div>

			<div class="menu">
				<ul>
					<li><a href="#">Casaaaaaaaaa</a></li>
					<li><a href="#">ACERCA</a></li>
					<li><a href="#">SERVICIO</a></li>
					<li><a href="#">DESIGN</a></li>
					<li><a href="#">CONTACTANOS</a></li>
				</ul>
			</div>

			<div class="search">
				<input class="srch" type="search" name="" placeholder="Escribe Texto">
				<a href="#"> <button class="btn">Buscar</button></a>
			</div>

		</div>
		<div class="content">
			<h1>Cursos de <br><span>Desarrollo y diseño</span> <br>web</h1>
			<p class="par">Nuestros cursos están diseñados para que puedas aprender a la velocidad que <br>
				necesitas, con un enfoque en la innovación y la práctica. ¡Inscríbete hoy y revoluciona tus 
				<br> habilidades de desarrollo web!"
			</p>

			<button class="cn"><a href="#">INSCRIBIRSE</a></button>

			
			<form class="form" action="modules/login.php" method="post">
			<h2>Login Here</h2>
				<!-- <input type="email" class="input" name="userEmail" placeholder="Usuario" required> -->
				<input type="email" class="input" name="userEmail" placeholder="Usuario" required>
				<!-- <input type="password" class="input" placeholder="contraseña" name="userPassword" required> -->
				<input type="password" class="input" placeholder="contraseña" name="userPassword" required>
				<button class="btnn" type="submit">Iniciar Sesion</button>
				<!-- <button class="btnn"><a href="#">Iniciar Secion</a></button> -->

				<p class="link">No tienes Cuenta<br>
					<a href="#">Registrate </a> aqui</a>
				</p>
				<p class="liw">Iniciar con</p>

				<div class="icons">
					<a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
					<a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
					<a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
					<a href="#"><ion-icon name="logo-google"></ion-icon></a>
					<a href="#"><ion-icon name="logo-skype"></ion-icon></a>
				</div>
			</form>
		</div>
		
	</div>
	
	<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/materialize.min.js"></script>

	<?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'errorpass') { ?>
		<script>
			Materialize.toast('Error: Contraseña Incorrecta', 6000);
		</script>
	<?php } elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'erroruser') { ?>
		<script>
			Materialize.toast('Error: Usuario No Existente', 6000);
		</script>
	<?php } elseif (isset($_GET['mensaje'])) { ?>
		<script>
			Materialize.toast('Error', 6000);
		</script>
	<?php } ?>
</body>

</html>