<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mi biblioteca virtual - Libros</title>
    <style>
        /* Estilos para el encabezado */
        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }
        /* Estilos para el menú de navegación */
        nav {
            background-color: #333;
            overflow: hidden;
        }
        nav a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        nav a:hover {
            background-color: #ddd;
            color: black;
        }
        /* Estilos para el contenido principal */
        main {
            margin: 20px;
        }
        /* Estilos para el pie de página */
        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }
        /* Estilos para la tabla */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Estilos para los botones */
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
    <header>
        <h1>Mi biblioteca virtual</h1>
    </header>
    <nav>
        <a href="#">Inicio</a>
        <a href="../autores/autores.php">Autores</a>
        <a href="../libros/libros.php">Libros</a>
    </nav>
    <main>
        <h2>Lista de libros</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Editorial</th>
                <th>Año de publicación</th>
                <th>Especialidad</th>
                <th>URL de ubicación del recurso</th>
                <th>Acciones</th>
            </tr>
            <?php
            include('../conexion/conexion.php');

            $sql = "SELECT libros.id, libros.titulo, autores.nombre, autores.apellido_paterno, autores.apellido_materno, libros.editorial, libros.anio, libros.especialidad, libros.url_ubicacion_recurso FROM libros INNER JOIN autores ON libros.autor_id = autores.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["titulo"] . "</td>";
                    echo "<td>" . $row["nombre"] . " " . $row["apellido_paterno"] . " " . $row["apellido_materno"] . "</td>";
                    echo "<td>" . $row["editorial"] . "</td>";
                    echo "<td>" . $row["anio"] . "</td>";
                    echo "<td>" . $row["especialidad"] . "</td>";
                    echo "<td>" . $row["url_ubicacion_recurso"] . "</td>";
                    echo "<td>";
                    echo "<a href='editar_libro.php?id=" . $row["id"] . "' class='button'>Editar</a> ";
                    echo "<a href='eliminar_libro.php?id=" . $row["id"] . "' class='button'>Eliminar</a> ";
                    echo "<a href='" . $row["url_ubicacion_recurso"] . "' target='_blank' class='button'>Leer libro</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay libros registrados.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
        <a href="agregar_libro.php" class="button">Agregar nuevo libro</a>
    </main>
    <footer>
        <p>Derechos reservados &copy; 2023</p>
    </footer>
</body>
</html>
