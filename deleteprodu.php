<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    echo "The user is not logged in. Redirecting to the login page...";
    header("Location: login.html");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    echo "Received ID: $id<br>";

    $con = mysqli_connect('localhost', 'root', '', 'proyectoFinal');
    if (!$con) {
        die("Connection error: " . mysqli_connect_error());
    } else {
        echo "Successfully connected to the database!<br>";
    }

    echo "Deleting associated records in 'favoritos'...<br>";
    $stmt = $con->prepare("DELETE FROM favoritos WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo "Error deleting from 'favoritos': " . $stmt->error . "<br>";
        mysqli_close($con);
        exit();
    }
    echo "Successfully deleted from 'favoritos'.<br>";
    $stmt->close();

    echo "Deleting associated records in 'historial'...<br>";
    $stmt = $con->prepare("DELETE FROM historial WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo "Error deleting from 'historial': " . $stmt->error . "<br>";
        mysqli_close($con);
        exit();
    }
    echo "Successfully deleted from 'historial'.<br>";
    $stmt->close();

    echo "Deleting product from 'productos'...<br>";
    $stmt = $con->prepare("DELETE FROM productos WHERE id_producto = ?");
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo "Error deleting the product: " . $stmt->error . "<br>";
        mysqli_close($con);
        exit();
    }
    echo "Product successfully deleted from 'productos'.<br>";
    $stmt->close();

    mysqli_close($con);

    echo "Redirecting to inventario.php...<br>";
    header("Location: inventario.php");
    exit();
} else {
    echo "Invalid or missing ID. Redirecting to inventario.php...<br>";
    header("Location: inventario.php");
    exit();
}
?>
