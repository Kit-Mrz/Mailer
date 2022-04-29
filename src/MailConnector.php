<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\ConnectorContract;
use Mrzkit\Mailer\Contracts\MailConfigContract;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailConnector implements ConnectorContract
{
    /**
     * @var PHPMailer
     */
    protected $phpMailer;

    /**
     * @var MailConfigContract
     */
    protected $mailConfigContract;

    public function __construct(MailConfigContract $mailConfigContract)
    {
        $this->mailConfigContract = $mailConfigContract;

        $this->setMailer();
    }

    /**
     * @return MailConfigContract
     */
    public function getMailConfigContract() : MailConfigContract
    {
        return $this->mailConfigContract;
    }

    /**
     * @desc 创建邮箱实例
     * @return $this
     */
    public function setMailer()
    {
        /*
        $config = [
            // 便于开启调试信息
            'debug'         => (bool) ($config['debug'] ?? false),
            'exceptions'    => (bool) ($config['exceptions'] ?? true), //Create an instance; passing `true` enables exceptions
            'SMTPAuth'      => (bool) ($config['SMTPAuth'] ?? true), //Enable SMTP authentication
            'SMTPSecure'    => (string) ($config['SMTPSecure'] ?? PHPMailer::ENCRYPTION_SMTPS),
            'SMTPAutoTLS'   => (bool) ($config['SMTPAutoTLS'] ?? false),  // Disable Auto TLS authentication
            'SMTPKeepAlive' => (bool) ($config['SMTPKeepAlive'] ?? true),
            'CharSet'       => (string) ($config['CharSet'] ?? PHPMailer::CHARSET_UTF8),

            'host'     => (string) ($config['host'] ?? ""), // Specify main and backup SMTP servers
            'port'     => (int) ($config['port'] ?? 465), // TCP port to connect to
            'username' => (string) ($config['username'] ?? ""), // SMTP username
            'password' => (string) ($config['password'] ?? ""),  // SMTP password
            'timeout'  => (string) ($config['timeout'] ?? 20), // 超时设为20秒
        ];
         */
        $mailConfigContract = $this->getMailConfigContract();

        $mail = new PHPMailer($mailConfigContract->getExceptions());

        $mail->SMTPDebug     = $mailConfigContract->getDebug() ? SMTP::DEBUG_LOWLEVEL : SMTP::DEBUG_OFF;
        $mail->SMTPAuth      = $mailConfigContract->getSMTPAuth();
        $mail->SMTPSecure    = $mailConfigContract->getSMTPSecure();
        $mail->SMTPAutoTLS   = $mailConfigContract->getSMTPAutoTLS();
        $mail->SMTPKeepAlive = $mailConfigContract->getSMTPKeepAlive();
        $mail->CharSet       = $mailConfigContract->getCharSet();
        $mail->Host          = $mailConfigContract->getHost();
        $mail->Port          = $mailConfigContract->getPort();
        $mail->Username      = $mailConfigContract->getUsername();
        $mail->Password      = $mailConfigContract->getPassword();
        $mail->Timeout       = $mailConfigContract->getTimeout();

        $this->phpMailer = $mail;

        return $this;
    }

    /**
     * @desc 获取邮箱实例
     * @return PHPMailer
     */
    public function phpMailer() : PHPMailer
    {
        return $this->phpMailer;
    }
}
