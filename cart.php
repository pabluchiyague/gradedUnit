<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'includes/db.php';
include 'includes/nav.php';

$user_id = $_SESSION['user_id'];
$membership_price = 400;

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle add to cart
if (isset($_GET['action']) && $_GET['action'] === 'add') {
    $item = $_GET['item'];
    if ($item === 'membership' && !in_array('membership', $_SESSION['cart'])) {
        $_SESSION['cart'][] = 'membership';
    } elseif ($item === 'eco_penalty') {
        $amount = isset($_GET['amount']) ? (int)$_GET['amount'] : 0;
        $_SESSION['cart'][] = [
            'type' => 'eco_penalty',
            'amount' => $amount
        ];
    }
    header('Location: cart.php');
    exit;
}

// Handle remove from cart
if (isset($_GET['action']) && $_GET['action'] === 'remove') {
    $item = $_GET['item'];
    if ($item === 'membership') {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($i) => $i !== 'membership');
    } elseif ($item === 'eco_penalty') {
        $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($i) => !(is_array($i) && $i['type'] === 'eco_penalty'));
    }
    header('Location: cart.php');
    exit;
}

// Handle checkout
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    foreach ($_SESSION['cart'] as $item) {
        if ($item === 'membership') {
            $stmt = $pdo->prepare("SELECT end_date FROM memberships WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $existing = $stmt->fetch();

            $start = new DateTime();
            if ($existing) {
                $start = new DateTime($existing['end_date']) > $start ? new DateTime($existing['end_date']) : $start;
                $start->modify('+1 day');
            }
            $end = clone $start;
            $end->modify('+1 year');

            if ($existing) {
                $stmt = $pdo->prepare("UPDATE memberships SET end_date = ? WHERE user_id = ?");
                $stmt->execute([$end->format('Y-m-d'), $user_id]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO memberships (user_id, start_date, end_date) VALUES (?, ?, ?)");
                $stmt->execute([$user_id, $start->format('Y-m-d'), $end->format('Y-m-d')]);
            }

            $stmt = $pdo->prepare("INSERT INTO purchases (user_id, item, amount, purchase_date) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$user_id, 'membership', $membership_price]);
        }

        if (is_array($item) && $item['type'] === 'eco_penalty') {
            $_SESSION['eco_paid'] = true;

            $amount = $item['amount'];
            $stmt = $pdo->prepare("INSERT INTO purchases (user_id, item, amount, purchase_date) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$user_id, 'eco_penalty', $amount]);

            $score = $_SESSION['eco_score'] ?? 0;
            $award = 'Bronze';
            if ($score >= 70) $award = 'Gold';
            elseif ($score >= 40) $award = 'Silver';

            $stmt = $pdo->prepare("INSERT INTO awards (user_id, award_type, score, awarded_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$user_id, $award, $score]);
        }
    }

    $_SESSION['cart'] = [];
    $message = "✅ Checkout complete! Your actions have been registered.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow bg-white bg-opacity-90">
        <h2>Your Cart</h2>

        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (!empty($_SESSION['cart'])): ?>
            <ul class="list-group mb-3">
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $item): 
                    if ($item === 'membership') {
                        $total += $membership_price;
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        1-Year Membership
                        <span>£<?php echo $membership_price; ?></span>
                        <a href="cart.php?action=remove&item=membership" class="btn btn-sm btn-danger">Remove</a>
                    </li>
                <?php } elseif (is_array($item) && $item['type'] === 'eco_penalty') {
                        $amount = $item['amount'];
                        $total += $amount;
                ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Eco Shortfall Donation
                        <span>£<?php echo $amount; ?></span>
                        <a href="cart.php?action=remove&item=eco_penalty" class="btn btn-sm btn-danger">Remove</a>
                    </li>
                <?php } endforeach; ?>
            </ul>

            <p><strong>Total:</strong> £<?php echo $total; ?></p>
            <form method="POST">
                <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
            </form>
        <?php else: ?>
            <p>Your cart is currently empty.</p>
        <?php endif; ?>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>
