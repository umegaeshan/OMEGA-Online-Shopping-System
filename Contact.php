<?php
session_start(); // Ensures the navbar shows the correct buttons if logged in
include 'includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/contact.css">
    <title>Contact OMEGA</title>
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="row g-5">
            <div class="col-md-7">
                <div class="contact-card p-4 blur-in">
                    <h2 class="fw-bold mb-4">Send us a Message</h2>
                    <form action="process-contact.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control custom-input" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control custom-input" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control custom-input" rows="5" placeholder="How can we help?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary contact-btn">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="contact-info-section h-100">
                    <h3 class="fw-bold mb-4">Contact Information</h3>
                    <div class="info-item mb-4">
                        <h5>📍 Our Location</h5>
                        <p class="text-muted">123 Business Road, Colombo, Sri Lanka</p>
                    </div>
                    <div class="info-item mb-4">
                        <h5>📞 Call Us</h5>
                        <p class="text-muted">+94 11 234 5678</p>
                    </div>
                    <div class="info-item mb-4">
                        <h5>✉️ Email Us</h5>
                        <p class="text-muted">support@omega.com</p>
                    </div>
                    <div class="business-hours mt-5 p-3 rounded-3">
                        <h6 class="fw-bold">Business Hours</h6>
                        <p class="small mb-0">Mon - Fri: 9:00 AM - 6:00 PM</p>
                        <p class="small">Sat: 10:00 AM - 2:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>