<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Transaction</title>
    <link rel="icon" href="../logo.png" type="image/png">
    <link rel="stylesheet" href="adminhome.css">
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .back-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Transaction</h1>

        <h2>Barangay Indigency Request</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $servername = "localhost";
                $username = "id21660325_dbuser";
                $password = "1StrongP@ssw0rd";
                $dbname = "id21660325_mydatabase";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data for indigency requests
                $sql_indigency = "SELECT id, lastName, firstName, status FROM indigency_request";
                $result_indigency = $conn->query($sql_indigency);

                if ($result_indigency->num_rows > 0) {
                    while ($row = $result_indigency->fetch_assoc()) {
                        $status = isset($row['status']) ? $row['status'] : 'Pending';
                        echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['lastName']}</td>
                                <td>{$row['firstName']}</td>
                                <td>{$status}</td>
                                <td><a href='view_request.php?type=indigency&id={$row['id']}'>View</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No indigency requests found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Barangay Clearance Request</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data for clearance requests
                $sql_clearance = "SELECT id, lastName, firstName, status FROM clearance_request";
                $result_clearance = $conn->query($sql_clearance);

                if ($result_clearance->num_rows > 0) {
                    while ($row = $result_clearance->fetch_assoc()) {
                        $status = isset($row['status']) ? $row['status'] : 'Pending';
                        echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['lastName']}</td>
                                <td>{$row['firstName']}</td>
                                <td>{$status}</td>
                                <td><a href='view_request.php?type=clearance&id={$row['id']}'>View</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No clearance requests found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Residency Request</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data for residency requests
                $sql_residency = "SELECT id, lastName, firstName, status FROM residency_request";
                $result_residency = $conn->query($sql_residency);

                if ($result_residency->num_rows > 0) {
                    while ($row = $result_residency->fetch_assoc()) {
                        $status = isset($row['status']) ? $row['status'] : 'Pending';
                        echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['lastName']}</td>
                                <td>{$row['firstName']}</td>
                                <td>{$status}</td>
                                <td><a href='view_request.php?type=residency&id={$row['id']}'>View</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No residency requests found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <h2>Solo Parent Request</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $servername = "localhost";
                $username = "id21660325_dbuser";
                $password = "1StrongP@ssw0rd";
                $dbname = "id21660325_mydatabase";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data for solo parent requests
                $sql_solo_parent = "SELECT id, lastName, firstName, status FROM soloparent_request";
                $result_solo_parent = $conn->query($sql_solo_parent);

                if ($result_solo_parent->num_rows > 0) {
                    while ($row = $result_solo_parent->fetch_assoc()) {
                        $status = isset($row['status']) ? $row['status'] : 'Pending';
                        echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['lastName']}</td>
                                <td>{$row['firstName']}</td>
                                <td>{$status}</td>
                                <td><a href='view_request.php?type=solo_parent&id={$row['id']}'>View</a></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No solo parent requests found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

       

        <a class="back-btn" href="admin.php">Back to Home</a>
    </div>
</body>

</html>
