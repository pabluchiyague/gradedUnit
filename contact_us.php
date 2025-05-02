<?php
session_start();
require 'includes/db.php';
include 'includes/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow">
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-md-6">
                <h2>Send Us a Message</h2>
                <p>We’re here to help! Whether you’re a business interested in sustainability, or just have a question, feel free to reach out.</p>

                <form method="POST" action="#">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6">
                <h2>Contact Information</h2>
                <p><strong>Email:</strong> <a href="mailto:contact@sustainenergy.com">contact@sustainenergy.com</a></p>
                <p><strong>Phone:</strong> +44 1234 567890</p>
                <p><strong>Address:</strong><br>
                    Sustain Energy HQ<br>
                    100 Eco Street<br>
                    Green City, G1 2EN<br>
                    United Kingdom
                </p>

                <p class="mt-4"><strong>Business Hours:</strong><br>
                    Monday to Friday: 9am – 5pm<br>
                    Saturday & Sunday: Closed
                </p>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>