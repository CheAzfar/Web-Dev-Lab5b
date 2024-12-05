<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "Lab_5b");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the user based on matric
if (isset($_GET['matric'])) {
    $matric = $conn->real_escape_string($_GET['matric']);

    $sql = "DELETE FROM users WHERE matric = '$matric'";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_users.php");
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

$conn->close();
?>
