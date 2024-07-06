<?php
ob_start();
$host = "localhost";
$dbname = "id21660325_mydatabase";
$username = "id21660325_dbuser";
$password = "1StrongP@ssw0rd";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);

$events = array();
if ($result) {
    // Fetch events from the database
    while ($row = $result->fetch_assoc()) {
        // Prepend 'uploads/' to event_image field
        $row['event_image'] = 'uploads/' . $row['event_image'];
        $events[] = $row;
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

// Output JSON encoded array of events
echo json_encode($events);
?>
