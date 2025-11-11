<?php
require_once('classes/StickyForm.php');
require_once('classes/PdoMethods.php');

$formConfig = [
    'first_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => '*First Name',
        'name' => 'first_name',
        'id' => 'first_name',
        'errorMsg' => null,
        'error' => '',
        'required' => true,
        'value' => 'John'
    ],
    'last_name' => [
        'type' => 'text',
        'regex' => 'name',
        'label' => 'Last Name',
        'name' => 'last_name',
        'id' => 'last_name',
        'errorMsg' => 'You must enter a valid last name',
        'error' => '',
        'required' => false,
        'value' => 'Doe'
    ],
    'email' => [
        'type' => 'text',
        'regex' => 'email',
        'label' => 'Email',
        'name' => 'email',
        'id' => 'email',
        'errorMsg' => 'You must enter a valid email address',
        'error' => '',
        'required' => false,
        'value' => 'example@email.com'
    ],
    'password' => [
        'type' => 'text',
        'regex' => 'password',
        'label' => 'Password',
        'name' => 'password',
        'id' => 'password',
        'errorMsg' => 'Must have at least (8 characters, 1 uppercase, 1 symbol, 1 number)',
        'error' => '',
        'required' => false,
        'value' => 'Pass$w0rd'
    ],
     'confirmPassword' => [
        'type' => 'text',
        'regex' => 'confirmPassword',
        'label' => 'confirmPassword',
        'name' => 'confirmPassword',
        'id' => 'confirmPassword',
        'errorMsg' => 'password does not match',
        'error' => '',
        'required' => false,
        'value' => 'Pass$w0rd'
    ],
    'masterStatus' => [
        'error' => false
    ]
];

$stickyForm = new StickyForm();
$pdo = new PdoMethods();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

      if ($_POST['password'] !== $_POST['confirmPassword']) {
        $formConfig['confirmPassword']['error'] = 'Passwords do not match';
        $formConfig['masterStatus']['error'] = true;
    }
   
    if (!$formConfig['masterStatus']['error']) {
        $sql = "SELECT * FROM assignment9 WHERE email = :email";
        $bindings = [
            [":email", $_POST['email'], "str"]
        ];
        $existing = $pdo->selectBinded($sql, $bindings);
        if (!empty($existing)) {
            $formConfig['email']['error'] = "Email already exists.";
            $formConfig['masterStatus']['error'] = true;
        }
    }

    if ( $formConfig['masterStatus']['error'] == false) {
        
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $bindings = [
            [':firstName', $_POST['first_name'], 'str'],
            [':lastName', $_POST['last_name'], 'str'],
            [':email', $_POST['email'], 'str'],
            [':password', $hashedPassword, 'str']
        ];

        $sql = "INSERT INTO assignment9 (firstName, lastName, email, password)
                VALUES (:firstName, :lastName, :email, :password)";

        // Execute the insert
        $result = $pdo->otherBinded($sql, $bindings);
        if ($result === 'noerror') {
            // Optional: reset form values after successful insert
            foreach ($formConfig as $key => $value) {
                if (isset($formConfig[$key]['value'])) {
                    $formConfig[$key]['value'] = '';
                }
            }
            }
        }
    }


// Fetch updated records every page load
$sql = "SELECT firstName, lastName, email, password FROM assignment9";
$records = $pdo->selectNotBinded($sql);


?>


<!DOCTYPE html>
<html>
<head>
    <title>assignment9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
<p>&nbsp;</p>    
<form method="post" action="">
        <div class="row">
            <!-- Render first name field -->
            <div class="col-md-6">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['first_name'], 'mb-3'); ?>
    
    
</div>            </div>

            <!-- Render last name field -->
            <div class="col-md-6">
                <div class="mb-3">
     <?php echo $stickyForm->renderInput($formConfig['last_name'], 'mb-3'); ?>
   
    
</div>            </div>
        </div>

        
        <!-- Render email password password -->
        <div class="row">
           
            <div class="col-md-4">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['email'], 'mb-3'); ?>
    
</div>            </div>
            <div class="col-md-4">
                <div class="mb-3">
   
    <?php echo $stickyForm->renderInput($formConfig['password'], 'mb-3'); ?>
    
</div>            </div>
            <div class="col-md-4">
                <div class="mb-3">
    <?php echo $stickyForm->renderInput($formConfig['confirmPassword'], 'mb-3'); ?>
    
</div>            </div>
        </div>
     
        <input type="submit" class="btn btn-primary" value="Register">
 
   
    <div class="container mt‑5">
  <div class="table-responsive">
    <table class="table table-hover table-bordered">
      <thead class="table-light">
        <tr>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">password</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($records as $record): ?>
          <tr>
            <td><?= htmlspecialchars($record['firstName']) ?></td>
            <td><?= htmlspecialchars($record['lastName']) ?></td>
            <td><?= htmlspecialchars($record['email']) ?></td>
            <td><?= htmlspecialchars($record['password']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>



</body>
</html>