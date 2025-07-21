<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us | Canvas & Craft</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

<?php include("includes/header.php"); ?>

<div class="contact-container">
  <div class="contact-info">
    <h2>Get in Touch</h2>
    <p><i class="fas fa-location-dot"></i> <strong>Address:</strong> Rawalpindi, Pakistan</p>
    <p>	<i class="fas fa-phone"></i> <strong>Phone:</strong> +92-301-2345678</p>
    <p>	<i class="fas fa-envelope"></i> <strong>Email:</strong> canvasandcraft@gmail.com</p>
    <p>	<i class="fas fa-clock"></i> <strong>Hours:</strong> Mon - Fri, 10am - 6pm</p>
  </div>

  <div class="contact-form">
    <h2>Send Us a Message</h2>
    <form action="contact-handler.php" method="POST">
      <input type="text" name="name" placeholder="Your Name" required>
      <input type="email" name="email" placeholder="Your Email" required>
      <textarea name="message" rows="5" placeholder="Your Message..." required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </div>
</div>
<?php include('includes/footer.php'); ?>

</body>
</html>
