
<?php
// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define init() for router
function init() {
    // Check if user is logged in
    if (!isset($_SESSION['id'])) {
        header("Location: index.php?page=login");
        exit;
    }

    $name = htmlspecialchars($_SESSION['name']); // prevent XSS
    $status = htmlspecialchars($_SESSION['status']);

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
</head>
<body class="container mt-5">

            <h1>Welcome page</h1>
            <p>welcome, {$name}!</p>
        

</body>
</html>
HTML;
}
?>

