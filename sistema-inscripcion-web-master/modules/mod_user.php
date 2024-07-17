<?php 
	
	session_start();

	include "../bd/database.php";
	$connection = connectDatabase();

	$cedula = $_POST['cedula'];
	$correo = $_POST['correo'];
	$oldPass = $_POST['oldpass'];
	$newPass = $_POST['newpass'];
	$reNewPass = $_POST['renewpass'];
	$tipoUser = $_POST['tipouser'];


	if ($newPass == $reNewPass) {
		$sqlQuery = 'SELECT * FROM persona WHERE cedula = '.$cedula.' ';
		$personFinded = $connection->query($sqlQuery);
		if ($personFinded->num_rows > 0) {
			while ($persona = $personFinded->fetch_assoc()) {
				$sqlQuery = 'SELECT * FROM usuario WHERE persona_idPersona = '.$persona['idPersona'].' ';
				$userFinded = $connection->query($sqlQuery);
				if ($userFinded->num_rows > 0) {
					while ($user = $userFinded->fetch_assoc()) {
						if ($oldPass == $user['password']) {
							$sqlQuery = 'UPDATE usuario SET correo = "'.$correo.'", password = "'.$newPass.'", perfil_idPerfil = "'.$tipoUser.'" ';
							if ($connection->query($sqlQuery)) {
								header('Location: ../modificar_usuario.php?mensaje=modificado');
							}else {
								echo "error";
							}
						}else {
							header('Location: ../modificar_usuario.php?mensaje=oldpasserr');
						}
					}
				}else {
					header('Location: ../modificar_usuario.php?mensaje=noexisteuser');
				}
			}
		}else {
			header('Location: ../modificar_usuario.php?mensaje=noexiste');
		}
	}else {
		header('Location: ../modificar_usuario.php?mensaje=newpasserr');
	}
	

?>