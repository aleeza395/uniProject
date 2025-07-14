<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $imageName = $_FILES["image"]["name"];

    $fields = [];
    if (!empty($name)) $fields[] = "name='$name'";
    if (!empty($price)) $fields[] = "price='$price'";
    if (!empty($imageName)) {
        $tmp = $_FILES["image"]["tmp_name"];
        $target = "uploads/" . basename($imageName);
        move_uploaded_file($tmp, $target);
        $fields[] = "image='$imageName'";
    }

    if (!empty($fields)) {
        $sql = "UPDATE products SET " . implode(", ", $fields) . " WHERE id=$id";
        mysqli_query($conn, $sql);
    }

    header("Location: admin.php");
}
