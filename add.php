<?php
include 'config/db.php';
include 'templates/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $release_date = $_POST["release_date"];
    $duration = $_POST["duration"];
    $language = $_POST["language"];
    $genre_id = $_POST["genre_id"];
    $director_id = $_POST["director_id"];

    $sql = "INSERT INTO at_movies (title, description, release_date, duration, language, genre_id, director_id) 
            VALUES ('$title', '$description', '$release_date', $duration, '$language', $genre_id, $director_id)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'New movie added successfully.',
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

$sql_genres = "SELECT * FROM at_genres";
$result_genres = $conn->query($sql_genres);

$sql_directors = "SELECT * FROM at_directors";
$result_directors = $conn->query($sql_directors);
?>

<h2 class="my-4">Add New Movie</h2>
<form method="POST" action="add.php">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="release_date">Release Date:</label>
        <input type="date" class="form-control" id="release_date" name="release_date" required>
    </div>
    <div class="form-group">
        <label for="duration">Duration (minutes):</label>
        <input type="number" class="form-control" id="duration" name="duration" required>
    </div>
    <div class="form-group">
        <label for="language">Language:</label>
        <input type="text" class="form-control" id="language" name="language" required>
    </div>
    <div class="form-group">
        <label for="genre_id">Genre:</label>
        <select class="form-control" id="genre_id" name="genre_id" required>
            <?php while($genre = $result_genres->fetch_assoc()) { ?>
                <option value="<?php echo $genre['id']; ?>"><?php echo $genre['name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="director_id">Director:</label>
        <select class="form-control" id="director_id" name="director_id" required>
            <?php while($director = $result_directors->fetch_assoc()) { ?>
                <option value="<?php echo $director['id']; ?>"><?php echo $director['name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">
        <span class="material-icons">add</span> Add Movie
    </button>
</form>

<?php
include 'templates/footer.php';
?>
