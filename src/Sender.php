<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\MailTransferContract;
use Mrzkit\Mailer\Contracts\SenderContract;
use RuntimeException;

class Sender implements SenderContract
{
    /** @var MailTransferContract */
    private $mailTransferContract;

    /** @var Mailer */
    protected static $mailer;

    public function __construct(MailTransferContract $mailTransferContract)
    {
        $this->mailTransferContract = $mailTransferContract;
    }

    /**
     * @desc Mailer
     * @param bool $force
     * @return Mailer
     */
    public static function mailer(bool $force = false) : Mailer
    {
        if ($force) {
            static::$mailer = new Mailer(new MailConnector());
        }

        if (is_null(static::$mailer)) {
            static::$mailer = new Mailer(new MailConnector());
        }

        return static::$mailer;
    }

    /**
     * @return MailTransferContract
     */
    private function getMailTransferContract() : MailTransferContract
    {
        return $this->mailTransferContract;
    }

    /**
     * @desc 发送
     * @return bool
     * @throws SenderException
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function send() : bool
    {
        try {
            $mailTransfer = $this->getMailTransferContract();
            $mailer       = $this->mailer();

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
            //
        } catch (RuntimeException $e) {
            //
            $translateSmtpErrorInfo = new TranslateSmtpErrorInfo($e->getMessage());

            $info = $translateSmtpErrorInfo->translateErrorInfo();

            throw new SenderException($info);
        }
    }
}
