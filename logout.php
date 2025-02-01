<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

class Logout {

    public function __construct() {
        $this->logoutUser();
    }

    private function logoutUser() {
        session_start();

        // Destroy the session
        session_unset();  // Removes all session variables
        session_destroy(); // Destroys the session

        // Clear all cookies (optional, if sessions use cookies)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Redirect to login page
        header("Location: login.php");
        exit();
    }
}

// Instantiate the Logout class to trigger the logout process
new Logout();
?>
