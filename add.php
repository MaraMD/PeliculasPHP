<?php
include 'config/db.php';
include 'templates/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $fecha_estreno = $_POST["fecha_estreno"];
    $duracion = $_POST["duracion"];
    $idioma = $_POST["idioma"];
    $genero_id = $_POST["genero_id"];
    $director_id = $_POST["director_id"];

    $sql = "INSERT INTO Peliculas (titulo, descripcion, fecha_estreno, duracion, idioma, genero_id, director_id) 
            VALUES ('$titulo', '$descripcion', '$fecha_estreno', $duracion, '$idioma', $genero_id, $director_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva película agregada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_generos = "SELECT * FROM Generos";
$result_generos = $conn->query($sql_generos);

$sql_directores = "SELECT * FROM Directores";
$result_directores = $conn->query($sql_directores);
?>

<h2>Agregar Nueva Película</h2>
<form method="POST" action="add.php">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required><br>
    
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea><br>
    
    <label for="fecha_estreno">Fecha de Estreno:</label>
    <input type="date" id="fecha_estreno" name="fecha_estreno" required><br>
    
    <label for="duracion">Duración (minutos):</label>
    <input type="number" id="duracion" name="duracion" required><br>
    
    <label for="idioma">Idioma:</label>
    <input type="text" id="idioma" name="idioma" required><br>
    
    <label for="genero_id">Género:</label>
    <select id="genero_id" name="genero_id" required>
        <?php while($row = $result_generos->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
        <?php } ?>
    </select><br>
    
    <label for="director_id">Director:</label>
    <select id="director_id" name="director_id" required>
        <?php while($row = $result_directores->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
        <?php } ?>
    </select><br>
    
    <input type="submit" value="Agregar Película">
</form>

<?php
include 'templates/footer.php';
?>
