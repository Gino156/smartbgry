<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Documents</title>
    <link rel="stylesheet" href="adminhome.css">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .document-buttons {
            margin-bottom: 20px;
        }

        .document-buttons button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container {
            display: none;
            margin-top: 20px;
            text-align: left;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .status {
            margin-top: 20px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>

<body>
    
    <div class="container">
        <!-- Button to go home -->
    <button onclick="goHome()">Go Home</button>
        <h1>Request New Document</h1>
        <div class="document-buttons">
            <button onclick="showForm('indigencyForm')">BARANGAY INDIGENCY FORM</button>
            <button onclick="showForm('clearanceForm')">BARANGAY CLEARANCE FORM</button>
            <button onclick="showForm('residencyForm')">BARANGAY RESIDENCY FORM</button>
            <button onclick="showForm('soloParentForm')">SOLO PARENT FORM</button>
        </div>

        <div class="form-container" id="indigencyForm">
            <h2>Barangay Indigency Form</h2>
            <form action="barangay_indigency.php" method="post">
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" id="middleName" name="middleName" required>
                </div>
                <div class="form-group">
                    <label for="address">Address Home#:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" required>
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="phone">Cellphone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship" required>
                </div>
                <button type="submit">Submit Request</button>
            </form>
            <span class="close-btn" onclick="closeForm()">×</span>
        </div>

        <div class="form-container" id="clearanceForm">
            <h2>Barangay Clearance Form</h2>
            <form action="barangay_clearance.php" method="post">
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" id="middleName" name="middleName" required>
                </div>
                <div class="form-group">
                    <label for="address">Address Home#:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" required>
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="phone">Cellphone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship" required>
                </div>
                <button type="submit">Submit Request</button>
            </form>
            <span class="close-btn" onclick="closeForm()">×</span>
        </div>

        <div class="form-container" id="residencyForm">
            <h2>Barangay Residency Form</h2>
            <form action="barangay_residency.php" method="post">
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" id="middleName" name="middleName" required>
                </div>
                <div class="form-group">
                    <label for="address">Address Home#:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" required>
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="phone">Cellphone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship" required>
                </div>
                <button type="submit">Submit Request</button>
            </form>
            <span class="close-btn" onclick="closeForm()">×</span>
        </div>

        <div class="form-container" id="soloParentForm">
            <h2>Solo Parent Form</h2>
            <form action="soloparent_request.php" method="post">
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="middleName">Middle Name:</label>
                    <input type="text" id="middleName" name="middleName" required>
                </div>
                <div class="form-group">
                    <label for="address">Address Home#:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" id="street" name="street" required>
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" id="birthday" name="birthday" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="phone">Cellphone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship" required>
                </div>
                <button type="submit">Submit Request</button>
            </form>
            <span class="close-btn" onclick="closeForm()">×</span>
        </div>

        <div class="status">
          
    </div>

    <script>
        function showForm(formId) {
            // Hide all forms
            var forms = document.querySelectorAll('.form-container');
            forms.forEach(function (form) {
                form.style.display = 'none';
            });

            // Show the selected form
            var form = document.getElementById(formId);
            if (form) {
                form.style.display = 'block';
            }
        }

        function closeForm() {
            var forms = document.querySelectorAll('.form-container');
            forms.forEach(function (form) {
                form.style.display = 'none';
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            fetch('fetch_requests.php')
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched data:', data); // Debugging step
                    var statusContainer = document.getElementById('status-container');
                    statusContainer.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(request => {
                            var requestDiv = document.createElement('div');
                            requestDiv.innerHTML = `
                                <strong>Document Type:</strong> ${request.document_type} <br>
                                <strong>Status:</strong> ${request.status} <br>
                                <hr>
                            `;
                            statusContainer.appendChild(requestDiv);
                        });
                    } else {
                        statusContainer.innerHTML = 'No requests found.';
                    }
                })
                .catch(error => {
                    var statusContainer = document.getElementById('status-container');
                    statusContainer.innerHTML = 'Error fetching request statuses.';
                    console.error('Error:', error);
                });
        });
        
        function goHome() {
    // Redirect to home page or perform any desired action
    window.location.href = "home.php"; // Change "home.html" to your actual home page URL
}

    </script>
</body>

</html>
