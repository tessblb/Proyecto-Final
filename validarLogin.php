<?php
include("conexion.php");

$correo = mysqli_real_escape_string($con, $_POST['correo']);
$contrasena = mysqli_real_escape_string($con, $_POST['contrasena']);

$query = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    session_start();
    $usuario = mysqli_fetch_assoc($result);
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre'] = $usuario['nombre'];
    header("Location: dashboard.php");
} else {
    echo '<br><div class="alert alert-danger">Incorrect email or password. Please try again.</div>';
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f4f4f4;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #8B4513;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #6a3e19;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="text-center">Login</h2>
    <form action="validarLogin.php" method="POST">
        <div class="mb-3">
            <label for="correo" class="form-label">Email</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Password</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Login</button>
    </form>
    
    <div class="mt-3 text-center">
        <p>Don't have an account?</p>
        <a href="register.php" class="btn btn-custom w-100 mb-2">Register</a>
    </div>
</div>

</body>
</html>
