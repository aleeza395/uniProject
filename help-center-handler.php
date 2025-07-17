<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $topic = $_POST["topic"];
    $message = htmlspecialchars($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO help_messages (name, email, topic, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $topic, $message);
    $stmt->execute();
    $stmt->close();

    echo "<h2 class='thank-you'>Thanks for contacting us! We'll get back to you soon. <br><a class='back-home' href='index.php'>Back to Home</a></h2>";
}
?>
