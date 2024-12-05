<!DOCTYPE html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content">
        <div class="text">
            Login Form
        </div>
        <form method="post" action="login.php">
            <div class="field">
                <label for="matric">Matric:</label>
                <input type="text" name="matric" required><br>
            </div>
            <div class="field">
                <label for="password">Password:</label>
                <input type="password" name="password" required><br>
            </div>

            <input type="submit" name="submit" value="Submit" class="button"><br><br>

            <p><a href="register.php">Register</a> here if you have not.</p>
        </form>
    </div>
</body>

<?php

// Database connection
$conn = new mysqli("localhost", "root", "", "Lab_5b");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $matric = $conn->real_escape_string(trim($_POST['matric']));
    $password = $_POST['password']; // We leave the password as it is for later hashing verification

    if (!empty($matric) && !empty($password)) {
        // Query to fetch user details
        $sql = "SELECT * FROM users WHERE matric = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                session_start(); // Start the session
                $_SESSION['user'] = [
                    'name' => $user['name'],
                    'role' => $user['role'], // Optional: include more details if required
                ];
                header("Location: view_users.php");
                exit;
            } else {
                echo "Invalid username or password. Try again.";
            }
        } else {
            echo "Invalid username or password. Try again.";
        }

        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
}

// Close database connection
$conn->close();
?>