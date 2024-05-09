<?php
// Database connection
$servername = "localhost"; // Your MySQL server host
$username = "your_username"; // Your MySQL database username
$password = "your_password"; // Your MySQL database password
$dbname = "login"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to handle file upload
function uploadImage($file) {
    $target_dir = "prince2/"; // Directory where the file will be uploaded
    $target_file = $target_dir . basename($file["name"]); // Path to store the uploaded file
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($file["name"])). " has been uploaded.";
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Create Product
// Create Product
// Handle form submission for adding a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    // Format the price properly
    $price = number_format($price, 2); // Format to 2 decimal places
    $image = uploadImage($_FILES['image']);

    // Insert product into database
    $sql = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully";
        // Redirect to the shop page after adding the product
        header("Location: shop.php");
        exit(); // Ensure subsequent code is not executed
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update Product
if (isset($_POST['update_product'])) {
    $id = $_POST['update_id'];
    $name = $_POST['update_name'];
    $price = $_POST['update_price'];

    // Update product in database
    $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Delete Product
if (isset($_POST['delete_product'])) {
    $id = $_POST['delete_id'];

    // Delete product from database
    $sql = "DELETE FROM products WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
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
    <style>
        /* New CSS styles */
         .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        table {
            width: 80%; /* Adjust the width of the table */
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 5px; /* Decrease padding */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        img {
            max-width: 50px;
            max-height: 50px;
        }

        .form {
            width: 80%;
            max-width: 500px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            margin-bottom: 10px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input[type="text"], .input-group input[type="file"] {
            width: calc(100% - 10px);
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        .button-container {
            text-align: center;
        }

        .btn {
            padding: 8px 20px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }


        
    </style>
</head>
<body>
    <!-- Your existing HTML content here -->

    <div class="container">
        <!-- Display database content -->
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Image</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>$" . htmlspecialchars($row['price']) . "</td>";
                echo "<td><img src='" . htmlspecialchars($row['image']) . "'></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No products found.";
        }
        ?>

        <!-- Add product form -->
        <form action="pr.php" method="post" enctype="multipart/form-data" class="form">
            <h3>Add, Update, or Delete Product</h3>
            <div class="input-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="input-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price">
            </div>
            <div class="input-group">
                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image">
            </div>
            <br>
            <div class="input-group">
                <label for="update_id">Product ID (for update):</label>
                <input type="text" id="update_id" name="update_id">
            </div>
            <div class="input-group">
                <label for="update_name">Updated Product Name:</label>
                <input type="text" id="update_name" name="update_name">
            </div>
            <div class="input-group">
                <label for="update_price">Updated Price:</label>
                <input type="text" id="update_price" name="update_price">
            </div>
            <br>
            <div class="input-group">
                <label for="delete_id">Product ID (for delete):</label>
                <input type="text" id="delete_id" name="delete_id">
            </div>
            <br>
            <div class="button-container">
                <button type="submit" class="btn" name="add_product">Add Product</button>
                <button type="submit" class="btn" name="update_product">Update Product</button>
                <button type="submit" class="btn" name="delete_product">Delete Product</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>

