<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'includes/db.php';
include 'includes/nav.php';


$measures = [
    "Carbon Emissions Reduction",
    "Renewable Energy Usage",
    "Waste Reduction",
    "Water Conservation",
    "Employee Sustainability Education",
    "Sustainable Packaging",
    "Transportation Sustainability",
    "Sustainable Supply Chain",
    "Carbon Offsetting",
    "Energy-Efficient Infrastructure"
];

$score = null;
$cost = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($measures as $index => $measure) {
        $field = 'measure_' . $index;
        if (isset($_POST[$field])) {
            if ($_POST[$field] === 'green') $score += 10;
            elseif ($_POST[$field] === 'amber') $score += 5;
        }
    }
    $cost = (100 - $score) * 10;
    $_SESSION['eco_score'] = $score;
    $_SESSION['eco_cost'] = $cost;
    header("Location: cart.php?action=add&item=eco_penalty&amount=$cost");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Green Calculator - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow bg-white bg-opacity-90">
        <h2 class="mb-4">Green Calculator</h2>
        <p>This tool helps evaluate your company's environmental efforts across 10 key sustainability measures. For each one, select your level of implementation:</p>
        <ul>
            <li><strong>🔴 RED</strong>: Not currently following this practice (no improvement from last year) ⠆ <strong>0 points</strong></li>
            <li><strong>🟠 AMBER</strong>: Partially or occasionally follow (5-10% improvemnt from last year) ⠆ <strong>5 points</strong></li>
            <li><strong>🟢 GREEN</strong>: Fully and consistently follow (over 10% improvemnt from last year) ⠆ <strong>10 points</strong></li> 
        </ul>
        <p>Your total score will determine a contribution amount (for missed points), and you'll receive an environmental award level.</p>
        <form method="POST">
            <?php foreach ($measures as $index => $measure): ?>
                <div class="mb-3">
                    <label class="form-label"><strong><?php echo $measure; ?></strong></label>
                    <select name="measure_<?php echo $index; ?>" class="form-select" required>
                        <option value="">Select</option>
                        <option value="red">🔴 RED – Not following (0 pts)</option>
                        <option value="amber">🟠 AMBER – Partially following (5 pts)</option>
                        <option value="green">🟢 GREEN – Fully following (10 pts)</option>
                    </select>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success mt-3">Submit & Continue to Cart</button>
        </form>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>