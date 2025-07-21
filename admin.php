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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    color: #66350F;
}

a {
    color: #66350F;
    text-decoration: none;
    font-weight: bold;
}

.form-container {
    max-width: 1000px;
    margin: 30px auto;
    background-color: #dbbfab;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(102, 53, 15, 0.1);
    border: none;
}

h2, h3 {
    text-align: center;
    color: #66350F;
}

form {
    margin-bottom: 30px;
    padding: 15px;
    border: 1px solid #66350F;
    border-radius: 10px;
    background-color: #fdf7f2;
}

form input, form select, form button {
    display: block;
    width: 95%;
    margin: 10px 0;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #66350F;
    border-radius: 8px;
    background-color: #fff8f2;
    color: #66350F;
}

form button {
    background-color: #66350F;
    color: #fff;
    cursor: pointer;
    transition: 0.3s ease;
}

form button:hover {
    background-color: #4a260a;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    color: #66350F;
}

table th, table td {
    padding: 10px;
    border: 1px solid #66350F;
    text-align: center;
}

table th {
    background-color: #dbbfab;
    font-weight: bold;
}

img {
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(102, 53, 15, 0.2);
    border: none;
}

button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

    </style>
</head>
<body>
<div class="form-container">
    <h2>Admin Dashboard</h2>
    
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
