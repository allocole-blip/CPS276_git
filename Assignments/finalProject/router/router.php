<?php
$path = "index.php?page=login";

require_once('includes/security.php'); // include security

$page = $_GET['page'] ?? '';

switch ($page) {
    case 'addContact':
        checkRole(['admin','staff']); // only admin/staff
        require_once('views/addContactForm.php');
        $content = init();
        break;

    case 'deleteContact':
        checkRole(['admin','staff']); // only admin/staff
        require_once('views/deleteContactTable.php');
        $content = init();
        break;

    case 'addAdmin':
        checkRole(['admin']); // only admin
        require_once('views/addAdminForm.php');
        $content = init();
        break;

    case 'deleteAdmin':
        checkRole(['admin']); // only admin
        require_once('views/deleteAdminTable.php');
        $content = init();
        break;

    case 'login':
        require_once('views/loginForm.php');
        $content = init();
        break;

    case 'welcome':
        ensureLoggedIn(); // any logged-in user
        require_once('views/welcome.php');
        $content = init();
        break;

    default:
        header('Location: '.$path);
        exit;
}
?>
