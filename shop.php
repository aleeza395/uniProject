<?php include('includes/header.php'); ?>
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
    <style>
        .container { display: flex; }
        .sidebar { width: 250px; padding: 20px; background: #f4f4f4; }
        .products { flex: 1; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; padding: 20px; }
        .product-card { border: 1px solid #ddd; border-radius: 8px; padding: 10px; text-align: center; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .product-card img { max-width: 100%; height: 200px; object-fit: cover; }
        .add-cart { font-size: 24px; cursor: pointer; color: green; margin-top: 10px; }
        .filter-label { display: block; margin: 10px 0 5px; font-weight: bold; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Welcome to the Craft Vault!</h1>
    <p style="text-align:center;">Buy handmade dreams — your walls and ears deserve it 💫</p>

    <div class="container">
        <!-- 🧩 Sidebar -->
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

        <!-- 🛍️ Products -->
        <div class="products">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="product-card">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Product">
                        <h3><?php echo $row['name']; ?></h3>
                        <p>Rs. <?php echo $row['price']; ?></p>
                        <p><small><?php echo ucfirst($row['category']); ?></small></p>
                        <div class="add-cart">🛒</div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products match your filters 😢</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
