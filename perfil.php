<?php

session_start();

if (!isset($_SESSION['loggedin'])){

    header('location: index.html');
    exit;
}


$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login-php';

//**Nos conectaremos a la Base De Datos */
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()){
//**Si hay algún error al conectarnos a la Base De Datos, se mostrará el siguiente mensaje */
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//**Preparamos la consulta para seleccionar los datos del usuario */
$smt = $con->prepare('SELECT password, email, name FROM accounts WHERE id = ?');

//**Unimos los parámetros de la consulta con el id del usuario */
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Médicas Alpha V.:::0.1:::..</title>
    <link rel="stylesheet" href="/css/style.css"
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="loggedin">
    <nav class="navtop">
        <h1 style="color:white;">Sistema de Control Fichas Médicas</h1>
        a href="inicio.php" style="color:white;">Inicio</a>
        <a href="perfil.php" style="color:white;"><i class="fas fa-user-circle"></i>Información de Usuario</a>
        <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesion</a>
    </nav>
    <div class="content">
    <h2>Información del Usuario</h2>
        <div>
            <p>
                La siguiente es la información registrada de tu cuenta
            </p>
            <table>
                <tr>
                    <td>Usuario:</td>
                    <td><?= $_SESSION['name'] ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?= $email ?></td>
                </tr>
            </table>



        </div>


    </div>



    </nav>

</body>

</html>







