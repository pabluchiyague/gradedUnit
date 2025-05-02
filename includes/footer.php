<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Footer Include</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Footer Include</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>

<main class="flex-grow-1">

</main>

<footer class="bg-success text-white mt-auto py-4">
    <div class="container d-flex justify-content-between align-items-center flex-column flex-md-row">
        <div>
            <a href="contact_us.php" class="text-white me-3">Contact Us</a>
            <a href="privacy_policy.php" class="text-white">Privacy Policy</a>
        </div>
        <small>&copy; <?php echo date('Y'); ?> Sustain Energy. All rights reserved.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

