<?php
//**Confirmamos la sesión */
session_start();

if (!isset($_SESSION['loggedin'])){

    header('location: index.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="loggedin">
    <nav class="navtop">
        <h1 style="color: white;">Sistema de control de Fichas Médicas</h1>
        <a href="perfil.php"><i class="fas fa-user-circle"></i>Perfil</a>
        <a href="cerrar-sesion.php"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
    </nav>

    <div class="content">
        <h2>Inicio</h2>
        <p>Bienvenido, <?=$_SESSION['name']?>!</p>
    </div>
</body>


</html>
