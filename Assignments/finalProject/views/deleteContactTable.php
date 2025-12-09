<?php
require_once 'controllers/deleteContactProc.php';

function init(){
    global $records, $msg, $deleted;
    if(count($records) === 0){
        $msg = "<p></p>";
        $output = "<p>T7</p>";
    }
    else {
        $output = <<<HTML
        <p>$msg</p>
   <h1>Delete contact</h1>
        <form method='post' action='index.php?page=deleteContact'>
            <input type='submit' class='btn btn-danger' name='delete' value='Delete'/><br><br><table class='table table-striped table-bordered'>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                     <th>city</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Phone</th>
                    <th>Email</th>
                     <th>dob</th>
                      <th>age</th>
                       <th>contact</th>

                </tr>
            </thead>
        <tbody>

HTML;

        foreach($records as $row){
            $output .= "<tr><td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['address']}</td>
             <td>{$row['city']}</td>
            <td>{$row['state']}</td>
            <td>{$row['zip_code']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['email']}</td>
             <td>{$row['dob']}</td>
              <td>{$row['age']}</td>
             <td>{$row['contacts']}</td>

            <td><input type='checkbox' name='chkbx[]' value='{$row['id']}' /></td></tr>";
        }

        $output .= "</tbody></table></form>";

        if($records == "error"){
            $msg = "<p style='color:red'>Could not display records</p>";
        }
        else {
            if(!$deleted){
                $msg = "<p>&nbsp;</p>";
            }
            else {
                $msg = "<p style='color: green'>Contact(s) deleted</p>";
            }
            
        }
        
    }

    return $msg.$output;
}