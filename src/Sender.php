<?php

namespace Mrzkit\Mailer;

use MrzKit\Mailer\Contract\TranslateSmtpErrorInfo;
use RuntimeException;

trait Sender
{
    public function send()
    {
        try {
            $mailer = new Mailer(new MailConnector());

            $from = $this->getFrom();
            $mailer->setFrom($from['address'], $from['name']);

            $recipients = $this->getRecipients();
            $mailer->addRecipients($recipients);

            $replyTo = $this->getReplyTo();
            $mailer->addReplyTo($replyTo['address'], $replyTo['name']);

            $cc = $this->getCC();
            $mailer->addCC($cc);

            $bcc = $this->getBCC();
            $mailer->addBCC($bcc);

            $subject = $this->getSubject();
            $mailer->setSubject($subject);

            $body = $this->getBody();
            $mailer->setBody($body);

            $attachments = $this->getAttachments();
            $mailer->addAttachments($attachments);

            $isHtml = $this->isHtml();
            $mailer->isHTML($isHtml);

            return $mailer->send();
        } catch (RuntimeException $e) {
            $info = TranslateSmtpErrorInfo::translateErrorInfo($e->getMessage());

            throw new SenderException($info);
        }
    }
}
