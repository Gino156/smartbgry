<?php
ob_start(); // Start output buffering
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($conn);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve values from the form
    $message = $_POST['message'];
    $form_username = $user_data['username'];
    $recipient = $_POST['recipient'];

    // Insert the values into the database using prepared statements to prevent SQL injection
    $sql = $conn->prepare("INSERT INTO messages (timestamp, username, account, message) VALUES (CURRENT_TIMESTAMP, ?, ?, ?)");
    if ($sql === false) {
        die("Error preparing sztatement: " . $conn->error);
    }

    $sql->bind_param("sss", $form_username, $recipient, $message);

    if ($sql->execute()) {
        // Redirect to the same page to avoid form resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Output any errors
        echo "Error: " . $sql->error . "<br>";
    }

    // Close the prepared statement
    $sql->close();
}

// Retrieve messages
$sql = "SELECT messages.*, admin.*, users.*, messages.timestamp AS message_timestamp
        FROM messages
        LEFT JOIN admin ON messages.username = admin.username
        LEFT JOIN users ON messages.username = users.username
        WHERE (messages.account = '{$user_data['username']}'
               OR messages.username = '{$user_data['username']}'
               OR admin.username = '{$user_data['username']}'
               OR users.username = '{$user_data['username']}')
        ORDER BY messages.timestamp DESC";
$result = $conn->query($sql);
if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="messages.css">
    <style>
        body {
                         background-color: #d43532;
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            color: black;
            width: 80%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
        }
        .chat-box {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px;
            max-height: 400px;
            overflow-y: scroll;
        }
        .chat-message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 10px;
            background-color: #e0e0e0;
        }
        .chat-message .sender {
            font-weight: bold;
        }
        .chat-message .timestamp {
            font-size: 0.8em;
            color: #888;
        }
        .emoji-picker {
            margin-bottom: 10px;
        }
        .container {
    background-color: white;
    color: black;
    width: 80%;
    margin: auto;
    padding: 20px;
    border-radius: 10px;
    overflow: hidden; /* Add overflow hidden to prevent overlapping */
}

.form {
    margin-top: 20px; /* Add margin to separate the form from the chat box */
}

