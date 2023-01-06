<?php
require_once "vendor/autoload.php";
$context = [
    "logo"                => "https://statics.boolcdn.net/logo/kaadon/icon_512x512@2x.png",
    "title"               => "你正在进行登录认证",
    "code"                => "012356",
    "text_title"          => "你正在进行登录操作,你的账户为:usdtcloud@gmail.com, 请及时输入验证码进行验证",
    "text_identify"       => "Use this code to complete the login verification operation",
    "text_hint"           => "This code will expire in 24 hours",
    "text_important_hint" => "您收到了此电子邮件，此电子邮件对于您非常重要!请不要告诉他人",
    "text_reply_hint"     => "此邮件为系统邮件,请勿回复",
];
$GM      = (new \Kaadon\PhpMailer\GmailSender([
    "username" => "usdtcloud@gmail.com",
    "password" => "luyvlirbpnxowrmn"
]));
$GM->setTo("ipioonet@gmail.com")
    ->setSubject("服务续费通知")
    ->setTwigTemplates("/Volumes/SourceData/composer/phpmailer/twig_templates", "vercode.html", $context)
    ->Send();

