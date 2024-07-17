<?php 
	
	include "../bd/database.php";

	$connection = connectDatabase();

	function registroProfesores() {
		$nombre 	= $_POST['nombre'];
		$apellido 	= $_POST['apellido'];
		$cedula 	= $_POST['cedula'];
		$telefono 	= $_POST['telefono'];

		$sqlQuery = 'SELECT idPersona FROM persona WHERE cedula = "' . $cedula . '";';
		$personFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($personFinded->num_rows == 0) {
			//si la persoa no existe se registra en la base de datos
			$sqlQuery = "INSERT INTO persona VALUES (DEFAULT, '" . $cedula . "', '" . $nombre . "', '" . $apellido . "', '" . $telefono . "');";

			if ($GLOBALS['connection']->query($sqlQuery)) {
				// si el registro es exitoso se procede a registrar la persona creada como profesor
				$sqlQuery = 'SELECT idPersona FROM persona WHERE cedula = '. $cedula .';';
				$personFinded = $GLOBALS['connection']->query($sqlQuery);

				while ($person = $personFinded->fetch_assoc()) {
					$sqlQuery = "INSERT INTO profesor VALUES (DEFAULT, ". $person['idPersona'] .");";
					if ($GLOBALS['connection']->query($sqlQuery)) {
						// si el registro es exitoso se envia un mensaje de exito
						header('Location: ../registro_profesor.php?mensaje=registrado');
					}
				}

			}
		}else {
			// si la persona existe en la base de datos pero no existe como profesor
			while ($person = $personFinded->fetch_assoc()) {
				$sqlQuery = 'SELECT * FROM profesor WHERE persona_idPersona = '. $person['idPersona'] .';';
				$professorFinded = $GLOBALS['connection']->query($sqlQuery);
				if ($professorFinded->num_rows == 0) {
					// si la persona no esta registrada como profesor se procede a crear su perfil como profesor
					$sqlQuery = "INSERT INTO profesor VALUES (DEFAULT, ". $person['idPersona'] .");";
					if ($GLOBALS['connection']->query($sqlQuery)) {
						// si el registro es exitoso se envia un mensaje de exito 
						header('Location: ../registro_profesor.php?mensaje=registrado');
					}
				}else {
					// si la persona esta ya registrada como profesor se procede a dar un mensaje de error
					header('Location: ../registro_profesor.php?mensaje=yaregistrado');

				}
			}
			
		}
	}

	function registroSalones() {
		$bloque = $_POST['bloque'];
		$salon 	= $_POST['salon'];
		$capacidad 	= intval($_POST['capacidad']);

		$sqlQuery = 'SELECT * FROM salon WHERE bloque = "'.$bloque.'" AND numero = "'.$salon.'";';
		$roomsFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($roomsFinded->num_rows == 0) {
			$sqlQuery = 'INSERT INTO salon VALUES (DEFAULT, "'.$bloque.'", "'.$salon.'", '.$capacidad.');';
			if ($GLOBALS['connection']->query($sqlQuery)) {
				header('Location: ../registrar_salones.php?mensaje=registrado');
			}
		} else {
			header('Location: ../registrar_salones.php?mensaje=yaregistrado');
		}
	}

	function registroSeccion() {
		$curso = $_POST['curso'];
		$profesor = $_POST['profesor'];
		$seccion = $_POST['seccion'];
		$salon = $_POST['salon'];
		$dia = $_POST['dia'];
		$hora = $_POST['hora'];

		echo $salon."<br>";

		
		$sqlQuery = "SELECT * FROM seccion WHERE codigoSeccion = '".$seccion."' AND curso_idCurso = ".$curso." AND salon_idSalon = ".$salon." AND hora_idHora = ".$hora." AND dia_idDia = ".$dia." AND profesor_idProfesor = ".$profesor.";";
		$seccionFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($seccionFinded === false) {
			$sqlQuery = "INSERT INTO seccion VALUES(DEFAULT, '".$seccion."', ".$curso.", ".$salon.", ".$hora.", ".$dia.", ".$profesor.")";
			echo $sqlQuery."<br>";
			if ($GLOBALS['connection']->query($sqlQuery)) {
				header('Location: ../registro_secciones.php?mensaje=registrado');
			}
		}elseif ($seccionFinded->num_rows == 0) {
			$sqlQuery = "INSERT INTO seccion VALUES(DEFAULT, '".$seccion."', ".$curso.", ".$salon.", ".$hora.", ".$dia.", ".$profesor.")";
			if ($GLOBALS['connection']->query($sqlQuery)) {
				header('Location: ../registro_secciones.php?mensaje=registrado');
			}
		} else {
			header('Location: ../registro_secciones.php?mensaje=yaregistrado');
		}
	}
	
	switch ($_POST['opcion']) {
		case '1':
			registroProfesores();
			break;
		case '2':
			registroSalones();
			break;
		case '3':
			registroSeccion();
			break;
		default:
			# code...
			break;
	}

?>