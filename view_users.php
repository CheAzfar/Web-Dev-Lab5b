<!DOCTYPE html>
<html>
    <head>
        <title>View Users</title>
        <link rel="stylesheet" href="style.css">
        <style>
            table, th, td {
                border: 1px solid;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="text">
                Users List
            </div>
            <table>
                <div class="field">
                    <tr>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Action</th>
                    </tr>
                    <?php
                        // Database connection
                        $conn = new mysqli("localhost", "root", "", "Lab_5b");
                
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                
                        // Fetch data from the database
                        $sql = "SELECT matric, name, role FROM users";
                        $result = $conn->query($sql);
                
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['matric']) . "</td>
                                        <td>" . htmlspecialchars($row['name']) . "</td>
                                        <td>" . htmlspecialchars($row['role']) . "</td>
                                        <td>
                                            <div class='action-links'>
                                                <a href='update.php?matric=" . urlencode($row['matric']) . "'>Update</a>
                                                <a href='delete.php?matric=" . urlencode($row['matric']) . "' 
                                                onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                                            </div>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No users found</td></tr>";
                        }
                        $conn->close();
                    ?>
                </div>
            </table>
        </div>
    </body>
</html>
