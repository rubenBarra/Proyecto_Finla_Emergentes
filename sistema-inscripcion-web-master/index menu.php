<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: iniciar_sesion.php');
    //header('Location: registro_profesor.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="css/estilos.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="sidebar">
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
                    <i class="bx bx-chat"></i>
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
                    <i class="bx bx-folder"></i>
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
                    <i class="bx bx-cart-alt"></i>
                    <span class="link_name">Compras</span>
                </a>
                <span class="tooltip">Order</span>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="link_name">Configuracion</span>
                </a>
                <span class="tooltip">Settings</span>
            </li>
            <li class="profile">
                
                <i class="bx bx-log-out" id="log_out"></i>
            </li>
        </ul>
    </div>
    
    <!-- Scripts -->
    <script src="js/script-menu.js"></script>
</body>

</html>