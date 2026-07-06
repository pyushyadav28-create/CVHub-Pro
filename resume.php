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

$userStmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch();

$profileStmt = $pdo->prepare("SELECT * FROM profiles WHERE user_id = ?");
$profileStmt->execute([$userId]);
$profile = $profileStmt->fetch();

$eduStmt = $pdo->prepare("SELECT * FROM education WHERE user_id = ? ORDER BY start_year DESC");
$eduStmt->execute([$userId]);
$educations = $eduStmt->fetchAll();

$expStmt = $pdo->prepare("SELECT * FROM experience WHERE user_id = ? ORDER BY start_date DESC");
$expStmt->execute([$userId]);
$experiences = $expStmt->fetchAll();

$skillStmt = $pdo->prepare("SELECT * FROM skills WHERE user_id = ? ORDER BY id DESC");
$skillStmt->execute([$userId]);
$skills = $skillStmt->fetchAll();

$projectStmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY id DESC");
$projectStmt->execute([$userId]);
$projects = $projectStmt->fetchAll();

require_once "includes/header.php";
?>

<div class="dashboard-layout">

<?php require_once "includes/sidebar.php"; ?>

<div class="main-content">

    <div class="topbar">
        <h2>My Resume</h2>

        <button onclick="window.print()" class="btn btn-primary">
            Print / Save PDF
            
</a>
        </button>
    </div>

    <div class="resume-box">

        <div class="resume-header">

            <h1><?php echo htmlspecialchars($user['full_name']); ?></h1>

            <p>
                <?php echo htmlspecialchars($profile['job_title'] ?? 'Developer'); ?>
            </p>

            <p>
                <?php echo htmlspecialchars($user['email']); ?>

                <?php if (!empty($profile['phone'])) { ?>
                    | <?php echo htmlspecialchars($profile['phone']); ?>
                <?php } ?>

                <?php if (!empty($profile['location'])) { ?>
                    | <?php echo htmlspecialchars($profile['location']); ?>
                <?php } ?>
            </p>

        </div>

        <?php if (!empty($profile['bio'])) { ?>
            <section class="resume-section">
                <h2>Profile</h2>
                <p><?php echo htmlspecialchars($profile['bio']); ?></p>
            </section>
        <?php } ?>

        <section class="resume-section">
            <h2>Skills</h2>

            <?php foreach ($skills as $skill) { ?>
                <span class="resume-skill">
                    <?php echo htmlspecialchars($skill['skill_name']); ?>
                </span>
            <?php } ?>
        </section>

        <section class="resume-section">
            <h2>Experience</h2>

            <?php foreach ($experiences as $exp) { ?>

                <div class="resume-item">

                    <h3><?php echo htmlspecialchars($exp['job_title']); ?></h3>

                    <p>
                        <strong><?php echo htmlspecialchars($exp['company']); ?></strong>
                        |
                        <?php
                        $start = !empty($exp['start_date']) ? date('M Y', strtotime($exp['start_date'])) : '';
                        $end = !empty($exp['end_date']) ? date('M Y', strtotime($exp['end_date'])) : 'Present';
                        echo $start . " - " . $end;
                        ?>
                    </p>

                    <p><?php echo htmlspecialchars($exp['description']); ?></p>

                </div>

            <?php } ?>
        </section>

        <section class="resume-section">
            <h2>Education</h2>

            <?php foreach ($educations as $edu) { ?>

                <div class="resume-item">

                    <h3><?php echo htmlspecialchars($edu['degree']); ?></h3>

                    <p>
                        <strong><?php echo htmlspecialchars($edu['institution']); ?></strong>
                        |
                        <?php echo htmlspecialchars($edu['start_year']); ?>
                        -
                        <?php echo htmlspecialchars($edu['end_year']); ?>
                    </p>

                    <p><?php echo htmlspecialchars($edu['description']); ?></p>

                </div>

            <?php } ?>
        </section>

        <section class="resume-section">
            <h2>Projects</h2>

            <?php foreach ($projects as $project) { ?>

                <div class="resume-item">

                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>

                    <p><?php echo htmlspecialchars($project['description']); ?></p>

                    <p>
                        <strong>Technologies:</strong>
                        <?php echo htmlspecialchars($project['technologies']); ?>
                    </p>

                </div>

            <?php } ?>
        </section>

    </div>

</div>

</div>

<?php require_once "includes/footer.php"; ?>