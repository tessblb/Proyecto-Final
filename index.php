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
    <title>Epsylone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        a.text-decoration-none {
            color: #654321;
        }
    </style>
</head>
<body>
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
                        <a class="nav-link active" href="index.php">Home</a>
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
                        <a class="nav-link" href="about.php">About</a>
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
    </div>
    <div class="container">
        <br><br><br>
        <div class="custom">
            <h1>WELCOME TO EPSYLONE</h1>
        </div>
        <br><br>
        <h2>Espylone: Where every note begins.</h2>
        <h3>Your destination for quality musical instruments and inspiration.</h3><br><br>
        <section id="features">
            <div class="container">
                <header>
                    <h2>Take a look at our <strong>featured products</strong>!</h2>
                </header>
                <div class="row aln-center">
                    <div class="col-4 col-6-medium col-12-small">
                        <section>
                            <a href="guitar.php" class="image featured .img-fluid"><img src="pic01.jpg" alt=""></a>
                            <header>
                                <h3>Guitar/Bass</h3>
                            </header>
                            <p><strong>Guitar & Bass:</strong> iconic sound, timeless design, and unmatched quality for every musician.</p>
                        </section>
                    </div>

                    <div class="col-4 col-6-medium col-12-small">
                        <section>
                            <a href="piano.php" class="image featured .img-fluid"><img src="pic02.jpg" alt=""></a>
                            <header>
                                <h3>Piano</h3>
                            </header>
                            <p><strong>Piano:</strong> unlock your musical potential with our high-quality keyboards and pianos.</p>
                        </section>
                    </div>

                    <div class="col-4 col-6-medium col-12-small">
                        <section>
                            <a href="drums.php" class="image featured .img-fluid"><img src="pic03.jpg" alt=""></a>
                            <header>
                                <h3>Drums</h3>
                            </header>
                            <p><strong>Drums:</strong> powerful, dynamic, and made to deliver the rhythm you need.</p>
                        </section>
                    </div>
                </div>
            </div><br><br>
        <section id="features">
            <div class="container">
                <div class="row aln-center">
                    <div class="col-4 col-6-medium col-12-small">
                        <section>
                            <a href="PA.php" class="image featured .img-fluid"><img src="pic04.jpg" alt=""></a>
                            <header>
                                <h3>PA Equipment</h3>
                            </header>
                            <p><strong>PA Equipments:</strong> iconic sound, timeless design, and unmatched quality for every musician.</p>
                        </section>
                    </div>

                    <div class="col-4 col-6-medium col-12-small">
                        <section>
                            <a href="winds.php" class="image featured .img-fluid"><img src="pic05.jpg" alt=""></a>
                            <header>
                                <h3>Winds</h3>
                            </header>
                            <p><strong>Winds:</strong> unlock your musical potential with our high-quality keyboards and pianos.</p>
                        </section>
                    </div>

                    <div class="col-4 col-6-medium col-12-small">
                        <section>
                            <a href="violins.php" class="image featured .img-fluid"><img src="pic06.jpg" alt=""></a>
                            <header>
                                <h3>Strings</h3>
                            </header>
                            <p><strong>Strings:</strong> powerful, dynamic, and made to deliver the rhythm you need.</p>
                        </section>
                    </div>
                </div>
            </div>

        <br><br><br><br><br>
        <footer>
        <div class="container">
        <div class="row">
            <div class="col-6 text-end">
            <p>&copy; 2024 Epsylone Music Store. All rights reserved.</p>
            </div>
            <div class="col-6 text-start">
            <p>All of our products come from this <a href="https://www.thomann.de/fr/index.html" target="_blank" class="text-decoration-none">reference</a>.</p>
            </div>
        </div>
        </div>
        </footer>
    </div>
    </div>
</body>
</html>
