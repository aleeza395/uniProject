<?php
include("config.php");
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Admin Dashboard</h2>
    
    <!-- Add Product Form -->
    <form action="admin-add.php" method="POST" enctype="multipart/form-data">
        <h3>Add Product</h3>
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="file" name="image" required>

        <select name="category" required>
            <option value="">-- Select Category --</option>
            <option value="paintings">Paintings</option>
            <option value="earrings">Earrings</option>
            <option value="studs">Studs</option>
            <option value="keychains">Keychains</option>
        </select>

        <button type="submit">Add Product</button>
    </form>

    <h3>All Products</h3>
    <table border="1" width="100%">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><img src="uploads/<?php echo $row['image']; ?>" width="80"></td>
                <td><?php echo $row['name']; ?></td>
                <td>$<?php echo $row['price']; ?></td>
                <td><?php echo ucfirst($row['category']); ?></td>
                <td>
                    <!-- Update Form -->
                    <form action="admin-update.php" method="POST" enctype="multipart/form-data" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" placeholder="New name">
                        <input type="number" step="0.01" name="price" placeholder="New price">
                        <input type="file" name="image">
                        <select name="category">
                            <option value="">-- Category --</option>
                            <option value="paintings">Paintings</option>
                            <option value="earrings">Earrings</option>
                            <option value="studs">Studs</option>
                            <option value="keychains">Keychains</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>

                    <!-- Delete Form -->
                    <form action="admin-delete.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h3>All Users</h3>
<table border="1" width="100%">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
    </tr>
    <?php
    $users = mysqli_query($conn, "SELECT * FROM users");
    while ($user = mysqli_fetch_assoc($users)) {
    ?>
        <tr>
            <td><?= $user['id']; ?></td>
            <td><?= $user['name']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['role']; ?></td>
            <td>
                <form action="admin-delete-user.php" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <button type="submit" onclick="return confirm('Delete user?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>


    <br><a href="logout.php">Logout</a>
</div>
</body>
</html>
