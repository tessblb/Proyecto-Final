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

if (empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

$total_general = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total_general += floatval($item['prix']) * intval($item['quantity']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Step 1</title>
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
<br>
        <div class="container mt-5">
            <h1>Delivery & Payment Information</h1>
            <form action="checkout.php" method="POST">
                <div class="mb-3">
                    <label for="address" class="form-label">Delivery Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select class="form-select" id="payment_method" name="payment_method" required>
                        <option value="" disabled selected>Choose</option>
                        <option value="credit_card">Credit Card</option>
                    </select>
                </div>

                <div id="credit_card_info" style="display:none;">
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="card_number" name="card_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Expiry Date (MM/YY)</label>
                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" name="cvv" required>
                    </div>
                </div>

                <h3>Total: €<?php echo number_format($total_general, 2); ?></h3>
                <button type="submit" class="btn btn-custom">Proceed to Payment</button>
            </form>

            <a href="carrito.php" class="btn btn-secondary mt-3">Back to Cart</a><br><br>
        </div>
    </div>

    <script>
        document.getElementById('payment_method').addEventListener('change', function () {
            var paymentMethod = this.value;
            var creditCardInfo = document.getElementById('credit_card_info');

            creditCardInfo.style.display = 'none';

            if (paymentMethod === 'credit_card') {
                creditCardInfo.style.display = 'block'; 
            }
        });
    </script>
</body>
</html>
