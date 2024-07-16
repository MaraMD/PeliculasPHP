<?php
include 'config/db.php';
include 'templates/header.php';

$sql = "SELECT * FROM at_movies WHERE status = 'active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>List of Movies</h2>";
    echo "<table>";
    echo "<tr><th>Title</th><th>Description</th><th>Release Date</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["release_date"] . "</td>";
        echo "<td>
                <a href='view.php?id=" . $row["id"] . "'>View</a>
                <a href='edit.php?id=" . $row["id"] . "'>Edit</a>
                <a href='delete.php?id=" . $row["id"] . "'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No movies registered.</p>";
}

include 'templates/footer.php';
?>



