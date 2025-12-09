<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize empty nav
$nav = "";

// If user is not logged in, do not show nav
if (!isset($_SESSION['status'])) {
    return;
}

$status = $_SESSION['status'];


$nav = '
<nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-primary" href="index.php?page=addContact">Add Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="index.php?page=deleteContact">Delete Contact(s)</a>
                </li>';

// Admin-only links
if ($status === 'admin') {
    $nav .= '
                <li class="nav-item">
                    <a class="nav-link text-primary" href="index.php?page=addAdmin">Add Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary" href="index.php?page=deleteAdmin">Delete Admin(s)</a>
                </li>';
}

// Logout is available to all logged-in users
$nav .= '
                <li class="nav-item">
                    <a class="nav-link text-primary" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
?>
