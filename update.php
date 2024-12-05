<!DOCTYPE html>
<html>
    <head>
        <title>Update Form</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="content">
            <div class="text">
                Update User
            </div>
            <form method="post" action="update.php">
                <div class="field">
                    <label for="matric">Matric:</label>
                    <input type="text" name="matric" required><br>
                </div>
                <div class="field">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required><br>
                </div>
    
                <div class="field">
                    <label for="role">Access Level:</label>
                <select name="role" required>
                    <option value="" disabled selected>Please select</option>
                    <option value="student">Student</option>
                    <option value="lecture">Lecture</option>
                </select><br>
                </div>
    
                <input type="submit" name="submit" value="Update" class="button">
                <a href="view_users.php">Cancel</a>
            </form>
        </div>
    </body>
</html>

<?php
// Database connection
$con = mysqli_connect('localhost', 'root', '', 'Lab_5b');

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $matric = mysqli_real_escape_string($con, $_POST['matric']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    // Update the `users` table with new values
    $sql = "UPDATE `users` 
            SET `name` = '$name', `role` = '$role' 
            WHERE `matric` = '$matric'";

    if (mysqli_query($con, $sql)) {
        if (mysqli_affected_rows($con) > 0) {
            echo "User data updated successfully.";
        } else {
            echo "No matching record found for the given Matric.";
        }
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>
