<?php
ob_start();
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
  $password = $_POST['password'];
  $fullname = $_POST['fullname'];
    $username = $_POST['username'];

    $sql = "INSERT INTO users (email, password, fullname, username) VALUES ('$email','$password', '$fullname', '$username')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit(); // Make sure to exit after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating Account</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="navbar">
        <h1>CREATE YOUR ACCOUNT</h1>
        <div>
            <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="container">
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="fullname" placeholder="Full Name" required>
            <input type="text" name="username" placeholder="Username" required>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class='far fa-eye-slash' id="togglePassword" style="font-size:24px; cursor:pointer; position: absolute; right: 30px; top: 35%; transform: translateY(-50%);"></i>
            </div>
            <div class="password-wrapper">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat Password" required>
                <i class='far fa-eye-slash' id="toggleConfirmPassword" style="font-size:24px; cursor:pointer; position: absolute; right: 30px; top: 35%; transform: translateY(-50%);"></i>
            </div>
            <input type="submit" value="Create Account">
        </form>
    </div>
    
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        function toggleConfirmPasswordVisibility() {
            var confirmPasswordField = document.getElementById("confirm_password");
            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
            } else {
                confirmPasswordField.type = "password";
            }
        }

        document.getElementById("togglePassword").addEventListener("click", togglePasswordVisibility);
        document.getElementById("toggleConfirmPassword").addEventListener("click", toggleConfirmPasswordVisibility);
    </script>
</body>
</html>
