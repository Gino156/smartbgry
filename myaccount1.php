<?php
ob_start();
error_reporting(0);

session_start();

include("connection.php");
include("function2.php");

$user_data = check_login($conn);

// Retrieve username from the session
$username = $user_data['username'];

// Fetch the latest image filename for the user from the database
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

// File upload logic
if (isset($_FILES['uploadfile'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./profile/" . $filename;

    $folderPath = "./profile";

    // Check if the folder exists, if not, create it
    if (!is_dir($folderPath)) {
        mkdir($folderPath);
    }

    // Retrieve username from the session
    $username = $user_data['username'];

    // Save data to the database
    $insert_query = "INSERT INTO image (filename, username) VALUES (?, ?)";
    $insert_stmt = mysqli_prepare($conn, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "ss", $filename, $username);

    if (mysqli_stmt_execute($insert_stmt)) {
        // Now let's move the uploaded image into the folder: profile
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3> Image uploaded successfully!</h3>";
            header("Location: home.php");
            exit(); // Ensure that no further code is executed after the header
        } else {
            echo "<h3> Failed!</h3>";
        }
    } else {
        echo "<h3> Failed!</h3>";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Account</title>
    <link rel="icon" href="../logo.png" type="image/png">
        <link rel="stylesheet" href="home.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: red;
            display: flex;
            flex-direction: column;
            min-height: 350vh;
        }
        header {
             background-color: linear-gradient(90deg, #ff0000, #990000);
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            font-size: 18px;
        }
        header .header-left, header .header-right {
            display: flex;
            align-items: center;
        }
        header img {
            height: 50px;
            width: 50px;
            cursor: pointer;
        }
        .profile-icon.active {
            background-image: url('profile-active.png');
        }
        footer {
            background-color: lightgray;
            padding: 10px;
            text-align: center;
            margin-top: auto;
        }
        .search-bar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 20px;
            margin-right: 20px;
                    margin-bottom: 750px; /* Adjust the top margin as needed */

        }
        .search-bar {
            position: relative;
            padding: 10px;
            background-color: white;
            text-align: center;
            display: flex;
            border-radius: 10px;
            flex: 1;
        }
   .search-bar input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-repeat: no-repeat;
            background-position: 95% center;
            margin-right: -40px;
        }
        .search-bar button {
            background-image: url('glass.png');
            background-size: cover;
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 100px;
            cursor: pointer;
        }
  .box-icon {
            background-image: url('line.jpg');
            background-size: cover;
            width: 60px;
            height: 60px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-left: 15px;
        }
        .container {
            margin: 20px;
            position: relative;
            text-align: center;
            padding: 20px;
            color: maroon;
            font-size: 22px;
            font-weight: bold;
            background-color: white;
            border-radius: 10px;
            margin-bottom: -5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 20px;
        }
        form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
  
        .register-icon {
         position: absolute;
          bottom: -5px; /* Adjust bottom positioning to fit it to the bottom */
           right: -7px; /* Adjust right positioning if needed */
           width: 200px;
           height: 50px;
}
        .outside-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 30px;
            margin-left: 20px;
            margin-right: 20px;
        }
        .events {
            margin-left: 20px;
            margin-right: 20px;
        }
        .registered{
            margin-left: 20px;
            margin-right: 20px;
        }
        .white-button {
            flex: 1;
            background-color: white;
            color: black;
            border: none;
            border-radius: 5px;
            padding: 10px 10px;
            margin: 5px;
            cursor: pointer;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 20px;
            height: 500px;
        }
        .grid-container .container {
            margin: 0;
            position: relative;
            overflow: hidden;
        }
        .grid-container .container::after {
            content: '';
            display: block;
            padding-bottom: 50%; /* Make it occupy half of the container height */
        }
        .grid-container .container img {
            position: absolute;
            top: 35%;
            left: 50%;
            height: 60%;
            width: 90%;
            border-radius: 10px;
            transform: translate(-50%, -50%);
        }
       
         .grid-container .container .caption {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            color: black;
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap; /* Ensure the text is in one line */
        }
          .grid-container .container .caption1 {
            position: absolute;
            bottom: 35px;
            left: 50%;
            transform: translateX(-50%);
            color: black;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap; /* Ensure the text is in one line */
        }
         .grid-container .container .caption2 {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            color: black;
            font-size: 10px;
            font-weight: bold;
            white-space: nowrap; /* Ensure the text is in one line */
        }
        .grid-container .container .register-text {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            color: gray;
            font-size: 12px;
            font-style: italic;
        }
  .grid-container .container .icon {
    position: absolute;
    top: 2px;
    right: 2px;
    width: 30px;
    height: 25px;
    background-image: url('heart.png');
    background-size: contain;
    cursor: pointer;
        }
        .sidebar {
            position: fixed;
            left: -75.33%;
            width: 75.33%;
            height: calc(100% - 50px);
            background-color: lightgray;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            padding: 20px;
            box-sizing: border-box;
            z-index: 1;
             height: 100%;
           justify-content: center;
        }
        .sidebar.active {
            left: 0;
                height: 100%;

        }
        .sidebar img.profile {
            display: block;
            margin: 0 auto 20px;
            height: 130px;
            width: 130px;
            border-radius: 50%;
            border: 2px;
        }
        
        .sidebar button img {
            margin-right: 10px
            
        }
        .sidebar .logout-button {
            background-color: white;
            color: black;
        }
        .profile-side img {
    margin-top: 25px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
.profile {
    text-align: center;
    margin-bottom: 20px;
}

.profile-picture img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
}

