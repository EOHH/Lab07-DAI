<?php
include('../conexion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $anio = $_POST["anio"];
    $autor_id = $_POST["autor_id"];
    $url_ubicacion_recurso = $_POST["url_ubicacion_recurso"];
    $especialidad = $_POST["especialidad"];
    $editorial = $_POST["editorial"];

    $sql = "UPDATE libros SET titulo='$titulo', anio='$anio', autor_id='$autor_id', url_ubicacion_recurso='$url_ubicacion_recurso', especialidad='$especialidad', editorial='$editorial' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: libros.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$id = $_GET["id"];
$sql = "SELECT * FROM libros WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql_autores = "SELECT * FROM autores";
$result_autores = $conn->query($sql_autores);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Libro</title>
</head>
<body>
    <h1>Editar libro</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?php echo $row["titulo"]; ?>" required>
        <br>
        <label for="anio">Año:</label>
        <input type="number" name="anio" value="<?php echo $row["anio"]; ?>" required>
        <br>
        <label for="autor_id">Autor:</label>
        <select name="autor_id" required>
            <?php
            if ($result_autores->num_rows > 0) {
                while($row_autores = $result_autores->fetch_assoc()) {
                    if ($row_autores["id"] == $row["autor_id"]) {
                        echo "<option value='" . $row_autores["id"] . "' selected>" . $row_autores["nombre"] . " " . $row_autores["apellido_paterno"] . " " . $row_autores["apellido_materno"] . "</option>";
                    } else {
                        echo "<option value='" . $row_autores["id"] . "'>" . $row_autores["nombre"] . " " . $row_autores["apellido_paterno"] . " " . $row_autores["apellido_materno"] . "</option>";
                    }
                }
            } else {
                echo "<option value=''>No hay autores registrados.</option>";
            }
            ?>
        </select>
        <br>
        <label for="url_ubicacion_recurso">URL de ubicación del recurso:</label>
        <input type="text" name="url_ubicacion_recurso" value="<?php echo $row["url_ubicacion_recurso"]; ?>" required>
        <br>
        <label for="especialidad">Especialidad:</label>
        <input type="text" name="especialidad" value="<?php echo $row["especialidad"]; ?>" required>
        <br>
        <label for="editorial">Editorial:</label>
        <input type="text" name="editorial" value="<?php echo $row["editorial"]; ?>" required>
        <br>
        <input type="submit" value="Guardar cambios">
    </form>
    <a href="libros.php">Volver a la lista de libros</a>
</body>
</html>

<?php
$conn->close();
?>
