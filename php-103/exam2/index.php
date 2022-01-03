<?php
/**
 * Calculate and print BMI
 *
 * @param float $heightInches
 * @param float $weightPounds
 */
function calculate_bmi_english($heightInches, $weightPounds){
  // Calculate index using $heightInches and $weightPounds
  $index =0;
  if($heightInches !=0 && $weightPounds !=0) {
    $index = round($weightPounds/($heightInches*$heightInches)* 703,2);
  }

  // Deterine the BMI by comparing the $index 
  $bmi="";
  if ($index < 18.5) {
    $bmi="underweight - BMI : " . $index;
  } else if ($index < 25) {
    $bmi="normal - BMI : ". $index;
  } else if ($index < 30) {
    $bmi="overweight - BMI : " . $index;
  } else {
    $bmi="obese - BMI : " .$index;
  }

  echo $bmi; // print the result
}
calculate_bmi_english(69,150);
?>
