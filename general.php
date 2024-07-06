<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($conn);
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate and sanitize input data
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $password = isset($_POST['password']) ? $conn->real_escape_string($_POST['password']) : '';
    $fullname = isset($_POST['fullname']) ? $conn->real_escape_string($_POST['fullname']) : '';
    $first_name = isset($_POST['first_name']) ? $conn->real_escape_string($_POST['first_name']) : '';
    $middle_name = isset($_POST['middle_name']) ? $conn->real_escape_string($_POST['middle_name']) : null;
    $last_name = isset($_POST['last_name']) ? $conn->real_escape_string($_POST['last_name']) : '';
    $gender = isset($_POST['gender']) ? $conn->real_escape_string($_POST['gender']) : '';
    $birthday = isset($_POST['birthday']) ? $conn->real_escape_string($_POST['birthday']) : null;
    $birthplace = isset($_POST['birthplace']) ? $conn->real_escape_string($_POST['birthplace']) : null;
    $type = isset($_POST['type']) ? $conn->real_escape_string($_POST['type']) : '';
    $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : null;
    $contactNo = isset($_POST['contactNo']) ? (int)$_POST['contactNo'] : null;
    $status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : '';
    $nationality = isset($_POST['nationality']) ? $conn->real_escape_string($_POST['nationality']) : null;
    $religion = isset($_POST['religion']) ? $conn->real_escape_string($_POST['religion']) : null;
    $occupation = isset($_POST['occupation']) ? $conn->real_escape_string($_POST['occupation']) : null;
    $sector = isset($_POST['sector']) ? $conn->real_escape_string($_POST['sector']) : '';
    $voterNo = isset($_POST['voterNo']) ? (int)$_POST['voterNo'] : null;
    $philNo = isset($_POST['philNo']) ? (int)$_POST['philNo'] : null;
    $personCon = isset($_POST['personCon']) ? $conn->real_escape_string($_POST['personCon']) : null;
    $personRe = isset($_POST['personRe']) ? $conn->real_escape_string($_POST['personRe']) : null;
    $personNo = isset($_POST['personNo']) ? (int)$_POST['personNo'] : null;

    // Retrieve username from the user data
    $username = $user_data['username'];

    // Validate input fields
    $errors = validateInput($email, $password, $fullname, $first_name, $middle_name, $last_name, $gender, $birthday, $birthplace, $type, $address, $contactNo, $status, $nationality, $religion, $occupation, $sector, $voterNo, $philNo, $personCon, $personRe, $personNo);

    // If there are no errors, update the database
    if (empty($errors)) {
        $update_query = "UPDATE users SET email=?, password=?, fullname=?, first_name=?, middle_name=?, last_name=?, gender=?, birthday=?, birthplace=?, type=?, address=?, contactNo=?, status=?, nationality=?, religion=?, occupation=?, sector=?, voterNo=?, philNo=?, personCon=?, personRe=?, personNo=? WHERE username=?";
        $update_stmt = mysqli_prepare($conn, $update_query);

        mysqli_stmt_bind_param($update_stmt, "ssssssssssisssssiissis", $email, $password, $fullname, $first_name, $middle_name, $last_name, $gender, $birthday, $birthplace, $type, $address, $contactNo, $status, $nationality, $religion, $occupation, $sector, $voterNo, $philNo, $personCon, $personRe, $personNo, $username);

        if (mysqli_stmt_execute($update_stmt)) {
            // Refresh form fields

            // Redirect to 
            header("Location: myaccount.php");
            die;
        } else {
            // Handle database error
            $errors['general'] = "An error occurred while updating. Please try again.";
            // Log or display the error
            error_log("Database Error: " . mysqli_error($conn));
        }
    }
}

