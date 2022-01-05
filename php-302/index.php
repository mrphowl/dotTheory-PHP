<?php
/**
 * PHP 302 Practical Exam
 * 
 * Philippine heroes
 * 
 * Connect to database using PHP PDO.
 * Query and show all records.
 */
$dbconf = (object) [
    'dbhost' => 'localhost',
    'dbport' => '3306',
    'dbname' => 'php_trainin1g',
    'dbuser' => 'dottheoryphpuser',
    'dbpassword' => 'dottheoryphp',
];

try {
    $dbh = mysqli_connect($dbconf->dbhost, $dbconf->dbuser, $dbconf->dbpassword);
}
catch(Exception $e) {
    echo $e->getMessage();
    die();
}

mysqli_select_db($dbh, $dbconf->dbname);

$stmt = 'SELECT `id`, `firstname`, `lastname`, `birthplace`, `description` FROM `ph_heroes`';
$query = mysqli_query($dbh, $stmt);
$rowcount = mysqli_num_rows($query);
$data = [];

while($row = mysqli_fetch_array($query)) {
    $filters = [
        'id' => FILTER_VALIDATE_INT,
        'firstname' => FILTER_SANITIZE_STRING,
        'lastname' => FILTER_SANITIZE_STRING,
        'birthplace' => FILTER_SANITIZE_STRING,
        'description' => FILTER_SANITIZE_STRING,
    ];
    $data[] = (object) filter_var_array($row, $filters);
}

mysqli_close($dbh);
unset($stmt, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 302 Practical Exam: PHP PDO</title>

    <style>
        html, body {
            font-family: Calibri, sans-serif;
            font-size: 16px;
        }

        table {border-collapse: collapse;}

        table th, table td {
            text-align: left;
            padding: 0.25rem 0.5rem;
            border: 1px solid;
        }
    </style>
</head>
<body>
    <div>
        <h1>Philippine Heroes</h1>
    </div>
    <div>
        <p>Rows: <?php echo $rowcount; ?></p>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Birth place</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $item): ?>
                <tr>
                    <td><?php echo $item->id; ?></td>
                    <td><?php echo $item->firstname; ?></td>
                    <td><?php echo $item->lastname; ?></td>
                    <td><?php echo $item->birthplace; ?></td>
                    <td><?php echo $item->description; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>