<?php

namespace Mrzkit\Mailer;

use RuntimeException;

class Sender
{
    private static $mailer;

    private $mailTransfer;

    public function __construct(MailTransfer $mailTransfer)
    {
        $this->mailTransfer = $mailTransfer;
    }

    public static function getMailer() : Mailer
    {
        if (is_null(static::$mailer)) {
            static::$mailer = new Mailer(new MailConnector());
        }

        return static::$mailer;
    }

    /**
     * @return MailTransfer
     */
    public function getMailTransfer() : MailTransfer
    {
        return $this->mailTransfer;
    }

    public function send()
    {
        try {
            $mailTransfer = $this->getMailTransfer();

            $mailer = static::getMailer();

            $from = $mailTransfer->getFrom();
            $mailer->setFrom($from['address'], $from['name']);

            $recipients = $mailTransfer->getRecipients();
            $mailer->addRecipients($recipients);

            $replyTo = $mailTransfer->getReplyTo();
            $mailer->addReplyTo($replyTo['address'], $replyTo['name']);

            $cc = $mailTransfer->getCC();
            $mailer->addCC($cc);

            $bcc = $mailTransfer->getBCC();
            $mailer->addBCC($bcc);

            $subject = $mailTransfer->getSubject();
            $mailer->setSubject($subject);

            $body = $mailTransfer->getBody();
            $mailer->setBody($body);

            $attachments = $mailTransfer->getAttachments();
            $mailer->addAttachments($attachments);

            $isHtml = $mailTransfer->isHtml();
            $mailer->isHTML($isHtml);

            return $mailer->send();
        } catch (RuntimeException $e) {
            $translateSmtpErrorInfo = new TranslateSmtpErrorInfo($e->getMessage());

            $info = $translateSmtpErrorInfo->translateErrorInfo();

            throw new SenderException($info);
        }
    }
}
