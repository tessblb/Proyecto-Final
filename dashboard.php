<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar {
            background-color: #8f8787;
        }
        .btn-custom {
            background-color: #8B4513;
            color: white;
            border: none;
            padding: 5px 15px;
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
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="music.png" alt="Tienda Logo" style="width: 40px;" class="rounded-pill">
            </a>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Shop</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="guitar.php">Guitars</a></li>
                            <li><a class="dropdown-item" href="piano.php">Pianos</a></li>
                            <li><a class="dropdown-item" href="drums.php">Drums</a></li>
                        </ul>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item">
                    <span class="navbar-text text-white me-3">Hello, <?php echo $_SESSION['nombre']; ?>!</span>
                </li>
                <form class="d-flex" action="buscar.php" method="GET">
                    <input class="form-control me-2" type="text" name="nombre" placeholder="Search">
                    <button class="btn btn-custom" type="submit">Search</button>
                </form>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Close Session</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 80px;">
        <h2>Welcome, <?php echo $_SESSION['nombre']; ?></h2>
        <p>You registered correctly.</p>
    </div>
</body>
</html>

