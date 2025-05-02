<?php
session_start();
require 'includes/db.php';
include 'includes/nav.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Handle promote/demote actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['action'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['action'] === 'make_admin' ? 'admin' : 'user';

    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->execute([$new_role, $user_id]);
    header('Location: admin.php');
    exit;
}

// Fetch all transactions
$transactions_stmt = $pdo->prepare("SELECT purchases.*, users.company_name FROM purchases JOIN users ON purchases.user_id = users.id ORDER BY purchase_date DESC");
$transactions_stmt->execute();
$transactions = $transactions_stmt->fetchAll();

// Fetch all users
$users_stmt = $pdo->query("SELECT id, company_name, email, role FROM users ORDER BY company_name");
$users = $users_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Sustain Energy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('images/background_home.jpg') no-repeat center center fixed; background-size: cover;" class="d-flex flex-column">
<main class="container mt-5 mb-5 flex-grow-1">
    <div class="card p-4 shadow bg-white bg-opacity-90">
        <h2 class="mb-4">Admin Dashboard</h2>

        <h4>All Transactions</h4>
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-success">
                <tr>
                    <th>Company</th>
                    <th>Item</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $txn): ?>
                    <tr>
                        <td><?= htmlspecialchars($txn['company_name']) ?></td>
                        <td><?= htmlspecialchars($txn['item']) ?></td>
                        <td>£<?= number_format($txn['amount'], 2) ?></td>
                        <td><?= date('F j, Y - H:i', strtotime($txn['purchase_date'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <hr class="my-4">

        <h4>Manage User Roles</h4>
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-success">
                <tr>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['company_name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <?php if ($user['role'] !== 'admin'): ?>
                                        <button name="action" value="make_admin" class="btn btn-sm btn-outline-success">Make Admin</button>
                                    <?php else: ?>
                                        <button name="action" value="remove_admin" class="btn btn-sm btn-outline-danger">Remove Admin</button>
                                    <?php endif; ?>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">You</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>
