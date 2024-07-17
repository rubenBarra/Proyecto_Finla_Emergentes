<?php 
	// TODO: implement a modular design to this script
	
	session_start();

	include "../bd/database.php";

	$connection = connectDatabase();

	$inputEmail = $_POST['userEmail'];
	$inputPassword = $_POST['userPassword'];

	$sqlQuery = "SELECT * FROM usuario WHERE correo = '" . $inputEmail . "';";

	$usersFinded = $connection->query($sqlQuery);
	
	if ($usersFinded->num_rows > 0) {
		while ($row = $usersFinded->fetch_assoc()) {
			if ($row['password'] == $inputPassword) {
				$_SESSION['user'] = $row['correo'];
				$_SESSION['idUser'] = $row['idUsuario'];
				$_SESSION['perfilUser'] = $row['perfil_idPerfil'];
				header('Location: ../index.php');
			} else {
				header('Location: ../iniciar_sesion.php?mensaje=errorpass');
			}
		}
	} else {
		header('Location: ../iniciar_sesion.php?mensaje=erroruser');
	}
?>