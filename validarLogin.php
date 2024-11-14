<?php
include("conexion.php");

$correo = mysqli_real_escape_string($con, $_POST['correo']);
$contrasena = mysqli_real_escape_string($con, $_POST['contrasena']);

// Consulta para verificar si el usuario existe
$query = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    session_start();
    $usuario = mysqli_fetch_assoc($result);
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre'] = $usuario['nombre'];
    header("Location: dashboard.php"); // Redirige al dashboard o página principal
} else {
    echo '<br><div class="alert alert-danger">Correo o contraseña incorrectos. Inténtalo de nuevo.</div>';
}

mysqli_close($con);
?>
