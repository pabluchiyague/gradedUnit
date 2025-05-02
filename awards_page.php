<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'includes/db.php';
include 'includes/nav.php';


$user_id = $_SESSION['user_id'];



// Get most recent award
$stmt = $pdo->prepare("SELECT award_type, score, awarded_at FROM awards WHERE user_id = ? ORDER BY awarded_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$award = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Award Certificate - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script>
        function printCertificate() {
            window.print();
        }
    </script>
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow bg-white bg-opacity-90 text-center">
        <h2 class="mb-4">Certificate of Environmental Achievement</h2>

        <?php if ($award): ?>
            <img src="images/<?php echo strtolower($award['award_type']); ?>Award.jpg" alt="Award Badge" class="mb-3" style="max-height: 150px;">
            <p class="lead">This is to certify that</p>
            <h3 class="fw-bold text-success"><?php echo htmlspecialchars($_SESSION['user_name']); ?></h3>
            <p class="lead">has been awarded the</p>
            <h1 class="display-4 text-<?php echo strtolower($award['award_type']); ?>">
                <?php echo strtoupper($award['award_type']); ?> AWARD
            </h1>
            <p class="lead">for achieving a sustainability score of <strong><?php echo $award['score']; ?>/100</strong></p>
            <p class="text-muted">Awarded on: <?php echo date('F j, Y', strtotime($award['awarded_at'])); ?></p>
            <button onclick="printCertificate()" class="btn btn-outline-success mt-3">Download/Print Certificate</button>
            <a href="all_awards.php" class="btn btn-secondary mt-3 ms-2">View All Previous Awards</a>
        <?php else: ?>
            <p class="text-danger">No award found. Please complete the Green Calculator to earn a certificate.</p>
        <?php endif; ?>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>
