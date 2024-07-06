<?php
ob_start();
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        // Read from database
        $query = "SELECT * FROM admin WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $admin_data = mysqli_fetch_assoc($result);

            if ($admin_data['password'] === $password) {
                $_SESSION['admin_id'] = $admin_data['id'];
                header("Location: admin_home.php");
                die;
            } else {
                $errors['general'] = "Wrong email or password!";
            }
        } else {
            $errors['general'] = "Wrong email or password!";
        }
    } else {
        $errors['general'] = "Please provide valid email and password!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <img src="../admin_logo.png" alt="Admin Logo" class="logo">
    </div>

    <div class="body">
        <div class="container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="email" name="email" class="input-field email" placeholder="Email" required>
                <?php if (isset($errors['general'])): ?>
                    <div class="error-message"><?php echo $errors['general']; ?></div>
                <?php endif; ?>
                <input type="password" name="password" class="input-field password" placeholder="Password" required>
                <input class="button" type="submit" value="Login">
            </form>
        </div>
    </div>

    <script>
        // Your client-side JavaScript code here
    </script>
</body>
</html>
