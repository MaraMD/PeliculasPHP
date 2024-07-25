<?php
include 'config/db.php';
include 'templates/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $birth_date = $_POST["birth_date"];
    $nationality = $_POST["nationality"];

    $sql = "INSERT INTO at_directors (name, birth_date, nationality) VALUES ('$name', '$birth_date', '$nationality')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New director added successfully.',
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
    <h2 class="my-4">Add New Director</h2>
    <form method="POST" action="add_director.php">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="birth_date">Birth Date:</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
        </div>
        <div class="form-group">
            <label for="nationality">Nationality:</label>
            <input type="text" class="form-control" id="nationality" name="nationality">
        </div>
        <button type="submit" class="btn btn-primary">Add Director</button>
    </form>
</div>

<?php
include 'templates/footer.php';
?>