<?php
ob_start();
$host = "localhost"; // Define $host
$dbname = "id21660325_mydatabase"; // Define $dbname
$username = "id21660325_dbuser";
$password = "1StrongP@ssw0rd";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Check if form is submitted and has the required data
if (isset($_POST['email']) && isset($_POST['new_password'])) {
    // Retrieve the email and new password from your form
    $desiredEmail = $_POST['email'];
    $newPassword = $_POST['new_password'];

    // Update the password in the 'users' table
    try {
        $stmt = $pdo->prepare("UPDATE users SET password = :newPassword WHERE email = :desiredEmail");
        $stmt->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(':desiredEmail', $desiredEmail, PDO::PARAM_STR);
        $stmt->execute();

        echo "Password updated successfully.";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    // Display an error message if form data is missing
    echo "";
}

// Close the connection
$pdo = null;
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgot.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .password-container {
            position: relative;
            margin-bottom: 15px;
        }
        .show-password-container {
            margin-bottom: 20px;
        }
        .password-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 50px;
            box-sizing: border-box;
            background-color: white;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>SMARTBRGY.ph</h1>
        <div>
            <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="container-lock">
        <img src="logo.png" alt="logo">
    </div>
    <div class="description">
        <h3><strong>Trouble Logging In?</strong></h3>
        <h5>Enter your email and new password to reset your password.</h5>
    </div>
    <div class="container">
        <form action="forgot.php" method="post" onsubmit="return validateForm();">
            <input type="email" name="email" placeholder="Email" required onblur="checkInputValidity('email')">
            <div class="password-container">
                <input type="password" name="new_password" id="password" required placeholder="New Password" onblur="checkInputValidity('new_password')" class="password-field">
            </div>
            <div class="show-password-container">
                <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
                <label for="show-password">Show password</label>
            </div>
            <div class="bi bi-arrow-left-circle">
                <input id="button" type="submit" value="Reset Password"><br>
            </div>
        </form>
        <footer class="footer">
            <a href="index.php">Return to Login Page</a>
        </footer>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var showPasswordCheckbox = document.getElementById("show-password");

            passwordInput.type = showPasswordCheckbox.checked ? "text" : "password";
        }

        // Function to add red-placeholder class when input is empty or there are errors
        function checkInputValidity(inputName) {
            var input = document.getElementsByName(inputName)[0];
            
            if (input.value === "") {
                input.classList.add("red-placeholder");
            } else {
                input.classList.remove("red-placeholder");
            }
        }

        // Check input validity on form submission
        function validateForm() {
            checkInputValidity('email');
            checkInputValidity('new_password');
            
            return (!document.getElementsByName('email')[0].classList.contains("red-placeholder") &&
                    !document.getElementsByName('new_password')[0].classList.contains("red-placeholder"));
        }
    </script>
</body>
</html>
