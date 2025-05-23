<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'includes/db.php';
include 'includes/nav.php';

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT end_date FROM memberships WHERE user_id = ?");
$stmt->execute([$user_id]);
$membership = $stmt->fetch();

$today = new DateTime();
if (!$membership || new DateTime($membership['end_date']) < $today) {
    header("Location: membership.php");
    exit;
}

// Fetch all awards for this user
$stmt = $pdo->prepare("SELECT award_type, score, awarded_at FROM awards WHERE user_id = ? ORDER BY awarded_at DESC");
$stmt->execute([$user_id]);
$awards = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Awards - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow bg-white bg-opacity-90">
        <h2 class="mb-4">Your Award History</h2>

        <?php if ($awards): ?>
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-success">
                    <tr>
                        <th scope="col">Award</th>
                        <th scope="col">Score</th>
                        <th scope="col">Date Awarded</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($awards as $award): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($award['award_type']); ?></td>
                            <td><?php echo (int)$award['score']; ?>/100</td>
                            <td><?php echo date('F j, Y', strtotime($award['awarded_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">You haven't received any awards yet.</p>
        <?php endif; ?>

        <a href="awards_page.php" class="btn btn-outline-success mt-3">Back to Latest Award</a>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>