<?php
$servername = "localhost";
$username = "id21660325_dbuser";
$password = "1StrongP@ssw0rd"; 
$database = "id21660325_mydatabase";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM events WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Event deleted successfully";
} else {
    echo "Error deleting event: " . $conn->error;
}

$conn->close();

header("Location: manage-events.php");
exit();