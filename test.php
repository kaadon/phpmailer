<?php
require_once "vendor/autoload.php";

$GM = (new \Kaadon\PhpMailer\GmailSender([
    "username" => "mengxiaoxiao.com@gmail.com",
    "password" => "nsigvqffqiyylgkn"
]));

try {
    $context = [
        "server" => [
            "member"         => "usdtcloud@gmail.com",
            "time"         => date("Y-m-d H:i:s"),
            "node"           => "韩国",
            "ip"             => "103.86.47.17",
            "payment_method" => "按月支付",
            "payment_price"  => "US$29",
        ]
    ];
    $GM->setTo("usdtcloud@gmail.com")
        ->setSubject("服务续费通知")
        ->setTwigTemplates("/Volumes/SourceData/composer/phpmailer/twig_templates","product.html",$context)
        ->Send();
}catch (Exception $exception){
    var_dump($exception->getMessage());
}
