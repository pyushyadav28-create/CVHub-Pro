<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config/database.php';

$userId = $_SESSION['user_id'];
$user = $_SESSION['user_name'];

/* ===========================
   Dashboard Statistics
=========================== */

// Education Count
$education = $pdo->prepare("SELECT COUNT(*) FROM education WHERE user_id=?");
$education->execute([$userId]);
$educationCount = $education->fetchColumn();

// Project Count
$projects = $pdo->prepare("SELECT COUNT(*) FROM projects WHERE user_id=?");
$projects->execute([$userId]);
$projectCount = $projects->fetchColumn();

// Skill Count
$skills = $pdo->prepare("SELECT COUNT(*) FROM skills WHERE user_id=?");
$skills->execute([$userId]);
$skillCount = $skills->fetchColumn();

// Experience Count
$experience = $pdo->prepare("SELECT COUNT(*) FROM experience WHERE user_id=?");
$experience->execute([$userId]);
$experienceCount = $experience->fetchColumn();

/* ===========================
   Profile Completion
=========================== */

$score = 20;

$profile = $pdo->prepare("SELECT * FROM profiles WHERE user_id=?");
$profile->execute([$userId]);
$p = $profile->fetch();

if ($p) {

    if (!empty($p['job_title'])) $score += 10;
    if (!empty($p['phone'])) $score += 10;
    if (!empty($p['location'])) $score += 10;
    if (!empty($p['bio'])) $score += 15;
    if (!empty($p['github'])) $score += 10;
    if (!empty($p['linkedin'])) $score += 10;
}

$score += min($educationCount * 5, 10);
$score += min($experienceCount * 5, 10);
$score += min($projectCount * 5, 10);
$score += min($skillCount * 2, 5);

$completion = min($score, 100);

require_once 'includes/header.php';
?>

<div class="dashboard-layout">

    <?php require_once 'includes/sidebar.php'; ?>

    <div class="main-content">

        <div class="topbar">

            <h2>
                Good Afternoon,
                <?php echo htmlspecialchars($user); ?> 👋
            </h2>

            <div class="top-icons">
                <i class="fa-regular fa-bell"></i>
                <i class="fa-regular fa-user"></i>
            </div>

        </div>

        <div class="hero-card">

            <div>

                <h1>Build Your Developer Portfolio</h1>

                <p>
                    Complete your profile and showcase your work to recruiters.
                </p>

                <!-- Progress Bar -->
                <div class="progress-box">

                    <div class="progress">

                        <div class="progress-bar"
                             style="width:<?= $completion ?>%;">

                        </div>

                    </div>

                    <p><?= $completion ?>% Complete</p>

                </div>

                <a href="profile.php" class="btn-primary">
                    Complete Profile
                </a>

            </div>

            <i class="fa-solid fa-laptop-code hero-icon"></i>

        </div>

        <div class="stats">

            <div class="stat">

                <i class="fa-solid fa-user"></i>

                <h2><?= $completion ?>%</h2>

                <p>Profile Complete</p>

            </div>

            <div class="stat">

                <i class="fa-solid fa-code"></i>

                <h2><?= $projectCount ?></h2>

                <p>Projects</p>

            </div>

            <div class="stat">

                <i class="fa-solid fa-graduation-cap"></i>

                <h2><?= $educationCount ?></h2>

                <p>Education</p>

            </div>

            <div class="stat">

                <i class="fa-solid fa-award"></i>

                <h2><?= $skillCount ?></h2>

                <p>Skills</p>

            </div>

        </div>
        <div class="dashboard-section">

<h2>Portfolio Analytics</h2>

<div class="chart-card">

<canvas id="portfolioChart"></canvas>

</div>

</div>
<div class="dashboard-section">

    <h2>Quick Actions</h2>

    <div class="quick-grid">

        <a href="profile.php" class="quick-card">
            <i class="fa-solid fa-user"></i>
            <h3>Edit Profile</h3>
            <p>Update your personal information.</p>
        </a>

        <a href="projects.php" class="quick-card">
            <i class="fa-solid fa-diagram-project"></i>
            <h3>Add Project</h3>
            <p>Showcase your latest work.</p>
        </a>

        <a href="skills.php" class="quick-card">
            <i class="fa-solid fa-code"></i>
            <h3>Add Skill</h3>
            <p>Highlight your technical skills.</p>
        </a>

        <a href="education.php" class="quick-card">
            <i class="fa-solid fa-graduation-cap"></i>
            <h3>Add Education</h3>
            <p>Keep your qualifications updated.</p>
        </a>

    </div>

</div>
<div class="dashboard-section">

<h2>Recent Projects</h2>

<div class="activity">

<?php

$stmt = $pdo->prepare("
SELECT title
FROM projects
WHERE user_id=?
ORDER BY id DESC
LIMIT 5
");

$stmt->execute([$userId]);

$recentProjects = $stmt->fetchAll();

if(count($recentProjects)>0){

foreach($recentProjects as $project){

?>

<div class="activity-item">

<i class="fa-solid fa-diagram-project"></i>

<?= htmlspecialchars($project['title']) ?>

</div>

<?php

}

}else{

?>

<div class="activity-item">

<i class="fa-solid fa-circle-info"></i>

No projects added yet.

</div>

<?php } ?>

</div>

</div>

        <div class="dashboard-section">

            <h2>Recent Activity</h2>

            <div class="activity">

                <div class="activity-item">
                    <i class="fa-solid fa-circle-check"></i>
                    Profile Updated
                </div>

                <div class="activity-item">
                    <i class="fa-solid fa-circle-check"></i>
                    Resume Uploaded
                </div>

                <div class="activity-item">
                    <i class="fa-solid fa-circle-check"></i>
                    Project Added
                </div>

            </div>

        </div>

    </div>

</div>
<script>

const ctx = document.getElementById('portfolioChart');

new Chart(ctx, {

type: 'bar',

data: {

labels: [

'Projects',

'Skills',

'Education',

'Experience'

],

datasets: [{

label: 'Portfolio Data',

data: [

<?= $projectCount ?>,

<?= $skillCount ?>,

<?= $educationCount ?>,

<?= $experienceCount ?>

],

backgroundColor: [

'#2563EB',

'#10B981',

'#F59E0B',

'#8B5CF6'

],

borderRadius:10

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:false

}

},

scales:{

y:{

beginAtZero:true

}

}

}

});

</script>

<?php require_once 'includes/footer.php'; ?>