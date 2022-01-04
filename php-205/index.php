<?php
if(isset($_POST['submitted'])) {
    define('FEEDBACK_STUDENT', 'This person is a STUDENT');
    define('FEEDBACK_EMPLOYEE', 'This person is an EMPLOYEE');
    define('FEEDBACK_FAMILY', 'Have a FAMILY');
    define('FEEDBACK_AGELESS', 'This person is AGELESS');

    $firstname = filter_input(INPUT_POST, 'firstname');
    $lastanme = filter_input(INPUT_POST, 'lastanme');
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, ['min_range' => 1]);

    if($age >= 1 and $age <= 19) {
        $feedback = FEEDBACK_STUDENT;
    } elseif($age >= 20 and $age <= 25) {
        $feedback = FEEDBACK_EMPLOYEE;
    } elseif($age >= 26 and $age <= 30) {
        $feedback = FEEDBACK_FAMILY;
    } else {
        $feedback = FEEDBACK_AGELESS;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dotTheory: PHP 205 Practical Exam</title>
</head>
<body>
    <form action="index.php" method="post">
        <div>
            <label for="firstname">First name</l1abel>
            <input type="text" name="firstname" id="firstname" placeholder="First name">
        </div>
        <div>
            <label for="lastname">Last name</l1abel>
            <input type="text" name="lastname" id="lastname" placeholder="Last name">
        </div>
        <div>
            <label for="age">Age</l1abel>
            <input type="number" name="age" id="age" placeholder="Age" min="0">
        </div>
        <div>
            <button type="submit" name="submitted" value="1">Submit</button>
        </div>
    </form>

    <?php if(isset($_POST['submitted'])): ?>
    <div>
        <p><?php echo $feedback; ?></p>
    </div>
    <?php endif; ?>
    
</body>
</html>