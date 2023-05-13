<?php
include('../conexion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];

    $sql = "UPDATE autores SET nombre='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: autores.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$id = $_GET["id"];
$sql = "SELECT * FROM autores WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Autor</title>
</head>
<body>
    <h1>Editar autor</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $row["nombre"]; ?>" required>
        <br>
        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" value="<?php echo $row["apellido_paterno"]; ?>" required>
        <br>
        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" value="<?php echo $row["apellido_materno"]; ?>" required>
        <br>
        <input type="submit" value="Guardar cambios">
    </form>
    <a href="autores.php">Volver a la lista de autores</a>
</body>
</html>

<?php
$conn->close();
?>
