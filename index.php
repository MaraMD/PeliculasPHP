<?php
include 'config/db.php';
include 'templates/header.php';


$sql = "SELECT * FROM at_movies WHERE status = 'active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 class='my-4'>List of Movies</h2>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Title</th><th>Description</th><th>Release Date</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["release_date"] . "</td>";
        echo "<td>
                <a href='view.php?id=" . $row["id"] . "' class='btn btn-info btn-sm'>View</a>
                <a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No movies found.</p>";
}
?>
<div class="container mt-4">
    <h2>Listado de Películas</h2>
    <div class="form-group mb-4">
        <input type="text" id="search" class="form-control" placeholder="Buscar película...">
    </div>
    <div id="movie-list">
        <!-- Aquí se mostrarán las películas -->
    </div>
</div>

<?php
include 'templates/footer.php';
?>
<script>
document.getElementById('search').addEventListener('input', function() {
    const query = this.value;
    fetch('search.php?q=' + query)
        .then(response => response.json())
        .then(data => {
            const movieList = document.getElementById('movie-list');
            movieList.innerHTML = '';
            if (data.length > 0) {
                let table = '<table class="table table-striped"><thead><tr><th>Título</th><th>Descripción</th><th>Fecha de Estreno</th><th>Acciones</th></tr></thead><tbody>';
                data.forEach(movie => {
                    table += `<tr>
                                <td>${movie.title}</td>
                                <td>${movie.description}</td>
                                <td>${movie.release_date}</td>
                                <td>
                                    <a href='view.php?id=${movie.id}' class="btn btn-info btn-sm">Ver</a>
                                    <a href='edit.php?id=${movie.id}' class="btn btn-warning btn-sm">Editar</a>
                                    <a href='delete.php?id=${movie.id}' class="btn btn-danger btn-sm">Eliminar</a>
                                </td>
                              </tr>`;
                });
                table += '</tbody></table>';
                movieList.innerHTML = table;
            } else {
                movieList.innerHTML = '<p>No hay películas encontradas.</p>';
            }
        });
});
</script>
