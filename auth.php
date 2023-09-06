<?php
session_start ();



//**Aquí Agregamos los Datos de nuestra Base de Datos */

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'login-php';


//**En esta sección se establece la conexión con la Base de Datos */
$conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
    
    die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//**Procedemos a validad la información , con la función isset */
if ( !isset($_POST['username'], $_POST['password']) ) {

    header('Location: index.html');
}

//**Creamos la primera capa de seguridad para Evitar la Inyección de SQL */
if ($stmt = $conexion->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        
        if (password_verify($_POST['password'], $password)) {
            
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: home.php');
        } else {
            echo 'Incorrect username and/or password!';
        }
    } else {
        echo 'Incorrect username and/or password!';
    }
    
    $stmt->close();
}
//**Aquí validamos si coincide con la Base de Datos */
$stmt->store_result();
if ($stmt->num_rows > 0) {
    
    $stmt->bind_result($id, $password);
    $stmt->fetch();
    
    if (password_verify($_POST['password'], $password)) {
        
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;
        header('Location: home.php');
    } else {
        echo 'Incorrect username and/or password!';
    }
} else {
    echo 'Incorrect username and/or password!';
}
$stmt->close();
