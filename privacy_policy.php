<?php
session_start();
require 'includes/db.php';
include 'includes/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Privacy Policy - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="flex-grow-1 container mt-5 mb-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4">Privacy & Copyright Policy</h2>

        <h4>1. Data Collection</h4>
        <p>
            Sustain Energy collects only the necessary information to provide our services, such as your company name, contact details, and email address.
            We do not collect unnecessary data or track your activity outside of our platform.
        </p>

        <h4>2. How We Use Your Data</h4>
        <p>
            Your data is used solely for account management, analytics, and improving your experience. We never sell or share your data with third parties
            without your explicit consent, unless legally required.
        </p>

        <h4>3. Cookies</h4>
        <p>
            We use cookies for basic functionality (like keeping you logged in). You can disable cookies in your browser settings if you prefer.
        </p>

        <h4>4. Security</h4>
        <p>
            We take data protection seriously and use secure database connections and encrypted passwords. However, no system is 100% secure—please
            keep your login details confidential.
        </p>

        <h4>5. Copyright & Ownership</h4>
        <p>
            All content on this platform, including images, software, and text, is the property of Sustain Energy or licensed third parties. 
            You may not reuse or distribute any content without written permission.
        </p>

        <h4>6. Changes to This Policy</h4>
        <p>
            Sustain Energy reserves the right to modify this policy at any time. We recommend reviewing it periodically to stay informed.
        </p>

        <h4>7. Contact</h4>
        <p>
            If you have questions about this policy, please contact us at <a href="mailto:contact@sustainenergy.com">contact@sustainenergy.com</a>.
        </p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>