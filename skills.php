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

$stmt = $pdo->prepare("SELECT * FROM skills WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$userId]);
$skills = $stmt->fetchAll();

require_once "includes/header.php";
?>

<div class="dashboard-layout">

<?php require_once "includes/sidebar.php"; ?>

<div class="main-content">

<div class="topbar">
    <h2>Skills</h2>
</div>

<div class="dashboard-section">

<div class="row">

    <!-- Add Skill -->
    <div class="col-lg-4">

        <div class="card p-4 shadow-sm">

            <h3 class="mb-3">Add Skill</h3>

            <form action="actions/add_skill.php" method="POST">

                <div class="mb-3">
                    <label>Skill Name</label>
                    <input type="text"
                           name="skill_name"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Skill Level</label>

                    <select name="skill_level"
                            class="form-control"
                            required>

                        <option value="">Select Level</option>
                        <option>Beginner</option>
                        <option>Intermediate</option>
                        <option>Advanced</option>
                        <option>Expert</option>

                    </select>

                </div>

                <div class="mb-3">
                    <label>Category</label>

                    <input type="text"
                           name="category"
                           class="form-control"
                           placeholder="Programming, Database, Design...">

                </div>

                <button class="btn btn-primary w-100">
                    Add Skill
                </button>

            </form>

        </div>

    </div>

    <!-- Skill List -->
    <div class="col-lg-8">

        <h3>Your Skills</h3>

        <?php if(count($skills)>0){ ?>

            <?php foreach($skills as $skill){ ?>

                <div class="card p-3 mb-3">

                    <h4>
                        <?php echo htmlspecialchars($skill['skill_name']); ?>
                    </h4>

                    <p>
                        <strong>Level:</strong>
                        <?php echo htmlspecialchars($skill['skill_level']); ?>
                    </p>

                    <p>
                        <strong>Category:</strong>
                        <?php echo htmlspecialchars($skill['category']); ?>
                    </p>

                    <a href="edit_skill.php?id=<?php echo $skill['id']; ?>"
                       class="btn btn-primary btn-sm">
                        Edit
                    </a>

                    <a href="actions/delete_skill.php?id=<?php echo $skill['id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this skill?');">
                        Delete
                    </a>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="alert alert-info">
                No skills added yet.
            </div>

        <?php } ?>

    </div>

</div>

</div>

</div>

</div>

<?php require_once "includes/footer.php"; ?>