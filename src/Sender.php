<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\MailProviderContract;
use Mrzkit\Mailer\Contracts\MailTransferContractContractContract;
use Mrzkit\Mailer\Contracts\SenderContract;
use Exception;

class Sender implements SenderContract
{
    /** @var MailTransferContractContractContract */
    private $mailTransferContract;

    /** @var MailProviderContract */
    private $mailProviderContract;

    public function __construct(MailTransferContractContractContract $mailTransferContract, MailProviderContract $mailProviderContract)
    {
        $this->mailTransferContract = $mailTransferContract;

        $this->mailProviderContract = $mailProviderContract;
    }

    /**
     * @return MailTransferContractContractContract
     */
    public function getMailTransferContract() : MailTransferContractContractContract
    {
        return $this->mailTransferContract;
    }

    /**
     * @return MailProviderContract
     */
    public function getMailProviderContract() : MailProviderContract
    {
        return $this->mailProviderContract;
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

            $mailer = $this->getMailProviderContract()->getMailer();

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
        } catch (Exception $e) {
            //
            $translateSmtpErrorInfo = new TranslateSmtpErrorInfo($e->getMessage());

            $info = $translateSmtpErrorInfo->translateErrorInfo();

            throw new SenderException($info);
        }
    }
}
