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

$user_id = $_SESSION['id_usuario'];

$con = mysqli_connect('localhost', 'root', '', 'proyectoFinal');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['add'])) {
    $id_producto = intval($_GET['add']);

    if ($id_producto > 0) {
        $query_check_fav = "SELECT * FROM favoritos WHERE id_usuario = ? AND id_producto = ?";
        $stmt_check = $con->prepare($query_check_fav);
        $stmt_check->bind_param("ii", $user_id, $id_producto);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows === 0) {
            $query_add_fav = "INSERT INTO favoritos (id_usuario, id_producto) VALUES (?, ?)";
            $stmt_add = $con->prepare($query_add_fav);
            $stmt_add->bind_param("ii", $user_id, $id_producto);
            $stmt_add->execute();
            $message = "Product added to favorites !";
        } else {
            $message = "This product was already in your favorites";
        }
    }
}
$query = "SELECT f.id_producto, p.nombre, p.precio 
          FROM favoritos f
          JOIN productos p ON f.id_producto = p.id_producto
          WHERE f.id_usuario = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$favoritos = [];
while ($row = $result->fetch_assoc()) {
    $favoritos[] = $row;
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites</title>
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
    <div class="container mt-5">
        <h1>My Favorites</h1>
            <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <?php if (empty($favoritos)): ?>
            <p>You have no favorite items.</p>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($favoritos as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td>€<?php echo number_format($item['precio'], 2); ?></td>
                        <td>
                            <a href="detalles.php?id=<?php echo $item['id_producto']; ?>" class="btn btn-info btn-sm">View</a>
                            <a href="deletefav.php?id=<?php echo $item['id_producto']; ?>" class="btn btn-danger btn-sm">Remove</a>
                            <a href="carrito.php?add=<?php echo $item['id_producto']; ?>" class="btn">
                                <img src="carrit.png" alt="Carrito" style="width: 40px; height: auto;">
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="index.php" class="btn btn-custom">Back to Home</a><br><br>
    </div>
</body>
</html>
