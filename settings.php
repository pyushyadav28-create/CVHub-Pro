<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "config/database.php";

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

require_once "includes/header.php";
?>

<div class="dashboard-layout">

<?php require_once "includes/sidebar.php"; ?>

<div class="main-content">

    <div class="topbar">
        <h2>Settings</h2>
    </div>

    <div class="dashboard-section">

        <div class="row">

            <div class="col-lg-6">

                <div class="card p-4 shadow-sm mb-4">

                    <h3>Account Information</h3>

                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Joined:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="card p-4 shadow-sm mb-4">

                    <h3>Change Password</h3>

                    <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success">Password updated successfully.</div>
                    <?php } ?>

                    <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger">Password update failed. Check your current password.</div>
                    <?php } ?>

                    <form action="actions/update_password.php" method="POST">

                        <div class="mb-3">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary">
                            Update Password
                        </button>

                    </form>

                </div>

            </div>

        </div>

        <div class="card p-4 shadow-sm">

            <h3>Account Actions</h3>

            <a href="actions/logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>

</div>

</div>

<?php require_once "includes/footer.php"; ?>