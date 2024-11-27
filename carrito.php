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

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_GET['add'])) {
    $id_producto = intval($_GET['add']);
    if ($id_producto > 0) {
        $query = "SELECT * FROM productos WHERE id_producto = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $produit = $result->fetch_assoc();

            if (isset($_SESSION['carrito'][$id_producto])) {
                $_SESSION['carrito'][$id_producto]['quantity']++;
            } else {
                $_SESSION['carrito'][$id_producto] = [
                    'nom' => $produit['nombre'],
                    'prix' => $produit['precio'],
                    'quantity' => 1
                ];
            }
        }
    }

    header("Location: carrito.php");
    exit();
}


if (isset($_GET['remove'])) {
    $id_producto = intval($_GET['remove']);
    if (isset($_SESSION['carrito'][$id_producto])) {
        unset($_SESSION['carrito'][$id_producto]);
    }
}

$_SESSION['from_cart'] = true;
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
        <br><br><h1>Your shopping basket</h1>
        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Your shopping basket is empty.</p>
        <?php else: ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_general = 0;
                    foreach ($_SESSION['carrito'] as $id => $item): 
                        $total = $item['prix'] * $item['quantity'];
                        $total_general += $total;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nom']); ?></td>
                        <td>€<?php echo number_format($item['prix'], 2); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>€<?php echo number_format($total, 2); ?></td>
                        <td>
                            <a href="carrito.php?remove=<?php echo $id; ?>" class="btn btn-danger btn-sm">Delete</a>
                            <a href="favorite.php?add=<?php echo $id; ?>" class="btn btn-warning btn-sm">Move to favorite</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total : €<?php echo number_format($total_general, 2); ?></h3>
            <a href="checkout1.php" class="btn btn-custom">Go to checkout</a>
        <?php endif; ?>
        <br><br>
        <a href="index.php" class="btn btn-custom">Continue shopping</a>
    </div><br><br>
</body>
</html>
