<?php
require_once "vendor/autoload.php";

//use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport as Transport;
//use Symfony\Component\Mailer\Mailer;
//
//$transport = new Transport("usdtcloud@gmail.com","luyvlirbpnxowrmn");
//$mailer = new Mailer($transport);
////
//$email = (new \Symfony\Component\Mime\Email())
//    ->from('usdtcloud@gmail.com')
//    ->to('ipioonet@gmail.com')
//    //->cc('cc@example.com')
//    //->bcc('bcc@example.com')
//    //->replyTo('fabien@example.com')
//    //->priority(Email::PRIORITY_HIGH)
//    ->subject('Time for Symfony Mailer!')
//    ->text('Sending emails is fun again!')
//    ->html('<p style="color: blue">See Twig integration for better HTML integration!</p>');
//
//$bool = $mailer->send($email);
//var_dump($bool);


$email = 'runoob.com@runoob.com';  //邮箱地址
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailMsg = "正确邮箱格式";
} else {
    $emailMsg = "非法邮箱格式";
}
echo $emailMsg;