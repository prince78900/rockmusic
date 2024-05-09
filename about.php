<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - RockMusic</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <style>
        /* Additional styles specific to the About Us page */
        h2 {
            color: white; /* Change the color to white */
        }

        /* Styles for the container */
        .container {
            max-width: 1200px; /* Limit container width */
            margin: 0 auto; /* Center container */
            padding: 20px; /* Add some padding around the container */
        }

        /* Styles for the About Us section */
        .about-us-container {
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Distribute items evenly */
            margin-bottom: 40px; /* Add some space between sections */
        }

        /* Styles for the About Us and Contact Us sections */
        .about-us,
        #contact {
            flex-basis: calc(50% - 10px); /* Set width of each section */
            background-color: black; /* Set background color to black */
            color: white; /* Set text color to white */
            padding: 20px; /* Add padding */
            border-radius: 8px; /* Add border radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        /* Styles for the Contact Form */
        #contact form {
            max-width: 600px; /* Limit form width */
            margin: 0 auto; /* Center form */
            background-color: black; /* Set form background color */
            color: white; /* Set text color to white */
            padding: 20px; /* Add padding */
            border-radius: 8px; /* Add border radius */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        #contact h2 {
            text-align: center; /* Center heading */
            margin-bottom: 20px; /* Add space below heading */
            color: white; /* Set heading color to white */
        }

        #contact label {
            display: block; /* Display labels as block */
            margin-bottom: 10px; /* Add space below labels */
            font-weight: bold; /* Make labels bold */
        }

        #contact input[type="text"],
        #contact input[type="email"],
        #contact textarea {
            width: 100%; /* Set input width to full */
            padding: 10px; /* Add padding */
            margin-bottom: 20px; /* Add space below inputs */
            border: 1px solid #ddd; /* Add border */
            border-radius: 4px; /* Add border radius */
        }

        #contact textarea {
            height: 150px; /* Set textarea height */
        }

        #contact input[type="submit"] {
            background-color: #00a9ff; /* Set submit button background color */
            color: #fff; /* Set text color */
            border: none; /* Remove border */
            padding: 10px 20px; /* Add padding */
            border-radius: 4px; /* Add border radius */
            cursor: pointer; /* Add pointer cursor */
            transition: background-color 0.3s; /* Add transition */
        }

        #contact input[type="submit"]:hover {
            background-color: #0077cc; /* Change background color on hover */
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
                <!-- Add a link to the cart page -->
                <li><a href="cart.php"><i class="bx bx-cart cart-logo"></i></a></li>
            </ul>
        </nav>
    </header>

    <section class="container">
        <div class="about-us-container">
            <section class="about-us">
                <h2>About Us</h2>
                <p>Welcome to RockMusic! We provide high-quality products that satisfy your taste in music and instruments.</p>
                <p>We consist of a selection of products that will make you rock and roll.</p>
                <p>Feel free to explore our website and discover our wide range of products.</p>
            </section>
            <section id="contact">
                <h2>Contact Us</h2>
                <form action="submit.php" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br>
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>
                    
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" required><br>
                    
                    <label for="message">Message:</label><br>
                    <textarea id="message" name="message" rows="4" required></textarea><br>
                    
                    <input type="submit" value="Submit">
                </form>
            </section>
        </div>
    </section>

    <footer>
        <div class="container">
            <!-- Footer content -->
        </div>
    </footer>
</body>
</html>
