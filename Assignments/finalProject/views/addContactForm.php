<?php
require_once 'controllers/addContactProc.php';

function init() {
    global $formConfig, $stickyForm, $acknowledgment;

    // Keep copies of the radio fields for rendering
    $ageRangeField = $formConfig['age_range'];
    $contactTypeField = $formConfig['contact_type'];

    return <<<HTML
{$acknowledgment}
<div class="container mt-5">
   <h1>Add contact</h1>
    <form method="post" action="">
        <div class="row">
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['fname'], 'mb-3')}
            </div>
            <div class="col-md-6">
                {$stickyForm->renderInput($formConfig['lname'], 'mb-3')}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {$stickyForm->renderInput($formConfig['address'], 'mb-3')}
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                {$stickyForm->renderSelect($formConfig['state'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['zip_code'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['phone'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['city'], 'mb-3')}
            </div>
             <div class="col-md-3">
                {$stickyForm->renderInput($formConfig['DOB'], 'mb-3')}
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <!-- Age Range radio buttons -->
                {$stickyForm->renderRadio($ageRangeField, 'mb-3', 'horizontal')}
            </div>
            <p></p>
            <div class="col-md-6">
                <!-- Contact Type radio buttons -->
                {$stickyForm->renderRadio($contactTypeField, 'mb-3', 'horizontal')}
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Add Contact">
    </form>
</div>
HTML;
}
?>
