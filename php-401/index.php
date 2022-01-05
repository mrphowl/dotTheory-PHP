<?php
/**
 * PHP 401 practical exam
 * 
 * Given a string, remove all HTML tags except paragraph and italics tags.
 * 
 * String:
<p>In Italy<i>pasta</i> is commonly <br />
eaten during <b>Lunch and Dinner</b> to have a lighter stomach.<br />
The only thing that is common for Italians is that <i>coffee</i> is always served 3 or 4 times a day.</p>
<script>alert("Cafe!");</script>
 */
$samplestring = <<<'EOT'
<p>In Italy<i>pasta</i> is commonly <br />
eaten during <b>Lunch and Dinner</b> to have a lighter stomach.<br />
The only thing that is common for Italians is that <i>coffee</i> is always served 3 or 4 times a day.</p>
<script>alert("Cafe!");</script>
EOT;

if(isset($_POST['submitted'])) {
    $input = filter_input(INPUT_POST, 'mytext', FILTER_UNSAFE_RAW);
    $input = strip_tags($input, '<p> <i>');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 401 Practical Exam: Security</title>
</head>
<body>
    <div>
        <h1>Cleaning Input</h1>
    </div>
    <div>
        <p>Remove all HTML tags except paragraph and italics tags.</p>

        <form action="index.php" method="post">
            <div>
                <textarea name="mytext" id="mytext" cols="30" rows="10"><?php echo $samplestring; ?></textarea>
            </div>
            <div>
                <button type="submit" name="submitted">Go</button>
            </div>
        </form>
    </div>
    <?php if($input): ?>
    <div><?php echo $input; ?></div>
    <?php endif; ?>
</body>
</html>