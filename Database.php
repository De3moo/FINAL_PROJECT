<?php

$servername = "localhost:3306"; // e.g., "localhost" or "127.0.0.1"
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$database = "diary"; // your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    

// Note: It's a good practice to close the connection when you're done with it.
// $conn->close();

?>
