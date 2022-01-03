<?php
 
function checkNum($number) {
   $return = "";
   if($number && is_numeric($number)) {
       if($number % 2 == 0) {
           $return = "Even";
       } else {
           $return = "Odd";
       }
   }
   return $return;
}

if(isset($_POST['inputNumber'])) {
   $check = checkNum($_POST['inputNumber']);
   echo 'Entered value: ' . $_POST['inputNumber'].'<br>';
}
