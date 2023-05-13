<?php
include('../conexion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];

    $sql = "INSERT INTO autores (nombre, apellido_paterno, apellido_materno) VALUES ('$nombre', '$apellido_paterno', '$apellido_materno')";

    if ($conn->query($sql) === TRUE) {
        header("Location: autores.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Autor</title>
</head>
<body>
    <h1>Agregar nuevo autor</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <br>
        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" required>
        <br>
        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" required>
        <br>
        <input type="submit" value="Agregar">
    </form>
    <a href="autores.php">Volver a la lista de autores</a>
</body>
</html>

<?php
$conn->close();
?>
