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
} else {
    $admin['administrator'] = 0;
}

$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_producto <= 0) {
    die("Error: Invalid product ID.");
}

$query = "SELECT p.*, c.nombre AS category_name 
          FROM productos p
          JOIN categoria c ON p.categoria = c.id_categoria
          WHERE p.id_producto = ?";
$stmt = $con->prepare($query);

if (!$stmt) {
    die("Error preparing the query: " . $con->error);
}

$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Error: Product not found.");
}

$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'], $_POST['stars'])) {
    $comment = trim($_POST['comment']);
    $stars = intval($_POST['stars']);

    if ($stars >= 1 && $stars <= 5 && !empty($comment)) {
        $stmt = $con->prepare("INSERT INTO comentarios (id_producto, id_usuario, comment, stars) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $id_producto, $_SESSION['id_usuario'], $comment, $stars);

        if ($stmt->execute()) {
            $message = "<p class='text-success'>Your review has been submitted successfully!</p>";
        } else {
            $message = "<p class='text-danger'>Error: " . htmlspecialchars($stmt->error) . "</p>";
        }

        $stmt->close();
    } else {
        $message = "<p class='text-danger'>Please provide a valid rating and comment.</p>";
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .navbar {
            background-color: #8f8787;
            justify-content: space-between;
            height: 60px;
            display: flex;
            align-items: center;
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
        .review-section {
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Shop</a>
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

    <div class="container mt-5 pt-5">
        <h1><?php echo htmlspecialchars($product['nombre']); ?></h1>
        <div class="row">
            <div class="col-md-6">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($product['fotos']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>Description</h3>
                <p><?php echo htmlspecialchars($product['descripcion']); ?></p>
                <h4>Price: €<?php echo number_format($product['precio'], 2); ?></h4>
                <h5>Stock: <?php echo $product['cantidad']; ?></h5><br>
                <?php if ($product['cantidad'] > 0): ?>
                    <a href="carrito.php?add=<?php echo $product['id_producto']; ?>" class="btn btn-custom">Add to Cart</a>
                <?php else: ?>
                    <button class="btn btn-custom" disabled>Out of Stock</button>
                <?php endif; ?>

                <div class="review-section">
                    <?php if (isset($message)) echo $message; ?>
                    <h5>Leave a Review</h5>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="stars" class="form-label">Rating (1 to 5 stars)</label>
                            <select name="stars" id="stars" class="form-select" required>
                                <option value="" disabled selected>Select...</option>
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Comment</label>
                            <textarea name="comment" id="comment" rows="4" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h3>Reviews</h3>
            <?php
            $con = mysqli_connect('localhost', 'root', '', 'proyectoFinal');
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "SELECT u.nombre, c.comment, c.stars, c.date_creation 
                      FROM comentarios c
                      JOIN usuarios u ON c.id_usuario = u.id_usuario
                      WHERE c.id_producto = ?
                      ORDER BY c.date_creation DESC";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $id_producto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='mb-3'>";
                    echo "<h5>" . htmlspecialchars($row['nombre']) . " (" . $row['stars'] . " stars)</h5>";
                    echo "<p>" . htmlspecialchars($row['comment']) . "</p>";
                    echo "<small class='text-muted'>" . $row['date_creation'] . "</small>";
                    echo "</div>";
                }
            } else {
                echo "<p>No reviews for this product yet.</p>";
            }

            $stmt->close();
            mysqli_close($con);
            ?>
        </div>
        <br><br><br>
    </div>
</body>
</html>
