<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(236, 236, 224);
            margin: 0;
            padding: 0;
        }
        h2, h3 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .access-denied {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    echo "<p class='access-denied'>Access denied. Please <a href='admin-login.html'>login</a> as an administrator.</p>";
    exit();
}     

// Connect to database
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your DB password
$dbname = "tregistration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch registration count
$count_sql = "SELECT COUNT(*) AS register_count FROM tregistration";
$count_result = $conn->query($count_sql);
$register_count = 0;

if ($count_result->num_rows > 0) {
    $row = $count_result->fetch_assoc();
    $register_count = $row['register_count'];
}

// Fetch registration data
$sql = "SELECT * FROM tregistration"; // Replace 'tregistration' with your table name
$result = $conn->query($sql);

echo "<h2>Registration Data</h2>";
echo "<h3>Total Registered Users: $register_count</h3>";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Sector</th>
                <th>Birthday</th>
                <th>Gender</th>
                <th>Courses</th>
                <th>School</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['full_name'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['phone_number'] . "</td>
                <td>" . $row['address'] . "</td>
                <td>" . $row['sector'] . "</td>
                <td>" . $row['birthday'] . "</td>
                <td>" . $row['gender'] . "</td>
                <td>" . $row['courses'] . "</td>
                <td>" . $row['school'] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No registrations found.";
}

$conn->close();
?>

</body>
</html>
