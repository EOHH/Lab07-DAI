<?php
include('../conexion/conexion.php');

$id = $_GET["id"];
$sql = "DELETE FROM autores WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: autores.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
