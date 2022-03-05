<?php

namespace Mrzkit\Mailer\Contracts;

interface MailSetter
{
    /**
     * @param array $from
     * @return MailSetter
     */
    public function setFrom(array $from);

    /**
     * @param array $recipients
     * @return MailSetter
     */
    public function setRecipients(array $recipients);

    /**
     * @param array $replyTo
     * @return MailSetter
     */
    public function setReplyTo(array $replyTo);

    /**
     * @param array $cc
     * @return MailSetter
     */
    public function setCc(array $cc);

    /**
     * @param array $bcc
     * @return MailSetter
     */
    public function setBcc(array $bcc);

    /**
     * @param string $subject
     * @return MailSetter
     */
    public function setSubject(string $subject);

    /**
     * @param string $body
     * @return MailSetter
     */
    public function setBody(string $body);

    /**
     * @param array $attachments
     * @return MailSetter
     */
    public function setAttachments(array $attachments);

    /**
     * @param bool $isHtml
     * @return MailSetter
     */
    public function setIsHtml(bool $isHtml);

}
