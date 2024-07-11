<?php
include 'config/db.php';

$id = $_GET["id"];

$sql = "DELETE FROM Peliculas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Película eliminada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: index.php");
?>
