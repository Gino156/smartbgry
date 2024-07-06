

<?php

$servername = "localhost";
$username = "id21660325_dbuser";
$password = "1StrongP@ssw0rd"; 
$database = "id21660325_mydatabase";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

$conn->set_charset("utf8mb4");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>