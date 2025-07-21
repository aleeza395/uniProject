<?php
include("config.php");
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $message = "Email already exists!";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit();
        } else {
            $message = "Signup failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
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
        <h2>Signup</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Signup</button>
        </form>
        <p class="error"><?php echo $message; ?></p>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
