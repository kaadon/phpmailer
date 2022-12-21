<?php
require_once "vendor/autoload.php";

//use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport as Transport;
//use Symfony\Component\Mailer\Mailer;
//
//$transport = new Transport("usdtcloud@gmail.com","");
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


$GM = (new \Kaadon\PhpMailer\GmailSender([
    "username" => "usdtcloud@gmail.com",
    "password" => ""
]));
$GM->setTo("ipioonet@gmail.com")->setText("123456")->Send();