<?php
include 'config/db.php';
include 'templates/header.php';

$sql = "SELECT * FROM Peliculas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Listado de Películas</h2>";
    echo "<table>";
    echo "<tr><th>Título</th><th>Descripción</th><th>Fecha de Estreno</th><th>Acciones</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["titulo"] . "</td>";
        echo "<td>" . $row["descripcion"] . "</td>";
        echo "<td>" . $row["fecha_estreno"] . "</td>";
        echo "<td>
                <a href='view.php?id=" . $row["id"] . "'>Ver</a>
                <a href='edit.php?id=" . $row["id"] . "'>Editar</a>
                <a href='delete.php?id=" . $row["id"] . "'>Eliminar</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No hay películas registradas.</p>";
}

include 'templates/footer.php';
?>


