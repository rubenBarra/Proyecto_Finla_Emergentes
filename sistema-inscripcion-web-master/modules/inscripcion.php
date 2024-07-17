<?php 
	
	session_start();

	include "../bd/database.php";
	$connection = connectDatabase();

	function inscripcionAlumnoNuevo() {
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$cedula = $_POST['cedula'];
		$telefono = $_POST['telefono'];
		$seccion = $_POST['seccion'];

		$sqlQuery = 'SELECT * FROM persona WHERE cedula = "'.$cedula.'"';
		$personFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($personFinded->num_rows == 0) {
			$sqlQuery = 'INSERT INTO persona VALUES(DEFAULT, "'.$cedula.'", "'.$nombre.'", "'.$apellido.'", "'.$telefono.'")';
			if ($GLOBALS['connection']->query($sqlQuery)) {
				$sqlQuery = 'SELECT idPersona FROM persona WHERE cedula = "'.$cedula.'" ';
				$personFinded = $GLOBALS['connection']->query($sqlQuery);
				while ($row = $personFinded->fetch_assoc()) {
					$sqlQuery = 'INSERT INTO alumno VALUES(DEFAULT, '.$row['idPersona'].')';
					if ($GLOBALS['connection']->query($sqlQuery)) {
						$sqlQuery = 'SELECT idAlumno FROM alumno WHERE persona_idPersona = '.$row['idPersona'].' ';
						$alumnoFinded = $GLOBALS['connection']->query($sqlQuery);
						while ($alumno = $alumnoFinded->fetch_assoc()) {
							$sqlQuery = 'INSERT INTO inscripcion VALUES(DEFAULT, '.$alumno['idAlumno'].', '.$_SESSION['idUser'].', '.$seccion.')';
							if ($GLOBALS['connection']->query($sqlQuery)) {
								header('Location: ../inscripcion_alumno_nuevo.php?mensaje=registrado');
							}
						}
					}
				}
			}
		}else {
			while ($persona = $personFinded->fetch_assoc()) {
				$sqlQuery = 'SELECT * FROM alumno WHERE persona_idPersona = '.$persona['idPersona'].' ';
				$alumnoFinded = $GLOBALS['connection']->query($sqlQuery);
				if ($alumnoFinded->num_rows == 0) {
					$sqlQuery = 'INSERT INTO alumno VALUES(DEFAULT, '.$persona['idPersona'].')';
					if ($GLOBALS['connection']->query($sqlQuery)) {
						$sqlQuery = 'SELECT idAlumno FROM alumno WHERE persona_idPersona = '.$persona['idPersona'].' ';
						$alumnoFinded = $GLOBALS['connection']->query($sqlQuery);
						while ($alumno = $alumnoFinded->fetch_assoc()) {
							$sqlQuery = 'INSERT INTO inscripcion VALUES(DEFAULT, '.$alumno['idAlumno'].', '.$_SESSION['idUser'].', '.$seccion.')';
							if ($GLOBALS['connection']->query($sqlQuery)) {
								header('Location: ../inscripcion_alumno_nuevo.php?mensaje=registrado');
							}
						}
					}
				}else {
					header('Location: ../inscripcion_alumno_nuevo.php?mensaje=yaregistrado');
				}
			}
		}
	}

	function inscripcionAlumnoExistente() {
		$cedula = $_POST['cedula'];
		$curso = $_POST['curso'];
		$seccion = $_POST['seccion'];

		$sqlQuery = 'SELECT * FROM alumno JOIN persona ON persona_idPersona = idPersona AND cedula = "'.$cedula.'" ';
		$alumnoFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($alumnoFinded->num_rows != 0) {
			while ($alumno = $alumnoFinded->fetch_assoc()) {
				$sqlQuery = 'SELECT * FROM inscripcion JOIN seccion WHERE alumno_idAlumno = '.$alumno['idAlumno'].' AND curso_idCurso = '.$curso.' AND seccion_idSeccion = idSeccion';
				$inscripcionFinded = $GLOBALS['connection']->query($sqlQuery);
				if ($inscripcionFinded->num_rows == 0) {
					$sqlQuery = 'INSERT INTO inscripcion VALUES(DEFAULT, '.$alumno['idAlumno'].', '.$_SESSION['idUser'].', '.$seccion.')';
					if ($GLOBALS['connection']->query($sqlQuery)) {
						header('Location: ../inscripcion_alumno_existente.php?mensaje=registrado');
					}
				}else {
					header('Location: ../inscripcion_alumno_existente.php?mensaje=yaregistrado');
				}
			}
		}else {
			header('Location: ../inscripcion_alumno_existente.php?mensaje=noregistrado');
		}
	}

	switch ($_POST['opcion']) {
		case '1':
			inscripcionAlumnoNuevo();
			break;
		case '2':
			inscripcionAlumnoExistente();
			break;
		default:
			# code...
			break;
	}

?>