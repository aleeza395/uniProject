<?php
session_start();
include("config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $user_id = $_SESSION["user_id"];

    mysqli_query($conn, "DELETE FROM cart WHERE id = $id AND user_id = $user_id");

    header("Location: cart.php");
    exit();
}
?>
