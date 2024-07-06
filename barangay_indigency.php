<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indigency Successfully Registered</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .status {
            text-align: center;
            margin-top: 50px;
        }

        .status p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Request New Document(Brgy Indigency)</h1>
        <div class="status">
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "id21660325_dbuser"; // Update with your MySQL username
            $password = "1StrongP@ssw0rd"; // Update with your MySQL password
            $database = "id21660325_mydatabase"; // Update with your MySQL database name

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $lastName = $_POST['lastName'];
                $firstName = $_POST['firstName'];
                $middleName = $_POST['middleName'];
                $address = $_POST['address'];
                $street = $_POST['street'];
                $birthday = $_POST['birthday'];
                $age = $_POST['age'];
                $phone = $_POST['phone'];
                $citizenship = $_POST['citizenship'];

                $stmt = $conn->prepare("INSERT INTO indigency_request (lastName, firstName, middleName, address, street, birthday, age, phone, citizenship) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssiss", $lastName, $firstName, $middleName, $address, $street, $birthday, $age, $phone, $citizenship);

                if ($stmt->execute()) {
                    $message = "New record created successfully";
                } else {
                    $message = "Error: " . $stmt->error;
                }

                $stmt->close();
            }
            ?>
            <p><?php echo isset($message) ? $message : ""; ?></p>
            <a href="requestdocuments.php" class="btn">Go Back</a>
        </div>
    </div>
</body>

</html>
