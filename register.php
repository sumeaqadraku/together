<?php
// Start the session
session_start();

// Include the database connection
include 'include/db.php'; // Ensure the path is correct

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'user'; // Default role for new users

    // Check if passwords match
    if ($password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL query to insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $hashed_password, $role); // Bind parameters

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        } else {
            echo 'Error: Could not register user.';
        }

        // Close the statement
        $stmt->close();
    } else {
        echo 'Passwords do not match.';
    }
}
?>

<!-- Registration form -->
<form method="POST" action="register.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <button type="submit">Register</button>
</form>
