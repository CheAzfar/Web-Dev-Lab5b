<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="content">
            <div class="text">
                Registration Form
            </div>
            <form method="post" action="register.php">
                <div class="field">
                    <label for="matric">Matric:</label>
                    <input type="text" name="matric" required><br>
                </div>
                <div class="field">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required><br>
                </div>
                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required><br>
                </div>
                <div class="field">
                    <label for="role">Role:</label>
                    <select name="role" required>
                        <option value="" disabled selected>Please select</option>
                        <option value="student">Student</option>
                        <option value="lecture">Lecture</option>
                    </select><br>
                </div>
                <input type="submit" name="submit" value="Submit" class="button">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </body>
</html>

<?php
//database connection  
$con = mysqli_connect('localhost', 'root', '','Lab_5b');  

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
    
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $matric = mysqli_real_escape_string($con, $_POST['matric']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = mysqli_real_escape_string($con, $_POST['role']);

    // Insert data into `users` table
    $sql = "INSERT INTO `users` (`matric`, `name`, `password`, `role`) 
            VALUES ('$matric', '$name', '$password', '$role')";

    if (mysqli_query($con, $sql)) {
        echo "User registration inserted successfully";
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}