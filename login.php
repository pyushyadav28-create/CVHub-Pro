<?php
require_once 'includes/header.php';
require_once 'includes/guest_navbar.php';
?>

<section class="auth-page">

    <div class="auth-container">

        <div class="auth-left">

            <div class="auth-content">

                <h1>Welcome Back 👋</h1>

                <p>
                    Login to access your dashboard, update your CV,
                    manage your profile and showcase your skills.
                </p>

            </div>

        </div>

        <div class="auth-right">

            <div class="auth-card">

                <h2>Login</h2>

                <?php
                if(isset($_GET['registered'])){
                    echo "<p style='color:green;'>Registration Successful! Please login.</p>";
                }

                if(isset($_GET['error'])){
                    echo "<p style='color:red;'>Invalid Email or Password.</p>";
                }
                ?>

                <form action="actions/login_action.php" method="POST">

                    <div class="form-group">

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            required>

                    </div>

                    <div class="form-group">

                        <label>Password</label>

                        <input
                            type="password"
                            name="password"
                            required>

                    </div>

                    <button class="register-btn">

                        Login

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

<?php
require_once 'includes/footer.php';
?>