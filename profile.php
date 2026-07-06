<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

require_once 'config/database.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);

$user = $stmt->fetch();

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="dashboard">

<div class="container">

<h1 class="dashboard-title">
My Profile
</h1>

<form action="actions/update_profile.php" method="POST">

<div class="row">

<div class="col-md-6">

<div class="form-group">
<label>Full Name</label>
<input
type="text"
name="full_name"
value="<?= htmlspecialchars($user['full_name']) ?>"
required>
</div>

</div>

<div class="col-md-6">

<div class="form-group">
<label>Email</label>
<input
type="email"
value="<?= htmlspecialchars($user['email']) ?>"
readonly>
</div>

</div>

<div class="col-md-6">

<div class="form-group">
<label>Job Title</label>
<input
type="text"
name="job_title"
value="<?= htmlspecialchars($user['job_title']) ?>">
</div>

</div>

<div class="col-md-6">

<div class="form-group">
<label>Phone</label>
<input
type="text"
name="phone"
value="<?= htmlspecialchars($user['phone']) ?>">
</div>

</div>

<div class="col-md-6">

<div class="form-group">
<label>Location</label>
<input
type="text"
name="location"
value="<?= htmlspecialchars($user['location']) ?>">
</div>

</div>

<div class="col-md-6">

<div class="form-group">
<label>GitHub</label>
<input
type="text"
name="github"
value="<?= htmlspecialchars($user['github']) ?>">
</div>

</div>

<div class="col-md-12">

<div class="form-group">
<label>LinkedIn</label>
<input
type="text"
name="linkedin"
value="<?= htmlspecialchars($user['linkedin']) ?>">
</div>

</div>

<div class="col-md-12">

<div class="form-group">
<label>Website</label>
<input
type="text"
name="website"
value="<?= htmlspecialchars($user['website']) ?>">
</div>

</div>

<div class="col-md-12">

<div class="form-group">
<label>About Me</label>

<textarea
name="bio"
rows="6"
class="form-control"><?= htmlspecialchars($user['bio']) ?></textarea>

</div>

</div>

<div class="col-md-12">

<button class="register-btn">

Save Profile

</button>

</div>

</div>

</form>

</div>

</section>

<?php
require_once 'includes/footer.php';
?>