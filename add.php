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
        echo "New movie added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_genres = "SELECT * FROM at_genres";
$result_genres = $conn->query($sql_genres);

$sql_directors = "SELECT * FROM at_directors";
$result_directors = $conn->query($sql_directors);
?>

<h2>Add New Movie</h2>
<form method="POST" action="add.php">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required><br>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>
    
    <label for="release_date">Release Date:</label>
    <input type="date" id="release_date" name="release_date" required><br>
    
    <label for="duration">Duration (minutes):</label>
    <input type="number" id="duration" name="duration" required><br>
    
    <label for="language">Language:</label>
    <input type="text" id="language" name="language" required><br>
    
    <label for="genre_id">Genre:</label>
    <select id="genre_id" name="genre_id" required>
        <?php while($row = $result_genres->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select><br>
    
    <label for="director_id">Director:</label>
    <select id="director_id" name="director_id" required>
        <?php while($row = $result_directors->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select><br>
    
    <input type="submit" value="Add Movie">
</form>

<?php
include 'templates/footer.php';
?>
