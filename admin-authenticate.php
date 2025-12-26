<?php
session_start();
$server = "localhost"; // Server address
$username = "root"; // Adjust as per your SQL server credentials
$password = ""; // Adjust as per your SQL server credentials
$database = "admin_db"; // Database name

// Establishing the connection
$conn = new mysqli($server, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching form data
$admin_user = $_POST['username'];
$admin_pass = $_POST['password'];

// Query to check admin credentials
$sql = "SELECT * FROM admin_db WHERE username='$admin_user' AND password='$admin_pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: view-registrations.php"); // Redirect to the data viewing page
} else {
    echo "Invalid Username or Password";
}

$conn->close();
?>
