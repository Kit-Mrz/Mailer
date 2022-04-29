<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\MailConfigContract;
use Mrzkit\Mailer\Contracts\MailTransferContractContractContract;

class SenderFactory
{
    public static function sender(MailTransferContractContractContract $mailTransferContract, MailConfigContract $mailConfigContract) : bool
    {
        $mailProvider = new MailProvider($mailConfigContract);

        $sender = new Sender($mailTransferContract, $mailProvider);

        return $sender->send();
    }

    public static function send(array $params) : bool
    {
        $mailTransfer = new MailTransfer();

        $mailTransfer->setFrom($params['from'])
            ->setSubject($params['subject'])
            ->setBody($params['body'])
            ->setRecipients($params['recipients'])
            ->setReplyTo($params['replyTo'] ?? $params['from'])
            ->setCC($params['cc'] ?? [])
            ->setBCC($params['bcc'] ?? [])
            ->setAttachments($params['attachments'] ?? []);

        $defaultMailConfig = new DefaultMailConfig();

        $send = static::sender($mailTransfer, $defaultMailConfig);

        return $send;
    }
}