<?php 

	session_start();

	include "../bd/database.php";

	$connection = connectDatabase();

	$inputName = $_POST["userName"];
	$inputLastName = $_POST["userLastName"];
	$inputId = $_POST["userId"];
	$inputPhone = $_POST["userPhone"];
	$inputEmail = $_POST["userEmail"];
	$inputPassword = $_POST["userPassword"];
	$repeatPassword = $_POST["repeatPassword"];


	if ($inputPassword == $repeatPassword) {
			$sqlQuery = "SELECT idPersona FROM persona WHERE cedula = '" . $inputId . "';";
			$personFinded = $connection->query($sqlQuery);
		

		if ($personFinded->num_rows == 0) {
			$sqlQuery = "SELECT correo FROM usuario WHERE correo = '" . $inputEmail . "';";
			$emailsFinded = $connection->query($sqlQuery);

	
			if ($emailsFinded->num_rows == 0) {
				$sqlQuery = "INSERT INTO persona VALUES (DEFAULT, '" . $inputId . "', '" . $inputName . "', '" . $inputLastName . "', '" . $inputPhone . "');";
			
				if ($connection->query($sqlQuery) === true) {
					$sqlQuery = "SELECT idPersona FROM persona WHERE cedula = '" . $inputId . "';";
					$user = $connection->query($sqlQuery);
			
					if ($user->num_rows > 0) {
						
						while ($row = $user->fetch_assoc()) {
							$sqlQuery = "INSERT INTO usuario VALUES (DEFAULT, '" . $inputEmail . "', '" . $inputPassword . "',  " . $row["idPersona"] . ", 2);";
							$connection->query($sqlQuery);
						}
						header('Location: ../registro_usuario.php?mensaje=registrado');
					}
				}
			}else {
				header('Location: ../registro_usuario.php?mensaje=errormail');
			}
		} else {
			
			while ($row = $personFinded->fetch_assoc()) {
				$userId = $row['idPersona'];
				$sqlQuery = "SELECT * FROM usuario WHERE persona_idPersona = '" . $userId . "';";
				$usersFinded = $connection->query($sqlQuery);
				
			
				if ($usersFinded->num_rows == 0) {
					$sqlQuery = "SELECT correo FROM usuario WHERE correo = '" . $inputEmail . "';";
					$emailsFinded = $connection->query($sqlQuery);
					if ($emailsFinded->num_rows == 0) {
						$sqlQuery = "INSERT INTO usuario VALUES (DEFAULT, '" . $inputEmail . "', '" . $inputPassword . "',  " . $userId . ", 2);";
						if ($connection->query($sqlQuery)) {
							header('Location: ../registro_usuario.php?mensaje=registrado');
						}
					}else {
						header('Location: ../registro_usuario.php?mensaje=errormail');
					}
				}else {
				
					header('Location: ../registro_usuario.php?mensaje=yaregistrado');
				}
			}

		}
	} else {
		header('Location: ../registro_usuario.php?mensaje=passsame');
	}



?>