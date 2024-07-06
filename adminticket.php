<?php
ob_start(); // Start output buffering
session_start();

include("connection.php");
include("function2.php");

$user_data = check_login($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve event_name from the form
    $event_name = $_POST['event_name'];

    // Fetch event_date based on the selected event_name
    $event_date_query = $conn->prepare("SELECT event_date FROM events WHERE event_name = ?");
    $event_date_query->bind_param("s", $event_name);
    $event_date_query->execute();
    $event_date_result = $event_date_query->get_result();

    if ($event_date_result->num_rows > 0) {
        $row = $event_date_result->fetch_assoc();
        $event_date = $row['event_date'];

        // Insert the values into the database using prepared statements to prevent SQL injection
        $sql = $conn->prepare("INSERT INTO ticket (timestamp, username, event_name, event_date) VALUES (CURRENT_TIMESTAMP, ?, ?, ?)");
        if ($sql === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $form_username = $user_data['username']; // Assuming username is in user_data

        $sql->bind_param("sss", $form_username, $event_name, $event_date);

        if ($sql->execute()) {
            // Redirect to the same page to avoid form resubmission on refresh
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            // Output any errors
            echo "Error: " . $sql->error . "<br>";
        }

        // Close the prepared statement
        $sql->close();
    } else {
        echo "Error: Event date not found for the selected event name.";
    }
}

// Retrieve tickets and count the number of registrations for each event
$sql = "SELECT ticket.event_name, ticket.username, COUNT(*) AS event_count, MAX(ticket.timestamp) AS ticket_timestamp
        FROM ticket
        GROUP BY ticket.event_name, ticket.username
        ORDER BY ticket_timestamp DESC";

$result = $conn->query($sql);
if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Ticket</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <style>
        /* Add your CSS styles here */
        body {
            background-color: red;
            margin: 0;
            padding: 0;
            min-height: 130vh;
        }

        .container {
            background-color: white;
            color: black;
            width: 80%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
        }

        .chat-box {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
            max-height: 400px;
            overflow-y: scroll;
        }

        .chat-message {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .event-name {
            font-weight: bold;
        }

        .event-count {
            font-weight: bold;
            color: green;
            margin-left: 10px;
        }

        .timestamp {
            color: #999;
            font-size: 0.8em;
            margin-left: 10px;
        }

        input[type="submit"] {
            font-weight: bold;
            margin-top: 20px;
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }

        .go-home-button {
            margin-top: 20px;
            text-align: center;
        }

        .go-home-button button {
            background-color: maroon;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .go-home-button button:hover {
            background-color: darkred;
        }

        select {
            font-size: 14px; /* Adjust this value to change the size */
            padding: 5px;
            font-weight: bold;
            width: 60%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Barangay Ticket!</h1>
        <div class="chat-box">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='chat-message'>
                            <span class='event-name'>Event: {$row['event_name']}</span>
                            <span class='event-count'>Registered: {$row['event_count']} time/s</span>
                            <span class='timestamp'>Last Registered: {$row['ticket_timestamp']}</span>
                            <br>
                            <span class='username'>Registered by: {$row['username']}</span>
                          </div>";
                }
            } else {
                echo "<div class='chat-message'>No records found</div>";
            }
            ?>
        </div>
    </div>
    <div class="go-home-button">
        <button onclick="window.location.href = 'admin.php';">Go to Home</button>
    </div>
</body>
</html>
