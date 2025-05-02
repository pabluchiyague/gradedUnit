<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['reset_email'])) {
    header('Location: forgot_password.php');
    exit;
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashed, $_SESSION['reset_email']]);

        unset($_SESSION['reset_email']);
        header('Location: login.php?reset=success');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="bg-light">
    <div class="container mt-5">
        <div class="card p-4 shadow mx-auto" style="max-width: 400px;">
            <h2 class="text-center">Reset Password</h2>
            <?php if ($message): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="password" name="password" class="form-control mb-3" placeholder="New Password" required>
                <input type="password" name="confirm_password" class="form-control mb-3" placeholder="Confirm Password" required>
                <button type="submit" class="btn btn-primary w-100">Update Password</button>
            </form>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>