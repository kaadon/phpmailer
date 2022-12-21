<?php

namespace Kaadon\PhpMailer;

use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport as Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

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
     * @return void
     * @throws \Exception
     */
    public function SetTo(?string $to)
    {
        if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->to = $to;
        $this->email->to($this->to);
    }

    /**
     * @param string|null $cc
     * @return void
     * @throws \Exception
     */
    public function setCc(?string $cc)
    {
        if (!filter_var($cc, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->cc = $cc;
        $this->email->cc($this->cc);
    }

    /**
     * @param string|null $bcc
     * @return void
     * @throws \Exception
     */
    public function setBcc(?string $bcc)
    {
        if (!filter_var($bcc, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->bcc = $bcc;
        $this->email->bcc($this->bcc);
    }

    /**
     * @param null $replyTo
     */
    public function setReplyTo($replyTo): void
    {
        if (!filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Illegal post box format");
        }
        $this->replyTo = $replyTo;
        $this->email->replyTo($this->replyTo);
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
        $this->email->subject($this->subject);
    }

    /**
     * @param null $html
     */
    public function setHtml($html): void
    {
        $this->html = $html;
        $this->email->html($this->html);

    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
        $this->email->text($this->text);
    }

    /**
     * @param string|null $priority
     * @return void
     */
    public function setPriority(?string $priority = null): void
    {
        if (is_null($priority)) $priority = Email::PRIORITY_HIGH;
        $this->priority = $priority;
        $this->email->priority($this->priority);
    }

    /**
     * @return void
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function Send()
    {
        if (empty($this->to) && empty($this->replyTo)) {
            throw new \Exception("Lack of recipients");
        }
        if (empty($this->text) && empty($this->html)) {
            throw new \Exception("Lack of sending content");
        }
        return $this->mailer->send($this->email);
    }
}