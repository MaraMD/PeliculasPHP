<?php
include 'config/db.php';
include 'templates/header.php';

$sql = "SELECT * FROM at_movies WHERE status = 'active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 class='my-4'>List of Movies</h2>";
    echo "<table class='table table-striped'>";
    echo "<thead><tr><th>Title</th><th>Description</th><th>Release Date</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["release_date"] . "</td>";
        echo "<td>
                <a href='view.php?id=" . $row["id"] . "' class='btn btn-info btn-sm'>View</a>
                <a href='edit.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<p>No movies found.</p>";
}

include 'templates/footer.php';
?>



