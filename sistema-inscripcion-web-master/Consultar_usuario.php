<?php 
	include "bd/database.php";
	$connection = connectDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Consultas de usuarios</title>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css">
	<link type="text/css" rel="stylesheet" href="css/style-forms.css">
</head>
<body class="cuerpo">
	
     <nav class="blue lighten-1 z-depth-3">
   		 <div class="nav-wrapper">
      		<a href="index.php" class="brand-logo">Sistema CTT</a>
     		 <ul id="nav-mobile" class="right hide-on-med-and-down">
       			 <li><a href="modules/logout.php"><i class=" material-icons">power_settings_new</i></a></li>
     		 </ul>
   		 </div>
  	</nav>
   
	 <div class="container">
		 <div class="row blue lighten-1 z-depth-3 registro-form card">
			<h2>Consultar Usuarios</h2>
			<form action="" method="post">
				<div class="row">
					<table class="centered">
					    <thead class="table-1">
					        <tr>
					        	<th data-field="nombre">Cedula</th>
					            <th data-field="nombre">Nombre</th>
					            <th data-field="apellido">Apellido</th>
					            <th data-field="correo">Correo</th>
					            <th data-field="contrasena">Contraseña</th>
					            <th data-field="perfil">Perfil</th>
					        </tr>
					    </thead>
					    <tbody class="table-2">
					        <?php 

					        	$sqlQuery = 'SELECT cedula, nombre, apellido, correo, password, tipoPerfil FROM usuario JOIN persona JOIN perfil ON idPersona = persona_idPersona AND idPerfil = perfil_idPerfil';
					        	$seccionFinded =  $connection->query($sqlQuery);
								if ($seccionFinded->num_rows != 0) {
									while ($seccion = $seccionFinded->fetch_assoc()) {
										echo "	<tr>
													<td>".$seccion['cedula']."</td>
							           				<td>".$seccion['nombre']."</td>
								            		<td>".$seccion['apellido']."</td>
								            		<td>".$seccion['correo']."</td>
								            		<td>".$seccion['password']."</td>
								            		<td>".$seccion['tipoPerfil']."</td>
						          				</tr>";
									}
								}else {
									echo "	<tr>
						         				<td colspan='5'>No hay registros</td>
					          				</tr>";
								}

					        ?>
					    </tbody>
					</table>
				</div>	  
			</form>
		</div>
	</div>
	
	<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script>
		  $(document).ready(function() {
		      $('select').material_select();
		  });
 	</script>
</body>
</html>