<?php
  //$nameArray=[];
  session_start();
function addClearNames(){
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $addName = $_POST['addName'] ?? '' ;
  $inputName = $_POST['name'] ??'';
  $clearNames = $_POST['clearNames'] ??'';
  //How does processNames.php determine whether to add a 
  // new name or clear all names based on which button was 
  // clicked?

  if($addName === 'Add Name'){
      //format name 
      $namePart = explode(' ',$inputName); 
       //How does PHP handle string-to-array conversion 
       //using the explode function, and why is this useful
       // in this application?
      if (count($namePart) > 1){ 
          $firstName = $namePart[0];
          $lastName = $namePart[1];
      $formatedName = "$lastName, $firstName";

      
    $_SESSION['$nameArray'][] = $formatedName;}

  // sort name 
      sort($_SESSION['$nameArray']);
  
    return implode("\n", $_SESSION['$nameArray']);}
  //What role does the implode function play in formatting
  //the output for the textarea?

  //How does the use of "\n" inside a double-quoted string
  // affect how names are displayed in the textarea? 
  // Why not use <br>?
  if($clearNames === "Clear Names"){
    $_SESSION['$nameArray']= [];
    return '';}
    
}else return '';}
