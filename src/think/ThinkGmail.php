<?php

namespace Kaadon\PhpMailer\think;

use Kaadon\PhpMailer\GmailSender;
use think\facade\Config;

/**
 *
 */
class ThinkGmail extends GmailSender
{
    protected static $instance;
    /**
     * @param array $config
     * @throws \Exception
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }
    public static function instance(){
        if(is_null(self::$instance)){
            $config = [];
            if (Config::has("kaadon.phpmailer.gmail")) {
                $config = Config::get("kaadon.phpmailer.gmail");
            }
            if (!isset($config['username'])) throw new Exception("Key does not exist");
            self::$instance= new static($config);
        }
        return self::$instance;
    }
    /**
     * @param string $code
     * @param string $title
     * @param string $text_title
     * @param string $logo
     * @param string $text_hint
     * @param string $text_identify
     * @param string $text_important_hint
     * @param string $text_reply_hint
     * * example [    "logo"                => "https://statics.boolcdn.net/logo/kaadon/icon_512x512@2x.png",
     * *              "title"               => "you are logging in",
     * *              "code"                => "012356",
     * *              "text_title"          => "You are logging in, your account is: usdtcloud@gmail.com, please enter the verification code in time for verification",
     * *              "text_identify"       => "Use this code to complete the login verification operation",
     * *              "text_hint"           => "This code will expire in 24 hours",
     * *              "text_important_hint" => "You have received this email, this email is very important to you! Please do not tell others",
     * *              "text_reply_hint"     => "This email is a system email, please do not reply"
     * *         ]
     * @return $this
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendTemplateVerificationCode(string $code, string $title, string $text_title, string $logo, string $text_hint, string $text_identify, string $text_important_hint, string $text_reply_hint)
    {
        $context = [
            "logo"                => $logo,
            "title"               => $title,
            "code"                => $code,
            "text_title"          => $text_title,
            "text_identify"       => $text_identify,
            "text_hint"           => $text_hint,
            "text_important_hint" => $text_important_hint,
            "text_reply_hint"     => $text_reply_hint,
        ];
        $this->setTwigTemplates("/Volumes/SourceData/composer/phpmailer/twig_templates", "vercode.html", $context);
        return $this;
    }
}