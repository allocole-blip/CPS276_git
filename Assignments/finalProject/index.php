<?php
require_once 'includes/navigation.php';
require_once 'router/router.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Final Assignment</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <?php 
        echo $nav;      // Navigation will show if logged in
        echo $content;  // Content from router
    ?>
</body>
</html>
