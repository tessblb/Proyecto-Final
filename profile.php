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

$admin_id = $_SESSION['id_usuario'];

$con = mysqli_connect('localhost', 'root', '', 'proyectoFinal');
if (!$con) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$user_id = $_SESSION['id_usuario'];
$user = null;

$stmt = $con->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $nacimiento = $_POST['nacimiento'];
    $tarjeta = $_POST['tarjeta'];
    $direccion = $_POST['direccion'];

    if (empty($nombre) || empty($correo) || empty($contrasena) || empty($nacimiento) || empty($tarjeta) || empty($direccion)) {
        echo "<div class='alert alert-danger'>Please fill in all fields correctly.</div>";
    } else {
        $update_stmt = $con->prepare("UPDATE usuarios SET nombre = ?, correo = ?, contrasena = ?, nacimiento = ?, tarjeta = ?, direccion = ? WHERE id_usuario = ?");
        $update_stmt->bind_param("ssssssi", $nombre, $correo, $contrasena, $nacimiento, $tarjeta, $direccion, $user_id);

        if ($update_stmt->execute()) {
            echo "<br><br><br><div class='alert alert-success container'>Informations modified successfully !</div>";
        } else {
            echo "<div class='alert alert-danger'>Error : " . $update_stmt->error . "</div>";
        }
        $update_stmt->close();
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <div class="row">
        <div class="col-md-8">
            <h2>Modification of your infos</h2>
            <?php if ($user): ?>
                <form method="POST" action="profile.php">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Email</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($user['correo']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Password</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo htmlspecialchars($user['contrasena']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nacimiento" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="nacimiento" name="nacimiento" value="<?php echo htmlspecialchars($user['nacimiento']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tarjeta" class="form-label">Bankcard</label>
                        <input type="text" class="form-control" id="tarjeta" name="tarjeta" value="<?php echo htmlspecialchars($user['tarjeta']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Address</label>
                        <textarea class="form-control" id="direccion" name="direccion" required><?php echo htmlspecialchars($user['direccion']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom">Save changes</button>
                </form>
            <?php else: ?>
                <div class="alert alert-danger">User not found.</div>
            <?php endif; ?>
        </div>

        <div class="col-md-4 d-flex flex-column align-items-center">
            <img src="music.png" alt="Epsylone logo" class="rounded-pill" style="width: 300px;">
            <a href="historial.php" class="btn btn-custom mb-3 w-100">Go to purchase history</a>
            <a href="favorite.php" class="btn btn-custom mb-3 w-100">Go to favorites</a>
            <a href="carrito.php" class="btn btn-custom mb-3 w-100">Go to cart</a>
        </div>
    </div>
</div>



</body>
</html>
