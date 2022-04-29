<?php

namespace Mrzkit\Mailer\Contracts;

use Mrzkit\Mailer\MailConnector;
use Mrzkit\Mailer\Mailer;

class DefaultOfferMailer implements OfferMailerContract
{
    public function getMailer() : Mailer
    {
        return new Mailer(new MailConnector());
    }
}
