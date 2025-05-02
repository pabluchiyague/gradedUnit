<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'includes/db.php';
include 'includes/nav.php';

$user_id = $_SESSION['user_id'];
$message = '';

// Check membership
$stmt = $pdo->prepare("SELECT start_date, end_date FROM memberships WHERE user_id = ?");
$stmt->execute([$user_id]);
$membership = $stmt->fetch();

$today = new DateTime();
$has_membership = false;

if ($membership) {
    $end_date = new DateTime($membership['end_date']);
    $has_membership = $today < $end_date;
    $days_left = $today->diff($end_date)->days;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Membership - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow bg-white bg-opacity-90">
        <h2 class="mb-4">Membership</h2>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($membership && $has_membership): ?>
            <p class="mb-3">✅ You have an active membership until <strong><?php echo date('F j, Y', strtotime($membership['end_date'])); ?></strong>.</p>
            <p>That's <strong><?php echo $days_left; ?></strong> day(s) remaining.</p>
            <a href="cart.php?action=add&item=membership" class="btn btn-success mt-2">Extend by One Year (£400)</a>

        <?php elseif ($membership): ?>
            <p class="text-warning">⚠️ Your membership expired on <strong><?php echo date('F j, Y', strtotime($membership['end_date'])); ?></strong>.</p>
            <a href="cart.php?action=add&item=membership" class="btn btn-success mt-2">Renew for One Year (£400)</a>

        <?php else: ?>
            <p>You currently do not have an active membership.</p>

            <h4 class="mt-4">🌿 Membership Plan - £400/year</h4>
            <ul>
                <li>Official certification of environmental commitment</li>
                <li>Displayable award badge for your company</li>
                <li>Access to advanced sustainability tools</li>
                <li>Public listing on our Eco-Friendly Partners page</li>
            </ul>

            <p class="mt-3">To become a member, continue to checkout:</p>
            <a href="cart.php?action=add&item=membership" class="btn btn-primary">Add Membership to Cart</a>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>