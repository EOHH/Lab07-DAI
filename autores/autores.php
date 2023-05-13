<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mi biblioteca virtual - Autores</title>
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
        <h2>Lista de autores</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Acciones</th>
            </tr>
            <?php
            include('../conexion/conexion.php');

            $sql = "SELECT * FROM autores";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["apellido_paterno"] . "</td>";
                    echo "<td>" . $row["apellido_materno"] . "</td>";
                    echo "<td>";
                    echo "<a href='editar_autor.php?id=" . $row["id"] . "' class='button'>Editar</a> ";
                    echo "<a href='eliminar_autor.php?id=" . $row["id"] . "' class='button'>Eliminar</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay autores registrados.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
        <a href="agregar_autor.php" class="button">Agregar nuevo autor</a>
    </main>
    <footer>
        <p>Derechos reservados &copy; 2023</p>
    </footer>
</body>
</html>
