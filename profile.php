<?php
session_start();

class UserRedirect {

    public function __construct() {
        $this->redirectUser();
    }

    private function redirectUser() {
        // Check if the user is logged in
        if (!$this->isLoggedIn()) {
            $this->redirectToLogin();
        }

        // Redirect based on role
        if ($_SESSION['role'] == 'admin') {
            $this->redirectToDashboard();
        } else {
            $this->redirectToUserDashboard();
        }
    }

    private function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    private function redirectToLogin() {
        header("Location: login.php");
        exit();
    }

    private function redirectToDashboard() {
        header("Location: dashboard.php");
        exit();
    }

    private function redirectToUserDashboard() {
        header("Location: user_dashboard.php");
        exit();
    }
}

// Instantiate the UserRedirect class to trigger the redirection process
new UserRedirect();
?>
