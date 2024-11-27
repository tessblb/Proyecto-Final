<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

if (isset($_SESSION['id_usuario'])) {
    $admin_id = $_SESSION['id_usuario'];
    $con = mysqli_connect('localhost', 'root', '', 'proyectoFinal');


if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$queryadmin = "SELECT administrator FROM usuarios WHERE id_usuario = $admin_id";
$resultadmin = mysqli_query($con, $queryadmin);

if (!$resultadmin) {
    die("Error: " . mysqli_error($con));
}

$admin = mysqli_fetch_assoc($resultadmin);

var_dump($admin);
} else {
    $admin['administrator'] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php">
                            <img src="music.png" alt="Tienda Logo" style="width: 40px;" class="rounded-pill">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="guitar.php">Guitars</a></li>
                            <li><a class="dropdown-item" href="piano.php">Pianos</a></li>
                            <li><a class="dropdown-item" href="drums.php">Drums</a></li>
                            <li><a class="dropdown-item" href="PA.php">PA Equipment</a></li>
                            <li><a class="dropdown-item" href="winds.php">Winds</a></li>
                            <li><a class="dropdown-item" href="violins.php">Strings</a></li>
                            <li><a class="dropdown-item" href="shop.php">All of our products</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">About</a>
                    </li>
                    <?php if ($admin['administrator'] == 1): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Administrator</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="inventario.php">Inventory</a></li>
                            <li><a class="dropdown-item" href="newproducto.php">Add a product</a></li>
                            <li><a class="dropdown-item" href="modiproducto.php">Modify a product</a></li>
                            <li><a class="dropdown-item" href="usuarios.php">Users</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>

                <form class="navbar-nav ms-auto d-flex align-items-center" action="buscar.php" method="GET">
                    <input class="form-control me-2" type="text" name="nombre" placeholder="Search">
                    <button class="btn btn-custom" type="submit">Search</button>
                </form>

                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="profile.php">
                            <img src="profile.png" alt="Profile" style="width: 30px;">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="favorite.php">
                            <img src="favorite.png" alt="Favorites" style="width: 30px;">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white position-relative" href="carrito.php">
                            <img src="carrit.png" alt="Cart" style="width: 50px; height: auto;">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br><br><br>
        <h2 class="custom">ESLYONE: Where every note begins.</h2>
        <div class="photo">
            <img src="foto.png">
        </div>
        <div class="container">
        <p id="present"><i>Hello! I'm Tess Buchet Le Bihan, an engineering student at ESME Sudria University (France)
            and currently on an exchange program at Anáhuac Mexico Norte.</i></p>
        <p id="present"><i>I'm also passionate about music, and you can find a link to my YouTube channel below.</i></p>
            <br><br>
            <h2 id="enca2">Information About Me</h2>
            <ul>
                <li><b>Name:</b> Tess Buchet Le Bihan</li>
                <li><b>Email:</b> <a href="mailto:tess.buchetle@anahuac.mx" class="text-decoration-none">tess.buchetle@anahuac.mx</a></li>
                <li><b>Phone number:</b> <a href="tel:+525611478231"></a>+52 56 1147 8231</li>
                <li><b>Address:</b> París (Francia), Ciudad de México (México)</li>
                <li><b>Studies:</b> <a href="https://www.esme.fr/en/" target="_blank" class="text-decoration-none">ESME Sudria, </a><a href="https://www.anahuac.mx" target="_blank" class="text-decoration-none">Anáhuac Mexico</a></li>
            </ul>
            <br><br>
            <h2 id="enca2">Social Networks</h2>
            <ul>
                <li><a href="https://linkedin.com/in/tess-buchet-le-bihan-6695b2222" target="_blank" class="text-decoration-none">LinkedIn</a></li>
                <li><a href="https://www.youtube.com/@tessblb" target="_blank" class="text-decoration-none">Youtube</a></li>
            </ul>

            <br><br>
            <button class="btn btn-custom" type="submit">Continue Shopping</button>
            <br><br>
        </div>
    
</body>
</html>
