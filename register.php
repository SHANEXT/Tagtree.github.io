<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform your registration logic here

    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
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
    $sql = "INSERT INTO users (full_name, contact_number, address, username, password) VALUES ('$name', '$contact_number', '$address', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        // Redirect to login page
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
