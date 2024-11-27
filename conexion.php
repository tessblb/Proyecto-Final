<?php
$con = mysqli_connect("localhost", "root", "", "proyectoFinal"); 

if (mysqli_connect_errno()) {
    echo "<p>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
}
?>