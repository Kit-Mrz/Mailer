<?php

namespace Mrzkit\Mailer\Contracts;

use Mrzkit\Mailer\DefaultMailConfig;
use Mrzkit\Mailer\MailConnector;
use Mrzkit\Mailer\Mailer;

class DefaultMailProvider implements MailProviderContract
{
    public function getMailer() : Mailer
    {
        return new Mailer(new MailConnector(new DefaultMailConfig()));
    }
}
