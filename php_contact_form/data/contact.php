<?php
if(empty($_POST)) {
    echo 'No...';
    exit;
}

    $name = '';
    $email = '';
    $subject = '';
    $message = '';
    $recipient = 'alissar@arnaout.com';

    // some validations
    if(isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }

    if(isset($_POST['email'])) {
        $email = str_replace(array("\r","\n","%0a","%0d"),'',$_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    if(isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    }

    if(isset($_POST['message'])) {
        $message = $_POST['message'];
    }

    //TODO: set up noreply email on your domain
    // then replace following email with noreply email
    $headers = [
        'From'=> 'noreply@test.ca',
        'Reply-To'=>$name. '<'.$email.'>'
    ];

    if(mail($recipient, $subject, $message, $headers)) {
        echo '<p>Thank you for contacting me,'.$name.'. You will get a reply within 24h </p>';
    }else{
        echo '<p>We are sorry but the email did not go through</p>';
    }
?>