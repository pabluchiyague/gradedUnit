<?php
session_start();
require ('includes/db.php');
include 'includes/nav.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $_POST['company_name'];
    $contact_person = $_POST['contact_person'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $message = "Email already registered.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO users (company_name, contact_person, phone, email, password, role) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$company_name, $contact_person, $phone, $email, $hashed_password, 'user']);

        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="flex-grow-1 d-flex justify-content-center align-items-center py-5">
    <div class="card p-4 shadow" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-3">Register</h2>

        <?php if ($message): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
            </div>
            <div class="mb-3">
                <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" required>
            </div>
            <div class="mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>

        <div class="text-center mt-3">
            <small>Already have an account? <a href="login.php">Login</a></small>
        </div>
    </div>
</main>
    <?php include 'includes/footer.php'; ?>
</body>
</html>