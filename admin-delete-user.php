<?php
include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
}
header("Location: admin-dashboard.php");
exit();