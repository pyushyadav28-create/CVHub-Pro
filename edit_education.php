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

if (!isset($_GET['id'])) {
    header("Location: education.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM education WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);

$education = $stmt->fetch();

if (!$education) {
    die("Education record not found.");
}

require_once "includes/header.php";
?>

<div class="container mt-5">

    <div class="card p-4 shadow">

        <h2>Edit Education</h2>

        <form action="actions/update_education.php" method="POST">

            <input type="hidden" name="id" value="<?php echo $education['id']; ?>">

            <div class="mb-3">
                <label>Institution</label>
                <input type="text" name="institution" class="form-control"
                    value="<?php echo htmlspecialchars($education['institution']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Degree</label>
                <input type="text" name="degree" class="form-control"
                    value="<?php echo htmlspecialchars($education['degree']); ?>" required>
            </div>

            <div class="mb-3">
                <label>Field of Study</label>
                <input type="text" name="field_of_study" class="form-control"
                    value="<?php echo htmlspecialchars($education['field_of_study']); ?>">
            </div>

            <div class="mb-3">
                <label>Start Year</label>
                <input type="number" name="start_year" class="form-control"
                    value="<?php echo $education['start_year']; ?>" required>
            </div>

            <div class="mb-3">
                <label>End Year</label>
                <input type="number" name="end_year" class="form-control"
                    value="<?php echo $education['end_year']; ?>">
            </div>

            <div class="mb-3">
                <label>Grade</label>
                <input type="text" name="grade" class="form-control"
                    value="<?php echo htmlspecialchars($education['grade']); ?>">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($education['description']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Update Education
            </button>

            <a href="education.php" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

<?php require_once "includes/footer.php"; ?>