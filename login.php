<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, password, role FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($id, $plain_password, $role); // Retrieve plain text password
        if ($stmt->fetch() && $password === $plain_password) { // Compare plain text passwords
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $id;
            $_SESSION['role'] = $role;
            $_SESSION['username'] = $username;

            if ($role == 'admin') {
                header("location: admin.php");
            } else {
                header("location:page.php");
            }
        } else {
            echo "Invalid username or password.";
        }
        $stmt->close();
    }
}
$conn->close();
?>



<!DOCTYPE html><html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="style.css" rel="stylesheet" type="text/css">


	</head>
	<body>
	    <div class="login">
		<h1>Login</h1>
		<form action="login.php" method="post">
			<label for="username">
				<i class="fas fa-user"></i>
			</label>
		<input type="text" name="username" placeholder="Username" id="username" required>
			<label for="password">
				<i class="fas fa-lock"></i>
			</label>
	<input type="password" name="password" placeholder="Password" id="password" required>
	<p>Don't Have an Account? <a href="signup-2.php">Register</a></p>
				<input type="submit" value="Login">
			</form>
		</div>
	</body></html>