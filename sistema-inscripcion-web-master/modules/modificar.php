<?php 
	
	session_start();

	include "../bd/database.php";
	$connection = connectDatabase();

	function modificarSeccion() {
		$curso = $_POST['curso'];
		$profesor = $_POST['profesor'];
		$seccion = $_POST['seccion'];
		$salon = $_POST['salon'];
		$dia = $_POST['dia'];
		$hora = $_POST['hora'];

		$sqlQuery = 'SELECT * FROM seccion WHERE codigoSeccion = "'.$seccion.'" ';
		$seccionFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($seccionFinded->num_rows > 0) {
			$sqlQuery = 'UPDATE seccion SET curso_idCurso = '.$curso.', salon_idSalon = '.$salon.', hora_idHora = '.$hora.', dia_idDia = '.$dia.', profesor_idProfesor = '.$profesor.' WHERE codigoSeccion = "'.$seccion.'" ';
			echo $sqlQuery;
			if ($GLOBALS['connection']->query($sqlQuery)) {
				header('Location: ../modificar_secciones.php?mensaje=modificada');
			}
		}else {
			header('Location: ../modificar_secciones.php?mensaje=noexiste');
		}
	}

	function modificarProfesor() {
		$nombre 	= $_POST['nombre'];
		$apellido 	= $_POST['apellido'];
		$cedula 	= $_POST['cedula'];
		$telefono 	= $_POST['telefono'];
		
		$sqlQuery = 'SELECT * FROM persona WHERE cedula = "'.$cedula.'" ';
		$personFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($personFinded->num_rows > 0) {
			while ($persona = $personFinded->fetch_assoc()) {
				$sqlQuery = 'SELECT * FROM profesor WHERE persona_idPersona = '.$persona['idPersona'].' ';
				$profesorFinded = $GLOBALS['connection']->query($sqlQuery);
				if ($profesorFinded->num_rows > 0) {
					$sqlQuery = 'UPDATE persona SET nombre = "'.$nombre.'", apellido = "'.$apellido.'", telefono = "'.$telefono.'" WHERE cedula = "'.$cedula.'" ';
					echo $sqlQuery;
					if ($GLOBALS['connection']->query($sqlQuery)) {
						echo "entro";
						header('Location: ../modificar_profesores.php?mensaje=modificada');
					}
				}else {
					header('Location: ../modificar_profesores.php?mensaje=noexistepro');
				}
			}
			
		}else {
			header('Location: ../modificar_profesores.php?mensaje=noexiste');
		}
	}

	function modificarInscripcion() {
		$cedula = $_POST['cedula'];
		$seccion = $_POST['seccion'];

		$sqlQuery = 'SELECT * FROM persona WHERE cedula = "'.$cedula.'" ';
		$personFinded = $GLOBALS['connection']->query($sqlQuery);
		if ($personFinded->num_rows > 0) {
			while ($persona = $personFinded->fetch_assoc()) {
				$sqlQuery = 'SELECT * FROM alumno WHERE persona_idPersona = '.$persona['idPersona'].' ';
				$alumnoFinded = $GLOBALS['connection']->query($sqlQuery);
				if ($alumnoFinded->num_rows > 0) {
					while ($alumno = $alumnoFinded->fetch_assoc()) {
						$sqlQuery = 'SELECT * FROM inscripcion WHERE alumno_idAlumno = '.$alumno['idAlumno'].' ';
						$inscripcionFinded = $GLOBALS['connection']->query($sqlQuery);
						if ($inscripcionFinded->num_rows > 0) {
							$sqlQuery = 'UPDATE inscripcion SET seccion_idSeccion = '.$seccion.', usuario_idUsuario = '.$_SESSION['idUser'].' ';
							if ($GLOBALS['connection']->query($sqlQuery)) {
								header('Location: ../modificar_inscripcion.php?mensaje=modificado');
							}else {
								echo "error";
							}
						}
					}
				}else {
					header('Location: ../modificar_inscripcion.php?mensaje=noexistealu');
				}
			}
		}else {
			header('Location: ../modificar_inscripcion.php?mensaje=noexiste');
		}
	}



	switch ($_POST['opcion']) {
		case '1':
			modificarSeccion();
			break;
		case '2':
			modificarProfesor();
			break;
		case '3':
			modificarInscripcion();
			break;
		default:
			# code...
			break;
	}

?>