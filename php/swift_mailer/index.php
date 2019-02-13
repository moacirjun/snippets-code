<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./PatrimonioMail.php";

$mail = new PatrimonioMail();

$mail->message
    ->setTo(['dev@lbz.agency' => 'Dev'])
    ->setBody('Here is the message itself')
    ;

$result = $mail->send();

echo $result;