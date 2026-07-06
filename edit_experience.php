<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "config/database.php";

if (!isset($_GET['id'])) {
    header("Location: experience.php");
    exit();
}

$id = $_GET['id'];
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM experience WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);

$experience = $stmt->fetch();

if (!$experience) {
    die("Experience not found.");
}

require_once "includes/header.php";
?>

<div class="dashboard-layout">

<?php require_once "includes/sidebar.php"; ?>

<div class="main-content">

    <div class="topbar">
        <h2>Edit Experience</h2>
    </div>

    <div class="dashboard-section">

        <div class="card p-4 shadow-sm">

            <form action="actions/update_experience.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $experience['id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Company</label>
                    <input type="text"
                           name="company"
                           class="form-control"
                           value="<?php echo htmlspecialchars($experience['company']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Job Title</label>
                    <input type="text"
                           name="job_title"
                           class="form-control"
                           value="<?php echo htmlspecialchars($experience['job_title']); ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Employment Type</label>
                    <input type="text"
                           name="employment_type"
                           class="form-control"
                           value="<?php echo htmlspecialchars($experience['employment_type']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text"
                           name="location"
                           class="form-control"
                           value="<?php echo htmlspecialchars($experience['location']); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date"
                           name="start_date"
                           class="form-control"
                           value="<?php echo $experience['start_date']; ?>"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date"
                           name="end_date"
                           class="form-control"
                           value="<?php echo $experience['end_date']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"><?php echo htmlspecialchars($experience['description']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Experience
                </button>

                <a href="experience.php" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

</div>

<?php require_once "includes/footer.php"; ?>