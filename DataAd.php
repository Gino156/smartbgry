<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Display Users Data</title>
<style>
body {
  background: linear-gradient(to bottom, #FFC0CB, #FF5733);
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  color: #333;
  overflow-x: hidden; /* Prevent horizontal scrollbar on smaller screens */
}

.header {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f2f2f2;
  padding: 10px;
}

.header img {
  max-height: 50px; /* Adjust the height of the image */
  margin-right: 10px; /* Space between image and text */
}

.table-container {
  max-height: 500px; /* Set a max height for the table container */
  overflow-y: auto; /* Enable vertical scrolling */
  margin: 20px auto; /* Center the table container */
}

table {
  width: 100%;
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
  padding: 8px;
  white-space: nowrap; /* Prevent text wrapping in table cells */
}

th {
  background-color: #f2f2f2;
  position: sticky;
  top: 0; /* Stick the headers to the top */
}

form {
  display: inline;
}

button[type="submit"] {
  background-color: #3498db;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}

select[name="verify_status"] {
  padding: 5px;
  font-size: 14px;
}

select[name="verify_status"] option[value="Verified"] {
  background-color: #27ae60;
  color: white;
}

select[name="verify_status"] option[value="Unverified"] {
  background-color: #e74c3c;
  color: white;
}

/* Glow effect on hover */
table td:hover {
  text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #ff5733, 0 0 70px #ff5733, 0 0 80px #ff5733, 0 0 100px #ff5733, 0 0 150px #ff5733;
}

/* Change text color to white on hover */
table td:hover {
  color: white;
}
</style>
</head>
<body>

<div class="header">
  <img src="logo.png" alt="Logo" />
  <h2>Users Data</h2>
</div>

<?php
// Include the database connection file
include 'connection.php';

// Function to sanitize and validate input
function sanitize_input($data) {
  // Remove whitespace (not applicable here as we are dealing with enum values)
  $data = trim($data);
  // Prevent XSS
  $data = htmlspecialchars($data);
  return $data;
}

// Update Verify status if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['user_id']) && isset($_POST['verify_status'])) {
    $user_id = sanitize_input($_POST['user_id']);
    $verify_status = sanitize_input($_POST['verify_status']);

    // Update Verify status in the database
    $update_sql = "UPDATE users SET verify = '$verify_status' WHERE id = '$user_id'";
    if (mysqli_query($conn, $update_sql)) {
      echo '<div style="color: green; text-align: center;">Verify status updated successfully.</div>';
    } else {
      echo '<div style="color: red; text-align: center;">Error updating verify status: ' . mysqli_error($conn) . '</div>';
    }
  }
}

// Query to fetch all data from the users table
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo '<div class="table-container">'; // Container for table with vertical scroll
  echo '<table>';
  echo '<thead>'; // Use thead for table header
  echo '<tr>';
  echo '<th>ID</th>';
  echo '<th>Verify</th>'; // Verify column after ID
  echo '<th>Email</th>';
  echo '<th>Password</th>';
  echo '<th>Full Name</th>';
  echo '<th>Username</th>';
  echo '<th>Date</th>';
  echo '<th>First Name</th>';
  echo '<th>Middle Name</th>';
  echo '<th>Last Name</th>';
  echo '<th>Gender</th>';
  echo '<th>Birthday</th>';
  echo '<th>Birthplace</th>';
  echo '<th>Type</th>';
  echo '<th>Address</th>';
  echo '<th>Contact No</th>';
  echo '<th>Status</th>';
  echo '<th>Nationality</th>';
  echo '<th>Religion</th>';
  echo '<th>Occupation</th>';
  echo '<th>Sector</th>';
  echo '<th>Voter No</th>';
  echo '<th>Phil No</th>';
  echo '<th>Person Con</th>';
  echo '<th>Person Re</th>';
  echo '<th>Person No</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>'; // Start tbody for table body

  // Output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>';

    // Display current Verify status as a dropdown select box
    echo '<form method="post">';
    echo '<input type="hidden" name="user_id" value="' . $row['id'] . '">';
    echo '<select name="verify_status">';
    echo '<option value="Unverified" ' . ($row['verify'] == 'Unverified' ? 'selected' : '') . '>Unverified</option>';
    echo '<option value="Verified" ' . ($row['verify'] == 'Verified' ? 'selected' : '') . '>Verified</option>';
    echo '</select>';
    echo '<button type="submit">Update</button>';
    echo '</form>';

    echo '</td>';
    echo '<td>' . ($row['email'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if email is empty
    echo '<td>' . ($row['password'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if password is empty
    echo '<td>' . ($row['fullname'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if full name is empty
    echo '<td>' . ($row['username'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if username is empty
    echo '<td>' . ($row['date'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if date is empty
    echo '<td>' . ($row['first_name'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if first name is empty
    echo '<td>' . ($row['middle_name'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if middle name is empty
    echo '<td>' . ($row['last_name'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if last name is empty
    echo '<td>' . ($row['gender'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if gender is empty
    echo '<td>' . ($row['birthday'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if birthday is empty
    echo '<td>' . ($row['birthplace'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if birthplace is empty
    echo '<td>' . ($row['type'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if type is empty
    echo '<td>' . ($row['address'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if address is empty
    echo '<td>' . ($row['contactNo'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if contact no is empty
    echo '<td>' . ($row['status'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if status is empty
    echo '<td>' . ($row['nationality'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if nationality is empty
    echo '<td>' . ($row['religion'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if religion is empty
    echo '<td>' . ($row['occupation'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if occupation is empty
    echo '<td>' . ($row['sector'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if sector is empty
    echo '<td>' . ($row['voterNo'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if voter no is empty
    echo '<td>' . ($row['philNo'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if phil no is empty
    echo '<td>' . ($row['personCon'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if person con is empty
    echo '<td>' . ($row['personRe'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if person re is empty
    echo '<td>' . ($row['personNo'] ?: '🤔 Incomplete') . '</td>'; // Display emoji if person no is empty
    echo '</tr>';
  }
  echo '</tbody>'; // Close tbody
  echo '</table>';
  echo '</div>'; // Close table-container div for vertical scrolling
} else {
  echo '<div style="text-align: center;">No records found</div>';
}

// Close connection (included for clarity, though closing isn't necessary as PHP automatically closes it at script end)
mysqli_close($conn);
?>

<button onclick="window.location.href = 'admin.php';">Go to Home 🏠</button>

</body>
</html>
