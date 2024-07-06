<?php
session_start();

include 'connection.php';
include 'function2.php';

$user_data = check_login($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: red;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .user-detail {
            margin-bottom: 15px;
        }
        .user-detail strong {
            display: inline-block;
            width: 150px;
        }
         .go-home-button button {
       margin-top: 40px;
            background-color: #800000; /* Maroon color */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>User Details</h1>
    <?php if ($user_data): ?>
        <div class="user-detail"><strong>ID:</strong> <?= htmlspecialchars($user_data['id']); ?></div>
        <div class="user-detail"><strong>Email:</strong> <?= htmlspecialchars($user_data['email']); ?></div>
        <div class="user-detail"><strong>Full Name:</strong> <?= htmlspecialchars($user_data['fullname']); ?></div>
        <div class="user-detail"><strong>Username:</strong> <?= htmlspecialchars($user_data['username']); ?></div>
        <div class="user-detail"><strong>First Name:</strong> <?= htmlspecialchars($user_data['first_name']); ?></div>
        <div class="user-detail"><strong>Middle Name:</strong> <?= htmlspecialchars($user_data['middle_name']); ?></div>
        <div class="user-detail"><strong>Last Name:</strong> <?= htmlspecialchars($user_data['last_name']); ?></div>
        <div class="user-detail"><strong>Gender:</strong> <?= htmlspecialchars($user_data['gender']); ?></div>
        <div class="user-detail"><strong>Birthday:</strong> <?= htmlspecialchars($user_data['birthday']); ?></div>
        <div class="user-detail"><strong>Birthplace:</strong> <?= htmlspecialchars($user_data['birthplace']); ?></div>
        <div class="user-detail"><strong>Blood Type:</strong> <?= htmlspecialchars($user_data['type']); ?></div>
        <div class="user-detail"><strong>Address:</strong> <?= htmlspecialchars($user_data['address']); ?></div>
        <div class="user-detail"><strong>Contact No:</strong> <?= htmlspecialchars($user_data['contactNo']); ?></div>
        <div class="user-detail"><strong>Status:</strong> <?= htmlspecialchars($user_data['status']); ?></div>
        <div class="user-detail"><strong>Nationality:</strong> <?= htmlspecialchars($user_data['nationality']); ?></div>
        <div class="user-detail"><strong>Religion:</strong> <?= htmlspecialchars($user_data['religion']); ?></div>
        <div class="user-detail"><strong>Occupation:</strong> <?= htmlspecialchars($user_data['occupation']); ?></div>
        <div class="user-detail"><strong>Sector:</strong> <?= htmlspecialchars($user_data['sector']); ?></div>
        <div class="user-detail"><strong>Voter No:</strong> <?= htmlspecialchars($user_data['voterNo']); ?></div>
        <div class="user-detail"><strong>PhilHealth No:</strong> <?= htmlspecialchars($user_data['philNo']); ?></div>
        <div class="user-detail"><strong>Contact Person:</strong> <?= htmlspecialchars($user_data['personCon']); ?></div>
        <div class="user-detail"><strong>Relationship:</strong> <?= htmlspecialchars($user_data['personRe']); ?></div>
        <div class="user-detail"><strong>Contact Person No:</strong> <?= htmlspecialchars($user_data['personNo']); ?></div>
    <?php else: ?>
        <p>No user data found. Please add info ypur account.</p>
    <?php endif; ?>
    
    <div class="go-home-button">
        <button onclick="window.location.href = 'admin.php';">Go to Home</button>

    </div>
</div>

</body>
</html>
