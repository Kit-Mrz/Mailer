<?php

namespace Mrzkit\Mailer\Contracts;

use Mrzkit\Mailer\Mailer;

interface MailProvider
{
    public function getMailer() : Mailer;
}
