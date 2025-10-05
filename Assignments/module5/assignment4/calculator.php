<?php
class Calculator{
 
    public static function sum($a, $b){
        return $a + $b;
    }
  public static function calc($operator = null, $numOne = null, $numTwo = null){
       $numOne = (float)$numOne;
        $numTwo = (float)$numTwo;
    switch ($operator) {
    case '*':
    return " The calculation is $numOne * $numTwo.
    The answer is " . $numOne * $numTwo . "<br>";

        // break;

    case '+':
       
      return "The calculation is $numOne + $numTwo.
    The answer is ". $numOne + $numTwo . "<br>";
   // break;
    

    case '-':
         return "The calculation is $numOne - $numTwo.
     The answer is " . $numOne - $numTwo . "<br>";
       // break;

    case '/':
      if($numTwo == 0){
         return "The calculation is $numOne / $numTwo.
     Cannont divide by 0" . "<br>";      }
        return " The calculation is $numOne / $numTwo.
    The answer is " . $numOne / $numTwo . "<br>";
        //break;

    default:
       return "Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.";
       // break;
}

return 7 . "<br>"; 
}
} ?>
