<?php
session_start();
include 'db.php'; // Your database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: logini.php'); // Redirect to login if not
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$userQuery = $conn->prepare("SELECT * FROM users WHERE id = ?");
$userQuery->bind_param("i", $user_id);
$userQuery->execute();
$userResult = $userQuery->get_result();
$user = $userResult->fetch_assoc();

// Fetch orders
$orderQuery = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$orderQuery->bind_param("i", $user_id);
$orderQuery->execute();
$orderResult = $orderQuery->get_result();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RockMsic</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
<link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
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
            <!-- Add a link to the cart page -->
            <li><a href="cart.php"><i class="bx bx-cart cart-logo"></i></a></li>
        </ul>
    </nav>
    </header>


    <div class="profile">
    <h1>User Profile</h1>
    <a href="login.php">Log out</a>
    <h2>Details</h2>
    <?php if ($user): ?> <!-- Add a check to ensure $user is not null -->
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <?php else: ?>
        <p>User details not found.</p> <!-- Display a message if user details are not found -->
    <?php endif; ?>

    <h2>Orders</h2>
    <?php if ($orderResult->num_rows > 0): ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
            <?php while ($order = $orderResult->fetch_assoc()): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></td>
                <td>$<?php echo number_format($order['total'], 2); ?></td>
                <td><?php echo htmlspecialchars($order['order_status']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</div>

</body>
</html>

<style>
.navigation-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #000;
    padding: 10px 20px;
    color: white; 
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
    padding: 5px 10px; 
    border-radius: 5px; 
    transition: background-color 0.3s, color 0.3s; 
}

.nav-link:hover, .nav-link:focus {
    background-color: #555; 
    color: #fff;
}

.profile h1{
    color:black;
}

.profile {
    margin-top: 75px;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    color: #000; /* Adjust text color */
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
    color: #000; /* Adjust text color */
}

th {
    background-color: #000; /* Adjust header background color */
    color: white;
}

.profile a{
    color: black;
}



</style>
