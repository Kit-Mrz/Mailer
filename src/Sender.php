<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\MailTransferContract;
use Mrzkit\Mailer\Contracts\OfferMailerContract;
use Mrzkit\Mailer\Contracts\SenderContract;
use Exception;

class Sender implements SenderContract
{
    /** @var MailTransferContract */
    private $mailTransferContract;

    /** @var OfferMailerContract OfferMailerContract */
    private $offerMailerContract;

    public function __construct(MailTransferContract $mailTransferContract, OfferMailerContract $offerMailerContract)
    {
        $this->mailTransferContract = $mailTransferContract;

        $this->offerMailerContract = $offerMailerContract;
    }

    /**
     * @return MailTransferContract
     */
    public function getMailTransferContract() : MailTransferContract
    {
        return $this->mailTransferContract;
    }

    /**
     * @return OfferMailerContract
     */
    public function getOfferMailerContract() : OfferMailerContract
    {
        return $this->offerMailerContract;
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

            $mailer = $this->getOfferMailerContract()->getMailer();

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
