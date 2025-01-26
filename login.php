<?php
include 'include/db.php';  

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
<?php
// Start the session
session_start();

// Include the database connection
include('db.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the username and password entered by the user
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a query to check if the username exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(); // Fetch the user data from the database

    // If the user exists and the password matches
    if ($user && password_verify($password, $user['password'])) {
        // Store user data in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // This will be used to check if the user is an admin

        // Redirect to the dashboard or home page
        if ($user['role'] == 'admin') {
            header('Location: dashboard.php'); // Admin goes to the dashboard
        } else {
            header('Location: index.php'); // Regular user goes to the home page
        }
        exit(); // Stop further code execution after redirection
    } else {
        // If the login failed, show an error message
        echo 'Invalid username or password';
    }
}
?>


  <div class="background">
    <div class="login-card">
      <div class="login-icon">
        <img src="images/collaborate.png" alt="Login Icon">
      </div>
      <h1>Login</h1>
      <p>Welcome back! Let’s reignite your journey to well-being.</p>

      <form action="dashboard.html" method="POST">
        <div class="form-group">
          <input type="email" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <div class="actions">
          <a href="forgot-password.html" class="forgot-password">Forgot password?</a>
          <button type="submit" class="btn">Sign In</button>

          
        </div>
      </form>

      <div class="divider">or sign in with</div>
      <div class="social-login">
        <button class="social-btn google"><i class="fab fa-google"></i> Google</button>
        <button class="social-btn facebook"><i class="fab fa-facebook-f"></i> Facebook</button>
        <button class="social-btn apple"><i class="fab fa-apple"></i> Apple</button>
      </div>
    </div>
  </div>
  <script src="js/form-validation.js"></script>
</body>
</html>
