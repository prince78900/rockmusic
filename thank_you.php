
   



<?php
include 'db.php'; // ensure you have the database connection

session_start();

// Get the most recent order for the current session
// Assuming the session_id or similar identifier was saved with the order
$session_id = session_id();
$query = "SELECT * FROM orders WHERE session_id = '$session_id' ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);
$order = $result->fetch_assoc();


if (isset($_SESSION['last_order_id'])) {
    $order_id = $_SESSION['last_order_id'];
    $query = "SELECT * FROM orders WHERE id = '$order_id'";
    $result = $db->query($query);
    $order = $result->fetch_assoc();

}


if (!$result) {
    die('Database query failed: ' . $db->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RockMusic</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <img src="prince2/miller2.png" height="100" width="200">
    <h1>RockMusic</h1>
    <nav>
        <ul>
            <li></li>
            <li><a href="page.php">Home</a></li>
            <li></li>
            <li><a href="shop.php">Shop</a></li>
            <li></li>
            <li><a href="about.php">About</a></li>
            <li></li>
            <li><a href="profile.php">Profile</a></li>
            <!-- Add a link to the cart page with the cart logo -->
            <li><a href="cart.php"><i class="bx bx-cart cart-logo"></i></a></li>
        </ul>
    </nav>
</header>

<div class="icons">
    <a href="cart.php">
        <div class="fas fa-search" id="search-btn"></div>
    </a>
    <a href="cart.php">
        <div class="fas fa-shopping-cart" id="cart-btn"></div>
    </a>
    <a href="/menu">
        <div class="fas fa-bars" id="menu-btn"></div>
    </a>
</div>


<body>
    <div class="container">
    <h1>Order Details</h1>
    

    <?php if ($order): ?>
    <ul class="order-details">
        <li><strong>Order Number:</strong> <?php echo htmlspecialchars($order['id']); ?></li>
        <li><strong>Customer Name:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></li>
        <li><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?></li>
        <li><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></li>
        <li><strong>Total Paid:</strong> $<?php echo number_format($order['total'], 2); ?></li>
        <li><strong>Order Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($order['order_date'])); ?></li>
        <li><strong>Status:</strong> <?php echo htmlspecialchars($order['order_status']); ?></li>
    </ul>
<?php else: ?>
    <p>Order details could not be found.</p>
<?php endif; ?>


    
    <a href="page.php" class="btn">Go back to Home</a>
    <a href="profile.php" class="btn">Order Status</a>
    </div>
</body>
</html>

<style>

.order-details {
    color: black; /* Set the text color to black */
}


.container {
    padding: 150px;
    color: black; /* Set the text color to white */
}


.navigation-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #00A9FF;
    padding: 10px 20px;
    color: black;
}

.logo1 img {
    height: 50px;
    width: auto;
}

.navbar {
    display: flex;
    gap: 15px;
}

.nav-link {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 5px 10px 0; /* Adjusted padding to remove space underneath */
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
    border-bottom: none;
}


.nav-link:hover,
.nav-link:focus {
    background-color: #555;
    color: #fff;
}

/* Basic reset */
body, h1, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif; /* You can choose a font you prefer */
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
    padding: 0px;
}



li:last-child {
    border-bottom: none;
}

li strong {
    color: #555;
}

.container {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    background: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    color: #333;
}

.order-details {
    list-style: none;
    padding: 0;
}

.order-details li {
    margin-bottom: 10px;
}

.order-details strong {
    color: #555;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 20px;
    background-color: #000000; /* Change background color to black */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    text-align: center;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #333333; /* Darken the background color on hover */
}



    </style>