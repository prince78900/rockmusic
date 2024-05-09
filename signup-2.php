<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // Password stored as plain text
    $role = 'customer';

    $sql = "INSERT INTO users (first_name, last_name, email, contact_number, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssss", $first_name, $last_name, $email, $contact_number, $username, $password, $role);
        if ($stmt->execute()) {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('myModal').style.display = 'block';
                    });
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "SQL Error: " . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* CSS for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login">
        <h1>Sign Up</h1>
        <form action="signup-2.php" method="POST">
            <label for="first_name">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
            <label for="last_name">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
            <label for="email">
                <i class="fas fa-envelope"></i>
            </label>
            <input type="email" name="email" id="email" placeholder="Email Address" required>
            <label for="contact_number">
                <i class="fas fa-phone"></i>
            </label>
            <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number" required>
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" id="username" placeholder="Username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <button type="submit">Sign Up</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Sign up successful!</p>
        </div>
    </div>

    <script>
        // Close the modal when clicking on the close button
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('myModal');
            var span = document.getElementsByClassName("close")[0];

            span.onclick = function() {
                modal.style.display = "none";
            }

            // Close the modal when clicking outside of it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
</body>
</html>
