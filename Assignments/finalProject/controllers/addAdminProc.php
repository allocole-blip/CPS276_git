<?php
require_once 'classes/PdoMethods.php';
require_once 'classes/StickyForm.php';

$stickyForm = new StickyForm();
$acknowledgment = "";

// -----------------------------
// FORM CONFIGURATION
// -----------------------------
$formConfig = [
    'firstName' => [
        'id' => 'firstName',
        'name' => 'firstName',
        'label' => 'first name',
        'type' => 'text',
        'required' => true,
        'regex' => 'name',
        'errorMsg' => 'You must enter a valid first name',
        'value' => '',
        'error' => ''
    ],
    'lastName' => [
        'id' => 'lastName',
        'name' => 'lastName',
        'label' => 'last name',
        'type' => 'text',
        'required' => true,
        'regex' => 'name',
        'errorMsg' => 'You must enter a valid last name',
        'value' => '',
        'error' => ''
    ],
    'email' => [
        'id' => 'email',
        'name' => 'email',
        'label' => 'email',
        'type' => 'text',
        'required' => true,
        'regex' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'value' => 'example@gmail.com',
        'error' => ''
    ],
     'password' => [
        'id' => 'password',
        'name' => 'password',
        'label' => 'password',
        'type' => 'text',
        'required' => true,
        'regex' => 'password',
        'errorMsg' => 'You must enter a valid passowrd.',
        'value' => 'Password123!',
        'error' => ''
    ],
  'status' => [
    'id' => 'status',
    'name' => 'status',
    'label' => 'status',
    'type' => 'select',
    'required' => true,
    'options' => [
        '' => 'Please select a status',  // <-- default placeholder option
        'staff' => 'staff',
        'admin' => 'admin',
    ],
    'selected' => '', // <-- matches the placeholder key
    'error' => '',
    'errorMsg' => 'You must select a status',
],

    'masterStatus' => [
        'error' => false
    ]
];


// -----------------------------
// PROCESS FORM SUBMISSION
// -----------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validate form
    $formConfig = $stickyForm->validateForm($_POST, $formConfig);

    if (!$formConfig['masterStatus']['error']) {

        $pdo = new PdoMethods();
        $insertSql = "INSERT INTO admins
            (name, email, password, status)
            VALUES (:name, :email, :password, :status)";

       // Combine firstName and lastName into a single name field
        $fullName = $_POST['firstName'] . ' ' . $_POST['lastName'];
         // Hash the password before inserting
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $bindings = [
            [":name", $fullName, "str"], // Use the combined name
            [":email", $_POST['email'], "str"],
            [":password", $hashedPassword, "str"],
            [":status", $_POST['status'], "str"]
        ];


        $result = $pdo->otherBinded($insertSql, $bindings);

        if ($result === "error") {
            $acknowledgment = "<p class='text-danger'>There was an error adding the contact.</p>";
        } else {
            $acknowledgment = "<p class='text-success'>Contact added successfully!</p>";

            // Clear form values
            foreach ($formConfig as $key => &$field) {
                if ($key !== 'masterStatus') {
                    $field['value'] = "";
                    if (isset($field['selected'])) $field['selected'] = "";
                }
            }
        }
    }
}
?>
