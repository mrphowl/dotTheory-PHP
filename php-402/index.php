<?php
/**
 * PHP 402: PHP XML
 * 
 * Read an XML document
 */
$xml = simplexml_load_file('students.xml');
$list = $xml->record;
$data = [];
foreach($list as $listitem) {
    $data[] = (object) [
        'id' => $listitem->attributes()->student_id,
        'name' => $listitem->name,
        'gender' => $listitem->gender,
        'section' => $listitem->section,
    ];
}

if(php_sapi_name() == 'cli') { // Output if script is run in cli
    echo "Students Record\n\n";
    foreach($data as $item) {
        echo "Student ID: {$item->id}\n";
        echo "Name: {$item->name}\n";
        echo "Gender: {$item->gender}\n";
        echo "Section: {$item->section}\n";
        echo PHP_EOL;
    }
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dotTheory - PHP 402: PHP XML</title>

    <style>
        html, body {
            font-family: Calibri, sans-serif;
            font-size: 16px;
        }
        body { padding: 0.5rem 1rem; }
        body > div {
            margin-bottom: 1rem;
        }
        p.output { font-weight: bold; }
        body > div > div.record {
            border: 1px solid lightgray;
            padding: 1rem;
            margin-bottom: 0.5rem;
        }
        span.ridlabel { font-weight: bold; }
    </style>
</head>
<body>
    <div>
        <h1>Students Record</h1>
    </div>
    <div>
        <?php foreach($data as $item): ?>
        <div class="record">
            <p><span class="ridlabel">Student ID:</span> <?php echo $item->id; ?></p>
            <p>Name: <?php echo $item->name; ?></p>
            <p>Gender: <?php echo $item->gender; ?></p>
            <p>Section: <?php echo $item->section; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>