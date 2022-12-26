<?php
require_once "vendor/autoload.php";
$context = [
    "server" => [
        "member"         => "ipioonet@gmail.com",
        "time"         => date("Y-m-d H:i:s"),
        "node"           => "韩国",
        "ip"             => "103.86.47.17",
        "payment_method" => "按月支付",
        "payment_price"  => "US$29",
    ]
];
$GM = (new \Kaadon\PhpMailer\GmailSender([
    "username" => "usdtcloud@gmail.com",
    "password" => "luyvlirbpnxowrmn"
]));
$GM->setTo("ipioonet@gmail.com")->setSubject("服务续费通知")->setTwigTemplates("/Volumes/SourceData/composer/phpmailer/twig_templates","server.html",$context)->Send();

