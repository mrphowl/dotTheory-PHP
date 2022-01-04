<?php
/**
 * Send an email to using the Gmail server
 * 
 * Setup PHP to send to GMail.
 * Create a form to send the email.
 * Send and email three times.
 */
if(isset($_POST['submitted'])) {
    $to = filter_input(INPUT_POST, 'to', FILTER_VALIDATE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'emailbody', FILTER_SANITIZE_STRING);
    $headers = 'From: noreply@example.com';
    $error = false;
    $message = [];

    if(!$to) {
        $error = true;
        $message[] = 'Empty or invalid email.';
    }
    if(empty($subject)) {
        $error = true;
        $message[] = 'Subject is empty!';
    }
    if(!$error) {
        mail($to, $subject, $content, $headers);
        $message[] = 'Email sent.';
    }

    if($error) {
        $form_to = $_POST['to'];
        $form_subject = $_POST['subject'];
        $form_content = $_POST['emailbody'];
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 301 Practical Exam: Send Email</title>

    <style>
        body {
            padding: 1rem 2rem;
        }

        form > fieldset {
            display: flex;
            gap: 1rem;
            justify-content: space-between;
        }

        form > fieldset input {
            flex-basis: 90%;
        }

        form >fieldset textarea {
            min-height: 150px;
            flex: 1;
            resize: vertical;
            min-width: 680px;
            max-height: 400px;
        }
        form > div.formbuttons {
            padding-top: 0.5rem;
            display: flex;
            justify-content: flex-end;
        }
        form button {
            border-radius: 0;
            font-size: 1rem;
            border: none;
            background-color: orange;
            color: white;
            padding: 0.5rem 1rem;
        }
        form button:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
<div>
    <h1>Send an Email</h1>
</div>
<div>
    <form action="index.php" method="post" name="emailform">
        <fieldset>
            <label for="to">To</label>
            <input type="text" name="to" id="to" required <?php if($error) print "value=\"{$form_to}\""; ?>>
        </fieldset>
        <fieldset name="fieldsubject" form="emailform">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" required <?php if($error) print "value=\"{$form_subject}\""; ?>>
        </fieldset>
        <fieldset>
            <textarea name="emailbody" id="emailbody" cols="30" rows="10" placeholder="Type your message here."><?php if($error) print $form_content; ?></textarea>
        </fieldset>
        <div class="formbuttons">
            <button type="submit" name="submitted" value="emailform">Send</button>
        </div>
    </form>
    <?php if($message): ?>
    <?php foreach($message as $line): ?>
    <div class="notif">
        <p><?php echo $line; ?></p>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>