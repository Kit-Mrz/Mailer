<?php

namespace Mrzkit\Mailer\Contracts;

interface MailGetter
{
    /**
     * @return array
     */
    public function getFrom() : array;

    /**
     * @return array
     */
    public function getRecipients() : array;

    /**
     * @return array
     */
    public function getReplyTo() : array;

    /**
     * @return array
     */
    public function getCc() : array;

    /**
     * @return array
     */
    public function getBcc() : array;

    /**
     * @return string
     */
    public function getSubject() : string;

    /**
     * @return string
     */
    public function getBody() : string;

    /**
     * @return array
     */
    public function getAttachments() : array;

    /**
     * @return bool
     */
    public function isHtml() : bool;
}
