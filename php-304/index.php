<?php
/**
 * PHP 304 practical exam
 * 
 * Write a PHP script which will display the copyright information in 
 *  the following format:
 *  © 2018 PHP Training - C&T
 * Create a simple 'birthday countdown' script, the script will 
 *  count the number of days between the current day and your birthday.
 * Write a PHP script to calculate the difference between two dates:
 *  Sept 1, 1933
 *  Sept 1, 2021
 */
date_default_timezone_set('Asia/Manila');

/**
 * Return the copyright information with the current year.
 * 
 * @return string
 */
function copyright_info() {
    $copystring = '© [/YEAR] PHP Training - C&T';
    return str_replace('[/YEAR]', date('Y'), $copystring);
}
/**
 * Calculate the number of days before $birthday
 * 
 * @param string $birthday
 * @return int
 */
function birthday_countdown(string $birthday) {
    $now = new DateTime();
    $mybirthday = new DateTime($birthday);
    $interval = $now->diff($mybirthday);
    return $interval->days;
}

/**
 * Calculate the difference between two dates.
 * 
 * @param string $date1
 * @param string $date2
 * @return int
 */
function date_diff_between(string $date1, string $date2) {
    $dateleft = new DateTime($date1);
    $dateright = new DateTime($date2);
    $interval = $dateleft->diff($dateright);
    return $interval->days;
}

// Get the results
$copytext = copyright_info();
$daysremaining = birthday_countdown('June 3');
$diffbetweendates = date_diff_between('Sept 1, 1933', 'Sept 1, 2021');

if(php_sapi_name() == 'cli') { // Output if script is run in cli
    echo 'Copyright Information:' . PHP_EOL;
    echo $copytext . PHP_EOL;
    echo PHP_EOL;

    echo 'Birthday countdown' . PHP_EOL;
    echo "$daysremaining days before my birthday." . PHP_EOL;
    echo PHP_EOL;

    echo 'Calculate the difference between two dates:' . PHP_EOL;
    echo 'Sept 1, 1933 and Sept 1, 2021' . PHP_EOL;
    echo "$diffbetweendates days";
    exit(); // stop the script here so we don't need to print the HTML code below
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 304 Practical Exam</title>

    <style>
        html, body {
            font-family: Calibri, sans-serif;
            font-size: 16px;
        }
        body { padding: 0.5rem 1rem; }
        body > div {
            margin-bottom: 1rem;
        }
        body > div:not(:first-child) {
            border: 1px solid lightgray;
            padding: 1rem;
        }
        p.output { font-weight: bold; }
    </style>
</head>
<body>
    <div>
        <h1>Date Functions</h1>
    </div>
    <div>
        <p>Copyright information</p>
        <p class="output"><?php echo $copytext; ?></p>
    </div>
    <div>
        <p>Birthday countdown</p>
        <p class="output"><?php echo $daysremaining; ?> days before my birthday.</p>
    </div>
    <div>
        <p>Calculate the difference between two dates:</p>
        <p>Sept 1, 1933 and Sept 1, 2021</p>
        <p class="output"><?php echo $diffbetweendates; ?> days</p>
    </div>
</body>
</html>