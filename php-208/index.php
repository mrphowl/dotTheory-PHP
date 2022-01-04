<?php
//create function with an exception
function checkNum($number) {
  if($number>1) {
    throw new Exception("Value must be 1 or below");
  }
  if(!is_numeric($number)) {
      throw new TypeError("Value must be a number");
  }
  return true;
}

$num = 2;
//trigger exception
try {
    if(checkNum($num)) {
        echo 'Value is accepted.';
    }
}
catch(TypeError $e) {
    echo $e->getMessage();
} 
catch(Exception $e) {
    echo $e->getMessage();
}
?>
