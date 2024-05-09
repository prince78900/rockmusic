<?php
include('server.php');
$id = 0;
$edit_state = false;
$customer_name = '';
$address = '';
$phone = '';
$total = '';
$order_status = 'pending';

// Check if we are editing an order
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;
    $record = mysqli_query($db, "SELECT * FROM orders WHERE id=$id")->fetch_assoc();
    $customer_name = $record['customer_name'];
    $address = $record['address'];
    $phone = $record['phone'];
    $total = $record['total'];
    $order_status = $record['order_status'];
}
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

<div class="container">
    <h1><?php echo $edit_state ? 'Edit Order' : 'New Order'; ?></h1>
    <form action="server.php" method="POST" class="order-form">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Customer Name</label>
            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" required>
        </div>
        <div class="input-group">
            <label>Address</label>
            <textarea name="address" required><?php echo $address; ?></textarea>
        </div>
        <div class="input-group">
            <label>Phone</label>
            <input type="text" name="phone" value="<?php echo $phone; ?>" required>
        </div>
        <div class="input-group">
            <label>Total</label>
            <input type="text" name="total" value="<?php echo $total; ?>" required>
        </div>
        <div class="input-group">
            <label>Status</label>
            <select name="order_status">
                <option value="pending" <?php echo $order_status === 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="completed" <?php echo $order_status === 'completed' ? 'selected' : ''; ?>>Completed</option>
                <option value="cancelled" <?php echo $order_status === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="<?php echo $edit_state ? 'update_order' : 'save_order'; ?>">
                <?php echo $edit_state ? 'Update' : 'Save'; ?>
            </button>
        </div>
    </form>
</div>
</body>
</html>

<style>

/* Keep existing styles for header and navigation panels */

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-family: 'New Rocker', cursive;
    text-align: center;
    margin-bottom: 20px;
}

.order-form .input-group {
    margin-bottom: 20px;
}

.order-form .input-group label {
    display: block;
    margin-bottom: 5px;
}

.order-form .input-group input,
.order-form .input-group textarea,
.order-form .input-group select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
}

.order-form .input-group select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="%23333" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
    padding-right: 30px;
}

.order-form .input-group button {
    padding: 10px 20px;
    background-color: black; /* Change background color to black */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}


.order-form .input-group button:hover {
    background-color: #645e5e;
    
}

</style>
