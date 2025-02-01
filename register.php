<?php
session_start();
include 'include/db.php';

class UserRegistration {

    private $db;
    private $conn;
    public $error = '';
    public $success = '';

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection(); // Get the connection object
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->handleFormSubmission();
        }
    }

    private function handleFormSubmission() {
        // Get input values from form
        $email = trim($_POST['email']);
        $password = trim($_POST['password']); // Only password now

        // Validate input
        if (empty($email) || empty($password)) {
            $this->error = "All fields are required!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Invalid email format!";
        } else {
            $this->checkEmailExistence($email, $password);
        }
    }

    private function checkEmailExistence($email, $password) {
        // Check if email already exists in the database
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $this->error = "Email is already registered!";
        } else {
            $this->registerUser($email, $password);
        }
        $stmt->close();
    }

    private function registerUser($email, $password) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = "user"; // Default role

        // Insert the user into the database
        $stmt = $this->conn->prepare("INSERT INTO users (email, password, role, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $this->success = "Account created successfully! You can now log in.";
        } else {
            $this->error = "Registration failed. Please try again.";
        }
        $stmt->close();
    }
}

// Create an instance of the UserRegistration class
$registration = new UserRegistration();
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
      <?php if (!empty($registration->error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($registration->error) ?></p>
      <?php elseif (!empty($registration->success)) : ?>
        <p style="color: green;"><?= htmlspecialchars($registration->success) ?></p>
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
