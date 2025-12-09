<?php
require_once 'classes/PdoMethods.php';
require_once 'classes/StickyForm.php';

$stickyForm = new StickyForm();
$acknowledgment = "";

// -----------------------------
// FORM CONFIGURATION
// -----------------------------
$formConfig = [
    'fname' => [
        'id' => 'fname',
        'name' => 'fname',
        'label' => 'First Name',
        'type' => 'text',
        'required' => true,
        'regex' => 'name',
        'errorMsg' => 'You must enter a valid fist name',
        'value' => '',
        'error' => ''
    ],
    'lname' => [
        'id' => 'lname',
        'name' => 'lname',
        'label' => 'Last Name',
        'type' => 'text',
        'required' => true,
        'regex' => 'name',
        'errorMsg' => 'you must enter a valid last name',
        'value' => '',
        'error' => ''
    ],
    'address' => [
        'id' => 'address',
        'name' => 'address',
        'label' => 'Address',
        'type' => 'text',
         'regex' => 'address',
        'required' => true,
        'value' => '123 anyplace',
        'error' => '',
        'errorMsg' => 'you must entire a valid address',
    ],
     'city' => [
        'id' => 'city',
        'name' => 'city',
        'label' => 'city',
        'type' => 'text',
        'required' => true,
        'regex' => 'city',
        'errorMsg' => 'You must enter a valid city.',
        'value' => 'somewhere',
        'error' => ''
    ],
    'state' => [
        'id' => 'state',
        'name' => 'state',
        'label' => 'State',
        'type' => 'select',
        'required' => true,
        'options' => [
            'Mi' => 'Michigan',
            'CA' => 'California',
            'NY' => 'New York',
            'TX' => 'Texas',
            'FL' => 'Florida'
        ],
        'selected' => 'Mi',
        'error' => '',
        'errorMsg' => 'you must select a sate',
    ],
    'zip_code' => [
        'id' => 'zip_code',
        'name' => 'zip_code',
        'label' => 'Zip Code',
        'type' => 'text',
        'required' => true,
        'regex' => 'zip',
        'errorMsg' => 'you must entire a valid zip code',
        'value' => '12345',
        'error' => ''
    ],
    'phone' => [
        'id' => 'phone',
        'name' => 'phone',
        'label' => 'Phone Number',
        'type' => 'text',
        'required' => false,
        'regex' => 'phone',
        'errorMsg' => 'you must enter a valid phone number',
        'value' => '999.999.9999',
        'error' => ''
    ],
    'email' => [
        'id' => 'email',
        'name' => 'email',
        'label' => 'Email',
        'type' => 'text',
        'required' => true,
        'regex' => 'email',
        'errorMsg' => 'You must enter a valid email address.',
        'value' => 'example@gmail.com',
        'error' => ''
    ],
    'DOB' => [
        'id' => 'DOB',
        'name' => 'DOB',
        'label' => 'DOB',
        'type' => 'text',
        'required' => true,
        'regex' => 'dob',
        'errorMsg' => 'You must enter a valid date of birth.',
        'value' => '01/01/0000',
        'error' => ''
    ],
    'age_range' => [
        'id' => 'age_range',
        'name' => 'age_range',
        'label' => 'Age Range',
        'type' => 'radio',
        'required' => true,
        'options' => [
            ['value' => '0_17', 'label' => '0-17', 'checked' => false],
            ['value' => '18_30', 'label' => '18-30', 'checked' => false],
            ['value' => '31_50', 'label' => '31-50', 'checked' => false],
            ['value' => '50_plus', 'label' => '50+', 'checked' => false]
        ],
        'error' => ''
    ],
    'contact_type' => [
        'id' => 'contact_type',
        'name' => 'contact_type',
        'label' => 'Contact Type',
        'type' => 'radio',
        'required' => false,
        'options' => [
            ['value' => 'newsletter', 'label' => 'newsletter', 'checked' => false],
            ['value' => 'email', 'label' => 'email', 'checked' => false],
              ['value' => 'text', 'label' => 'text', 'checked' => false]
        ],
        'error' => ''
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

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Prepare data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $state = $_POST['state'] ?? '';
    $zip = $_POST['zip_code'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $dob = $_POST['DOB'];
    $age = $_POST['age_range'];
    $contact_type = isset($_POST['contacts']) ? implode(',', $_POST['contacts']) : '';

    $sql = "INSERT INTO contacts (fname,lname,address,city,state,zip_code,phone,email,dob,age,contacts)
            VALUES (:fname,:lname,:address,:city,:state,:zip,:phone,:email,:dob,:age,:contacts)";

    $bindings = [
        [':fname', $fname, 'str'],
        [':lname', $lname, 'str'],
        [':address', $address, 'str'],
        [':city', $city, 'str'],
        [':state', $state, 'str'],
        [':zip', $zip, 'str'],
        [':phone', $phone, 'str'],
        [':email', $email, 'str'],
        [':dob', $dob, 'str'],
        [':age', $age, 'str'],
        [':contacts', $contact_type, 'str']
    ];

    $result = $pdo->otherBinded($sql, $bindings);

    if ($result === 'noerror') {
        echo "<div class='alert alert-success'>Contact Information Added</div>";
    } else {
        echo "<div class='alert alert-danger'>There was an error adding the record</div>";
    }
}}}
?>