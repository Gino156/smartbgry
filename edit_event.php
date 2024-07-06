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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventDescription = $_POST['eventDescription'];

    $sql = "UPDATE events SET event_name='$eventName', event_date='$eventDate', event_description='$eventDescription' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Event updated successfully";
    } else {
        echo "Error updating event: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Event not found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="adminhome.css">
</head>

<body>
    <div class="content">
        <div class="add-event">
            <h2>Edit Event</h2>
            <form id="editEventForm" method="POST" action="edit_event.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="form-group">
                    <label for="eventName">Event Name:</label>
                    <input type="text" id="eventName" name="eventName" value="<?php echo $row['event_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="eventDate">Event Date:</label>
                    <input type="date" id="eventDate" name="eventDate" value="<?php echo $row['event_date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="eventDescription">Event Description:</label>
                    <textarea id="eventDescription" name="eventDescription" required><?php echo $row['event_description']; ?></textarea>
                </div>
                <button type="submit">Update Event</button>
            </form>
        </div>
    </div>
</body>

</html>