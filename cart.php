<?php
session_start();
include("config.php");

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Get cart items
$result = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <div><strong>🎨 Canvas & Craft</strong></div>
    <div>
        <a href="index.php">Home</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="dashboard">
    <h2>🛍️ Your Cart</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0" style="margin-top: 20px; width: 80%; margin: auto; text-align: center;">
            <tr>
                <th>Product</th>
                <th>Price (PKR)</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php 
            $grandTotal = 0;
            while ($item = mysqli_fetch_assoc($result)):
                $subtotal = $item['price'] * $item['quantity'];
                $grandTotal += $subtotal;
            ?>
            <tr>
                <td><?php echo $item['product_name']; ?></td>
                <td><?php echo $item['price']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $subtotal; ?></td>
                <td>
                    <form method="POST" action="remove-from-cart.php" onsubmit="return confirm('Remove item from cart?');">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <button type="submit">🗑️ Remove</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>Rs. <?php echo $grandTotal; ?></strong></td>
            </tr>
        </table>
    <?php else: ?>
        <p style="text-align:center;">🫤 Your cart is empty. Let’s fill it with some love!</p>
    <?php endif; ?>

</div>

</body>
</html>
