<?php
include 'config/db.php';
include 'templates/header.php';

// Verificar si se ha pasado un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar la consulta SQL para actualizar el estado a 'inactivo'
    $sql = "UPDATE at_movies SET status = 'inactive' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Movie marked as inactive successfully.";
    } else {
        echo "Error marking the movie as inactive: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid ID.";
}

$conn->close();
include 'templates/footer.php';
?>
