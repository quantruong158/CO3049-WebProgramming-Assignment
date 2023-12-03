<?php
function mailInit($mail)
{
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = ''; //update here
    $mail->Password = ''; //update here
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom(''); //update here
}
