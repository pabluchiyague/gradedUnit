<?php
session_start();
require 'includes/db.php';
include 'includes/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="bg-light">
<main class="container mt-5 mb-5">
    <div class="card p-4 shadow">
        <div class="row g-4 align-items-center">
            <div class="col-md-5">
                <img src="images/about_placeholder.jpg" class="img-fluid rounded shadow" alt="Our mission image">
            </div>
            <div class="col-md-7">
                <h2 class="mb-3">Our Mission</h2>
                <p>
                    At <strong>Sustain Energy</strong>, our goal is to empower companies to become more environmentally conscious and actively participate in building a sustainable future. 
                    We believe that even small efforts—when multiplied across industries—can lead to a significant impact on our planet.
                </p>
                <p>
                    Through our platform, businesses can calculate their carbon footprint, earn green points, and take steps to improve their sustainability efforts.
                </p>
                <p>
                    <strong>100% of our proceeds</strong> go directly toward supporting climate action initiatives, environmental education, and reforestation projects. 
                    When you work with us, you’re not only improving your business—you’re contributing to the future of our planet.
                </p>
            </div>
        </div>

        <div class="mt-5 row text-center">
            <div class="col-md-4 mb-3">
                <img src="images/tree_icon.png" width="60" alt="Trees">
                <h5 class="mt-2">50,000+ Trees Planted</h5>
            </div>
            <div class="col-md-4 mb-3">
                <img src="images/company_icon.png" width="60" alt="Companies">
                <h5 class="mt-2">120+ Companies Supported</h5>
            </div>
            <div class="col-md-4 mb-3">
                <img src="images/earth_icon.png" width="60" alt="Earth impact">
                <h5 class="mt-2">Global Climate Impact</h5>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>