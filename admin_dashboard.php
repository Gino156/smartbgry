<?php 
ob_start();
session_start();

	include("connection.php");
	include("function2.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
           $email = $_POST['email'];
          $password = $_POST['password'];

		if(!empty($email ) && !empty($password) && !is_numeric($email ))
		{

			//read from database
			$query = "select * from admin where email  = '$email ' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['id'] = $user_data['id'];
						header("Location:admin.php ");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <img src="../logo.png" alt="Logo" class="logo">
    </div>

    <div class="body">
        <div class="container">
            <form method="post" onsubmit="return validateForm();" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="email" name="email" class="input-field email" placeholder="Email" required onblur="checkInputValidity('email')">

                <?php if (isset($errors['general'])): ?>
                    <div class="error-message" id="email-error"><?php echo $errors['general']; ?></div>
                <?php endif; ?><br>

                <div class="password-wrapper">
                    <input type="password" name="password" class="input-field password" id="password" required placeholder="Password" onblur="checkInputValidity('password')">
                    <img src="close-eye.png" alt="Toggle Password Visibility" class="eye-icon" id="eye-icon" onclick="togglePasswordVisibility()">
                </div>

                <?php if (isset($errors['password'])): ?>  
                    <div class="error-message"><?php echo $errors['password']; ?></div>
                <?php endif; ?><br>

                <label class="remember-me">
                    <input type="checkbox" name="remember"> Remember Me
                    <span class="forgot-password"><a href="forgotAdmin.php">Forgot Password?</a></span>
                </label>

                <div class="link">
                    <input id="button" class="button" type="submit" value="Login"><br>
                </div>
            </form>

            <div class="create-account-text">
                <p>Don't have an account? <a href="adminaccount.php" class="create-account-link">Create an account</a></p>
            </div>
            <p class="copyright">Copyright 2024</p>
        </div>
    </div>
    <div class="footer"></div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "../open-eye.png";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "../close-eye.png";
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var emailInput = document.querySelector('input[type="email"]');
            var passwordInput = document.getElementById("password");

            emailInput.addEventListener('click', function () {
                this.style.borderColor = '#ff0000';
            });

            emailInput.addEventListener('blur', function () {
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });

            passwordInput.addEventListener('click', function () {
                this.style.borderColor = '#ff0000';
            });

            passwordInput.addEventListener('blur', function () {
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });
        });

        function checkInputValidity(inputId) {
            var input = document.getElementsByName(inputId)[0];
            var errorDiv = document.getElementById(inputId + '-error');
            
            if (input.value === "" || (errorDiv && errorDiv.innerHTML !== "")) {
                input.classList.add("red-placeholder");
            } else {
                input.classList.remove("red-placeholder");
            }
        }

        function validateForm() {
            checkInputValidity('email');
            checkInputValidity('password');
            
            return (!document.getElementsByName('email')[0].classList.contains("red-placeholder") &&
                    !document.getElementsByName('password')[0].classList.contains("red-placeholder"));
        }
        
        document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const rememberMeCheckbox = document.getElementById('rememberMe');

    // Load saved email if it exists
    if (localStorage.getItem('rememberMe') === 'true') {
        emailInput.value = localStorage.getItem('email');
        rememberMeCheckbox.checked = true;
    }

    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent actual form submission

        if (rememberMeCheckbox.checked) {
            localStorage.setItem('email', emailInput.value);
            localStorage.setItem('rememberMe', 'true');
        } else {
            localStorage.removeItem('email');
            localStorage.removeItem('rememberMe');
        }

        // Proceed with form submission logic
        alert('Form submitted!');
    });
});

    </script>
</body>
</html>
