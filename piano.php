<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

include("conexion.php");

$query = "SELECT id_producto, fotos, nombre, precio FROM productos WHERE categoria = 2";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Erreur lors de la récupération des produits : " . mysqli_error($con));
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitars</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar {
            background-color: #8f8787;
        }
        .container {
            background-color: #f9f9f9;
        }
        .custom {
            background: linear-gradient(135deg, #8B4513, #D2B48C);
            color: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; 
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        h2 {
            text-align: center;
        }
        h3 {
            text-align: center;
        }
        .btn-custom {
            background-color: #8B4513;
            color: white;
            border: none;
            padding: 8px 15px;
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
    <!--Contenedor principal de BS5-->
    <div class="container">
        <!-- Grey with black text -->
        <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="index.php">
                            <img src="music.png" alt = "Tienda Logo" style="width: 40px;" class="rounded-pill">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Shop</a>
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

        <br><br><br>
        <div class = "custom">
            <h1>EPSYLONE's pianos</h1>
        </div>
        <br><br>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-3 text-center mb-4">
                    <a href="detalles.php?id=<?php echo $row['id_producto']; ?>" class="text-decoration-none">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['fotos']); ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>" class="img-fluid" style="max-height: 200px;">
                        <h5><?php echo htmlspecialchars($row['nombre']); ?></h5>
                        <p>Price: €<?php echo number_format($row['precio'], 2); ?></p>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
