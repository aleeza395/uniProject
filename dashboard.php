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
if (isset($_POST["submit_review"])) {
    $product = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $rating = (int) $_POST["rating"];
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);

    $insert = "INSERT INTO reviews (user_id, product_name, rating, comment) 
               VALUES ($user_id, '$product', $rating, '$comment')";
    mysqli_query($conn, $insert);

    // Refresh the page to show the new review in the list
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

    <!-- Review Form -->
    <form action="" method="POST">
        <input type="text" name="product_name" placeholder="Product Name" required>
        <select name="rating" required>
            <option value="">Rating</option>
            <option value="1">1 - 😞</option>
            <option value="2">2 - 😐</option>
            <option value="3">3 - 🙂</option>
            <option value="4">4 - 😃</option>
            <option value="5">5 - 🤩</option>
        </select>
        <textarea name="comment" placeholder="Your comment..." required></textarea>
        <button type="submit" name="submit_review">Submit Review</button>
    </form>

    <?php if (isset($_POST["submit_review"])): ?>
        <p style="color: green;">Review submitted successfully!</p>
    <?php endif; ?>

    <hr>

    <!-- Review Table -->
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
