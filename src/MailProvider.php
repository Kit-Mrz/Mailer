<?php

namespace Mrzkit\Mailer;

use Mrzkit\Mailer\Contracts\ConnectorContract;
use Mrzkit\Mailer\Contracts\MailConfigContract;
use Mrzkit\Mailer\Contracts\MailProviderContract;

class MailProvider implements MailProviderContract
{
    /**
     * @var MailConfigContract
     */
    private $mailConfigContract;

    public function __construct(MailConfigContract $mailConfigContract)
    {
        $this->mailConfigContract = $mailConfigContract;
    }

    public function getMailConfigContract() : MailConfigContract
    {
        return $this->mailConfigContract;
    }

    public function getConnectorContract() : ConnectorContract
    {
        return new MailConnector($this->getMailConfigContract());
    }

    public function getMailer() : Mailer
    {
        return new Mailer($this->getConnectorContract());
    }
}
