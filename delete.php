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
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Movie marked as inactive successfully.',
                }).then(function() {
                    window.location = 'index.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error marking movie as inactive: " . $conn->error . "',
                });
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Invalid ID.',
            }).then(function() {
                window.location = 'index.php';
            });
          </script>";
}

$conn->close();
include 'templates/footer.php';
?>
