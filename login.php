<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'include/db.php';

class Login {
    private $conn;
    private $error;

    public function __construct($db) {
        $this->conn = $db->getConnection();  // Get the connection object
        $this->error = '';
    }

    public function loginUser($email, $password) {
        // Check if email and password are provided
        if (empty($email) || empty($password)) {
            $this->error = 'Both email and password are required.';
            return false;  // Return false to indicate login failure
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Please enter a valid email address.';
            return false;  // Return false to indicate login failure
        }

        // Prepare a query to check if the email exists in the database
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Store user data in the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header('Location: profile.php');
            } else {
                header('Location: index.php');
            }
            exit();
        } else {
            $this->error = 'Invalid email or password.';
            return false;  // Return false to indicate login failure
        }
    }

    public function getError() {
        return $this->error;
    }
}

// Initialize error variable and handle login
$login = new Login(new Database());
$loginSuccessful = false;  // Flag to track if login was successful

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Attempt login
    if ($login->loginUser($email, $password)) {
        $loginSuccessful = true;
    }
    $error = $login->getError();
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
                <?php elseif ($loginSuccessful) : ?>
                    <p style="color: green;">The form is valid! Redirecting...</p>
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