function validateInput($email, $password, $fullname, $first_name, $middle_name, $last_name, $gender, $birthday, $birthplace, $type, $address, $contactNo, $status, $nationality, $religion, $occupation, $sector, $voterNo, $philNo, $personCon, $personRe, $personNo) {
    $errors = array();

    // Validate each input field
    if (empty($email)) {
        $errors['email'] = "Please enter an email.";
    }
    // Add more validation rules for other fields...

    return $errors;
}
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartBrgy.ph</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <style>
        /* Centering the main content */
        body {
            background-color: red;
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        } 
        
        .main-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        
        .account-details {
            border-radius: 25px 25px 0 0; /* Set border-radius for the first template */
        }
        
        .account-section {
            border-radius: 0 0 25px 25px; /* Set border-radius for the second template */
        }

        /* Styling for account details and section */
        .account-details,
        .account-section {
            width: 80%; /* Adjust width as needed */
            max-width: 220px; /* Max width to avoid stretching on large screens */
            background-color: #f0f0f0; /* Just for visualization */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Adding some space between the two sections */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Styling for images */
        .account-verification img {
            max-width: 100%; /* Ensures images adjust to the template width */
            margin-bottom: 10px; /* Adds space between image and other elements */
        }

        /* Styling for input fields */
        .account-verification input[type="text"],
        .account-verification input[type="date"],
        .account-verification select {
            width: calc(100% - 20px); /* Subtracting padding from width */
            padding: 10px;
            margin: 10px 0;
            border-radius: 25px;
            border: 1px solid #ccc; /* Border color */
            box-sizing: border-box;
            text-align: left; /* Align text to the left */
        }

        /* Styling for labels */
        .account-verification label {
            font-style: italic;
            font-weight: bold;
            margin-left: 15px;
            margin-top: 15px;
            margin-bottom: -15px;
            color: #14436D;
            text-align: left; /* Align labels to the left */
            display: block; /* Ensures labels appear on a new line */
        }
        .gen-img {
            max-width: 40px; /* Adjust the size as needed */
        }
        /* Styling for profile picture */
        .profile-picture {
            position: relative;
            width: 60px; /* Adjust the size of the circular image */
            height: 60px;
            border-radius: 50%; /* To make it circular */
            overflow: hidden; /* To hide overflow if the image is larger */
            margin-right: 20px; /* Add space between image and text */
        }

        .profile-img {
            width: 100%; /* Ensure the image fills the container */
            height: auto; /* Maintain aspect ratio */
        }
        .account-details {
            display: flex; /* Use flexbox */
            align-items: center; /* Align items vertically */
            border-radius: 25px 25px 0 0; /* Set border-radius for the first template */
        }
    </style>
</head>
<body>
<div class="main-content">
  <div class="account-details">
    <div class="profile-picture">
        <img src="<?php echo $profile_image_path; ?>" alt="Profile Picture" class="profile-img">
    </div>
    <h2>My Account</h2>
</div>

    <div class="account-section">
        <div class="account-verification">
            
            <img src="req.png" class="req" alt="iwee" id="1-icon">
            <h3><img src="gen.png" class="gen gen-img" alt="iwee" id="1-icon"></h3>
            <form method="post" action="other.php">
                <!-- Form inputs -->
                <label for="first_name">First Name:</label><br>
                <input type="text" name="first_name" id="first_name"><br>
                <label for="middle_name">Middle Name:</label><br>
                <input type="text" name="middle_name" id="middle_name"><br>
                <label for="last_name">Last Name:</label><br>
                <input type="text" name="last_name" id="last_name"><br>
                <label for="gender">Gender:</label><br>
                <select name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="o">Other</option>
                </select><br>
                <label for="birthday">Date of Birth:</label><br>
                <input type="date" name="birthday" id="birthday"><br>
                
                <input type="submit" value="Update" name="update">

            </form>
        </div>
    </div>
</div>

<script src="home.js"></script>
<script>
 // Function to add click and blur event listeners to input field
        function addRedBorderEffect(inputElement) {
            // Add click event listener to the input
            inputElement.addEventListener('click', function () {
                // Change border color to red
                this.style.borderColor = '#ff0000';
            });

            // Add blur event listener to the input
            inputElement.addEventListener('blur', function () {
                // If the input is not empty, remove the red border; otherwise, keep it red
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });
        }

        // Get references to all input fields
        var allInputs = document.querySelectorAll('input[required], select');

        // Apply red border effect to all input fields
        allInputs.forEach(function (input) {
            addRedBorderEffect(input);
        });
</script>
</body>
</html>
