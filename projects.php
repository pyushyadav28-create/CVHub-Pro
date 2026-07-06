<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once "config/database.php";

$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];

require_once "includes/header.php";
?>

<div class="dashboard-layout">

    <?php require_once "includes/sidebar.php"; ?>

    <div class="main-content">

        <div class="topbar">

            <h2>
                <i class="fa-solid fa-diagram-project"></i>
                My Projects
            </h2>

        </div>

        <div class="dashboard-section">

            <div class="row">
                <!-- Add Project Form -->
<div class="col-lg-4">

    <div class="card p-4 shadow-sm">

        <h3 class="mb-4">
            <i class="fa-solid fa-plus"></i>
            Add New Project
        </h3>

        <form action="actions/add_project.php"
              method="POST"
              enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Project Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       placeholder="Enter project title"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                    placeholder="Describe your project"
                    required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Technologies</label>
                <input type="text"
                       name="technologies"
                       class="form-control"
                       placeholder="PHP, MySQL, Bootstrap">
            </div>

            <div class="mb-3">
                <label class="form-label">GitHub Link</label>
                <input type="url"
                       name="github"
                       class="form-control"
                       placeholder="https://github.com/username/project">
            </div>

            <div class="mb-3">
                <label class="form-label">Live Demo Link</label>
                <input type="url"
                       name="live_demo"
                       class="form-control"
                       placeholder="https://example.com">
            </div>

            <div class="mb-4">
                <label class="form-label">Project Image</label>
                <input type="file"
                       name="image"
                       class="form-control"
                       accept=".jpg,.jpeg,.png,.webp">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fa-solid fa-floppy-disk"></i>
                Add Project
            </button>

        </form>

    </div>

</div>

<!-- Projects List -->
<div class="col-lg-8">

    <h3 class="mb-4">
        <i class="fa-solid fa-folder-open"></i>
        Your Projects
    </h3>

    <div class="projects-grid">
        <?php

$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$userId]);

$projects = $stmt->fetchAll();

if (count($projects) > 0) {

    foreach ($projects as $project) {

?>

<div class="project-card">

    <?php if (!empty($project['image'])) { ?>

        <img src="assets/uploads/projects/<?php echo htmlspecialchars($project['image']); ?>" alt="Project Image">

    <?php } else { ?>

        <img src="assets/images/project-placeholder.jpg" alt="Project Image">

    <?php } ?>

    <div class="project-content">

        <h3><?php echo htmlspecialchars($project['title']); ?></h3>

        <p><?php echo htmlspecialchars($project['description']); ?></p>

        <div class="tech">

            <?php

            if (!empty($project['technologies'])) {

                $techs = explode(",", $project['technologies']);

                foreach ($techs as $tech) {

                    echo "<span>" . htmlspecialchars(trim($tech)) . "</span>";

                }

            }

            ?>

        </div>

      <div class="project-buttons">

    <?php if (!empty($project['github_link'])) { ?>
        <a href="<?php echo htmlspecialchars($project['github_link']); ?>" target="_blank" class="btn-primary">
            GitHub
        </a>
    <?php } ?>

    <?php if (!empty($project['live_demo'])) { ?>
        <a href="<?php echo htmlspecialchars($project['live_demo']); ?>" target="_blank" class="btn-outline">
            Live Demo
        </a>
    <?php } ?>

    <a href="edit_project.php?id=<?php echo $project['id']; ?>" class="btn-warning">
        <i class="fa-solid fa-pen"></i> Edit
    </a>
    <a href="actions/delete_project.php?id=<?php echo $project['id']; ?>"
   class="btn-danger"
   onclick="return confirm('Are you sure you want to delete this project?');">

    <i class="fa-solid fa-trash"></i>
    Delete

</a>

</div>

    </div>

</div>

<?php

    }

} else {

?>

<p>No projects added yet.</p>

<?php } ?>

               </div>

        </div>

    </div>

</div>

<?php require_once "includes/footer.php"; ?>