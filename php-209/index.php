<?php
/**
 * PHP 209 Practical Exam - Regular expressions
 * 
 * Match the word "cake" in the sentence:
 *  "He was eating cake in the cafe."
 * Find and replace spaces, new lines and tabs with a hypen:
 *  "Earth revolves around\nthe\tSun"
 * Find and split the string at comma, sequence of commas, whitespace, or combination:
 *  "My favourite colors are red, green and blue"
 */
$stringcake = "He was eating cake in the cafe.";

echo $stringcake . PHP_EOL;
if(preg_match("/cake/", $stringcake)) {
    echo 'It was a chocolate mousse.';
}
else {
    echo 'Didn\'t see any cake.';
}

echo PHP_EOL . PHP_EOL;
$stringearth = "Earth revolves around\nthe\tSun";

echo $stringearth . PHP_EOL;
echo preg_replace("/[ \t]|(\r\n|\r|\n)/", '-', $stringearth) . PHP_EOL;

echo PHP_EOL;
$stringcolors = "My favourite colors are red, green and blue";

echo $stringcolors . PHP_EOL;
print_r(preg_split("/[ ,]+/", $stringcolors));