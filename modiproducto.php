<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

$admin_id = $_SESSION['id_usuario'];

$con = mysqli_connect('localhost', 'root', '', 'proyectoFinal');
if (!$con) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$queryadmin = "SELECT administrator FROM usuarios WHERE id_usuario = ?";
$stmtAdmin = $con->prepare($queryadmin);
$stmtAdmin->bind_param("i", $admin_id);
$stmtAdmin->execute();
$resultAdmin = $stmtAdmin->get_result();
$admin = $resultAdmin->fetch_assoc();
$stmtAdmin->close();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;

if ($id > 0) {
    $stmt = $con->prepare("SELECT * FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    if (empty($nombre) || empty($descripcion) || empty($categoria) || $precio < 0 || $cantidad < 0) {
        echo "<div class='alert alert-danger'>Veuillez remplir tous les champs correctement.</div>";
    } else {
        $update_stmt = $con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, categoria = ?, precio = ?, cantidad = ? WHERE id_producto = ?");
        $update_stmt->bind_param("sssiii", $nombre, $descripcion, $categoria, $precio, $cantidad, $id);

        if ($update_stmt->execute()) {
            echo "<div class='alert alert-success'>Product modification success!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error during modification: " . $update_stmt->error . "</div>";
        }
        $update_stmt->close();
    }
}

// Handle comment deletion
if (isset($_GET['delete_comment'])) {
    $comment_id = intval($_GET['delete_comment']);
    $stmtDelete = $con->prepare("DELETE FROM comentarios WHERE id = ?");
    $stmtDelete->bind_param("i", $comment_id);
    if ($stmtDelete->execute()) {
        echo "<div class='alert alert-success'>Comment deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting comment: " . $stmtDelete->error . "</div>";
    }
    $stmtDelete->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Modification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
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
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Administrator</a>
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
        <br><br><br><br>
    <div class="custom">
    <h2>Product Modification</h2>
    </div>
    <br>
    <?php if ($product): ?>
        <form method="POST" action="modiproducto.php?id=<?php echo $id; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Product name</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($product['nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Category</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo htmlspecialchars($product['categoria']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Description</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($product['descripcion']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Price</label>
                <input type="number" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($product['precio']); ?>" required min="0">
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($product['cantidad']); ?>" required min="0">
            </div>
            <button type="submit" class="btn btn-custom">Update Product</button>
        </form>
    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>

    <hr>

    <div class="mt-5">
        <h3>Comments</h3>
        <?php
        $stmt = $con->prepare("
            SELECT c.id, c.comment, c.stars, c.date_creation, u.nombre AS usuario_nombre 
            FROM comentarios c
            JOIN usuarios u ON c.id_usuario = u.id_usuario
            WHERE c.id_producto = ? 
            ORDER BY c.date_creation DESC
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($comment = $result->fetch_assoc()) {
                echo "<div class='review-section mb-4'>";
                echo "<h5>" . htmlspecialchars($comment['usuario_nombre']) . "</h5>";
                echo "<p>" . htmlspecialchars($comment['comment']) . "</p>";
                echo "<p>Stars: " . htmlspecialchars($comment['stars']) . "</p>";
                echo "<small>Posted on: " . htmlspecialchars($comment['date_creation']) . "</small><br>";
                echo "<a href='modiproducto.php?id=$id&delete_comment=" . $comment['id'] . "' class='btn btn-danger btn-sm mt-2'>Delete</a>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>Still no comments.</p>";
        }
        $stmt->close();
        ?>
    </div>
    <hr>
    <a href="inventario.php" class="btn btn-custom">Try from inventory</a><br><br>
</div>
</body>
</html>
