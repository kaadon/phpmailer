<?php
require_once "vendor/autoload.php";

$GM = (new \Kaadon\PhpMailer\GmailSender([
    "username" => "",
    "password" => ""
]));
$GM->setTo("")->setText("123456")->Send();