<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #2ecc71;
            margin-bottom: 20px;
        }
        p {
            color: #2c3e50;
            margin: 10px 0;
        }
        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
// Database connection parameters
$host = 'localhost'; // Database host
$db_name = 'tregistration'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST['txtna'];
$email = $_POST['txtma'];
$phone_number = $_POST['txtno'];
$address = $_POST['txtnad'];
$sector = $_POST['txtse'];
$id_number = $_POST['txtid'];
$birthday = $_POST['txtbd'];
$age = $_POST['txtag'];
$whatsapp_number = $_POST['txtwn'];
$village = $_POST['txtvl'];
$courses = $_POST['txtco'];
$school = $_POST['txtsc'];
$gender = $_POST['Gender'];

// Insert data into the database
$sql = "INSERT INTO tregistration (full_name, email, phone_number, address, sector, id_number, birthday, age, whatsapp_number, village, courses, school, gender)
        VALUES ('$full_name', '$email', '$phone_number', '$address', '$sector', '$id_number', '$birthday', '$age', '$whatsapp_number', '$village', '$courses', '$school', '$gender')";

if ($conn->query($sql) === TRUE) {
    echo '<div class="container">
            <h2>Registration Successful!</h2>
            <p>Thank you, ' . htmlspecialchars($full_name) . '. Your registration has been completed successfully.</p>
            <p><a href="index.html">Go back to Home</a></p>
          </div>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>

</body>
</html>
