<?php
ob_start();
$host = "localhost"; // Define $host
$dbname = "id21660325_mydatabase"; // Define $dbname
$username = "id21660325_dbuser";
$password = "1StrongP@ssw0rd";

// Start session
session_start();

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$errors = [];

// Check if form is submitted and has the required data
if (isset($_POST['update'])) {
    // Retrieve the user's ID from the session
    $userId = $_SESSION['id'];

    // Retrieve other updated data from your form
    $newFirstName = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $newMiddleName = isset($_POST['middle_name']) ? $_POST['middle_name'] : null;
    $newLastName = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $newGender = isset($_POST['gender']) ? $_POST['gender'] : null;
    $newBirthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
    $newBirthplace = isset($_POST['birthplace']) ? $_POST['birthplace'] : null;
    $newType = isset($_POST['type']) ? $_POST['type'] : null;
    $newAddress = isset($_POST['address']) ? $_POST['address'] : null;
    $newContactNo = isset($_POST['contactNo']) ? $_POST['contactNo'] : null;
    $newStatus = isset($_POST['status']) ? $_POST['status'] : null;
    $newNationality = isset($_POST['nationality']) ? $_POST['nationality'] : null;
    $newReligion = isset($_POST['religion']) ? $_POST['religion'] : null;
    $newOccupation = isset($_POST['occupation']) ? $_POST['occupation'] : null;
    $newSector = isset($_POST['sector']) ? $_POST['sector'] : null;
    $newVoterNo = isset($_POST['voterNo']) ? $_POST['voterNo'] : null;
    $newPhilNo = isset($_POST['philNo']) ? $_POST['philNo'] : null;
    $newPersonCon = isset($_POST['personCon']) ? $_POST['personCon'] : null;
    $newPersonRe = isset($_POST['personRe']) ? $_POST['personRe'] : null;
    $newPersonNo = isset($_POST['personNo']) ? $_POST['personNo'] : null;

    // Validation
    // Validate contact number and person contact number
if (empty($newContactNo) || strlen($newContactNo) != 11 || !ctype_digit($newContactNo) ||
    !ctype_digit($newPersonNo)) {
    $errors[] = "Contact must be 11 digits long and numeric.";
}
    if (!ctype_digit($newVoterNo) || !ctype_digit($newPhilNo) || !ctype_digit($newPersonNo)) {
    $errors[] = "Please enter a number in No..";
}
    if (empty($newFirstName) || empty($newLastName) || empty($newGender) || empty($newBirthday) || empty($newBirthplace) || empty($newAddress) || empty($newStatus) || empty($newNationality) || empty($newReligion) || empty($newOccupation) || empty($newSector) || empty($newPersonCon) || empty($newPersonRe)) {
        $errors[] = "All fields are required.";
    }

    if (count($errors) == 0) {
        // Update the user information in the 'users' table
        try {
            $stmt = $pdo->prepare("UPDATE admin SET first_name = :newFirstName, middle_name = :newMiddleName, last_name = :newLastName, gender = :newGender, birthday = :newBirthday, birthplace = :newBirthplace, type = :newType, address = :newAddress, contactNo = :newContactNo, status = :newStatus, nationality = :newNationality, religion = :newReligion, occupation = :newOccupation, sector = :newSector, voterNo = :newVoterNo, philNo = :newPhilNo, personCon = :newPersonCon, personRe = :newPersonRe, personNo = :newPersonNo WHERE id = :userId");

            $stmt->bindParam(':newFirstName', $newFirstName, PDO::PARAM_STR);
            $stmt->bindParam(':newMiddleName', $newMiddleName, PDO::PARAM_STR);
            $stmt->bindParam(':newLastName', $newLastName, PDO::PARAM_STR);
            $stmt->bindParam(':newGender', $newGender, PDO::PARAM_STR);
            $stmt->bindParam(':newBirthday', $newBirthday, PDO::PARAM_STR);
            $stmt->bindParam(':newBirthplace', $newBirthplace, PDO::PARAM_STR);
            $stmt->bindParam(':newType', $newType, PDO::PARAM_STR);
            $stmt->bindParam(':newAddress', $newAddress, PDO::PARAM_STR);
            $stmt->bindParam(':newContactNo', $newContactNo, PDO::PARAM_STR);
            $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
            $stmt->bindParam(':newNationality', $newNationality, PDO::PARAM_STR);
            $stmt->bindParam(':newReligion', $newReligion, PDO::PARAM_STR);
            $stmt->bindParam(':newOccupation', $newOccupation, PDO::PARAM_STR);
            $stmt->bindParam(':newSector', $newSector, PDO::PARAM_STR);
            $stmt->bindParam(':newVoterNo', $newVoterNo, PDO::PARAM_STR);
            $stmt->bindParam(':newPhilNo', $newPhilNo, PDO::PARAM_STR);
            $stmt->bindParam(':newPersonCon', $newPersonCon, PDO::PARAM_STR);
            $stmt->bindParam(':newPersonRe', $newPersonRe, PDO::PARAM_STR);
            $stmt->bindParam(':newPersonNo', $newPersonNo, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            echo "User information updated successfully.";
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartBrgy.ph</title>
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
            height: 120vh;
        }
        
        .account-details {
            
            border-radius: 25px 25px 0 0; /* Set border-radius for the first template */
              background-color: #f0f0f0; /* Just for visualization */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Adding some space between the two sections */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .account-section {
            border-radius: 0 0 25px 25px; /* Set border-radius for the second template */
        }

        /* Styling for account details and section */
        .account-details,
        .account-section {
              width: 300%; /* Adjust width as needed */
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
        .account-verification  {
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
        input[type="submit"] {
            background-color: green;
            color: white;
                                 font-weight: bold;
            border-radius: 5px;

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
            
<?php
// Display errors if there are any
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
} elseif (isset($_POST['update']) && count($errors) == 0) {
    // Display success message if the form was submitted successfully
    echo "<p style='color: green;'>User information updated successfully.</p>";
}
?>

            
            <form method="post" action="myaccount1.php">
               First Name:<br>
                    <input type="text" name="first_name"><br>
                    Middle Name:<br>
                    <input type="text" name="middle_name"><br>
                    Last Name:<br>
                    <input type="text" name="last_name"><br>
                    Gender:<br>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="o">Other</option>
                    </select><br>
                    Birthday:<br>
                    <input type="date" name="birthday"><br>
                    
                                <h3><img src="other.png" class="gen gen-img" alt="iwee" id="1-icon"></h3>

                    Birthplace:<br>
                    <input type="text" name="birthplace"><br>
                    Blood Type:<br>
                    <select name="type">
                    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
                    </select><br>
                    Address:<br>
                    <input type="text" name="address"><br>
                    Contact No:<br>
                    <input type="text" name="contactNo"><br>
                    Civil Status:<br>
                    <select name="status">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select><br>
                    Nationality:<br>
                    <input type="text" name="nationality"><br>
                    Religion:<br>
                    <input type="text" name="religion"><br>
                    
                 <h3><img src="refer.png" class="gen gen-img" alt="iwee" id="1-icon"></h3>

                    Occupation:<br>
                    <input type="text" name="occupation"><br>
                    Sector:<br>
                    <select name="sector">
                        <option value="PWD">PWD</option>
                        <option value="Senior">Senior</option>
                        <option value="Solo Parent">Solo Parent</option>
                                                <option value="o">Other</option>

                    </select><br>
                    Voter No:<br>
                    <input type="text" name="voterNo"><br>
                    PhilHealth No:<br>
                    <input type="text" name="philNo"><br>
                    Contact Person in Case of Emergency:<br>
                    <input type="text" name="personCon"><br>
                    Contact Person Relationship:<br>
                    <input type="text" name="personRe"><br>
                    Contact Person Contact No:<br>
                    <input type="text" name="personNo"><br>
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
        <script>
    // Function to validate numeric input for Voter No and PhilHealth No
    function validateNumericInput(event) {
        const input = event.target;
        input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
    }

    // Attach event listeners to Voter No and PhilHealth No fields
    const voterNoInput = document.querySelector('input[name="voterNo"]');
    const philNoInput = document.querySelector('input[name="philNo"]');
    voterNoInput.addEventListener('input', validateNumericInput);
    philNoInput.addEventListener('input', validateNumericInput);

    // Function to validate Person No field
    function validatePersonNo(event) {
        const input = event.target;
        const value = input.value.trim();
        if (isNaN(value) || value === '') {
            input.setCustomValidity('Please enter a valid number');
        } else {
            input.setCustomValidity('');
        }
    }

    // Attach event listener to Person No field
    const personNoInput = document.querySelector('input[name="personNo"]');
    personNoInput.addEventListener('input', validatePersonNo);


</script>
</body>
</html>
