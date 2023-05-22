<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform your login authentication logic here

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection details
    $servername = "localhost";
    $database = "tagpunosigninup";
    $usernameDB = "root"; // Default username for phpMyAdmin
    $passwordDB = ""; // Default password for phpMyAdmin (empty)

    // Create connection
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Set the session variable
            $_SESSION['username'] = $row['username'];

            // Redirect to home page
            header("Location: home.php");
            exit();
        } else {
            // Invalid password
            $error = "Wrong account/password";
            header("Location: index.html?error=" . urlencode($error));
            exit();
        }
    } else {
        // Invalid username
        $error = "Wrong account/password";
        header("Location: index.html?error=" . urlencode($error));
        exit();
    }

    $conn->close();
}
?>