<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartBrgy.ph</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <style>
        html {
            height: 100%; /* Ensure html element covers full viewport height */
            background: 
                linear-gradient(to bottom, #ffcccc, #ff6666, #cc3333), /* light red to dark red gradient */
                url('hall.avif'); /* background image */
            background-size: cover; /* cover the entire background */
            background-position: center center; /* center the background image */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%; /* Ensure body covers full viewport height */
            overflow: hidden; /* Prevent scrolling */
        }

        .container {
            width: 100%;
            max-width: 300px;
            margin: 100px auto 0 auto; /* Adjusted margin to center container */
            padding: 20px;
            background: rgba(255, 255, 255, 0.9); /* semi-transparent white background */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            width: 80px;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .destination {
            margin-bottom: 30px;
        }

        .destination p {
            margin-bottom: 10px;
            color: #555;
        }

        .destination-btn {
            display: block;
            width: 90%;
            padding: 8px;
            margin: 5px auto;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .destination-btn:first-of-type {
            background: #28a745; /* green */
            color: #fff;
        }

        .destination-btn:first-of-type:hover {
            background: #218838; /* darker green */
        }

        .destination-btn:last-of-type {
            background: #17a2b8; /* sky blue */
            color: #fff;
        }

        .destination-btn:last-of-type:hover {
            background: #138496; /* darker sky blue */
        }

        .footer {
            padding: 20px 0; /* Add padding instead of margin to create spacing */
            text-align: center;
            color: #555;
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.9); /* semi-transparent white background */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../logo.png" alt="Logo" class="logo">
        <h2>Welcome to SmartBrgy.ph</h2>
        <div class="destination">
            <p>Choose destination:</p>
            <a href="index.php" class="destination-btn">Login as User</a>
            <a href="admin_dashboard.php" class="destination-btn">Login as Admin</a>
        </div>
    </div>
    <div class="footer">
        <p>&copy; 2024 SmartBrgy.ph</p>
    </div>
</body>
</html>
