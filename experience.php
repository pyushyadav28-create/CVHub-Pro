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

// Get experience data (FIXED COLUMN NAME)
$stmt = $pdo->prepare("
    SELECT * 
    FROM experience 
    WHERE user_id = ? 
    ORDER BY start_date DESC
");

$stmt->execute([$userId]);

$experiences = $stmt->fetchAll();

require_once "includes/header.php";
?>

<div class="dashboard-layout">

<?php require_once "includes/sidebar.php"; ?>

<div class="main-content">

    <div class="topbar">
        <h2>Work Experience</h2>
    </div>

    <div class="dashboard-section">

        <div class="row">

            <!-- ADD EXPERIENCE FORM -->
            <div class="col-lg-4">

                <div class="card p-4 shadow-sm">

                    <h3 class="mb-3">Add Experience</h3>

                    <form action="actions/add_experience.php" method="POST">

                        <input type="text" name="company" class="form-control mb-2" placeholder="Company" required>

                        <input type="text" name="job_title" class="form-control mb-2" placeholder="Job Title" required>

                        <input type="text" name="employment_type" class="form-control mb-2" placeholder="Employment Type">

                        <input type="text" name="location" class="form-control mb-2" placeholder="Location">

                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control mb-2" required>

                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control mb-2">

                        <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

                        <button class="btn btn-primary w-100">Add Experience</button>

                    </form>

                </div>

            </div>

            <!-- EXPERIENCE LIST -->
            <div class="col-lg-8">

                <h3>Your Experience</h3>

                <div class="projects-grid">

                    <?php foreach ($experiences as $exp) { ?>

                        <div class="card p-3 mb-3">

    <h4><?php echo htmlspecialchars($exp['job_title']); ?></h4>

    <p><strong><?php echo htmlspecialchars($exp['company']); ?></strong></p>

   <p>
<?php
$start = !empty($exp['start_date'])
    ? date('M Y', strtotime($exp['start_date']))
    : 'N/A';

$end = 'Present';

if (!empty($exp['end_date']) && $exp['end_date'] != '0000-00-00') {
    $end = date('M Y', strtotime($exp['end_date']));
}

echo $start . " - " . $end;
?>
</p>
    <p><?php echo htmlspecialchars($exp['description']); ?></p>

    <div class="mt-3">

        <a href="edit_experience.php?id=<?php echo $exp['id']; ?>"
           class="btn btn-primary btn-sm">
            Edit
        </a>

        <a href="actions/delete_experience.php?id=<?php echo $exp['id']; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete this experience?');">
            Delete
        </a>

    </div>

</div>

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<?php require_once "includes/footer.php"; ?>