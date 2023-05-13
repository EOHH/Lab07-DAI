<?php
include('../conexion/conexion.php');

$id = $_GET["id"];
$sql = "DELETE FROM libros WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: libros.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
