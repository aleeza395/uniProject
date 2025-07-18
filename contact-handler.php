<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Message Received</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    </head>
    <body>
        <div class="thank-you">
            <h2>Thank you, <?php echo $name; ?>! 🥳</h2>
            <p>We’ve received your message and will respond as soon as possible.</p>
            <a href="index.php" class="button">← Back to Home</a>
        </div>
    </body>
    </html>

<?php
} else {
    header("Location: contact.php");
    exit();
}
?>
