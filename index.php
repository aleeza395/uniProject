<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - MyShop</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<section class="hero">
    <div class="hero-content">
        <h1>Welcome to MyShop</h1>
        <p>Your one-stop store for everything!</p>
        <a href="shop.php" class="btn">Shop Now</a>
    </div>
</section>

<section class="best-sellers">
    <h2>Best Sellers</h2>
    <div class="product-grid">
        <div class="product-card">
            <img src="assets/images/product1.jpg" alt="Product 1">
            <h3>Product 1</h3>
            <p>$19.99</p>
        </div>
        <div class="product-card">
            <img src="assets/images/product2.jpg" alt="Product 2">
            <h3>Product 2</h3>
            <p>$24.99</p>
        </div>
        <div class="product-card">
            <img src="assets/images/product3.jpg" alt="Product 3">
            <h3>Product 3</h3>
            <p>$14.99</p>
        </div>
    </div>
</section>

<section class="reviews">
    <h2>What Our Customers Say</h2>
    <div class="review-grid">
        <div class="review-card">
            <p>“Great quality and fast shipping!”</p>
            <span>- Sarah</span>
        </div>
        <div class="review-card">
            <p>“Absolutely love the products!”</p>
            <span>- Ali</span>
        </div>
        <div class="review-card">
            <p>“Highly recommended.”</p>
            <span>- Zainab</span>
        </div>
    </div>
</section>

<?php include('includes/footer.php'); ?>
<script src="js/main.js"></script>
</body>
</html>
