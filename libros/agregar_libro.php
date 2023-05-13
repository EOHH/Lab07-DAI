<?php
include('../conexion/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $anio = $_POST["anio"];
    $autor_id = $_POST["autor_id"];
    $url_ubicacion_recurso = $_POST["url_ubicacion_recurso"];
    $especialidad = $_POST["especialidad"];
    $editorial = $_POST["editorial"];

    $sql = "INSERT INTO libros (titulo, anio, autor_id, url_ubicacion_recurso, especialidad, editorial) VALUES ('$titulo', '$anio', '$autor_id', '$url_ubicacion_recurso', '$especialidad', '$editorial')";

    if ($conn->query($sql) === TRUE) {
        header("Location: libros.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_autores = "SELECT * FROM autores";
$result_autores = $conn->query($sql_autores);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Libro</title>
</head>
<body>
    <h1>Agregar nuevo libro</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>
        <br>
        <label for="anio">Año:</label>
        <input type="number" name="anio" required>
        <br>
        <label for="autor_id">Autor:</label>
        <select name="autor_id" required>
            <?php
            if ($result_autores->num_rows > 0) {
                while($row = $result_autores->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . " " . $row["apellido_paterno"] . " " . $row["apellido_materno"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay autores registrados.</option>";
            }
            ?>
        </select>
        <br>
        <label for="url_ubicacion_recurso">URL de ubicación del recurso:</label>
        <input type="text" name="url_ubicacion_recurso" required>
        <br>
        <label for="especialidad">Especialidad:</label>
        <input type="text" name="especialidad" required>
        <br>
        <label for="editorial">Editorial:</label>
        <input type="text" name="editorial" required>
        <br>
        <input type="submit" value="Agregar">
    </form>
    <a href="libros.php">Volver a la lista de libros</a>
</body>
</html>

<?php
$conn->close();
?>
