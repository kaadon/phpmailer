<?php

namespace Kaadon\PhpMailer;

use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport as Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Twig\Loader\FilesystemLoader;

/**
 *
 */
class GmailSender
{
    /**
     * @var Email
     */
    protected $email;
    /**
     * @var Mailer
     */
    protected $mailer;


    /**
     * @var mixed
     */
    protected $from;

    /**
     * @var null
     */
    protected $to = null;
    /**
     * @var null
     */
    protected $cc = null;
    /**
     * @var null
     */
    protected $bcc = null;
    /**
     * @var null
     */
    protected $replyTo = null;
    /**
     * @var null
     */
    protected $priority = null;
    /**
     * @var string
     */
    protected $subject = '';
    /**
     * @var string
     */
    protected $text = '';
    /**
     * @var null
     */
    protected $html = null;

    /**
     * @param array $config
     * @throws \Exception
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['username']) || !isset($config['password'])) {
            throw new \Exception("Account information cannot be empty");
        }
        $transport    = new Transport($config['username'], $config['password']);
        $this->from   = $config['username'];
        $this->mailer = (new Mailer($transport));
        $this->email  = (new Email())->from($config['username']);
    }

    /**
     * @param string|null $to
     * @return $this
     * @throws \Exception
     */
    public function setTo(?string $to)
    {
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->to = $to;
        $this->email->to($this->to);
        return $this;
    }

    /**
     * @param string|null $cc
     * @return $this
     * @throws \Exception
     */
    public function setCc(?string $cc)
    {
        if (!filter_var($cc, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->cc = $cc;
        $this->email->cc($this->cc);

        return $this;
    }


    /**
     * @param string|null $bcc
     * @return $this
     * @throws \Exception
     */
    public function setBcc(?string $bcc)
    {
        if (!filter_var($bcc, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->bcc = $bcc;
        $this->email->bcc($this->bcc);

        return $this;
    }

    /**
     * @param $replyTo
     * @return $this
     * @throws \Exception
     */
    public function setReplyTo($replyTo)
    {
        if (!filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->replyTo = $replyTo;
        $this->email->replyTo($this->replyTo);

        return $this;
    }


    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        $this->email->subject($this->subject);
        return $this;
    }


    /**
     * @param $html
     * @return $this
     */
    public function setHtml($html)
    {
        $this->html = $html;
        $this->email->html($this->html);
        return $this;

    }

    /**
     * 设置模板
     * @param string $path //模板目录
     * @param $filename //模板文件
     * @param array $context //传递参数
     * @param array $options //传递配置
     * @return $this
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function setTwigTemplates(string $path, string $filename, array $context = [], array $options = [])
    {
        $loader     = new FilesystemLoader($path);
        $twig       = new \Twig\Environment($loader, $options);
        $this->html = $twig->render($filename, $context);
        $this->email->html($this->html);
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText(string $text)
    {
        $this->text = $text;
        $this->email->text($this->text);
        return $this;
    }


    /**
     *
     * @param string|null $priority
     * @return $this
     */
    public function setPriority(?string $priority = null)
    {
        if (is_null($priority)) $priority = Email::PRIORITY_HIGH;
        $this->priority = $priority;
        $this->email->priority($this->priority);
        return $this;
    }


    /**
     * 发送
     * @return bool
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function Send(): bool
    {
        if (empty($this->to) && empty($this->replyTo)) {
            throw new \Exception("Lack of recipients");
        }
        if (empty($this->text) && empty($this->html)) {
            throw new \Exception("Lack of sending content");
        }
        if (empty($this->priority)) {
            $this->setPriority();
        }

        if (empty($this->subject)) {
            $this->setSubject("This is a test email, without the theme of email.");
        }
        try {
            $this->mailer->send($this->email);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
        return true;
    }
}