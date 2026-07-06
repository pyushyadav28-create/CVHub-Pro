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
    header("Location: skills.php");
    exit();
}

$id = $_GET['id'];
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM skills WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);

$skill = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$skill) {
    die("Skill not found.");
}

require_once "includes/header.php";
?>

<div class="dashboard-layout">

<?php require_once "includes/sidebar.php"; ?>

<div class="main-content">

    <div class="topbar">
        <h2>Edit Skill</h2>
    </div>

    <div class="dashboard-section">

        <div class="card p-4 shadow-sm">

            <form action="actions/update_skill.php" method="POST">

                <input type="hidden" name="id" value="<?php echo $skill['id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Skill Name</label>
                    <input
                        type="text"
                        name="skill_name"
                        class="form-control"
                        value="<?php echo htmlspecialchars($skill['skill_name']); ?>"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Skill Level</label>
                    <select name="skill_level" class="form-control" required>
                        <option <?php if($skill['skill_level']=="Beginner") echo "selected"; ?>>Beginner</option>
                        <option <?php if($skill['skill_level']=="Intermediate") echo "selected"; ?>>Intermediate</option>
                        <option <?php if($skill['skill_level']=="Advanced") echo "selected"; ?>>Advanced</option>
                        <option <?php if($skill['skill_level']=="Expert") echo "selected"; ?>>Expert</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <input
                        type="text"
                        name="category"
                        class="form-control"
                        value="<?php echo htmlspecialchars($skill['category']); ?>">
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Skill
                </button>

                <a href="skills.php" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

</div>

<?php require_once "includes/footer.php"; ?>