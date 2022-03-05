<?php

namespace Mrzkit\Mailer\Contracts;

interface SenderContract
{
    /**
     * @desc 邮件发送
     * @return bool
     */
    public function send() : bool;
}
