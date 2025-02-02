<?php
session_start();
include 'include/db.php';  // Përfshijmë klasën Database për lidhjen me DB

class User {
    private $db;
    private $conn;

    // Konstruktori merr lidhjen e DB si argument
    public function __construct($db) {
        $this->db = $db;
        $this->conn = $this->db->getConnection();
    }

    // Funksioni për regjistrimin e përdoruesit
    public function register($email, $password) {
        // Validimi i të dhënave
        if (empty($email) || empty($password)) {
            return "All fields are required!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format!";
        }

        // Kontrollo nëse email-i ekziston në DB
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            return "Email is already registered!";
        } else {
            // Hash password dhe ruaj përdoruesin në DB
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = "user"; // Roli default

            // Komanda për të regjistruar përdoruesin në DB
            $stmt = $this->conn->prepare("INSERT INTO users (email, password, role, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$email, $hashed_password, $role]);

            return "Account created successfully! You can now log in.";
        }
    }
}

$error = '';
$success = '';

// Aktivizo raportimin e gabimeve për debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifikimi nëse është postuar formulari
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Krijo një instance të klasës User
    $user = new User(new Database());

    // Regjistro përdoruesin dhe merr mesazhin përkatës
    $result = $user->register($email, $password);

    // Verifikoni nëse regjistrimi ishte me sukses
    if (strpos($result, 'successfully') !== false) {
        $success = $result;
    } else {
        $error = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up - Together</title>
  <link rel="stylesheet" href="assets/css/signin.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="background">
    <div class="signin-card">
      <div class="signin-icon">
        <img src="images/sign-in.png" alt="Sign In Icon">
      </div>
      <h1>Sign Up</h1>
      <p>You can't pour from an empty cup. Join us to kickstart your wellbeing.</p>

      <!-- Show error or success message -->
      <?php if (!empty($error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
      <?php elseif (!empty($success)) : ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
      <?php endif; ?>

      <!-- Sign-up form -->
      <form action="register.php" method="POST">
        <div class="form-group">
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn">Sign Up</button>
      </form>

      <div class="divider">or sign up with</div>
      <div class="social-login">
        <button class="social-btn google"><i class="fab fa-google"></i> Google</button>
        <button class="social-btn facebook"><i class="fab fa-facebook-f"></i> Facebook</button>
        <button class="social-btn apple"><i class="fab fa-apple"></i> Apple</button>
      </div>

      <p class="footer-text">
        Already have an account? <a href="login.php" class="signin-link">Log in here</a>.
      </p>
    </div>
  </div>

  <script src="js/form-validation.js"></script>
</body>
</html>
