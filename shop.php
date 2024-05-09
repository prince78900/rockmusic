<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RockMusic</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
    <style>
        /* Your existing CSS styles */

        /* Style for the cart logo */
        .cart-logo {
            font-size: 30px; /* Adjust the font size as needed */
            display: inline-block; /* Display as inline-block for proper alignment */
            vertical-align: middle; /* Align vertically in line with text */
            margin-right: 5px; /* Add some margin to separate from text */
        }

        /* Style for the "Add to Cart" button */
        input[type="submit"] {
            background-color: black; /* Background color for the button */
            color: white; /* Text color */
            border: none; /* Remove border */
            padding: 10px 20px; /* Adjust padding as needed */
            border-radius: 5px; /* Add some border radius for rounded corners */
            cursor: pointer; /* Show pointer cursor on hover */
            transition: background-color 0.3s; /* Smooth transition for background color */
            width: 100%; /* Make the button width 100% */
        }

        /* Hover effect for the "Add to Cart" button */
        input[type="submit"]:hover {
            background-color: #61615d; /* Slightly darker green on hover */
        }

        /* Container for product card */
        .product-card {
            display: flex; /* Use flexbox for layout */
            flex-direction: column; /* Arrange children vertically */
            align-items: center; /* Center items horizontally */
            position: relative; /* Add position relative to set absolute position for button */
            border: 1px solid #ddd; /* Add border for better visualization */
            padding: 10px; /* Add some padding for spacing */
            margin-bottom: 20px; /* Add margin between product cards */
            text-align: center; /* Center text content */
        }

        /* Style for product image */
        .product-card img {
            max-width: 100%; /* Ensure the image fits within the container */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 10px; /* Add some bottom margin for spacing */
        }

        /* Style for product name */
        .product-card h2 {
            color: black; /* Set the color to black */
            font-size: 18px; /* Adjust the font size as needed */
            margin-top: 0; /* Remove default margin */
            margin-bottom: 5px; /* Add some bottom margin for spacing */
        }

        /* Style for product price */
        .product-card p {
            color: black; /* Set the color to black */
            font-size: 16px; /* Adjust the font size as needed */
            margin-top: 0; /* Remove default margin */
            margin-bottom: 10px; /* Add some bottom margin for spacing */
        }

        /* Style for the "Add to Cart" button */
        .add-to-cart-form {
            width: 100%; /* Make the button width 100% */
            margin-top: auto; /* Align button to the bottom of the container */
        }
    </style>
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
    <h2 class="products-heading">Our Rocking Products</h2>
    <div class="product-grid" id="productGrid">
        <!-- Existing products -->
        <?php
        // Fetch products from database
        include 'db_connection.php';
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        // Display products
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product-card">';
                // Update the image src to include the correct path
                echo '<img src="prince2/' . $row['image'] . '" alt="' . $row['name'] . '">';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>$' . $row['price'] . '</p>';
                // Add the form with hidden input field for adding to cart
                echo '<form class="add-to-cart-form" action="cart.php" method="get">';
                echo '<input type="hidden" name="add" value="' . $row['id'] . '">';
                echo '<input type="submit" value="Add to Cart">';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo "No products found.";
        }
        
        ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');
        const cartCount = document.getElementById('cartCount');

        addToCartBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.previousElementSibling.textContent;
                const productPrice = this.previousElementSibling.previousElementSibling.textContent.replace('$', '');

                // Store the added product in localStorage for persistence
                const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
                cartItems.push({ id: productId, name: productName, price: productPrice });
                localStorage.setItem('cart', JSON.stringify(cartItems));

                // Update cart count
                cartCount.textContent = cartItems.length;

                // Debug: Log cart items to console to verify
                console.log(cartItems);
            });
        });
    });

    
</script>

</body>
</html>
