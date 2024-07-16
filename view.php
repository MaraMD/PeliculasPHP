<?php
include 'config/db.php';
include 'templates/header.php';

$id = $_GET["id"];

$sql = "SELECT * FROM at_movies WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sql_genre = "SELECT name FROM at_genres WHERE id=" . $row["genre_id"];
$result_genre = $conn->query($sql_genre);
$genre = $result_genre->fetch_assoc();

$sql_director = "SELECT name FROM at_directors WHERE id=" . $row["director_id"];
$result_director = $conn->query($sql_director);
$director = $result_director->fetch_assoc();
?>

<h2>Movie Details</h2>
<p><strong>Title:</strong> <?php echo $row["title"]; ?></p>
<p><strong>Description:</strong> <?php echo $row["description"]; ?></p>
<p><strong>Release Date:</strong> <?php echo $row["release_date"]; ?></p>
<p><strong>Duration:</strong> <?php echo $row["duration"]; ?> minutes</p>
<p><strong>Language:</strong> <?php echo $row["language"]; ?></p>
<p><strong>Genre:</strong> <?php echo $genre["name"]; ?></p>
<p><strong>Director:</strong> <?php echo $director["name"]; ?></p>

<?php
include 'templates/footer.php';
?>
