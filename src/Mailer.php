<?php

namespace App\Cores\Mailer;

use PHPMailer\PHPMailer\PHPMailer;
use RuntimeException;

class Mailer
{
    /**
     * @var MailerConnect
     */
    protected $mailer;

    /**
     * @desc 邮件实例
     * @return PHPMailer
     */
    protected function getMailer() : PHPMailer
    {
        if (is_null($this->mailer)) {
            $this->mailer = app(MailerConnect::class);
        }

        return $this->mailer->getMailer();
    }

    /**
     * @desc 发件人
     * @param string $address
     * @param string $name
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function setFrom(string $address, string $name = '') : bool
    {
        if ( !$this->getMailer()->setFrom($address, $name)) {
            throw new RuntimeException($this->getMailer()->ErrorInfo);
        }

        return true;
    }

    /**
     * @desc 收件人(可多个)
     * @param array $recipients
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function addRecipients(array $recipients) : bool
    {
        foreach ($recipients as $recipient) {
            if ( !$this->getMailer()->addAddress($recipient['address'], $recipient['name'])) {
                throw new RuntimeException($this->getMailer()->ErrorInfo);
            }
        }

        return true;
    }

    /**
     * @desc 回复
     * @param string $address
     * @param string $name
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function addReplyTo(string $address, string $name = '') : bool
    {
        if ( !$this->getMailer()->addReplyTo($address, $name)) {
            throw new RuntimeException($this->getMailer()->ErrorInfo);
        }

        return true;
    }

    /**
     * @desc 抄送(可多个)
     * @param array $recipients
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function addCC(array $recipients) : bool
    {
        foreach ($recipients as $recipient) {
            if ( !$this->getMailer()->addCC($recipient['address'], $recipient['name'])) {
                throw new RuntimeException($this->getMailer()->ErrorInfo);
            }
        }

        return true;
    }

    /**
     * @desc 密送
     * @param array $recipients
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function addBCC(array $recipients) : bool
    {
        foreach ($recipients as $recipient) {
            if ( !$this->getMailer()->addBCC($recipient['address'], $recipient['name'])) {
                throw new RuntimeException($this->getMailer()->ErrorInfo);
            }
        }

        return true;
    }

    /**
     * @desc 是否 HTML
     * @param bool $isHtml
     */
    public function isHTML($isHtml = true)
    {
        $this->getMailer()->isHTML($isHtml);
    }

    /**
     * @desc 标题
     * @param string $subject
     * @return bool
     */
    public function setSubject(string $subject) : bool
    {
        if (empty($subject)) {
            throw new RuntimeException('Subject Empty.');
        }

        $this->getMailer()->Subject = $subject;

        return true;
    }

    /**
     * @desc 主体
     * @param string $body
     * @return bool
     */
    public function setBody(string $body) : bool
    {
        if (empty($body)) {
            throw new RuntimeException('Body Empty.');
        }

        $this->getMailer()->Body = $body;

        return true;
    }

    /**
     * @desc 附件
     * @param array $attachments
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function addAttachments(array $attachments) : bool
    {
        foreach ($attachments as $attachment) {
            if ( !file_exists($attachment['path'])) {
                throw new RuntimeException('Invalid argument path. File Not Exists.');
            }

            if ( !$this->getMailer()->addAttachment($attachment['path'], $attachment['name'] ?? '', $attachment['encoding'] ?? 'base64', $attachment['type'] ?? '')) {
                throw new RuntimeException($this->getMailer()->ErrorInfo);
            }
        }

        return true;
    }

    /**
     * @desc 发送邮件
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function send()
    {
        return $this->getMailer()->send();
    }
}
