<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Orders</title>
    <link rel="stylesheet" href="admin.css">
    <!-- Add your custom stylesheets here -->
    <style>
        /* Add your custom styles here */
        /* Container styles */
        .order-container {
            max-width: 800px;
            margin: 20px auto; /* Set margin to auto to center the container horizontally */
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center; /* Center the heading text */
        }

        .order-details {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .order-details p {
            margin-bottom: 10px;
        }

        .order-items {
            list-style: none;
            padding: 0;
        }

        .order-items li {
            margin-bottom: 10px;
        }

        /* Edit and Delete button styles */
        .edit_btn, .del_btn {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 10px; /* Add margin-right for spacing */
            background-color: #28a745; /* Green color for edit button */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .del_btn {
            background-color: #dc3545; /* Red color for delete button */
        }

        .edit_btn:hover, .del_btn:hover {
            background-color: #218838; /* Darker green on hover for edit button */
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <div id="logo">
            <img src="prince2/miller2.png" alt="Logo" height="100" width="200">
        </div>
        <div id="admin-panel">
            <h1>Admin Panel - Orders</h1>
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

    <div class="order-container">
        <h1>Order Details</h1>
        <div class="container">
            <h1>Manage Orders</h1>
           
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $results = mysqli_query($db, "SELECT * FROM orders");
                    while ($row = mysqli_fetch_array($results)) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['phone']}</td>
                            <td>\${$row['total']}</td>
                            <td>{$row['order_date']}</td>
                            <td>{$row['order_status']}</td>
                            <td>
                                <a href='order_form.php?edit={$row['id']}' class='edit_btn'>Edit</a>
                                <button onclick=\"confirmDelete({$row['id']})\" class='del_btn'>Delete</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(orderId) {
            if (confirm("Are you sure you want to delete this order?")) {
                window.location.href = 'server.php?del_order=' + orderId;
            }
        }
    </script>
</body>
</html>
