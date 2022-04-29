<?php

namespace Mrzkit\Mailer\Contracts;

use Mrzkit\Mailer\Mailer;

interface OfferMailerContract
{
    public function getMailer() : Mailer;
}
