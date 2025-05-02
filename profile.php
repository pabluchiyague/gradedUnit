<?php
session_start();
require ('includes/db.php');
include('includes/nav.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';

// Fetch user information
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    die('User not found.');
}

// Handle updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $contact_person = $_POST['contact_person'];
    $phone = $_POST['phone'];

    $stmt = $pdo->prepare('UPDATE users SET company_name = ?, contact_person = ?, phone = ? WHERE id = ?');
    $stmt->execute([$company_name, $contact_person, $phone, $_SESSION['user_id']]);

    $_SESSION['user_name'] = $company_name;
    $message = "Profile updated successfully!";
    header("Refresh:1"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="bg-light">
    <!-- Main Content -->
    <div class="container mt-5">
        <div class="card shadow p-4">
            <h2 class="text-center mb-4">Your Profile</h2>
            <?php if ($message): ?>
                <div class="alert alert-success text-center"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="company_name" class="form-control" value="<?php echo htmlspecialchars($user['company_name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="<?php echo htmlspecialchars($user['contact_person']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success w-50">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>