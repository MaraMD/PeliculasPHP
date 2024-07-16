<?php
include 'config/db.php';
include 'templates/header.php';

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha_estreno = $_POST["fecha_estreno"];
    $duracion = $_POST["duracion"];
    $idioma = $_POST["idioma"];
    $genero_id = $_POST["genero_id"];
    $director_id = $_POST["director_id"];

    $sql = "UPDATE at_movies SET title='$titulo', description='$descripcion', release_date='$fecha_estreno', 
            duration=$duracion, language='$idioma', genre_id=$genero_id, director_id=$director_id WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Movie updated successfully.";
    } else {
        echo "Error updating movie: " . $conn->error;
    }
}

$sql = "SELECT * FROM at_movies WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql_genres = "SELECT * FROM at_genres";
$result_genres = $conn->query($sql_genres);

$sql_directors = "SELECT * FROM at_directors";
$result_directors = $conn->query($sql_directors);
?>

<h2>Edit Movie</h2>
<form method="POST" action="edit.php?id=<?php echo $id; ?>">
    <label for="titulo">Title:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $row['title']; ?>" required><br>
    
    <label for="descripcion">Description:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo $row['description']; ?></textarea><br>
    
    <label for="fecha_estreno">Release Date:</label>
    <input type="date" id="fecha_estreno" name="fecha_estreno" value="<?php echo $row['release_date']; ?>" required><br>
    
    <label for="duracion">Duration (minutes):</label>
    <input type="number" id="duracion" name="duracion" value="<?php echo $row['duration']; ?>" required><br>
    
    <label for="idioma">Language:</label>
    <input type="text" id="idioma" name="idioma" value="<?php echo $row['language']; ?>" required><br>
    
    <label for="genero_id">Genre:</label>
    <select id="genero_id" name="genero_id" required>
        <?php while($genre = $result_genres->fetch_assoc()) { ?>
            <option value="<?php echo $genre['id']; ?>" <?php if($genre['id'] == $row['genre_id']) echo 'selected'; ?>><?php echo $genre['name']; ?></option>
        <?php } ?>
    </select><br>
    
    <label for="director_id">Director:</label>
    <select id="director_id" name="director_id" required>
        <?php while($director = $result_directors->fetch_assoc()) { ?>
            <option value="<?php echo $director['id']; ?>" <?php if($director['id'] == $row['director_id']) echo 'selected'; ?>><?php echo $director['name']; ?></option>
        <?php } ?>
    </select><br>
    
    <input type="submit" value="Update Movie">
</form>

<?php
include 'templates/footer.php';
?>
