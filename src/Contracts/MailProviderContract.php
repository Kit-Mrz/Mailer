<?php

namespace Mrzkit\Mailer\Contracts;

use Mrzkit\Mailer\Mailer;

interface MailProviderContract
{
    public function getMailer() : Mailer;
}
