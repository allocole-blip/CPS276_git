<?php
require_once 'classes/StickyForm.php';
require_once 'classes/PdoMethods.php';

function processLogin() {
    $error = '';
    
    // Define form configuration
    $formConfig = [
        'fields' => [
            'email' => [
                'id' => 'email',
                'name' => 'email',
                'label' => 'Email',
                'type' => 'text',
                'value' => '',
                'required' => true,
                'regex' => '/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/',
                'errorMsg' => 'Please enter a valid email.'
            ],
            'password' => [
                'id' => 'password',
                'name' => 'password',
                'label' => 'Password',
                'type' => 'password',
                'value' => '',
                'required' => true,
                'regex' => '/^.+$/', // Just required, no format check
                'errorMsg' => 'Password cannot be empty.'
            ]
        ],
        'masterStatus' => ['error' => false]
    ];

    // Check if form submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $stickyForm = new StickyForm();
        $formConfig = $stickyForm->validateForm($_POST, $formConfig);

        if (!$formConfig['masterStatus']['error']) {
            // No validation errors, check credentials
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $pdo = new PdoMethods();
            $sql = "SELECT * FROM admins WHERE email = :email";
            $bindings = [
                [":email", $email, "str"]
            ];
            $result = $pdo->selectBinded($sql, $bindings);

            if ($result !== 'error' && count($result) === 1) {
                $user = $result[0];

                if (password_verify($password, $user['password'])) {
                    // Correct login, set session
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['status'] = $user['status'];

                    // Redirect to welcome page
                    header("Location: index.php?page=welcome");
                    exit;
                } else {
                    $error = 'Incorrect email or password.';
                }
            } else {
                $error = 'Incorrect email or password.';
            }
        }
    }

    return ['error' => $error, 'formConfig' => $formConfig];
}
?>
