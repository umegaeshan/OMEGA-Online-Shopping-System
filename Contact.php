<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact US</title>
    <link rel="stylesheet" href="./styles/home.css">

</head>

<body>

    <?php
    session_start();
    include './includes/navbar.php';
    ?>


    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm p-4 border-0 rounded-4">
                    <h2 class="fw-bold mb-4">Get in Touch</h2>
                    <form action="process-contact.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <select name="subject" class="form-select">
                                <option value="general">General Inquiry</option>
                                <option value="order">Order Support</option>
                                <option value="returns">Returns & Refunds</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" placeholder="How can we help you?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="p-4">
                    <h3 class="fw-bold">Contact Information</h3>
                    <p class="text-muted">Have a question? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>

                    <div class="mt-4">
                        <p><strong>📍 Address:</strong> 123 Main Street, Colombo, Sri Lanka</p>
                        <p><strong>📞 Phone:</strong> +94 11 234 5678</p>
                        <p><strong>✉️ Email:</strong> support@omega.com</p>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold">Business Hours</h5>
                        <p class="text-muted mb-0">Monday - Friday: 9am - 6pm</p>
                        <p class="text-muted">Saturday: 10am - 2pm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>