<?php
require_once 'classes/StickyForm.php';
require_once 'controllers/loginProc.php';

function init() {
    // Process login and get error/form configuration
    $loginResult = processLogin(); // returns ['error', 'formConfig']
    $error = $loginResult['error'];
    $formConfig = $loginResult['formConfig'];

    $stickyForm = new StickyForm();

    // Render the fields
    $emailField = $stickyForm->renderInput($formConfig['fields']['email'], 'form-group mb-3');
    $passwordField = $stickyForm->renderPassword($formConfig['fields']['password'], 'form-group mb-3');

    // Return only the form HTML
    return <<<HTML
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Login</h2>
        <!-- Display error if present -->
        <div class="text-danger mb-3">{$error}</div>
        <form action="index.php?page=login" method="post">
            {$emailField}
            {$passwordField}
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
HTML;
}
?>
