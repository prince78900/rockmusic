<?php
session_start();
include 'db.php';

// Add to cart logic
if (isset($_GET['add'])) {
    $product_id = $_GET['add'];
    $session_id = session_id();
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM cart WHERE session_id = ? AND product_id = ?");
    $stmt->bind_param("si", $session_id, $product_id);
    $stmt->execute();
    $existing_product = $stmt->get_result();
    
    if ($existing_product->num_rows > 0) {
        $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE session_id = '$session_id' AND product_id = $product_id");
    } else {
        // Using prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO cart (product_id, session_id, quantity) VALUES (?, ?, 1)");
        $stmt->bind_param("is", $product_id, $session_id);
        $stmt->execute();
    }
    header("Location: cart.php");
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];
    
    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param("i", $cart_id);
    $stmt->execute();
    
    header("Location: cart.php");
}

// Display cart
$session_id = session_id();

// Using prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT cart.id, products.name, products.price, products.image, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.session_id = ?");
$stmt->bind_param("s", $session_id);
$stmt->execute();
$cart_items = $stmt->get_result();

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

<div class="container">
    <h1>Your Rocking Cart</h1>
    <div class="product-grid">
        <?php while ($item = $cart_items->fetch_assoc()): ?>
            <div class="product-card">
                <img src="prince2/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" height="150" width="150">
                <h2><?php echo $item['name']; ?></h2>
                <p><?php echo $item['quantity']; ?> x $<?php echo $item['price']; ?></p>
                <p>Total: $<?php echo number_format($item['quantity'] * $item['price'], 2); ?></p>
                <a href="cart.php?remove=<?php echo $item['id']; ?>" class="remove-btn">Remove</a>
            </div>
        <?php endwhile; ?>
    </div>
    <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
</div>


</body>
</html>



<style>
    /* Add your custom styles here */

    /* Container styles */
    .container {
        padding: 100px;
    }

    /* Navigation styles */
    .navigation-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #00A9FF;
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

    .nav-link:hover,
    .nav-link:focus {
        background-color: #555;
        color: #fff;
        text-decoration: none;
    }

    /* Header styles */
    h1 {
        text-align: center;
        color: white; /* Change the color to white */
        font-size: 24px;
        margin-top: 20px;
    }

    /* Table styles */
    table {
        width: 80%; /* Adjust based on your layout */
        margin: 20px auto; /* Center the table and add some margin */
        border-collapse: collapse; /* Collapses the border lines between cells */
        background-color: #f9f9f9; /* Light background for the table */
    }

    th, td {
        text-align: left;
        padding: 8px; /* Padding inside cells */
        border-bottom: 1px solid #ddd; /* Light border for readability */
        color: black; /* Set text color to black */
    }

    th {
        background-color: #cfcc18; /* Green background for headers */
        color: white; /* White text for headers */
    }

    /* Hover effect for rows */
    tr:hover {
        background-color: #f1f1f1; /* Light grey background on hover */
    }

    /* Style for the "Remove" link */
    a {
        color: #00A9FF; /* Red color for the 'Remove' link */
        text-decoration: none; /* No underline */
    }

    a:hover {
        text-decoration: underline; /* Underline on hover for better interactivity */
    }

    /* Styling the checkout link */
    a[href="checkout.php"] {
        display: block;
        width: fit-content;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #f9f9f9; /* Green background to match table headers */
        color: black; /* White text */
        text-align: center;
        border-radius: 5px; /* Rounded corners */
        font-weight: bold;
    }

    a[href="checkout.php"]:hover {
        background-color: #61615d; /* Slightly darker green on hover */
    }

    /* Styling for Your Rocking Cart */
    .container h1 {
        color: white; /* Change the color to white */
        font-family: 'New Rocker', cursive; /* Add the font-family */
    }

    /* Product grid styles */
    .product-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        gap: 10px;
    }

    .product-card {
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: calc(20% - 20px); /* Adjust the width of the product card */
    }

    .product-card img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .product-card h2 {
        margin-top: 10px;
        font-size: 16px; /* Adjust the font size of the product name */
        color: black; /* Change the color of the product name to black */
    }

    .product-card p {
        margin: 5px 0;
        color: black; /* Change the color of the product price to black */
    }

    .remove-btn {
        color: #fff;
        background-color: #ff0000;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
    }

    .checkout-btn {
        display: block;
        width: fit-content;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #cfcc18;
        color: white;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
    }
</style>
