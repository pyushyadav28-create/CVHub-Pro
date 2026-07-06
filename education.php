<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "config/database.php";

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM education WHERE user_id = ? ORDER BY start_year DESC");
$stmt->execute([$userId]);
$educations = $stmt->fetchAll();

require_once "includes/header.php";
?>

<div class="dashboard-layout">

<?php require_once "includes/sidebar.php"; ?>

<div class="main-content">

<div class="topbar">
    <h2>
        <i class="fa-solid fa-graduation-cap"></i>
        Education
    </h2>
</div>

<div class="row">

    <!-- Add Education Form -->
    <div class="col-lg-4">

        <div class="card p-4 shadow-sm">

            <h3>Add Education</h3>

            <form action="actions/add_education.php" method="POST">

                <div class="mb-3">
                    <label>Institution</label>
                    <input type="text" name="institution" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Degree</label>
                    <input type="text" name="degree" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Field of Study</label>
                    <input type="text" name="field_of_study" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Start Year</label>
                    <input type="number" name="start_year" class="form-control" min="1900" max="2100" required>
                </div>

                <div class="mb-3">
                    <label>End Year</label>
                    <input type="number" name="end_year" class="form-control" min="1900" max="2100">
                </div>

                <div class="mb-3">
                    <label>Grade</label>
                    <input type="text" name="grade" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <button class="btn btn-primary w-100">
                    Add Education
                </button>

            </form>

        </div>

    </div>

    <!-- Education List -->
    <div class="col-lg-8">

        <h3>Your Education</h3>

        <?php foreach($educations as $education){ ?>

            <div class="card p-3 mb-3 shadow-sm">

                <h4><?php echo htmlspecialchars($education['institution']); ?></h4>

                <h6><?php echo htmlspecialchars($education['degree']); ?></h6>

                <p>
                    <?php echo htmlspecialchars($education['field_of_study']); ?>
                </p>

                <p>
                    <?php echo $education['start_year']; ?>
                    -
                    <?php echo $education['end_year']; ?>
                </p>

                <p>
                    Grade:
                    <?php echo htmlspecialchars($education['grade']); ?>
                </p>

                <p>
                    <?php echo htmlspecialchars($education['description']); ?>
                </p>
                <div class="mt-3">

    <a href="edit_education.php?id=<?php echo $education['id']; ?>"
       class="btn btn-warning">
        <i class="fa-solid fa-pen"></i> Edit
    </a>

    <a href="actions/delete_education.php?id=<?php echo $education['id']; ?>"
       class="btn btn-danger"
       onclick="return confirm('Are you sure you want to delete this education record?');">
        <i class="fa-solid fa-trash"></i> Delete
    </a>

</div>

            </div>

        <?php } ?>

    </div>

</div>

</div>

</div>

<?php require_once "includes/footer.php"; ?>