<?php
include 'config/db.php';
include 'templates/header.php';

$id = $_GET["id"];

$sql = "SELECT * FROM Peliculas WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql_genero = "SELECT nombre FROM Generos WHERE id=" . $row["genero_id"];
$result_genero = $conn->query($sql_genero);
$genero = $result_genero->fetch_assoc();

$sql_director = "SELECT nombre FROM Directores WHERE id=" . $row["director_id"];
$result_director = $conn->query($sql_director);
$director = $result_director->fetch_assoc();
?>

<h2>Detalles de la Película</h2>
<p><strong>Título:</strong> <?php echo $row["titulo"]; ?></p>
<p><strong>Descripción:</strong> <?php echo $row["descripcion"]; ?></p>
<p><strong>Fecha de Estreno:</strong> <?php echo $row["fecha_estreno"]; ?></p>
<p><strong>Duración:</strong> <?php echo $row["duracion"]; ?> minutos</p>
<p><strong>Idioma:</strong> <?php echo $row["idioma"]; ?></p>
<p><strong>Género:</strong> <?php echo $genero["nombre"]; ?></p>
<p><strong>Director:</strong> <?php echo $director["nombre"]; ?></p>

<?php
include 'templates/footer.php';
?>
