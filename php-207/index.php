<?php
/**
 * PHP File operations
 * 
 * Check is file read.txt exists.
 * Get the current content.
 * Add a new string to the current content:
 *  "Prepare for the new King."
 * Show the contents of the file.
 */
$filename = 'read.txt';

if(file_exists($filename)) {
    echo 'File \'read.txt\' found in ' . __DIR__ . '.' . PHP_EOL;

    $content = file_get_contents($filename, 'r');
    $content .= PHP_EOL . 'Prepare for the new King.'; // PHP_EOL depends on the OS

    file_put_contents($filename, $content);
    unset($content);

    $fh = fopen($filename, 'r');

    while($line = fgets($fh)) {
        echo $line;
    }
    fclose($fh);
}