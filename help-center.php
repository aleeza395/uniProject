<!DOCTYPE html>
<html>
<head>
    <title>Help Center</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .faq-container {
            max-width: 800px;
            margin: 60px auto;
            padding: 20px;
        }
        .faq {
            margin-bottom: 15px;
        }
        .faq-question {
            background: #eee;
            padding: 15px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
        }
        .faq-answer {
            display: none;
            background: #f9f9f9;
            padding: 15px;
            border-left: 4px solid #007bff;
            border-radius: 5px;
        }

        .contact-form {
            margin-top: 50px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .contact-form input,
        .contact-form textarea,
        .contact-form select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .contact-form button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background: #0056b3;
        }

        .back-home {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background: #222;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="faq-container">
        <h2>Help Center</h2>

        <!-- FAQ Section -->
        <div class="faq">
            <div class="faq-question">🛒 How do I place an order?</div>
            <div class="faq-answer">Go to the Shop page, choose your items, and click "Add to Cart". You can then proceed to checkout.</div>
        </div>

        <div class="faq">
            <div class="faq-question">🔐 I forgot my password. What now?</div>
            <div class="faq-answer">We currently don’t support password reset. Please contact admin via the form below.</div>
        </div>

        <div class="faq">
            <div class="faq-question">🚚 How long does delivery take?</div>
            <div class="faq-answer">3-5 business days for local delivery. Customized orders may take longer.</div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <h3>Contact Support</h3>
            <form method="POST" action="help-center-handler.php">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <select name="topic">
                    <option value="general">General Inquiry</option>
                    <option value="order">Order Related</option>
                    <option value="technical">Technical Issue</option>
                </select>
                <textarea name="message" rows="5" placeholder="Type your message here..." required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>

        <a class="back-home" href="index.php">⬅ Back to Home</a>
    </div>

    <script>
        // Toggle FAQs
        document.querySelectorAll(".faq-question").forEach(q => {
            q.addEventListener("click", () => {
                const answer = q.nextElementSibling;
                answer.style.display = answer.style.display === "block" ? "none" : "block";
            });
        });
    </script>
</body>
</html>
