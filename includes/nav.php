<?php
$is_logged_in = isset($_SESSION['user_id']);
$is_admin = isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Sustain Energy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <!-- Always visible -->
                <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="sustainable_practices.php">Sustainable Practices</a></li>
                <li class="nav-item"><a class="nav-link" href="about_us.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="credentials.php">Credentials</a></li>

                <?php if ($is_logged_in): ?>
                    <!-- Protected Access -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="calculatorDropdown" role="button" data-bs-toggle="dropdown">
                            Calculator
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="calculatorDropdown">
                            <li><a class="dropdown-item" href="calculator.php">Green Calculator</a></li>
                            <li><a class="dropdown-item" href="awards_page.php">Awards Page</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            User Panel
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="membership.php">Membership</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown">
                            Shop
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="shopDropdown">
                            <li><a class="dropdown-item" href="point_shop.php">Shop</a></li>
                            <li><a class="dropdown-item" href="cart.php">Cart</a></li>
                        </ul>
                    </li>

                    <?php if ($is_admin): ?>
                        <li class="nav-item"><a class="nav-link text-warning" href="admin.php">Admin Panel</a></li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link text-warning" href="logout.php">Logout</a>
                    </li>

                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown">
                            Log in
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
                            <li><a class="dropdown-item" href="login.php">Log In</a></li>
                            <li><a class="dropdown-item" href="forgot_password.php">Forgot Password</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>