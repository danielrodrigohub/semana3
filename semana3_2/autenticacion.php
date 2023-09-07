<?php
session_start();


//**Aquí conectamos nuestra Base de Datos */

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login-php';

// Creamos la conexión a la Base de Datos

$conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {

//**Verifica si está conectada la Base de Datos con el Servidor */

    exit('Fallo en la conexión de MySQL:' . mysqli_connect_error());
}

// Se valida si se ha enviado información, con la función isset()

if (!isset($_POST['username'], $_POST['password'])) {

    // si no hay datos muestra error y re direccionar

    header('Location: index.html');
}

// Evitemamos que se haga una inyección de SQL

if ($stmt = $conexion->prepare('SELECT id,password FROM accounts WHERE username = ?')) {



    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
}


//**Se realiza la validación de Datos */
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $password);
    $stmt->fetch();


    if ($_POST['password'] === $password) {

        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('Location: inicio.php');
    }
} else {

//**En caso de que el usuario es Incorrecto */
$_SESSION['login_error'] = true;
header('Location: index.html');
}

$stmt->close();
