<?php
session_start();
include("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$name = $_SESSION["user_name"];

// Get cart items
$cart_result = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id");

// Get orders
$order_result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = $user_id");

// Get reviews
$review_result = mysqli_query($conn, "SELECT * FROM reviews WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', sans-serif;
        }

        nav {
            background: #222;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .dashboard {
            max-width: 1100px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }

        .dashboard h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #444;
        }

        .section {
            margin-bottom: 40px;
        }

        .section h3 {
            margin-bottom: 15px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .logout-btn {
            background: #f44336;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .home-btn {
            background: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            margin-left: 10px;
        }

        .btns {
            text-align: right;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<nav>
    <div><strong>🎨 Canvas & Craft</strong></div>
    <div>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="dashboard">
    <h2>Welcome, <?php echo htmlspecialchars($name); ?> 👋</h2>

    <!-- 🛒 Cart Section -->
    <div class="section">
        <h3>🛒 Your Cart</h3>
        <?php if (mysqli_num_rows($cart_result) > 0): ?>
        <table>
            <tr><th>Product</th><th>Quantity</th><th>Price</th></tr>
            <?php while ($item = mysqli_fetch_assoc($cart_result)): ?>
            <tr>
                <td><?php echo $item["product_name"]; ?></td>
                <td><?php echo $item["quantity"]; ?></td>
                <td>$<?php echo $item["price"]; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p>No items in your cart.</p>
        <?php endif; ?>
    </div>

    <!-- 📦 Orders Section -->
    <div class="section">
        <h3>📦 Your Orders</h3>
        <?php if (mysqli_num_rows($order_result) > 0): ?>
        <table>
            <tr><th>Order ID</th><th>Date</th><th>Total</th></tr>
            <?php while ($order = mysqli_fetch_assoc($order_result)): ?>
            <tr>
                <td><?php echo $order["id"]; ?></td>
                <td><?php echo $order["created_at"]; ?></td>
                <td>$<?php echo $order["total"]; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p>You haven't placed any orders yet.</p>
        <?php endif; ?>
    </div>

    <!-- ⭐ Reviews Section -->
    <div class="section">
        <h3>⭐ Your Reviews</h3>
        <?php if (mysqli_num_rows($review_result) > 0): ?>
        <table>
            <tr><th>Product</th><th>Rating</th><th>Comment</th></tr>
            <?php while ($rev = mysqli_fetch_assoc($review_result)): ?>
            <tr>
                <td><?php echo $rev["product_name"]; ?></td>
                <td><?php echo $rev["rating"]; ?>/5</td>
                <td><?php echo $rev["comment"]; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php else: ?>
            <p>No reviews submitted yet.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
