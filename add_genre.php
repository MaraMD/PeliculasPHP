<?php
include 'config/db.php';
include 'templates/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];

    $sql = "INSERT INTO at_genres (name, description) VALUES ('$name', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New genre added successfully.',
                }).then(function() {
                    window.location = 'index.php';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error: " . $conn->error . "',
                });
              </script>";
    }
}
?>

<div class="container">
    <h2 class="my-4">Add New Genre</h2>
    <form method="POST" action="add_genre.php">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Genre</button>
    </form>
</div>

<?php
include 'templates/footer.php';
?>