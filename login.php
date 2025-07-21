<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("config.php");
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($email === "canvasandcraft@gmail.com" && $password === "ZunairaAliza123.") {
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["role"] = "admin";
        $_SESSION["user_name"] = "Admin";
        header("Location: admin.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
        $_SESSION["role"] = $user["role"];

        if ($user["role"] === "admin") {
            $_SESSION["admin_logged_in"] = true;
            header("Location: admin.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $message = "Invalid login credentials!";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    color: #66350F;
}

.form-container {
    background-color: #dbbfab;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(102, 53, 15, 0.2);
    width: 100%;
    max-width: 400px;
    border: none;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #66350F;
}

form input {
    width: 95%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #66350F;
    border-radius: 8px;
    background-color: #fff8f2;
    color: #66350F;
    font-size: 16px;
}

form input::placeholder {
    color: #a1703d;
}

form button {
    width: 100%;
    padding: 12px;
    background-color: #66350F;
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #4a260a;
}

p {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

a {
    color: #66350F;
    font-weight: bold;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.error {
    color: red;
    font-size: 14px;
    text-align: center;
    margin-bottom: 10px;
}

    </style>

</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <?php if ($message): ?>
        <p class="error"><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
</div>
</body>
</html>
