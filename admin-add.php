<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $image = $_FILES["image"]["name"];
    $tmp = $_FILES["image"]["tmp_name"];
    $target = "uploads/" . basename($image);

    move_uploaded_file($tmp, $target);

    $query = "INSERT INTO products (name, price, image, category) 
              VALUES ('$name', '$price', '$image', '$category')";
    mysqli_query($conn, $query);

    header("Location: admin.php");
}