.profile-info h2 {
    font-size: 18px;
    margin: 10px 0;
}

.profile-info p {
    margin: 5px 0;
}
.profile-upload img {
  width: 90px;
  height: 90px;
  display: block;
  margin: 0 auto;
  margin-bottom: 20px;
  border-radius: 50%;
}
.green-button {
    background-color: maroon;
    border: none;
    border-radius: 20px; /* Adjust the border radius */
    color: white;
    padding: 8px 16px; /* Decrease the padding */
    font-size: 14px; /* Decrease the font size */
    cursor: pointer;
    transition: background-color 0.3s;
    margin: 0 auto;
  margin-bottom: 20px;
 
}

.green-button:hover {
    background-color: darkred;
}

.qr-code {
    width: 100px;
    height: 100px;
    margin: 10px 0;
}

.form-group {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 10px; /* Decrease the margin bottom */
}

.form-control {
    border: none;
    border-radius: 20px; /* Adjust the border radius */
    padding: 8px 12px; /* Decrease the padding */
    background-color: maroon;
    color: white;
    font-size: 14px; /* Decrease the font size */
    width: 30%; /* Adjust the width */
}
 .long {
        margin-top: 20px; /* Adjust the top margin as needed */
        margin-bottom: 20px; /* Adjust the bottom margin as needed */
    }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <img src="box.png" alt="Box" id="box-icon">
        </div>
        <h1>SMARTBRGY.ph</h1>
        <div class="profile">
            <div class="profile-side">
                <img src="<?php echo $profile_image_path; ?>" alt="Profile Picture">
            </div>
    </header>
    <div class="search-bar-container">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button></button>
        </div>
        <button class="box-icon"></button>
    </div>
    
    
  <div class="registered" id="featured-event-container">
    <?php include("other1.php"); ?>
</div>

        
    </script>  
    
  
    
  <script src="home.js"></script>
   
    

    
    <div class="sidebar" id="sidebar">
<div class="profile">
            <div class="profile-upload">
                <img src="<?php echo $profile_image_path; ?>" alt="Profile Picture">
            </div>   
            
            
         
            
        <div class="profile-info">
            
                <form method="POST" action="home.php" enctype="multipart/form-data">
            <div class="form-group">
                <input class="lol" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="green-button" type="submit" name="upload">Upload Picture</button>
            </div>
            </form>
            
                <h2><?php echo htmlspecialchars($user_data['fullname']); ?></h2>
                <h2><?php echo htmlspecialchars($user_data['contactNo']); ?></h2>
                <p class="status">Unverified</p>
                <img src="qr.png" alt="QR Code" class="qr-code">
            </div>
        
        
           <nav>
            <ul>
                <li><a href="asmin.php"><img src="home.png" alt="Home" width="20" height="20">Home</a></li>
                <li><a href="myaccount1.php"><img src="account.png" alt="Account" width="20" height="20">My account</a></li>
                <li><a href="adminmessage.php"><img src="inbox.png" alt="Inbox" width="20" height="20">Inbox</a></li>
                <li><a href="admininbox.php"><img src="arrow.png" alt="Transactions" width="20" height="20">All Transactions</a></li>
                <li><a href="adminticket.php"><img src="ticket.png" alt="Tickets" width="20" height="20">Tickets</a></li>
                <li><a href="destination.php"><img src="logout.png" alt="Log out" width="20" height="20">Log out</a></li>
            </ul>
        </nav>
    </div>
    
    
    
    
  

 <script>
    document.querySelector('.box-icon').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>



</body>
</html>