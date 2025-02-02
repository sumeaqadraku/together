<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'include/db.php'; // Përfshirja e lidhjes me DB

class Login {
    private $conn;
    private $error;

    // Konstruktor që merr lidhjen e DB
    public function __construct($db) {
        $this->conn = $db->getConnection();
        $this->error = '';
    }

    // Funksioni për login-in
    public function loginUser($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kontrollo nëse përdoruesi ekziston
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Drejto përdoruesin sipas rolit
            if ($user['role'] == 'admin') {
                header('Location: profile.php');
                exit();
            } else {
                header('Location: index.php');
                exit();
            }
        } else {
            $this->error = 'Invalid email or password.';
        }
    }

    // Funksioni për marrjen e gabimit
    public function getError() {
        return $this->error;
    }
}

// Kontrollo nëse formulari është dërguar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = new Login(new Database());
    $login->loginUser($email, $password);
    $error = $login->getError();  // Merr gabimin për ta shfaqur
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
