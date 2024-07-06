<?php
ob_start();
error_reporting(0);

session_start();

include("connection.php");
include("function2.php");

$user_data = check_login($conn);

// Retrieve username from the session
$username = $user_data['username'];

// Function to handle file upload
function uploadEventImage($conn, $user_data) {
    if (isset($_FILES['uploadfile'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./uploads/" . $filename; // Save the file in 'uploads' folder

        // Save data to the database (only the filename)
        $insert_query = "INSERT INTO events (event_image, username) VALUES (?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($insert_stmt, "ss", $filename, $user_data['username']);

        if (mysqli_stmt_execute($insert_stmt)) {
            // Move the uploaded image into the 'uploads' folder
            if (move_uploaded_file($tempname, $folder)) {
                return "Image uploaded successfully!";
            } else {
                return "Failed to move file to folder!";
            }
        } else {
            return "Failed to insert data into database!";
        }
    }
}

// Check if form was submitted for event image upload
if (isset($_POST['upload'])) {
    $upload_status = uploadEventImage($conn, $user_data);
    // Output upload status message
    echo "<h3>" . htmlspecialchars($upload_status) . "</h3>";
}

// Fetch the latest profile image filename for the user from the database
$select_query = "SELECT filename FROM image WHERE username = ? ORDER BY timestamp_column DESC LIMIT 1";
$select_stmt = mysqli_prepare($conn, $select_query);
mysqli_stmt_bind_param($select_stmt, "s", $username);
mysqli_stmt_execute($select_stmt);
mysqli_stmt_bind_result($select_stmt, $profile_image);
mysqli_stmt_fetch($select_stmt);
mysqli_stmt_close($select_stmt);

// Check if the fetched image filename is not empty
if (!empty($profile_image)) {
    // Display the profile picture using the fetched filename
    $profile_image_path = "./profile/" . $profile_image;
} else {
    // If no image found in the database, display a default profile picture
    $profile_image_path = "profile.png"; // Provide the path to your default profile picture
}

// Fetch events from the database
$sql = "SELECT event_name, event_date, event_image FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);

$events = array();
if ($result) {
    // Fetch events from the database
    while ($row = $result->fetch_assoc()) {
        // Prepend the upload folder path to the image file name
        $row['event_image'] = 'uploads/' . $row['event_image'];
        $events[] = $row;
    }
} else {
    echo "Error: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartBrgy.ph</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="home.css">
    <style>
    body {
            background: linear-gradient(135deg, #FFD8D8, #FF0000, #8B0000); /* Gradient from light red to red to dark red */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            min-height: 150vh; /* Ensure body takes at least 100% of viewport height */
            display: flex;
            flex-direction: column;
        }
         .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1; /* Take remaining vertical space */
            padding: 20px; /* Add padding for content */
        }

        .form-container {
            background-color: #f0f0f0;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 80%; /* Adjust form width */
            max-width: 600px; /* Set maximum width for better readability */
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group textarea,
        .form-group input[type="file"] {
            width: calc(100% - 10px); /* Adjust input width */
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #14436D;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <a href="reqAd.php">
                <img src="box.png" alt="Box" id="box-icon">
            </a>
        </div>
        <h1>SMARTBRGY.ph</h1>
        <div class="profile">
            <div class="profile-side">
                <a href="display_admin.php">
                    <img src="<?php echo $profile_image_path; ?>" alt="Profile Picture">
                </a>
            </div>
        </div>
    </header>

    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button></button>
        </div>
        <button class="box-icon"></button>
    </div>

    <!-- Display uploaded event images -->
    <div class="registered" id="featured-event-container">
       <div class="container">
        <div class="form-container">
            <form id="addEventForm" method="POST" action="add_event.php" enctype="multipart/form-data">
                <h2>Add New Event</h2>
                <div class="form-group">
                    <label for="eventName">Event Name:</label>
                    <input type="text" id="eventName" name="eventName" required>
                </div>
                <div class="form-group">
                    <label for="eventDate">Event Date:</label>
                    <input type="date" id="eventDate" name="eventDate" required>
                </div>
                <div class="form-group">
                    <label for="eventDescription">Event Description:</label>
                    <textarea id="eventDescription" name="eventDescription" required></textarea>
                </div>
                <div class="form-group">
                    <label for="eventImage">Event Image:</label>
                    <input type="file" id="eventImage" name="eventImage" accept="image/*" required>
                </div>
                <button type="submit">Add Event</button>
            </form>
        </div>
    </div>
        <script src="adminhome.js"></script>

    </div>

    <!-- Footer -->
    <footer style="font-size: 14px;">
        &copy; 2024 SmartBrgy.ph. All rights reserved.
    </footer>

    <!-- JavaScript -->
    <script src="home.js"></script>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="profile">
            <div class="profile-upload">
                <img src="<?php echo $profile_image_path; ?>" alt="Profile Picture">
            </div>
            
            <div class="profile-info">
                <!-- Form to upload event image -->
                <form method="POST" action="admin.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="uploadfile" />
                    </div>
                    <div class="form-group">
                        <button class="green-button" type="submit" name="upload">Upload Picture</button>
                    </div>
                </form>
                
                <!-- Display user information -->
                <h2><?php echo htmlspecialchars($user_data['fullname']); ?></h2>
                <h2><?php echo htmlspecialchars($user_data['contactNo']); ?></h2>
                <p class="status">Unverified</p>
                <img src="qr.png" alt="QR Code" class="qr-code">
            </div>
        </div>
        
        <!-- Sidebar navigation -->
        <nav>
            <ul>
                <li><a href="admin.php"><img src="home.png" alt="Home" width="20" height="20">Home</a></li>
              <li><a href="myaccount1.php"><img src="account.png" alt="Account" width="20" height="20">My Account</a></li>
                <li><a href="DataAd.php"><img src="account.png" alt="Account" width="20" height="20">Member Accounts</a></li>
                <li><a href="adminmessage.php"><img src="inbox.png" alt="Inbox" width="20" height="20">Inbox</a></li>
                <li><a href="transAd.php"><img src="arrow.png" alt="Transactions" width="20" height="20">All Transactions</a></li>
                <li><a href="adminticket.php"><img src="ticket.png" alt="Tickets" width="20" height="20">Tickets</a></li>
                <li><a href="destination.php"><img src="logout.png" alt="Log out" width="20" height="20">Log out</a></li>
            </ul>
        </nav>
    </div>

    <!-- JavaScript to toggle sidebar -->
    <script>
        document.querySelector('.box-icon').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>

</body>
</html>
