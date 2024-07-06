<?php
ob_start();
session_start();

include 'connection.php';
include 'functions.php';

$user_data = check_login($conn);

function display_user_data($data, $field) {
    return !empty($data[$field]) ? htmlspecialchars($data[$field]) : 'empty';
}

$update_success = false; // Flag for update success
$request_success = false; // Flag for request success
$error_message = ''; // Initialize error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_user'])) {
        // Update user details logic
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $birthday = $_POST['birthday'];
        $birthplace = $_POST['birthplace'];
        $contactNo = $_POST['contactNo'];
        $status = $_POST['status'];
        $address = $_POST['address'];

        // Prepare update query
        $query = "UPDATE users SET 
                    first_name = ?, 
                    middle_name = ?, 
                    last_name = ?, 
                    birthday = ?, 
                    birthplace = ?, 
                    contactNo = ?, 
                    status = ?, 
                    address = ? 
                  WHERE id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssssi', $first_name, $middle_name, $last_name, $birthday, $birthplace, $contactNo, $status, $address, $id);

        try {
            if ($stmt->execute()) {
                $update_success = true; // Set update success flag
                // Refresh user_data after update
                $user_data = check_login($conn);
            } else {
                $error_message = "Error updating record: " . $conn->error;
            }
        } catch (mysqli_sql_exception $e) {
            $error_message = "Error updating record: " . $e->getMessage();
        }
    }

    if (isset($_POST['create_request'])) {
        // Create request logic
        $id = $_POST['id'];
        $username = $user_data['username'];
        $date = $_POST['date'];
        $reason = $_POST['reason'];
        $document = $_POST['document'];

        // Prepare insert query for request
        $query = "INSERT INTO request (username, date, reason, situation, document) VALUES (?, ?, ?, 'pending', ?)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $username, $date, $reason, $document);

        try {
            if ($stmt->execute()) {
                $request_success = true; // Set request success flag
            } else {
                $error_message = "Error creating request: " . $conn->error;
            }
        } catch (mysqli_sql_exception $e) {
            $error_message = "Error creating request: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Details</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to bottom, #f0a5a5, #800000); /* Light red to dark red gradient */
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
            color: #14436D; /* Dark blue color for labels */
            font-style: italic; /* Italicize the text */
        }
        .go-home-button button {
            margin-top: 40px;
            background-color: #800000; /* Dark red */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .user-detail input, .user-detail select {
            width: calc(100% - 160px);
            padding: 5px;
            font-size: 14px;
            border-radius: 25px; /* Border radius of 25px */
            border: 1px solid #ccc; /* Example border style */
            outline: none; /* Remove outline */
        }
        .error-message {
            color: red;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .success-message {
            color: green;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Check Your Information</h1>
    <?php if ($update_success): ?>
        <div class="success-message">Information updated successfully!</div>
    <?php endif; ?>
    <?php if ($user_data): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= display_user_data($user_data, 'id'); ?>">
            <div class="user-detail"><strong>First Name:</strong> <input type="text" name="first_name" value="<?= display_user_data($user_data, 'first_name'); ?>"></div>
            <div class="user-detail"><strong>Middle Name:</strong> <input type="text" name="middle_name" value="<?= display_user_data($user_data, 'middle_name'); ?>"></div>
            <div class="user-detail"><strong>Last Name:</strong> <input type="text" name="last_name" value="<?= display_user_data($user_data, 'last_name'); ?>"></div>
            <div class="user-detail"><strong>Birthday:</strong> <input type="date" name="birthday" value="<?= display_user_data($user_data, 'birthday'); ?>"></div>
            <div class="user-detail"><strong>Birthplace:</strong> <input type="text" name="birthplace" value="<?= display_user_data($user_data, 'birthplace'); ?>"></div>
            <div class="user-detail"><strong>Contact No:</strong> <input type="text" name="contactNo" value="<?= display_user_data($user_data, 'contactNo'); ?>"></div>
            <div class="user-detail">
                <strong>Status:</strong>
                <select name="status">
                    <option value="Single" <?= display_user_data($user_data, 'status') == 'Single' ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?= display_user_data($user_data, 'status') == 'Married' ? 'selected' : ''; ?>>Married</option>
                    <option value="Divorced" <?= display_user_data($user_data, 'status') == 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Widowed" <?= display_user_data($user_data, 'status') == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                </select>
            </div>
            <div class="user-detail"><strong>Address:</strong> <input type="text" name="address" value="<?= display_user_data($user_data, 'address'); ?>"></div>
            <div class="go-home-button">
                <button type="submit" name="update_user">Update Information</button>
            </div>
        </form>
    <?php else: ?>
        <p>No user data found. Please add info to your account.</p>
    <?php endif; ?>

    <h1>Create Request</h1>
    <?php if ($request_success): ?>
        <div class="success-message">Request created successfully!</div>
    <?php endif; ?>
    <?php if ($user_data): ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= display_user_data($user_data, 'id'); ?>">
            <div class="user-detail"><strong>Your Appointment:</strong> <input type="date" name="date"></div>
            <div class="user-detail"><strong>Purpose:</strong> <input type="text" name="reason"></div>
            <div class="user-detail">
                <strong>Brgy. Document:</strong>
                <select name="document">
                    <option value="Brgy. Clearance">Brgy. Clearance</option>
                    <option value="Brgy. ID">Brgy. ID</option>
                    <option value="Brgy. Blotter">Brgy. Blotter</option>
                    <option value="Brgy. Business Permit">Brgy. Business Permit</option>
                    <option value="Brgy. Health Cert">Brgy. Health Cert</option>
                </select>
            </div>
            <div class="go-home-button">
                <button type="submit" name="create_request">Create Request</button>
            </div>
        </form>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <div class="error-message"><?= $error_message; ?></div>
    <?php endif; ?>

    <div class="go-home-button">
        <button onclick="window.location.href = 'home.php';">Go to Home</button>
    </div>
</div>

</body>
</html>
