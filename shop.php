<?php include(__DIR__ . '/includes/header.php'); ?>
<?php
include("config.php");

$categoryFilter = isset($_GET['category']) ? $_GET['category'] : [];
$minPrice = isset($_GET['min']) ? floatval($_GET['min']) : 0;
$maxPrice = isset($_GET['max']) ? floatval($_GET['max']) : 999999;

$query = "SELECT * FROM products WHERE price >= $minPrice AND price <= $maxPrice";
if (!empty($categoryFilter)) {
    $in = "'" . implode("','", array_map('mysqli_real_escape_string', array_fill(0, count($categoryFilter), $conn), $categoryFilter)) . "'";
    $query .= " AND category IN ($in)";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <?php if (isset($_GET['success'])): ?>
<script>
    alert("Added to cart successfully!");
</script>
<?php endif; ?>

    <h1 style="text-align:center;">Welcome to the Craft Vault!</h1>
    <p style="text-align:center;">Buy handmade dreams — your walls and ears deserve it <i class="fa-solid fa-sparkles"></i></p>

    <div class="container">

        <div class="sidebar">
            <h3>Filters</h3>
            <form method="GET">
                <label class="filter-label">Price Range</label>
                <input type="number" name="min" placeholder="Min Price" value="<?php echo $minPrice; ?>"><br>
                <input type="number" name="max" placeholder="Max Price" value="<?php echo $maxPrice; ?>"><br><br>

                <label class="filter-label">Category</label>
                <?php
                $categories = ['paintings', 'earrings', 'studs', 'keychains'];
                foreach ($categories as $cat) {
                    $checked = in_array($cat, $categoryFilter) ? "checked" : "";
                    echo "<input type='checkbox' name='category[]' value='$cat' $checked> " . ucfirst($cat) . "<br>";
                }
                ?>
                <br>
                <button type="submit">Apply Filters</button>
            </form>
        </div>

        <div class="products">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="product-card">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Product">
                        <h3><?php echo $row['name']; ?></h3>
                        <p>Rs. <?php echo $row['price']; ?></p>
                        <p><small><?php echo ucfirst($row['category']); ?></small></p>
                        <form method="POST" action="add-to-cart.php">
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
    <button type="submit" class="add-cart">🛒</button>
</form>

                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products match your filters <i class="fas fa-sad-tear"></i> </p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
