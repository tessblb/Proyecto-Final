<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

include("conexion.php");

// Récupération de l'ID du produit
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_producto <= 0) {
    die("Erreur : ID de produit non valide.");
}

// Requête pour récupérer les détails du produit
$query = "SELECT p.*, c.nombre AS nom_categorie 
          FROM productos p
          JOIN categoria c ON p.categoria = c.id_categoria
          WHERE p.id_producto = ?";
$stmt = $con->prepare($query);

if (!$stmt) {
    die("Erreur lors de la préparation de la requête : " . $con->error);
}

$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Erreur : produit non trouvé.");
}

$produit = $result->fetch_assoc();
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Produit</title>
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
    <class="container">
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

    <div class="container mt-5 pt-5">
        <h1><?php echo htmlspecialchars($produit['nombre']); ?></h1>
        <div class="row">
            <div class="col-md-6">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($produit['fotos']); ?>" alt="<?php echo htmlspecialchars($produit['nombre']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>Description</h3>
                <p><?php echo htmlspecialchars($produit['descripcion']); ?></p>
                <h4>Price : $<?php echo number_format($produit['precio'], 2); ?></h4>
                <h5>Stock : <?php echo $produit['cantidad']; ?></h5><br>
                <a href="carrito.php?add=<?php echo $produit['id_producto']; ?>" class="btn btn-primary">Add to cart</a>
            </div>
        </div>
    </div>
</body>
</html>
