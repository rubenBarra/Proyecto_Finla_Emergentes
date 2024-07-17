<?php
session_start();

if (!isset($_SESSION['user'])) {
	header('Location: iniciar_sesion.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Modificar Usuario</title>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css">
	<!-- <link type="text/css" rel="stylesheet" href="css/style-forms.css"> -->
	<link rel="stylesheet" href="css/estilos.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<style>
		.form-register {
			width: 800px;
			background: #24303c;
			padding: 30px;
			margin: auto;
			margin-top: 100px;
			border-radius: 4px;
			font-family: 'calibri';
			color: white;
			box-shadow: 7px 13px 37px #000;
		}

		.form-container {
			position: absolute;
			top: 40%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 70%;
			height: 90%;
			padding: 10px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			max-height: 90vh;
			overflow-y: none;
		}
	</style>
</head>

<body class="cuerpo">
	<div class="row">
		<div class="sidebar col-4">
			<div class="logo_details">
				<i class="bx bxl-audible icon"></i>
				<div class="logo_name">Webify</div>
				<i class="bx bx-menu" id="btn"></i>
			</div>
			<ul class="nav-list">
				<li>
					<i class="bx bx-search"></i>
					<input type="text" placeholder="Buscar...">
					<span class="tooltip">Buscar</span>
				</li>
				<li>
					<a href="#">
						<i class="bx bx-grid-alt"></i>
						<span class="link_name">Consultas</span>
					</a>
					<ul class="menu-vertical">
						<li><a href="consultar_alumnos.php">Alumnos</a></li>
						<li><a href="consultar_profesor.php">Profesores</a></li>
						<li><a href="consultar_seccion.php">Secciones</a></li>
					</ul>
				</li>
				<?php if ($_SESSION['perfilUser'] == 1) : ?>
					<li>
						<a href="#">
							<i class="bx bx-user"></i>
							<span class="link_name">Profesores</span>
							<!-- <span class="tooltip">User</span> -->
							<ul class="menu-vertical">
								<li><a href="registro_profesor.php">Nueva</a></li>
								<li><a href="modificar_profesores.php">Modificar</a></li>
							</ul>
					</li>
				<?php endif; ?>
				<?php if ($_SESSION['perfilUser'] == 1) : ?>
					<li>
						<a href="#">
							<i class="bx bx-folder"></i>
							<span class="link_name">Secciones</span>
						</a>
						<ul class="menu-vertical">
							<li><a href="registro_secciones.php">Nueva</a></li>
							<li><a href="modificar_secciones.php">Modificar</a></li>
							<li><a href="registrar_salones.php">Salones</a></li>
						</ul>
					</li>
				<?php endif; ?>
				<?php if ($_SESSION['perfilUser'] == 1) : ?>
					<li>
						<a href="#">
							<i class="bx bx-pie-chart-alt-2"></i>
							<span class="link_name">Usuario</span>
						</a>
						<ul class="menu-vertical">
							<li><a href="registro_usuario.php">Nueva</a></li>
							<li><a href="modificar_usuario.php">Modificar</a></li>
							<li><a href="consultar_usuario.php">Consultar</a></li>
						</ul>
					</li>
				<?php endif; ?>
				<li>
					<a href="#">
						<i class=" bx bx-user-plus"></i>
						<span class="link_name">Inscripciones</span>
					</a>
					<ul class="menu-vertical">
						<li><a href="inscripcion_alumno_nuevo.php">Nuevo</a></li>
						<li><a href="inscripcion_alumno_existente.php">Existente</a></li>
						<li><a href="modificar_inscripcion.php">Modificar Inscripcion</a></li>
					</ul>
				</li>

				<li>
					<a href="#">
						<i class="bx bx-cog"></i>
						<span class="link_name">Configuracion</span>
					</a>
					<span class="tooltip">Settings</span>
				</li>
				<li class="profile">
				<li class="profile"><a href="modules/logout.php"><i class=" material-icons">power_settings_new</i></a></li>
				<!-- <li class="profile"><i class="bx bx-log-out" id="log_out"></i></li> -->
				</li>
			</ul>

		</div>
		<div class="col-8">
			<div class="form-container">
				<div class="form-register">
					<h2>Modificacion de Usuario</h2>
					<form action="modules/mod_user.php" method="post">
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">assignment_ind</i>
								<input type="text" name="cedula" required>
								<label for="cedula">Ingrese la cedula</label>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix">email</i>
								<input type="email" name="correo">
								<label for="correo">Correo</label>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix">lock</i>
								<input type="password" name="oldpass">
								<label for="oldpass">Contraseña Actual</label>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix">lock</i>
								<input type="password" name="newpass">
								<label for="newpass">Ingrese Nueva Contraseña</label>
							</div>
							<div class="input-field col s6">
								<i class="material-icons prefix">lock</i>
								<input type="password" name="renewpass">
								<label for="renewpass">Repita Nueva Contraseña</label>
							</div>
							<div class="input-field col s4">
								<i class="material-icons prefix">account_circle</i>
								<select class="option-1" name="tipouser">
									<option value="" disabled selected>Seleccione el nivel del usuario</option>
									<option value="1">Super-Usuario</option>
									<option value="2">Usuario</option>
								</select>
							</div>
						</div>
						<div class="input-field">
							<button class="btn waves-effect waves-default" type="submit">
								<i class="material-icons left">done</i>
								Modificar Usuario
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script src="js/script-menu.js"></script>
		<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
		<script>
			$(document).ready(function() {
				$('select').material_select();
			});
		</script>

		<?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'modificado') { ?>
			<script>
				Materialize.toast('Usuario modificado con exito', 5000);
			</script>
		<?php } elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'newpasserr') { ?>
			<script>
				Materialize.toast('Error: Contraseñas no coinciden', 5000);
			</script>
		<?php } elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'noexiste') { ?>
			<script>
				Materialize.toast('Error: Persona no registrada', 5000);
			</script>
		<?php } elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'noexisteuser') { ?>
			<script>
				Materialize.toast('Error: Persona no registrada como Usuario', 5000);
			</script>
		<?php } elseif (isset($_GET['mensaje']) && $_GET['mensaje'] == 'oldpasserr') { ?>
			<script>
				Materialize.toast('Error: Vieja Contraseña incorrecta', 5000);
			</script>
		<?php } elseif (isset($_GET['mensaje'])) { ?>
			<script>
				Materialize.toast('Error', 5000);
			</script>
		<?php } ?>

</body>

</html>