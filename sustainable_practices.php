<?php
session_start();
require 'includes/db.php';
include 'includes/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sustainable Practices - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow bg-white bg-opacity-90">
        <h2 class="mb-4">Sustainable Practices</h2>
        <p>We believe that education is key to transformation. Below are resources and actionable tips to help your company move toward a more sustainable future.</p>

        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
            <!-- Blog Card 1 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="images/green-office.jpg" class="card-img-top" alt="Green office tips">
                    <div class="card-body">
                        <h5 class="card-title">10 Easy Ways to Make Your Office Greener</h5>
                        <p class="card-text">From switching to LED lighting to starting a recycling initiative—simple steps that make a big difference.</p>
                        <a href="blog_green_office.php" class="btn btn-success">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 2 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="images/supply-chain.jpg" class="card-img-top" alt="Sustainable supply chain">
                    <div class="card-body">
                        <h5 class="card-title">Building a Sustainable Supply Chain</h5>
                        <p class="card-text">Explore how to audit, improve, and partner with suppliers who align with your sustainability values.</p>
                        <a href="blog_supply_chain.php" class="btn btn-success">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Blog Card 3 -->
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="images/carbon-footprint.jpg" class="card-img-top" alt="Carbon reduction">
                    <div class="card-body">
                        <h5 class="card-title">How to Reduce Your Company’s Carbon Footprint</h5>
                        <p class="card-text">Track your emissions, offset your impact, and create measurable change.</p>
                        <a href="blog_carbon_reduction.php" class="btn btn-success">Read More</a>
                    </div>
                </div>
            </div>

            <!-- Add more cards as needed -->
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>