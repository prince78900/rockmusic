<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // File upload handling
    $targetDir = "prince2/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Allow certain file formats
        $allowTypes = array('jpg','png','jpeg','gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                // Insert product details into database
                $sql = "INSERT INTO products (name, price, image) VALUES ('$name', '$price', '$fileName')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Product added successfully'); window.location='index.php'; </script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }
}

// Handle form submission for updating a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $product_id = $_POST['update_id'];
    $name = $_POST['update_name'];
    $price = $_POST['update_price'];

    // Update product details in the database
    $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$product_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Product updated successfully'); window.location='index.php'; </script>";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Handle form submission for deleting a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $product_id = $_POST['delete_id'];
    // Delete product from the database
    $sql = "DELETE FROM products WHERE id=$product_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Deleted Succesfully'); window.location='index.php'; </script>";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}
?>
