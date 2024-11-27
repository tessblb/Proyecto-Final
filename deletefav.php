<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario']) || !isset($_GET['id'])) {
    header("Location: favorite.php");
    exit();
}

$user_id = $_SESSION['id_usuario'];
$id_producto = intval($_GET['id']);
$con = mysqli_connect('localhost', 'root', '', 'proyectoFinal');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "DELETE FROM favoritos WHERE id_usuario = ? AND id_producto = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $user_id, $id_producto);
$stmt->execute();
$stmt->close();
mysqli_close($con);

header("Location: favorite.php");
exit();
?>
