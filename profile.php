<?php
session_start();

class UserRedirect {

    public function __construct() {
        $this->redirectUser();
    }

    private function redirectUser() {
        if (!$this->isLoggedIn()) {
            $this->redirectToLogin();
        }

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

new UserRedirect();
?>
