<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $res = mysqli_query($conn, "SELECT image FROM products WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    unlink("uploads/" . $row["image"]);

    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: admin.php");
}
