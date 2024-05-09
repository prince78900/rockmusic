<?php
// Database connection
$servername = "localhost"; // Change to your MySQL server host if necessary
$username = "your_username"; // Change to your MySQL database username
$password = "your_password"; // Change to your MySQL database password
$dbname = "login"; // Change to your new database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database for the dashboard widgets
// Fetch data from the database for the dashboard widgets
$sqlSales = "SELECT SUM(price) AS total_sales FROM products";
$resultSales = $conn->query($sqlSales);
if (!$resultSales) {
    die("Error in SQL query: " . $conn->error);
}
$totalSales = ($resultSales->num_rows > 0) ? $resultSales->fetch_assoc()['total_sales'] : 0;

$sqlUsers = "SELECT COUNT(*) AS total_users FROM users";
$resultUsers = $conn->query($sqlUsers);
if (!$resultUsers) {
    die("Error in SQL query: " . $conn->error);
}
$totalUsers = ($resultUsers->num_rows > 0) ? $resultUsers->fetch_assoc()['total_users'] : 0;

$sqlProducts = "SELECT COUNT(*) AS total_products FROM products";
$resultProducts = $conn->query($sqlProducts);
if (!$resultProducts) {
    die("Error in SQL query: " . $conn->error);
}
$totalProducts = ($resultProducts->num_rows > 0) ? $resultProducts->fetch_assoc()['total_products'] : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Add custom styles for the dashboard */
        .dashboard {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            font-size: 24px;
        }
        .dashboard-widget {
            padding: 20px;
            border: 1px solid #ccc;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            text-align: center;
        }
        .dashboard-widget i {
            font-size: 36px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div id="logo">
            <img src="prince2/miller2.png" alt="Logo" height="100" width="200">
        </div>
        <div id="admin-panel">
            <h1>Admin Panel</h1>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="index.php">Products</a></li>
            <li><a href="order.php">Orders</a></li>
            <li><a href="ct.php">Contacts</a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>
    </nav>

    <div class="dashboard">
        <div class="dashboard-widget">
            <i class="fas fa-chart-bar"></i>
            <p>Monthly Sales: $<?php echo $totalSales; ?></p>
        </div>
        <div class="dashboard-widget">
            <i class="fas fa-users"></i>
            <p>Total Users: <?php echo $totalUsers; ?></p>
        </div>
        <div class="dashboard-widget">
            <i class="fas fa-cube"></i>
            <p>Total Products: <?php echo $totalProducts; ?></p>
        </div>
        <!-- Add more widgets as needed -->
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
