
<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login if user is not logged in
function ensureLoggedIn() {
    if (!isset($_SESSION['status'])) {
        header("Location: index.php?page=login");
        exit;
    }
}

// Check if user has the correct role for a page
function checkRole(array $allowedRoles) {
    ensureLoggedIn();
    if (!in_array($_SESSION['status'], $allowedRoles)) {
        header("Location: index.php?page=welcome"); // redirect to default page
        exit;
    }
}
?>
