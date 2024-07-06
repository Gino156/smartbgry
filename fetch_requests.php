<?php
$servername = "localhost";
$username = "id21660325_dbuser";
$password = "1StrongP@ssw0rd"; 
$database = "id21660325_mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$responses = [];

$tables = ["indigency_request", "clearance_request", "residency_request", "soloparent_request"];

foreach ($tables as $table) {
    $document_type = ucfirst(str_replace('_', ' ', $table)); // Construct document type based on table name

    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $responses[] = [
                'document_type' => $document_type, // Include document type
                'last_name' => $row['lastName'],
                'first_name' => $row['firstName'],
                'status' => $row['status'] ?? 'Pending'
            ];
        }
    }
}

$conn->close();

echo json_encode($responses);
?>
