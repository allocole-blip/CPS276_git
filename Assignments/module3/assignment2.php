<?php
$evenNumbers = [];
  foreach(range(1,50) as $j) {
    if($j%2== 0){
    $evenNumbers[] = $j;}
  }
  $evenNumbers = "Even numbers: " . implode('-', $evenNumbers);


$form = <<<html
<div class="mb-3">
        <label for="email"  class="form-label">Email address</label>
        <input type="text" placeholder="name@gmail.com" class="form-control" id="email">
    </div>
<div class="mb-3">
        <label for="textBox"  class="form-label" label >Example textarea </label>
        <textarea class="form-control" id="textBox" row="6"></textarea> 
    </div>
html; 


  function createTable($rows, $colums) {
      $table = '<table class="table table-bordered">';
      for($i=1; $i <= $rows; $i++) {
       $table .= '<tr>';
        for($j=1; $j <= $colums; $j++) {
         $table .='<td> row ' .($i) . ', col ' .( $j). '</td>';
        }          
        $table .= '</tr>';}
      
        $table .='</table>';
        echo $table; 

  }
  
?> 

<!doctype html>
<html lang="en">
<head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, 
            initial-scale=1, shrink-to-fit=no">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
          <title>Assignment 2 </title>
</head>
    <body class="container"> 
            <body class="container">
              
    <?php
    
       echo $evenNumbers;
      echo $form;
        echo createTable(8, 6);
    ?>
</body>
     </body>
</html>