<?php
ob_start();
error_reporting(0);

// Include database connection
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventDescription = $_POST['eventDescription'];

    // File upload handling
    $file_name = $_FILES['eventImage']['name'];
    $file_tmp = $_FILES['eventImage']['tmp_name'];
    $file_type = $_FILES['eventImage']['type'];
    $file_size = $_FILES['eventImage']['size'];
    $file_error = $_FILES['eventImage']['error'];

    // Check file upload error
    if ($file_error === 0) {
        $file_destination = "./uploads/" . $file_name;

        // Move uploaded file to destination
        if (move_uploaded_file($file_tmp, $file_destination)) {
            // Insert event data into database
            $insert_query = "INSERT INTO events (event_name, event_date, event_description, event_image) VALUES (?, ?, ?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "ssss", $eventName, $eventDate, $eventDescription, $file_name);

            if (mysqli_stmt_execute($insert_stmt)) {
                // Redirect to admin.php after successful event addition
                header("Location: admin.php");
                exit();
            } else {
                echo "Failed to add event to database!";
            }
        } else {
            echo "Failed to move uploaded file!";
        }
    } else {
        echo "Error uploading file!";
    }
}

// Close database connection
mysqli_close($conn);
?>
