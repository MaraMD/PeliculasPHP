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

    $sql = "UPDATE Peliculas SET titulo='$titulo', descripcion='$descripcion', fecha_estreno='$fecha_estreno', 
            duracion=$duracion, idioma='$idioma', genero_id=$genero_id, director_id=$director_id WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Película actualizada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM Peliculas WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql_generos = "SELECT * FROM Generos";
$result_generos = $conn->query($sql_generos);

$sql_directores = "SELECT * FROM Directores";
$result_directores = $conn->query($sql_directores);
?>

<h2>Editar Película</h2>
<form method="POST" action="edit.php?id=<?php echo $id; ?>">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $row['titulo']; ?>" required><br>
    
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo $row['descripcion']; ?></textarea><br>
    
    <label for="fecha_estreno">Fecha de Estreno:</label>
    <input type="date" id="fecha_estreno" name="fecha_estreno" value="<?php echo $row['fecha_estreno']; ?>" required><br>
    
    <label for="duracion">Duración (minutos):</label>
    <input type="number" id="duracion" name="duracion" value="<?php echo $row['duracion']; ?>" required><br>
    
    <label for="idioma">Idioma:</label>
    <input type="text" id="idioma" name="idioma" value="<?php echo $row['idioma']; ?>" required><br>
    
    <label for="genero_id">Género:</label>
    <select id="genero_id" name="genero_id" required>
        <?php while($genero = $result_generos->fetch_assoc()) { ?>
            <option value="<?php echo $genero['id']; ?>" <?php if($genero['id'] == $row['genero_id']) echo 'selected'; ?>><?php echo $genero['nombre']; ?></option>
        <?php } ?>
    </select><br>
    
    <label for="director_id">Director:</label>
    <select id="director_id" name="director_id" required>
        <?php while($director = $result_directores->fetch_assoc()) { ?>
            <option value="<?php echo $director['id']; ?>" <?php if($director['id'] == $row['director_id']) echo 'selected'; ?>><?php echo $director['nombre']; ?></option>
        <?php } ?>
    </select><br>
    
    <input type="submit" value="Actualizar Película">
</form>

<?php
include 'templates/footer.php';
?>
