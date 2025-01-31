<?php

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Include the database connection
include 'include/db.php';

// Initialize error variable
$error = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare a query to check if the email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the user data from the database
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Store user data in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header('Location: dashboard.php'); // Admin goes to dashboard
            } else {
                header('Location: index.php'); // Regular users go to index
            }
            exit();
        } else {
            $error = 'Invalid email or password.';
        }
    } else {
        $error = 'Invalid email or password.';
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Together</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="background">
        <div class="login-card">
            <div class="login-icon">
                <img src="images/collaborate.png" alt="Login Icon">
            </div>
            <h1>Login</h1>
            <p>Welcome back! Let’s reignite your journey to well-being.</p>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email"></label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password"></label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>

                <?php if (!empty($error)) : ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <div class="actions">
                <button type="submit" class="btn">Log In</button>
                    <a href="forgot-password.html" class="forgot-password">Forgot password?</a>
                   
                    <a href="signup.php" class="btn">Sign Up</a>

                </div>
            </form>

            <div class="divider">or sign in with</div>
            <div class="social-login">
            <a href="https://myaccount.google.com/" class="social-btn google">
    <i class="fab fa-google"></i> Google
  </a>

  <a href="https://www.facebook.com/" class="social-btn google">
    <i class="fab fa-facebook"></i> Facebook
  </a>

  <a href="https://www.apple.com/" class="social-btn google">
    <i class="fab fa-apple"></i> Apple
  </a>
              
            </div>
        </div>
    </div>
    <script src="js/form-validation.js"></script>
</body>
</html>
