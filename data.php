<?php
// Database connection parameters
$servername = 'localhost'; // Assuming MySQL server is running on the same machine
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password
$dbname = 'login'; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = 'customer'; // Default role
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);

   

    // Prepare SQL statement to insert data into the 'users' table
    $sql = "INSERT INTO users (username, password, role, first_name, last_name, email, contact_number) VALUES ('$username', '$hashed_password', '$role', '$first_name', '$last_name', '$email', '$contact_number')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // Output JavaScript code to display a pop-up message
        echo "<script>alert('Sign Up successfully!'); window.location='login.php'; </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
