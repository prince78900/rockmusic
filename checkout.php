<?php
session_start();
include 'db.php';  // Adjust the path as needed

// Check if the user is logged in and has an ID
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout_submit'])) {
    // Processing form data

    // Redirect to thank you page
    header("Location: thank_you.php");
    exit;
}


$user_id = $_SESSION['user_id'];  // Retrieve user ID from session

// Fetch cart items for the current session
// Fetch cart items for the current session
$session_id = session_id();
$cart_items_query = "SELECT p.id, p.name, p.price, p.image, c.quantity FROM products p 
                     JOIN cart c ON p.id = c.product_id WHERE c.session_id = '$session_id'";
$cart_items = $conn->query($cart_items_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    
    // Calculate total from cart
    $total = 0;
    foreach ($cart_items as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Insert order into the database with user_id
    $insert_query = "INSERT INTO orders (user_id, customer_name, address, phone, total, session_id) 
                     VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("isssds", $user_id, $name, $address, $phone, $total, $session_id);
    $stmt->execute();

    // Clear the cart after checkout
    $conn->query("DELETE FROM cart WHERE session_id = '$session_id'");
    
    header("Location: thank_you.php"); // Redirect to thank you page
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RockMusic</title>
    <link rel="stylesheet" href="checkout.css">
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
    <h1>Checkout</h1>
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
    <form action="checkout.php" method="post" class="checkout-form">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        <button type="submit" class="checkout-btn">Place Order</button>
    </form>
</div>

</body>
</html>

<style>
    .container {
    padding: 100px;
}

.navigation-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #000000;
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
    padding: 5px 10px;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover,
.nav-link:focus {
    background-color: #555;
    color: #fff;
}

/* General Styling for the header */
h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-top: 20px;
}

/* Styling for form */
form {
    width: 50%; /* Suitable width for forms */
    margin: 0 auto; /* Center the form */
    padding: 20px;
    background-color: #f9f9f9; /* Light background for the form */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

label {
    display: block; /* Make labels block level for better control */
    margin-bottom: 5px; /* Space between label and input */
    color: #666; /* Dark grey color for text */
}

input[type="text"],
textarea {
    width: calc(100% - 20px); /* Full width minus padding */
    padding: 10px; /* Padding inside inputs and textarea */
    margin-bottom: 15px; /* Space after each input */
    border: 1px solid #ddd; /* Subtle border */
    border-radius: 4px; /* Rounded corners for inputs */
}

textarea {
    height: 100px; /* Set a fixed height for textarea */
    resize: none; /* Disable resizing */
}

button {
    width: 100%; /* Button width to fill container */
    padding: 10px; /* Padding inside button */
    background-color: #00a9ff; /* Green background */
    color: white; /* Text color */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size */
    font-weight: bold; /* Bold font */
}

button.checkout-btn {
    background-color: black; /* Set background color for "Place Order" button */
}

button.checkout-btn:hover {
    background-color: grey; /* Change background color to white on hover */
    color: black; /* Change text color to black on hover */
}

/* Enhance focus on interactive elements */
input[type="text"]:focus,
textarea:focus,
button:focus {
    outline: none; /* Remove default outline */
    border-color: #4caf50; /* Green border for focus indication */
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5); /* Subtle glow */
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #00a9ff;
}

/* Styling for product name and price */
.product-card h2,
.product-card p {
    color: black;
}

/* Styling for the header */
header {
    background-color: #000000;
    color: white;
}

/* Styling for the "RockMusic" text */
h1 {
    color: white;
}

.container {
    padding: 100px;
    font-family: 'New Rocker', cursive; /* Apply the same font-family as the header */
}

h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-top: 20px;
    font-family: 'New Rocker', cursive; /* Apply the same font-family as the header */
}

.product-grid {
    display: flex; /* Display products in a flex container */
    flex-wrap: wrap; /* Allow products to wrap to the next line */
    justify-content: center; /* Center products horizontally */
}

.product-card {
    flex: 0 0 auto; /* Allow products to shrink and grow as needed */
    width: 200px; /* Set a fixed width for each product card */
    margin: 10px; /* Add some margin around each product card */
    padding: 10px; /* Add some padding inside each product card */
    border: 1px solid #ddd; /* Add a border around each product card */
    border-radius: 8px; /* Add some border radius for rounded corners */
    text-align: center; /* Center the content inside each product card */
}

.product-card img {
    max-width: 100%; /* Ensure the product images don't exceed the width of their container */
    height: auto; /* Allow the product images to scale proportionally */
}

.product-card h2 {
    margin-top: 10px; /* Add some spacing above the product name */
    font-size: 18px; /* Increase the font size of the product name */
}

.product-card p {
    margin: 5px 0; /* Add some spacing above and below the product price */
    font-size: 14px; /* Adjust the font size of the product price */
}

.product-card .remove-btn {
    display: inline-block; /* Display the remove button inline with other content */
    padding: 5px 10px; /* Add some padding to the remove button */
    background-color: #ff6347; /* Set a background color for the remove button */
    color: white; /* Set the text color of the remove button to white */
    border: none; /* Remove the border around the remove button */
    border-radius: 4px; /* Add some border radius for rounded corners */
    text-decoration: none; /* Remove underline from the remove button */
    cursor: pointer; /* Change the cursor to a pointer on hover */
}

.product-card .remove-btn:hover {
    background-color: #cc0000; /* Change the background color of the remove button on hover */
}

</style>
