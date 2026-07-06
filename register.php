<?php
require_once 'includes/header.php';
require_once 'includes/guest_navbar.php';
?>

<section class="auth-page">

    <div class="auth-container">

        <!-- Left Side -->
        <div class="auth-left">

            <div class="auth-content">

                <h1>Join CVHub Pro 🚀</h1>

                <p>
                    Create your professional developer portfolio, upload your CV,
                    showcase your projects, and get discovered by recruiters.
                </p>

                <ul>
                    <li><i class="fa-solid fa-circle-check"></i> Build your online CV</li>
                    <li><i class="fa-solid fa-circle-check"></i> Upload Resume</li>
                    <li><i class="fa-solid fa-circle-check"></i> Showcase Projects</li>
                    <li><i class="fa-solid fa-circle-check"></i> Connect with Recruiters</li>
                </ul>

            </div>

        </div>

        <!-- Right Side -->
        <div class="auth-right">

            <div class="auth-card">

                <h2>Create Account</h2>

                <form action="actions/register_action.php" method="POST">

                    <div class="form-group">
                        <label>Full Name</label>
                        <input
                            type="text"
                            name="full_name"
                            placeholder="John Doe"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input
                            type="email"
                            name="email"
                            placeholder="john@example.com"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input
                            type="password"
                            name="password"
                            placeholder="********"
                            required>
                    </div>

                    <button class="register-btn" type="submit">
                        Create Account
                    </button>

                </form>

                <div class="login-link">

                    Already have an account?

                    <a href="login.php">Login</a>

                </div>

            </div>

        </div>

    </div>

</section>

<?php
require_once 'includes/footer.php';
?>