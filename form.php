<?php
session_start();

include 'connection.php';
include 'functions.php';

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

if (!empty($profile_image)) {
    // Display the profile picture using the fetched filename
    $profile_image_path = "./profile/" . $profile_image;
} else {
    // If no image found in the database, display a default profile picture
    $profile_image_path = "profile.png"; // Provide the path to your default profile picture
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
       body{
           
            background: linear-gradient(to bottom, #f0a5a5, #800000); /* Light red to dark red gradient */
    
       }
       
        html, body, h1, h2, h3, h4, h5, h6 {
            font-family: "Roboto", sans-serif;
        }
        .w3-teal {
            background-color: #d43532 !important;
        }
        .w3-text-teal {
            color: #d43532 !important;
        }
        
          .go-home-button button {
       margin-top: 40px;
            background-color: red; /* Maroon color */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
          }
          .section-heading {
    font-size: 20px; /* Adjust the font size as per your preference */
     font-weight: bold;
     color:black;
}
            
    </style>
</head>
<body class="w3-light-grey">

<div class="w3-content w3-margin-top" style="max-width:1400px;">
    <div class="w3-row-padding">
        <div class="w3-third">
            <div class="w3-white w3-text-grey w3-card-4">
                <div class="w3-display-container">
                    <img src="<?php echo htmlspecialchars($profile_image_path); ?>" style="width:100%" alt="Profile Picture">
                    <div class="w3-display-bottomleft w3-container w3-text-black">
<h2 style="color: white; font-weight: bold;"><?php echo htmlspecialchars($user_data['fullname']); ?></h2>
                    </div>
                </div>
                <div class="w3-container">
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo htmlspecialchars($user_data['email']); ?></p>
                    <p><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo htmlspecialchars($user_data['username']); ?></p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo htmlspecialchars($user_data['address']); ?></p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo htmlspecialchars($user_data['contactNo']); ?></p>
                    <hr>
                    <p class="w3-large w3-text-theme"><b><i class="fa fa-info fa-fw w3-margin-right w3-text-teal"></i>Personal Information</b></p>
                    <p>ID: <?php echo htmlspecialchars($user_data['id']); ?></p>
                    <p>First Name: <?php echo htmlspecialchars($user_data['first_name']); ?></p>
                    <p>Middle Name: <?php echo htmlspecialchars($user_data['middle_name']); ?></p>
                    <p>Last Name: <?php echo htmlspecialchars($user_data['last_name']); ?></p>
                    <p>Gender: <?php echo htmlspecialchars($user_data['gender']); ?></p>
                    <p>Birthday: <?php echo htmlspecialchars($user_data['birthday']); ?></p>
                    <p>Birthplace: <?php echo htmlspecialchars($user_data['birthplace']); ?></p>
                    
                    
            
                </div>
            </div><br>
        </div>
        
        <div class="w3-twothird">
            <div class="w3-container w3-card w3-white w3-margin-bottom">
    <div class="w3-text-grey w3-padding-16">
        <h2 class="section-heading"><i class="fa fa-users fa-fw w3-margin-right w3-xlarge w3-text-teal"></i>Emergency Contact</h2>
        <!-- Emergency Contact details -->
        <p>Contact Person: <?php echo htmlspecialchars($user_data['personCon']); ?></p>
        <p>Relationship: <?php echo htmlspecialchars($user_data['personRe']); ?></p>
        <p>Contact Person No: <?php echo htmlspecialchars($user_data['personNo']); ?></p>
    </div>
</div>

<div class="w3-container w3-card w3-white">
    <div class="w3-text-grey w3-padding-16">
        <h2 class="section-heading"><i class="fa fa-certificate fa-fw w3-margin-right w3-xlarge w3-text-teal"></i>Other Information</h2>
        <p>Blood Type: <?php echo htmlspecialchars($user_data['type']); ?></p>
        <p>Status: <?php echo htmlspecialchars($user_data['status']); ?></p>
            <p>Nationality: <?php echo htmlspecialchars($user_data['nationality']); ?></p>
                    <p>Religion: <?php echo htmlspecialchars($user_data['religion']); ?></p>
                    <p>Occupation: <?php echo htmlspecialchars($user_data['occupation']); ?></p>
                    <p>Sector: <?php echo htmlspecialchars($user_data['sector']); ?></p>
                    <p>Voter No: <?php echo htmlspecialchars($user_data['voterNo']); ?></p>
                    <p>PhilHealth No: <?php echo htmlspecialchars($user_data['philNo']); ?></p>                <!-- Add Education details here -->
                    
    </div>
</div>
         <div class="go-home-button">
        <button onclick="window.location.href = 'home.php';">Go to Home</button>
    </div>
        </div>
    </div>
</div>

<footer class="w3-container w3-teal w3-center w3-margin-top">
    <p>SMARTBRGY.ph</p>
 
    
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>

</footer>

</body>
</html>
