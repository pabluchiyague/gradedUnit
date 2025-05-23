<?php
session_start();
require 'includes/db.php';
include 'includes/nav.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}


// Handle role change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['action'])) {
    $user_id = $_POST['user_id'];
    if ($_POST['action'] === 'delete') {
        if ($user_id != $_SESSION['user_id']) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
        }
    } else {
        $new_role = $_POST['action'] === 'make_admin' ? 'admin' : 'user';
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$new_role, $user_id]);
    }
    header('Location: admin.php');
    exit;
}

// Handle create user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {
    $company = $_POST['company_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);
    if ($check->rowCount() === 0) {
        $stmt = $pdo->prepare("INSERT INTO users (company_name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$company, $email, $password, $role]);
    }
    header('Location: admin.php');
    exit;
}

// Fetch all users
$users = $pdo->query("SELECT id, company_name, email, role FROM users ORDER BY company_name")->fetchAll();
$transactions = $pdo->query("SELECT purchases.*, users.company_name FROM purchases JOIN users ON purchases.user_id = users.id ORDER BY purchase_date DESC")->fetchAll();
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

        <!-- Transactions Table -->
        <h4>All Transactions</h4>
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-success">
                <tr><th>Company</th><th>Item</th><th>Amount</th><th>Date</th></tr>
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

        <!-- Add User Form -->
        <h4>Create New User</h4>
        <form method="POST" class="row g-3 mb-4">
            <input type="hidden" name="create_user" value="1">
            <div class="col-md-4"><input name="company_name" type="text" class="form-control" placeholder="Company Name" required></div>
            <div class="col-md-3"><input name="email" type="email" class="form-control" placeholder="Email" required></div>
            <div class="col-md-3"><input name="password" type="password" class="form-control" placeholder="Password" required></div>
            <div class="col-md-2">
                <select name="role" class="form-select">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Add User</button>
            </div>
        </form>

        <!-- Users Table -->
        <h4>Manage Users</h4>
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-success">
                <tr><th>Company</th><th>Email</th><th>Role</th><th>Actions</th></tr>
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
                                    <button name="action" value="delete" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
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