.form label,
.form select,
.form textarea,
.form input[type="submit"] {
    display: block; /* Display form elements as block to stack them vertically */
    margin-bottom: 10px; /* Add margin between form elements */
     font-weight: bold;
       margin-top: 20px;
            background-color: green; /* Maroon color */
}
.form input[type="text"],
.text {
    margin-right: 20px; /* Adjust the right margin as needed */
            color: black;
                        width: 60%;
            font-size: 16px;
            border-radius: 5px;
            
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
.send button {
                font-weight: bold;
       margin-top: 20px;
            background-color: green; /* Maroon color */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .go-home-button button:hover {
            background-color: #660000; /* Darker maroon */
        }
    input[type="submit"] {
            background-color: green;
            color: white;
                                 font-weight: bold;
            border-radius: 5px;

        }
       select {
            font-size: 14px; /* Adjust this value to change the size */
            padding: 5px;
            font-weight: bold;
            width: 60%;
            color:green;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Events ChatBox!!</h1>
        <div class="chat-box">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='chat-message'>
                            <span class='sender'>{$row['username']}</span> <br>
                            <span class='message'>{$row['message']}</span><br>
                            <span class='timestamp'>{$row['message_timestamp']}</span>
                          </div>";
                }
            } else {
                echo "<div class='chat-message'>No records found</div>";
            }
            ?>
        </div>

        <form action="message.php" method="post">
            
            
            
            
            <?php
            // Fetch usernames from the 'users' table
            $usersQuery = "SELECT username FROM users";
            $usersResult = $conn->query($usersQuery);

            // Fetch usernames from the 'admin' table
            $adminQuery = "SELECT username FROM admin";
            $adminResult = $conn->query($adminQuery);
            ?>

            <!-- Add a dropdown list for selecting the recipient -->
            <label for="recipient">Choose someone to chat:</label>
            <select name="recipient" required>
                <?php
                // Display usernames from the 'users' table
                while ($usersRow = $usersResult->fetch_assoc()) {
                    echo "<option value='{$usersRow['username']}'>{$usersRow['username']} (Member)</option>";
                }

                // Display usernames from the 'admin' table
                while ($adminRow = $adminResult->fetch_assoc()) {
                    echo "<option value='{$adminRow['username']}'>{$adminRow['username']} (Admin)</option>";
                }
                ?>
            </select><br>

            <!-- Label for the message -->
            <label for="message">Message:</label>
            <textarea class ="text" name="message" rows="4" cols="50" required></textarea><br>

            <!-- Emoji picker -->
            <div class="emoji-picker">
             <button type="button" onclick="addEmoji('&#128512;')">&#128512;</button> <!-- 😀 -->
<button type="button" onclick="addEmoji('&#128513;')">&#128513;</button> <!-- 😁 -->
<button type="button" onclick="addEmoji('&#128514;')">&#128514;</button> <!-- 😂 -->
<button type="button" onclick="addEmoji('&#128515;')">&#128515;</button> <!-- 😃 -->
<button type="button" onclick="addEmoji('&#128516;')">&#128516;</button> <!-- 😄 -->
<button type="button" onclick="addEmoji('&#128517;')">&#128517;</button> <!-- 😅 -->
<button type="button" onclick="addEmoji('&#128518;')">&#128518;</button> <!-- 😆 -->
<button type="button" onclick="addEmoji('&#128519;')">&#128519;</button> <!-- 😉 -->
<button type="button" onclick="addEmoji('&#128520;')">&#128520;</button> <!-- 😊 -->
<button type="button" onclick="addEmoji('&#128521;')">&#128521;</button> <!-- 😋 -->
<button type="button" onclick="addEmoji('&#128522;')">&#128522;</button> <!-- 😌 -->
<button type="button" onclick="addEmoji('&#128523;')">&#128523;</button> <!-- 😍 -->
<button type="button" onclick="addEmoji('&#128524;')">&#128524;</button> <!-- 😎 -->
<button type="button" onclick="addEmoji('&#128525;')">&#128525;</button> <!-- 😏 -->
<button type="button" onclick="addEmoji('&#128526;')">&#128526;</button> <!-- 😐 -->
<button type="button" onclick="addEmoji('&#128527;')">&#128527;</button> <!-- 😑 -->
<button type="button" onclick="addEmoji('&#128528;')">&#128528;</button> <!-- 😒 -->
<button type="button" onclick="addEmoji('&#128529;')">&#128529;</button> <!-- 😓 -->
<button type="button" onclick="addEmoji('&#128530;')">&#128530;</button> <!-- 😔 -->
<button type="button" onclick="addEmoji('&#128531;')">&#128531;</button> <!-- 😕 -->
<button type="button" onclick="addEmoji('&#128532;')">&#128532;</button> <!-- 😖 -->
<button type="button" onclick="addEmoji('&#128533;')">&#128533;</button> <!-- 😗 -->
<button type="button" onclick="addEmoji('&#128534;')">&#128534;</button> <!-- 😘 -->
<button type="button" onclick="addEmoji('&#128535;')">&#128535;</button> <!-- 😙 -->
<button type="button" onclick="addEmoji('&#128536;')">&#128536;</button> <!-- 😚 -->
<button type="button" onclick="addEmoji('&#128537;')">&#128537;</button> <!-- 😛 -->
<button type="button" onclick="addEmoji('&#128538;')">&#128538;</button> <!-- 😜 -->
<button type="button" onclick="addEmoji('&#128539;')">&#128539;</button> <!-- 😝 -->
<button type="button" onclick="addEmoji('&#128540;')">&#128540;</button> <!-- 😞 -->
<button type="button" onclick="addEmoji('&#128541;')">&#128541;</button> <!-- 😟 -->
<button type="button" onclick="addEmoji('&#128542;')">&#128542;</button> <!-- 😠 -->
<button type="button" onclick="addEmoji('&#128543;')">&#128543;</button> <!-- 😡 -->
<button type="button" onclick="addEmoji('&#128544;')">&#128544;</button> <!-- 😢 -->
<button type="button" onclick="addEmoji('&#128545;')">&#128545;</button> <!-- 😣 -->
<button type="button" onclick="addEmoji('&#128546;')">&#128546;</button> <!-- 😤 -->
<button type="button" onclick="addEmoji('&#128547;')">&#128547;</button> <!-- 😥 -->
<button type="button" onclick="addEmoji('&#128548;')">&#128548;</button> <!-- 😦 -->
<button type="button" onclick="addEmoji('&#128549;')">&#128549;</button> <!-- 😧 -->
<button type="button" onclick="addEmoji('&#128550;')">&#128550;</button> <!-- 😨 -->
<button type="button" onclick="addEmoji('&#128551;')">&#128551;</button> <!-- 😩 -->
<button type="button" onclick="addEmoji('&#128552;')">&#128552;</button> <!-- 😪 -->
<button type="button" onclick="addEmoji('&#128553;')">&#128553;</button> <!-- 😫 -->
<button type="button" onclick="addEmoji('&#128554;')">&#128554;</button> <!-- 😬 -->
<button type="button" onclick="addEmoji('&#128555;')">&#128555;</button> <!-- 😭 -->
<button type="button" onclick="addEmoji('&#128556;')">&#128556;</button> <!-- 😮 -->
<button type="button" onclick="addEmoji('&#128557;')">&#128557;</button> <!-- 😯 -->
<button type="button" onclick="addEmoji('&#128558;')">&#128558;</button> <!-- 😰 -->
<button type="button" onclick="addEmoji('&#128559;')">&#128559;</button> <!-- 😱 -->
<button type="button" onclick="addEmoji('&#128560;')">&#128560;</button> <!-- 😲 -->
<button type="button" onclick="addEmoji('&#128561;')">&#128561;</button> <!-- 😳 -->
<button type="button" onclick="addEmoji('&#128562;')">&#128562;</button> <!-- 😴 -->
<button type="button" onclick="addEmoji('&#128563;')">&#128563;</button> <!-- 😵 -->
<button type="button" onclick="addEmoji('&#128564;')">&#128564;</button> <!-- 😶 -->
<button type="button" onclick="addEmoji('&#128565;')">&#128565;</button> <!-- 😷 -->
<button type="button" onclick="addEmoji('&#128566;')">&#128566;</button> <!-- 😸 -->
<button type="button" onclick="addEmoji('&#128567;')">&#128567;</button> <!-- 😹 -->
<button type="button" onclick="addEmoji('&#128568;')">&#128568;</button> <!-- 😺 -->
<button type="button" onclick="addEmoji('&#128569;')">&#128569;</button> <!-- 😻 -->
<button type="button" onclick="addEmoji('&#128570;')">&#128570;</button> <!-- 😼 -->
<button type="button" onclick="addEmoji('&#128571;')">&#128571;</button>
<button type="button" onclick="addEmoji('&#10084;')">&#10084;</button> <!-- ❤️ -->
<button type="button" onclick="addEmoji('&#127881;')">&#127881;</button> <!-- 🎉 -->

                <!-- Add more emojis as needed -->
            </div>

            <!-- Submit button -->
                        <div class="send">
            <input type="submit" name="submit" value="Send Message">
                        </div>

        </form>
        <div class="go-home-button">
        <button onclick="window.location.href = 'home.php';">Go to Home</button>
                <button onclick="window.location.href = 'group.php';">Barangay Group Chat</button>
                <button onclick="window.location.href = 'adminmessage2.php';">Barangay Admin Chat</button>

    </div>
    </div>

    <script>
        function addEmoji(emoji) {
            const messageField = document.querySelector('textarea[name="message"]');
            messageField.value += emoji;
        }
       
   




    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
ob_end_flush(); // Flush the output buffer and send the output
?>
