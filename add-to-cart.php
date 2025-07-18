<?php
session_start();
include("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"];
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];

    $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id AND product_name = '$product_name'");
    
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_name = '$product_name'");
    } else {
        mysqli_query($conn, "INSERT INTO cart (user_id, product_name, price, quantity) VALUES ($user_id, '$product_name', $price, 1)");
    }

    header("Location: shop.php?success=1");
    exit();
}
