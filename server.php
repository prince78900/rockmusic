<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'login');

$username = "";
$password = "";
$first_name = "";
$last_name = "";
$email = "";
$contact_number = "";

$id = 0;
$edit_state = false;

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];

    mysqli_query($db, "INSERT INTO users (username, password, email, contact_number) VALUES ('$username', '$password', '$first_name', '$last_name', '$email', '$contact_number')");
    $_SESSION['message'] = "User saved";
    header('location: customers.php');
}

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $id = $_POST['id'];

    mysqli_query($db, "UPDATE users SET username='$username', password='$password', first_name='$first_name', last_name='$last_name', email='$email', contact_number='$contact_number' WHERE id=$id");
    $_SESSION['message'] = "User updated"; 
    header('location: customers.php');
}

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM users WHERE id=$id");
    $_SESSION['message'] = "User deleted"; 
    header('location: customers.php');
}

// Handling image upload and database insertion
if (isset($_POST['save_product'])) {
    $pname = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $sold = mysqli_real_escape_string($db, $_POST['sold']);
    $image = $_FILES['image']['name'];

    // Image file directory
    $target = "images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO products (name, description, price, image, sold) VALUES ('$pname', '$description', '$price', '$image', '$sold')";
        mysqli_query($db, $sql);
        $_SESSION['message'] = "Product created successfully";
    } else {
        $_SESSION['message'] = "Failed to upload image";
    }

    header('location: products.php');
}


if (isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $pname = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $image = $_FILES['image']['name'];
    $sold = mysqli_real_escape_string($db, $_POST['sold']);
    $target = "images/" . basename($image);

    if (!empty($image)) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image_update = ", image='$image'";
    } else {
        $image_update = "";
    }

    $sql = "UPDATE products SET name='$pname', description='$description', sold='$sold' , price='$price' $image_update WHERE id=$id";
    mysqli_query($db, $sql);

    $_SESSION['message'] = "Product updated successfully";
    header('location: products.php');
}

if (isset($_GET['del_product'])) {
    $id = $_GET['del_product'];
    mysqli_query($db, "DELETE FROM products WHERE id=$id");
    $_SESSION['message'] = "Product Deleted";
    header('location: products.php');
}



if (isset($_POST['save_order'])) {
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $total = $_POST['total'];
    $order_status = $_POST['order_status'];

    $query = "INSERT INTO orders (customer_name, address, phone, total, order_status) VALUES ('$customer_name', '$address', '$phone', '$total', '$order_status')";
    mysqli_query($db, $query);
    $_SESSION['message'] = "Order saved";
    header('location: order.php'); // Changed the redirection to dashboard.php
}

if (isset($_POST['update_order'])) {
    $id = $_POST['id'];
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $total = $_POST['total'];
    $order_status = $_POST['order_status'];

    $query = "UPDATE orders SET customer_name='$customer_name', address='$address', phone='$phone', total='$total', order_status='$order_status' WHERE id=$id";
    mysqli_query($db, $query);
    $_SESSION['message'] = "Order updated";
    header('location: order.php'); // Changed the redirection to dashboard.php
}

if (isset($_GET['del_order'])) {
    $id = $_GET['del_order'];
    mysqli_query($db, "DELETE FROM orders WHERE id=$id");
    $_SESSION['message'] = "Order deleted";
    header('location: order.php'); // Changed the redirection to dashboard.php
}

?>
