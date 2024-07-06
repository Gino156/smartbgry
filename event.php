<?php
ob_start(); // Start output buffering
session_start();

include("connection.php");
include("functions.php");

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

// Retrieve tickets
$sql = "SELECT ticket.*, users.*, events.*, ticket.timestamp AS ticket_timestamp
        FROM ticket
        LEFT JOIN events ON ticket.event_name = events.event_name AND ticket.event_date = events.event_date
        LEFT JOIN users ON ticket.username = users.username
        WHERE ticket.username = '{$user_data['username']}'
        ORDER BY ticket.timestamp DESC";

$result = $conn->query($sql);
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Retrieve images from the uploads folder
$images = glob("uploads/*.{jpg,jpeg,png,gif}", GLOB_BRACE);

// Fetch event names and corresponding images from the database
$events = [];
$eventsQuery = "SELECT event_name, event_image FROM events";
$eventsResult = $conn->query($eventsQuery);
if ($eventsResult !== false && $eventsResult->num_rows > 0) {
    while ($eventRow = $eventsResult->fetch_assoc()) {
        $events[$eventRow['event_image']] = $eventRow['event_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Event</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <style>
        /* Add your CSS styles here */
        body {
            background: linear-gradient(to bottom, #f0a5a5, #800000); /* Light red to dark red gradient */
            margin: 0;
            padding: 0;
            min-height: 145vh;
        }

        .container {
            background-color: white;
            color: black;
            width: 80%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
        }

        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: auto;
            border-radius: 10px;
            overflow: hidden;
        }

        .slides {
            display: none;
            width: 100%;
        }

        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        .prev:hover, .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
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

        .event-date {
            font-style: italic;
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
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .go-home-button button:hover {
            background-color: deepskyblue;
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
        <div class="slideshow-container">
            <?php
            foreach ($images as $image) {
                $filename = basename($image);
                if (isset($events[$filename])) {
                    echo "<div class='slides'>
                            <img src='$image' style='width:100%'>
                            <div class='event-name'>{$events[$filename]}</div>
                          </div>";
                }
            }
            ?>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <h1>Barangay Event!</h1>
        <div class="chat-box">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='chat-message'>
                            <span class='event-name'>Event:</span>
                            <span class='event-name'>{$row['event_name']}</span><br>
                            <span class='event-date'>Date: {$row['event_date']}</span>
                            <span class='timestamp'>Registered: {$row['ticket_timestamp']}</span>
                          </div>";
                }
            } else {
                echo "<div class='chat-message'>No records found</div>";
            }
            ?>
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            // Fetch events from the 'events' table
            $eventsQuery = "SELECT event_name, event_date FROM events";
            $eventsResult = $conn->query($eventsQuery);
            ?>

            <!-- Add a dropdown list for selecting the event -->
            <label for="event_name">Event:</label>
            <select name="event_name" required>
                <?php
                // Display events from the 'events' table
                while ($eventRow = $eventsResult->fetch_assoc()) {
                    echo "<option value='{$eventRow['event_name']}'>{$eventRow['event_name']} ({$eventRow['event_date']})</option>";
                }
                ?>
            </select><br>

            <input type="submit" name="submit" value="Register">
        </form>
    </div>
    <div class="go-home-button">
        <button onclick="window.location.href = 'home.php';">Go to Home</button>
    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("slides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }

        function plusSlides(n) {
            let slides = document.getElementsByClassName("slides");
            slideIndex += n;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            if (slideIndex < 1) {
                slideIndex = slides.length;
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>
</body>
</html>
