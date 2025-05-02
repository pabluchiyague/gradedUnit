<?php
session_start();
require 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
    <?php include 'includes/nav.php'; ?>

    <main class="flex-grow-1 d-flex justify-content-center align-items-center py-5">
        <div class="card shadow p-4 text-center card-overlay" style="width: 100%; max-width: 700px;">
            <h1>Welcome to Sustain Energy</h1>
            <p class="lead">This platform helps companies track and improve sustainability.</p>

            <?php if (!isset($_SESSION['user_id'])): ?>
                <p><a href="login.php" class="btn btn-success m-2">Login</a>
                   <a href="register.php" class="btn btn-outline-success m-2">Register</a></p>
            <?php else: ?>
                <p class="text-success">You are logged in as <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>