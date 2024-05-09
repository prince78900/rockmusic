<?php
// Database connection
$servername = "localhost"; // Change to your MySQL server host if necessary
$username = "your_username"; // Change to your MySQL database username
$password = "your_password"; // Change to your MySQL database password
$dbname = "login"; // Change to your database name if necessary

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Sanitize data to prevent SQL injection
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$subject = mysqli_real_escape_string($conn, $subject);
$message = mysqli_real_escape_string($conn, $message);

// Insert message into database
$sql = "INSERT INTO message (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
if ($conn->query($sql) === TRUE) {
    // Display pop-up message after successful submission
    echo "<script>alert('Message sent successfully');window.location='about.php'; </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
