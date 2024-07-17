<?php 

	include "../bd/database.php";
	$connection = connectDatabase();

	function obtenerSecciones() {
		$curso = $_GET['value'];
		echo '<option value="" disabled selected>Seleccione una Seccion...</option>';

		$sqlQuery = 'SELECT * FROM seccion JOIN profesor JOIN dia JOIN hora JOIN persona ON curso_idCurso = '.$curso.' AND dia_idDia = idDia AND hora_idHora = idHora AND profesor_idProfesor = idProfesor AND persona_idPersona = idPersona';
		$seccionFinded = $GLOBALS['connection']->query($sqlQuery);
		while ($row = $seccionFinded->fetch_assoc()) {
			echo "<option value='".$row['idSeccion']."'>".$row['codigoSeccion']." - ".$row['nombre']." ".$row['apellido']." - ".$row['nombreDia']." de ".$row['horaInicio']." a ".$row['horaFinal']."</option>";
		}
	}


	switch ($_GET['opcion']) {
		case '1':
			obtenerSecciones();
			break;
		default:
			# code...
			break;
	}

?>