<?php
/**
 * PHP 202 Practical Exam
 * 
 * Create a loop and print the string 10 times:
 *  "The quick brown fow jumps over the lazy dog"
 * On the 5th sentence, add the string
 *  " but the dog woke up and barked at the fox"
 * Show three results using For, While and Do-While loop.
 */
define('SENTENCE_MAIN', 'The quick brown fow jumps over the lazy dog');
define('SENTENCE_PS', ' but the dog woke up and barked at the fox');

echo 'For loop:' . PHP_EOL;
// using For loop
for($i = 1; $i <= 10; $i++) {
    echo SENTENCE_MAIN;
    if($i == 5) echo SENTENCE_PS;
    echo PHP_EOL;
}

echo PHP_EOL;
echo 'While loop:' . PHP_EOL;
$i = 1;

// using while loop
while($i <=10) {
    echo SENTENCE_MAIN;
    if($i == 5) echo SENTENCE_PS;
    echo PHP_EOL;
    $i++;
}

echo PHP_EOL;
echo 'Do-while loop:' . PHP_EOL;
$i = 1;

// using do-while loop
do {
    echo SENTENCE_MAIN;
    if($i == 5) echo SENTENCE_PS;
    echo PHP_EOL;
    $i++;
}
while($i < 10);
?>